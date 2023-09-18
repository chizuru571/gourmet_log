@extends('layouts.gourmet')
@section('title', 'Gourmet Logの新規作成')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>お店 新規登録</h2>
                <form action="{{ route('gourmet.create') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <font color="red"><li>{{ $e }}</li></font>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-3">店名</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="shop_name" value="{{ old('shop_name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">店名 フリガナ</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="name_katakana" value="{{ old('name_katakana') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">カテゴリー</label>
                        <div class="col-md-9">
                            <label><input type="checkbox" name="category" value="日本料理">日本料理</label>
                            <label><input type="checkbox" name="category" value="インド料理">インド料理</label>
                            <label><input type="checkbox" name="category" value="イタリアン">イタリアン</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">レビュー（最高:5 / 最低:1）</label>
                        <div class="col-md-9">
                        <select name="review">
                          <option value="">下記の中から選択してください</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">料理写真</label>
                        <div class="col-md-9">
                            <input type="file" class="form-control-file" name="food_picture">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Google Map URL</label>
                        <div class="col-md-9">
                            <input type="url" class="form-control" name="map_url" value="{{ old('map_url') }}" placeholder="https://example.com" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">電話番号</label>
                        <div class="col-md-9">
                            <input type="tel" class="form-control" name="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="{{ old('tel') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">コメント</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="comment" rows="2">{{ old('comment') }}</textarea>
                        </div>
                    </div>
                    @csrf
                    <div class ="row">
                        <div class="col-12 d-flex justify-content-center">
                            <input type="submit" class="btn btn-secondary" value="確認画面へ">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection