@extends('layouts.gourmet')
@section('title', 'ダッシュボード')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                {{ \Carbon\Carbon::now()->format("Y/m/d") }}
                <p>こんにちは</p>
            </div>
        </div>
    </div>
@endsection