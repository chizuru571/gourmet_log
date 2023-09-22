@extends('layouts.gourmet')
@section('title', 'Gourmet Logの確認画面')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <form action="{{ route('gourmet.send') }}" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-md-3">店名</label>
                        @if (array_key_exists('shop_name', $gourmet))
                            <div class="col-md-9">
                                {{ $gourmet["shop_name"] }}
                            </div>
                            <input type="hidden" name="shop_name" value="{{ $gourmet['shop_name'] }}">
                        @endif
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">店名　フリガナ</label>
                        @if (array_key_exists('name_katakana', $gourmet))
                            <div class="col-md-9">
                                {{ $gourmet["name_katakana"] }}
                            </div>
                            <input type="hidden" name="name_katakana" value="{{ $gourmet['name_katakana'] }}">
                    </div>
                        @endif
                    <div class="form-group row">
                        <label class="col-md-3">カテゴリー</label>
                        @if (array_key_exists('category', $gourmet))
                            <div class="col-md-9">
                                {{ $gourmet["category"] }}
                            </div>
                            <input type="hidden" name="category" value="{{ $gourmet['category'] }}">
                        @endif
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">レビュー</label>
                        @if (array_key_exists('review', $gourmet))
                            <div class="col-md-9">
                                {{ $gourmet["review"] }}
                            </div>
                            <input type="hidden" name="review" value="{{ $gourmet['review'] }}">
                        @endif
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">料理写真</label>
                        @if (array_key_exists('food_picture', $gourmet))
                            <div class="col-md-9">
                                {{ $gourmet["food_picture"] }}
                            </div>
                            <input type="hidden" name="food_picture" value="{{ $gourmet['food_picture'] }}">
                        @endif
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Google Map URL</label>
                        @if (array_key_exists('map_url', $gourmet))
                            <div class="col-md-9">
                                {{ $gourmet["map_url"] }}
                            </div>
                            <input type="hidden" name="map_url" value="{{ $gourmet['map_url'] }}">
                        @endif
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">電話番号</label>
                        @if (array_key_exists('tel', $gourmet))
                            <div class="col-md-9">
                                {{ $gourmet["tel"] }}
                            </div>
                            <input type="hidden" name="tel" value="{{ $gourmet['tel'] }}">
                        @endif
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">コメント</label>
                        @if (array_key_exists('comment', $gourmet))
                            <div class="col-md-9">
                                {{ $gourmet["comment"] }}
                            </div>
                            <input type="hidden" name="comment" value="{{ $gourmet['comment'] }}">
                        @endif
                    </div>
                    @csrf
                    <div class ="row">
                        <div class="col-12 d-flex justify-content-center">
                            <div class="row mt-3">
                                <div class="col-md-5">
                                    <a href="{{ route('gourmet.create')}}">
                                    <input type="submit" class="btn btn-success" value="修正する">
                                    </a>
                                </div>
                                <div class="col-md-2">　</div>
                                <div class="col-md-5">
                                    @csrf
                                    <input type="submit" class="btn btn-primary" value="登録する">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection