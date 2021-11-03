<?php

namespace Modules\Purchase\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Product\Entities\Product;
use Modules\Purchase\Entities\Purchase;
use Modules\Purchase\Http\Services\PaymentService;
use Zarinpal\Laravel\Facade\Zarinpal;


class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $purchases = $user->purchases;
        return response()->json([
            $purchases
        ]);

    }

//purchase
    public function purchase(Product $product)
    {
        $results = Zarinpal::request(
            url(route('callback')),
            $product->price,
            'خرید شارژ'
        );


        if (isset($results['Authority']) && !empty($results['Authority'])) {
            $this->createPurchase($product, $results);

            Zarinpal::redirect();
        } else
            return  PaymentService::failPayment();
    }

//callback
    public function callback()
    {
        $authority = \request('Authority');
        $order = $this->findPurchase($authority);

        if (!$order || !$authority) {
            return PaymentService::failPayment();
        }
        $verified_request = Zarinpal::verify('ok', $order->amount, $authority);

        if ($verified_request['Status'] === 'success') {
            $this->paidPurchase($order, $verified_request);

//            paid successfully and code will be show to buyer
            return PaymentService::successPayment($order);

        } else
          return PaymentService::failPayment();

    }

    /**
     * @param $product
     * @param $results
     */
    protected function createPurchase($product, $results)
    {
        Purchase::query()->create([
            'user_id' => 1,
            'product_id' => $product->id,
            'amount' => $product->price,
            'paid' => 0,
            'authority' => $results['Authority'],
        ]);
    }

    protected function findPurchase($authority)
    {
        $order = Purchase::query()->firstWhere('authority', $authority);
        return $order;
    }

    protected function paidPurchase($order, $verified_request)
    {
        $order->update([
            'paid' => 1,
            'refID' => $verified_request['RefID'],
        ]);
    }


}
