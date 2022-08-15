@extends('dash/base')

@section('header_path')
    Profile
@endsection

@section('header_title')
    Profile
@endsection
@section('content')
    <div id="profileCont">
        @include('dash/layouts/profile')
    </div>
@endsection
