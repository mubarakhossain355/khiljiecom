    @extends('frontend.layouts.master')
    @section('frontend_title')
        Home Page
    @endsection
    @section('frontend_content')
        @include('frontend.pages.widgets.slider')
        @include('frontend.pages.widgets.featured')
        @include('frontend.pages.widgets.countdown')
        @include('frontend.pages.widgets.bestseller')
        @include('frontend.pages.widgets.latestproduct')
        @include('frontend.pages.widgets.testimonial')
    @endsection
