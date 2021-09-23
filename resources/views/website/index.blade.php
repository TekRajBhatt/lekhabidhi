@extends('layouts.front')
@section('page_title', 'Lekha Bidhi')
    @push('styles')
    @endpush
@section('meta')
    @include('website.shared.meta')
@endsection

@section('content')
    @include('website.index.slider')
    @include('website.index.trending')
    @include('website.index.business')
    @include('website.index.marketing')
    @include('website.index.casestudy')
    @include('website.index.counter')
    @include('website.index.testimonial')
    @include('website.index.process')
    @include('website.index.quote')
    @include('website.index.pricing')
    @include('website.index.partner')
@endsection
@push('scripts')

@endpush
