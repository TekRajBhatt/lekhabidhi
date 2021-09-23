
@extends('layouts.front')
@section('page_title', 'Services')
    @push('styles')
    @endpush
@section('meta')
    @include('website.shared.meta')
@endsection
@section('content')

        <!-- Banner -->
        <section class="banner" style="background-image: url({{ asset('img/banner.jpg')}});">
            <div class="container">
                <div class="banner-wrap">
                    <h1>Details Page</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Details Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>
        <!-- Banner End -->

        <!-- Details Page -->
        <section class="details-page mt mb">

            @if(session('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
                    <strong> {{ session('success') }}</strong>
                </div>
            @endif

            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="details-sidebar">
                            <div class="details-list">
                                <h3>All Services List</h3>
                                <ul>
                                    {{-- <li><a href="#">{{ $details->title }}</a></li> --}}

                                    @foreach ($services as $service)
                                    <li><a href="{{ route('singleservice', $service->slug) }}">{{ $service->title }}</a></li>
                                    @endforeach

                                    {{-- <li><a href="#">Stock Management</a></li>
                                    <li><a href="#">Inventory Management</a></li>
                                    <li><a href="#">Accounting Management</a></li>
                                    <li><a href="#">Capital Management</a></li>
                                    <li><a href="#">Goodwill Management</a></li>
                                    <li><a href="#">System Management</a></li>
                                    <li><a href="#">Market Management</a></li> --}}
                                </ul>
                            </div>
                            <div class="details-list">
                                <h3>Get in Touch</h3>

                                <form action="{{ route('touch.store')}}" method="POST" class = 'form' name = 'touch_form'>
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name*" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email*" required>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" class="form-control" id="message" placeholder="Message*" required></textarea>
                                    </div>
                                    <div class="main-btn">
                                        <button class="btn btn-danger">Send Message <i class="las la-angle-double-right"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="details-list">
                                <h3>Get in Touch</h3>
                                <div class="download">
                                    <a href="#">Download Docs <i class="las la-file-medical-alt"></i></a>
                                    <a href="#">Download Pdf <i class="las la-file-pdf"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">


                        <div class="details-main">

                            {!! $details->description !!}

                        </div>


                    </div>
                </div>
            </div>
        </section>
        <!-- Details Page End -->

        <!-- Footer -->
        <footer id="footer" class="pt">
            <div class="footer-bg"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <h3>Company</h3>
                        <ul class="footer-links">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Software</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3>Social Media</h3>
                        <ul class="social-links">
                            <li class="facebook"><a href="#"><i class="lab la-facebook-f"></i> Facebook</a></li>
                            <li class="youtube"><a href="#"><i class="lab la-youtube"></i> Youtube</a></li>
                            <li class="whatsapp"><a href="#"><i class="lab la-whatsapp"></i> Whatsapp</a></li>
                            <li class="twitter"><a href="#"><i class="lab la-twitter"></i> Twitter</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3>Newsletter</h3>
                        <p>Quis autem veleum prehendet voluptate velit esse</p>
                        <form action="" method="get">
                            <input type="email" name="email" placeholder="Email Address" class="form-control">
                            <div class="main-btn">
                                <a href="#">Subscription <i class="las la-angle-double-right"></i></a>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <img src="{{ asset('img/logo.png')}}" alt="images">
                        <ul class="footer-contact">
                            <li>
                                <i class="flaticon-signs"></i>
                                <span>256 Elizaberth Ave, Brooklyn, CA, 90025</span>
                            </li>
                            <li>
                                <i class="flaticon-message"></i>
                                <span>example@example.com</span>
                            </li>
                            <li>
                                <i class="flaticon-phone-call"></i>
                                <span>+977 123 456 789</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="copyright">
                    <p>
                        ©2021 Lekhabidhi Accounting Software. All Rights Reserved.
                    </p>
                </div>
            </div>
        </footer>
        <!-- Footer End -->

@endsection
@push('scripts')
    {{-- scripts here --}}
@endpush
