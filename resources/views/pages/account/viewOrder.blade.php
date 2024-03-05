@extends('layouts.default')
@section('title', 'Your Order')

@php
    $theOrder = \App\Models\Order::find($order->id);

@endphp

@section('content')

    <h1> Order #{{$order->id}}</h1>
    <h2> Order Status: {{$order->status}}</h2>
    <h3> Total Value of Order: £{{$order->totalValue}}</h3>
<br>
    <h2>Your Order Contents:</h2>
<div class="form">
    <form class="account-form">
    <table class="table">
        <thead>
        <th>Product Image</th>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Price</th>
        @if($order->status === 'Ordered')
            <th>Returns</th>
        @endif
        </thead>
        @foreach($theOrder->products as $product)
            @php
                $imgPath = '/images/products/' . $product->mainImage;
            @endphp
            <tr>
                <td><img src="{{ $imgPath }}" alt="Image of the Product" width="100px" id="product-view-image"></td>
                <td>{{$product->id}}</td>
                <td><a target="_blank" href="/products/{{$product->id}}">{{$product->name}} </a></td>
                <td>£{{$product->price}}</td>
                @if($order->status === 'Ordered')
                    <td>Return Item</td>
                @endif
            </tr>
        @endforeach

    </table>
@endsection
</form>
</div>
