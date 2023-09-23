{{-- layouts/memo.blade.phpを読み込む --}}
@extends('layouts.gourmet')
@section('title', 'カテゴリー一覧・新規登録')

{{-- memo.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
            <h5>カテゴリー一覧<h5>
            </div>
            <div class="col-md-8 mx-auto">
                <form action="{{ route('gourmet.category.create') }}" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="category_name" value="{{ old('category_name')}}">
                        </div>
                        <div class="col-md-2">
                            <input type="submit" class="btn btn-primary" value="登録">
                        </div>
            <div class="col-md-8">
                    @if (count($errors) > 0)
                            @foreach($errors->all() as $e)
                                <font color="red">{{ $e }}</font>
                            @endforeach
                    @endif
                    </div>
                        </div>
                    @csrf
                </form>
            </div>
        </div>
    </div>
        <div class="row">
            <div class="list-memo col-md-8 mx-auto">
            <hr>
                <div class="row">
                    <table class="table table-light">
                        <thead>
                            <tr>
                                <th width="10%">No.</th>
                                <th width="40%">カテゴリー</th>
                                <th width="10%">編集</th>
                                <th width="10%">削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $category)
                                <tr>
                                    <th>{{ $category->id }}</th>
                                    <td>{{ $category->category_name }}</td>
                                    <td><div>
                                            <a href="{{ route('gourmet.category.edit', ['id' => $category->id]) }}">
                                                <input type="button" class="btn btn-success" value="編集">
                                            </a>
                                        </div>
                                    </td>
                                    <td><div>
                                            <a href="{{ route('gourmet.category.delete', ['id' => $category->id]) }}">
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
        </div>
    </div>
@endsection
