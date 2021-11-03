<?php

namespace Modules\Purchase\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Entities\Product;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = ['user_id' , 'product_id' ,'paid' , 'refID' ,'authority' , 'amount'];
    
    protected static function newFactory()
    {
        return \Modules\Purchase\Database\factories\PurchaseFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
