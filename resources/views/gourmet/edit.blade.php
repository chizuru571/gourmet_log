@extends('layouts.gourmet')
@section('title', 'Gourmet Logの編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>ニュース編集</h2>
                <form action="{{ route('gourmet.update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-3" for="shop_name">店名</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="shop_name" value="{{ $gourmet_form->shop_name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="name_katakana">店名 フリガナ</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="name_katakana" value="{{ $gourmet_form->name_katakana }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">カテゴリー</label>
                        <div class="col-md-9">
                            <label><input type="checkbox" name="category" value="{{ $gourmet_form->category }}">日本料理</label>
                            <label><input type="checkbox" name="category" value="{{ $gourmet_form->category }}">インド料理</label>
                            <label><input type="checkbox" name="category" value="{{ $gourmet_form->category }}">イタリアン</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">レビュー（最高:5 / 最低:1）</label>
                        <div class="col-md-9">
                        <select name="review">
                          <option value="">下記の中から選択してください</option>
                          <option value="{{ $gourmet_form->review }}">1</option>
                          <option value="{{ $gourmet_form->review }}">2</option>
                          <option value="{{ $gourmet_form->review }}">3</option>
                          <option value="{{ $gourmet_form->review }}">4</option>
                          <option value="{{ $gourmet_form->review }}">5</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="food_picture">料理写真</label>
                        <div class="col-md-9">
                            <input type="file" class="form-control-file" name="food_picture">
                            <div class="form-text text-info">
                                設定中: {{ $gourmet_form->food_picture }}
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Google Map URL</label>
                        <div class="col-md-9">
                            <input type="url" class="form-control" name="map_url" value="{{ $gourmet_form->map_url }}" placeholder="https://example.com" >
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-3">電話番号</label>
                        <div class="col-md-9">
                            <input type="tel" class="form-control" name="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="{{ $gourmet_form->tel }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">コメント</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="comment" rows="2">{{ $gourmet_form->comment }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $gourmet_form->id }}">
                            @csrf
                            <div class ="row">
                                <div class="col-12 d-flex justify-content-center">
                                    <input type="submit" class="btn btn-secondary" value="確認画面へ">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection