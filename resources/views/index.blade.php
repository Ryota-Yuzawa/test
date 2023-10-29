@extends('layouts.app')

@section('content')
<div>
    <h1>商品一覧画面</h1>
    <div>
        <form id="searchForm">
        @csrf
        <input type="text" id="keyword" name="keyword" placeholder="キーワード">
        <select id="company_name" name="company_name">
            <option value="">選択</option>
            @foreach($companies as $company)
                <option value="{{$company->id}}">{{$company->company_name}}</option>
            @endforeach
        </select><br>
        <input type="number" id="min_price" name="min_price" placeholder="下限価格">
        <input type="number" id="max_price" name="max_price" placeholder="上限価格"><br>
        <input type="number" id="min_stock" name="min_stock" placeholder="下限在庫数">
        <input type="number" id="max_stock" name="max_stock" placeholder="上限在庫数">
        <input type="submit" value="検索">
        </form>
    </div>
    <a href="{{ route('create') }}">新規登録</a>
    <a href="{{ route('index') }}">戻る</a>
    @if(session('message'))
        {{session('message')}}
    @endif
    <div id="productTable">
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>商品画像</th>
                    <th>商品名</th>
                    <th>メーカー名</th>
                    <th>価格</th>
                    <th>在庫数</th>
                </tr>
            </thead>
            <tbody id="productTableBody">
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td><img src="{{'/public/storage/'. $product['img_path']}}"></td>
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
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#searchForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: "{{ route('index') }}",
                data: $('#searchForm').serialize(),
                success: function(data) {
                    $('#productTable').find('tbody').html($(data).find('tbody').html());
                }
            });
        });
    });

    
</script>
@endsection
