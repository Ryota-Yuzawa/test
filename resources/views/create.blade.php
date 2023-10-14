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
            <span style="color:red;">商品名を２０文字以内で入力して下さい。</span>
            @enderror
        </div>
        <div class="form">
            <lavel>メーカー名：</lavel>
            <select name="company_name">
                @foreach($companies as $company)
                <option value="{{$company->id}}">{{$company->company_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form">
            <lavel>価格：</lavel>
            <input type="text" name="price" value="{{ old('price') }}" placeholder="価格">
            @error('price')
            <span style="color:red;">価格を数字で入力して下さい。</span>
            @enderror
        </div>
        <div class="form">
            <lavel>在庫数：</lavel>
            <input type="text" name="stock" value="{{ old('stock') }}" placeholder="在庫数">
            @error('stock')
            <span style="color:red;">在庫数を数字で入力して下さい。</span>
            @enderror
        </div>
        <div class="form">
            <lavel>コメント：</lavel>
            <input type="text" name="comment" value="{{ old('comment') }}" placeholder="コメント">
            @error('comment')
            <span style="color:red;">コメントを１５０文字以内で入力して下さい。</span>
            @enderror
        </div>
        <div class="form">
            <lavel>画像：</lavel>
            <input type="file" name="img_path">
        </div>
        <input type="submit" value="登録">
</div>
@endsection
