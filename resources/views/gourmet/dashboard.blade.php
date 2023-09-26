@extends('layouts.gourmet')
@section('title', 'ダッシュボード')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h4>
                {{ \Carbon\Carbon::now()->format("Y/m/d") }}
                <p>{{ Auth::user()->name }} さん　こんにちは！</p></h4>
            </div>
        </div>
    </div>
@endsection