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
            {{--<button--}}
                {{--onclick="purchase({{$product->id}})"--}}
                {{--data-url="{{route('purchase' , $product->id)}}"--}}
                {{--data-id="{{$product->id}}"--}}
            {{-->--}}
                {{--خرید--}}
            {{--</button>--}}
        </div>
    @endforeach
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    // $(document).ready(function () {


        function purchase(id) {
            let element = $('#' + id);
            let url = element.attr('data-url');
            $.ajax({
                url: "api/purchase/"+id,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.status) {
                        console.log(response)
                    }
                },
            });
        }
    // });
</script>
