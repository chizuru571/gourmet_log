@extends('layouts.gourmet')
@section('title', 'メモの編集')

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-8 mx-auto" >
                <div class ="row">
                    <div class="col-12 d-flex justify-content-center">
                      <h2>カテゴリー編集</h2>
                    </div>
                </div>
                <form action="?" method="post" enctype="multipart/form-data">
                    <div class="form-group row mt-3">
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="category_name" value="{{ $category_form->category_name }}">
                </div>
                            @if (count($errors) > 0)
                            @foreach($errors->all() as $e)
                                {{ $e }}
                            @endforeach
                    @endif
                    <div class ="row">
                    <div class="col-12 d-flex justify-content-center">
                    <div class="row mt-3">
                        <div class="col-md-5">
                            <a href="{{ route('gourmet.category.create')}}">
                            <input type="submit" class="btn btn-success" value="戻る" formaction="{{ route('gourmet.category.index') }}" formmethod="get">
                            </a>
                        </div>
                        <div class="col-md-2">　</div>
                        <div class="col-md-5">
                            <input type="hidden" name="id" value="{{ $category_form->id }}">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="修正する" formaction="{{ route('gourmet.category.update') }}">
                        </div>
                        </div>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection