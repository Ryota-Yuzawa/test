@extends('layouts.app')

@section('content')
<div>
    <h1>商品詳細画面</h1>
    <a href="{{ route('index') }}">戻る</a>
</div>
<div>
    <div>
        <div>ID: {{ $product->id}} </div>
        <div>商品画像：<img src="{{'/public/storage/'. $product['img_path']}}"></div>
        <div>商品名：{{ $product->product_name }} </div>
        <div>メーカー名： {{ $product->company->company_name }} </div>
        <div>価格： {{ $product->price }} </div>
        <div>在庫数： {{ $product->stock }} </div>
        <div>商品詳細： {{ $product->comment }} </div>
    </div>
    <div><a href="{{ route('edit', $product->id) }}">編集</div>
</div>
@endsection
