@extends('layouts.app')

@section('content')
<div>
    <h1>商品編集画面</h1>
    <a href="{{ route('index') }}">戻る</a>
</div>
<div>
    <form action="{{ route('update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div><lavel>ID: {{ $product->id}} </lavel></div>
        <div>
            <lavel>商品名：</lavel>
            <input type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}" placeholder="商品名">
            @error('product_name')
            <span style="color:red;">{{$message}}</span>
            @enderror
        </div>
        <div>
            <lavel>メーカー名：</lavel>
            <select name="company_id">
                @foreach($companies as $company)
                <option value="{{$company->id}}">{{$company->company_name}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <lavel>価格：</lavel>
            <input type="text" name="price" value="{{ old('price', $product->price) }}" placeholder="価格">
            @error('price')
            <span style="color:red;">{{$message}}</span>
            @enderror
        </div>
        <div>
            <lavel>在庫数：</lavel>
            <input type="text" name="stock" value="{{ old('stock', $product->stock) }}" placeholder="在庫数">
            @error('stock')
            <span style="color:red;">{{$message}}</span>
            @enderror
        </div>
        <div>
            <lavel>コメント：</lavel>
            <input type="text" name="comment" value="{{ old('comment', $product->comment) }}" placeholder="コメント">
            @error('comment')
            <span style="color:red;">{{$message}}</span>
            @enderror
        </div>
        <div>
            <lavel>画像：</lavel>
            <input type="file" name="img_path">
        </div>
        <input type="submit" value="更新">
    </from>
</div>
@endsection
