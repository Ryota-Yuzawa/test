@extends('layouts.app')

@section('content')
<div>
    <h1>商品新規登録画面</h1>
    <a href="{{ route('index') }}">戻る</a>
</div>
<div>
    <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form">
            <lavel>商品名：</lavel>
            <input type="text" name="product_name" value="{{ old('product_name') }}" placeholder="商品名">
            @error('product_name')
            <span style="color:red;">{{$message}}</span>
            @enderror
        </div>
        <div class="form">
            <lavel>メーカー名：</lavel>
            <select name="company_id">
                @foreach($companies as $company)
                <option value="{{$company->id}}">{{$company->company_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form">
            <lavel>価格：</lavel>
            <input type="text" name="price" value="{{ old('price') }}" placeholder="価格">
            @error('price')
            <span style="color:red;">{{$message}}</span>
            @enderror
        </div>
        <div class="form">
            <lavel>在庫数：</lavel>
            <input type="text" name="stock" value="{{ old('stock') }}" placeholder="在庫数">
            @error('stock')
            <span style="color:red;">{{$message}}</span>
            @enderror
        </div>
        <div class="form">
            <lavel>コメント：</lavel>
            <input type="text" name="comment" value="{{ old('comment') }}" placeholder="コメント">
            @error('comment')
            <span style="color:red;">{{$message}}</span>
            @enderror
        </div>
        <div class="form">
            <lavel>画像：</lavel>
            <input type="file" name="img_path">
        </div>
        <input type="submit" value="登録">
</div>
@endsection
