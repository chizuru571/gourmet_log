@extends('layouts.gourmet')
@section('title', 'Gourmet Logの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>お店一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-3">
                <a href="{{ route('gourmet.top') }}" role="button" class="btn btn-primary">トップページ</a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('gourmet.dashboard') }}" role="button" class="btn btn-primary">ダッシュボード</a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('gourmet.category.index') }}" role="button" class="btn btn-primary">カテゴリー一覧</a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('gourmet.add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ route('gourmet.index') }}" method="get">
                    <div class="form-group row">
                        <!--<label class="col-md-2">タイトル</label>-->
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-light">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">店名</th>
                                <th width="10%">カテゴリー</th>
                                <th width="10%">レビュー</th>
                                <th width="20%">コメント</th>
                                <th width="10%">詳細</th>
                                <th width="10%">編集</th>
                                <th width="10%">削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $gourmet)
                                <tr>
                                    <th>{{ $gourmet->id }}</th>
                                    <td>{{ $gourmet->shop_name }}</td>
                                    <td>{{ $gourmet->category->name }}</td>
                                    <td>{{ $gourmet->review }}</td>
                                    <td>{{ $gourmet->comment }}</td>
                                    <td><div>
                                            <a href="{{ route('gourmet.detail', ['id' => $gourmet->id]) }}">
                                                <input type="button" class="btn btn-primary" value="詳細">
                                            </a>
                                        </div>
                                    </td>
                                    <td><div>
                                            <a href="{{ route('gourmet.edit', ['id' => $gourmet->id]) }}">
                                                <input type="button" class="btn btn-success" value="編集">
                                            </a>
                                        </div>
                                    </td>
                                    <td><div>
                                            <a href="{{ route('gourmet.delete', ['id' => $gourmet->id]) }}">
                                                <input type="button" class="btn btn-danger" value="削除" onclick='return confirm("本当に削除してよろしいですか？")'>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class ="row">
                <div class="col-12 d-flex justify-content-center">
                {{ $posts->links() }}
                 </div>
             </div>
        </div>
    </div>
@endsection