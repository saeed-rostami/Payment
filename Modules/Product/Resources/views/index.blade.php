@extends('product::layouts.master')

@section('content')
    <h1>Hello World</h1>

    @foreach($products as $product)
        <div>
            <p>{{$product->name}}</p>
            <form action="{{route('purchase' , $product->id)}}" method="post">
                @csrf
                <button class="btn" type="submit">خرید</button>
            </form>
           
        </div>
    @endforeach
@endsection

