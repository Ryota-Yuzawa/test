@extends('layouts.app')

@section('content')
<div>
    <h1>商品一覧画面</h1>
    <div>
        <form action="{{ route('index') }}" method="GET">
    @csrf
        <input type="text" name="keyword">
        <select name="company_name">
                <option value="">選択</option>
                @foreach($companies as $company)
                <option value="{{$company->id}}">{{$company->company_name}}</option>
                @endforeach
        </select>
        <input type="submit" value="検索">
     </form>
    </div>
    <a href="{{ route('create') }}">新規登録</a>
    @if(session('message'))
        {{session('message')}}
    @endif
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>商品名</th>
                <th>メーカー名</th>
                <th>価格</th>
                <th>在庫数</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->company->company_name}}</td>
                    <td>{{ $product->price }}円</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <a href="{{ route('show', $product->id) }}">詳細</a>
                    </td>
                    <td>
                        <form action="{{ route('destroy', $product->id) }}" method="POST">
                        @csrf
                            <button type="submit" class="btn btn-danger">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
