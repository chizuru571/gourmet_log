@extends('layouts.gourmet')
@section('title'){{ $gourmet->shop_name }}@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>{{ $gourmet->shop_name }}詳細</h2>
                    <div class="form-group row">
                        <label class="col-md-3">店名</label>
                        <div class="col-md-9">
                            <p class="shop_name mx-auto">{{ $gourmet->shop_name }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">店名 フリガナ</label>
                        <div class="col-md-9">
                            <p class="name_katakana mx-auto">{{ $gourmet->name_katakana }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">カテゴリー</label>
                        <div class="col-md-9">
                            <p class="category mx-auto">{{ $gourmet->category }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">レビュー</label>
                        <div class="col-md-9">
                            <p class="review mx-auto">{{ $gourmet->review }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">料理写真</label>
                        <div class="col-md-9">
                            <img src="{{ secure_asset('storage/image/' . $gourmet->food_picture) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Google Map URL</label>
                        <div class="col-md-9">
                            <p class="map_url mx-auto">{{ $gourmet->map_url }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">電話番号</label>
                        <div class="col-md-9">
                            <p class="tel mx-auto">{{ $gourmet->tel }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">コメント</label>
                        <div class="col-md-9">
                            <p class="comment mx-auto">{{ $gourmet->comment }}</p>
                        </div>
                    </div>
                    @csrf
                    <div class ="row">
                        <div class="col-12 d-flex justify-content-center">
                            <a href="{{ route('gourmet.index')}}">
                            <input type="submit" class="btn btn-secondary" value="お店リストへ戻る">
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
