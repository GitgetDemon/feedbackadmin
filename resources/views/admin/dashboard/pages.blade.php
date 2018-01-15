@extends('layouts.app')

@section('body')
    <div class="container fromtop">
        <div class="row">
            <div class="col-3 menu">
                @include('admin.dashboard.menu')
            </div>
            <div class="col-9 box">
                @yield('content')
            </div>
            {{--@include('includes.site-message-success')--}}
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .menu
        {
            border: 1px solid #dadada;
        }
        .box
        {
            border: 1px solid #dadada;
        }
        .fromtop
        {
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
@endpush