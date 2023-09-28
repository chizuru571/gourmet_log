@extends('layouts.gourmet')
@section('title'){{ $gourmet->shop_name }}@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>{{ $gourmet->shop_name }}詳細</h2>
                    <div class="form-group row">
                        <label class="col-md-3"><strong>店名</strong></label>
                        <div class="col-md-9">
                            <p class="shop_name mx-auto">{{ $gourmet->shop_name }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3"><strong>店名 フリガナ</strong></label>
                        <div class="col-md-9">
                            <p class="name_katakana mx-auto">{{ $gourmet->name_katakana }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3"><strong>カテゴリー</strong></label>
                        <div class="col-md-9">
                            <p class="category mx-auto">{{ $gourmet->category->name }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3"><strong>レビュー</strong></label>
                        <div class="col-md-9">
                            <p class="review mx-auto">{{ $gourmet->review }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3"><strong>料理写真</strong></label>
                        <div class="image col-md-9">
                                @if ($gourmet->food_picture)
                                    <img src="{{ secure_asset('storage/image/' . $gourmet->food_picture) }}" width="180" height="180">
                                @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3"><strong>Google Map URL</strong></label>
                        <div class="col-md-9">
                            <p class="map_url mx-auto">{{ $gourmet->map_url }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3"><strong>電話番号</strong></label>
                        <div class="col-md-9">
                            <p class="tel mx-auto">{{ $gourmet->tel }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3"><strong>コメント</strong></label>
                        <div class="col-md-9">
                            <p class="comment mx-auto">{{ $gourmet->comment }}</p>
                        </div>
                    </div>
                    @csrf
                    <div class ="row">
                        <div class="col-12 d-flex justify-content-center">
                            <a href="{{ route('gourmet.index')}}">
                            <input type="submit" class="btn btn-light" value="お店リストへ戻る">
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
