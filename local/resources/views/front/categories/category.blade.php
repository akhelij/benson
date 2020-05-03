@extends('layouts.front.app')

@section('og')
    <meta property="og:type" content="category"/>
    <meta property="og:title" content="{{ $category->name }}"/>
    <meta property="og:description" content="{{ $category->description }}"/>
    @if(!is_null($category->cover))
        <meta property="og:image" content="{{ asset("storage/$category->cover") }}"/>
    @endif
@endsection

@section('content')
    <div class="container" style="margin-top:10%">
            
        @include('front.products.product-list', ['products' => $products,'currency' => $currency,'currency_diff' => $currency_diff])
           
    </div>
@endsection
