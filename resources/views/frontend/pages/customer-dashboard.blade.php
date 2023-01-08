@extends('frontend.layouts.master')
    @section('frontend_title')
        Customer Dashboard
    @endsection

    @section('frontend_content')
    @include('frontend.layouts.inc.breadcumb',['pagename'=>'customer'])
        <h2>{{$user->name}}</h2>

    @endsection
