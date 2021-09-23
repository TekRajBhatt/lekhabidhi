        <!-- Testimonails -->
        <section class="testimonials pt pb border-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="testimonials-left">
                            <div class="shape1 float-bob-y">
                                <img src="{{ asset('img/shape1.png')}}" alt="images">
                            </div>
                            <div class="shape2 rotate-me">
                                <img src="{{ asset('img/shape2.png')}}" alt="images">
                            </div>
                            <div class="shape3 float-bob-y">
                                <img src="{{ asset('img/shape3.png')}}" alt="images">
                            </div>
                            <div class="shape4 zoom-fade">
                                <img src="{{ asset('img/shape4.png')}}" alt="images">
                            </div>
                            <div class="testi-img">
                                <div class="testi-img1">
                                    <img src="{{ asset('img/testi1.png')}}" alt="images">
                                </div>
                                <div class="testi-img2">
                                    <img src="{{ asset('img/testi2.png')}}" alt="images">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="testi-content">
                            <div class="main-title">
                                <div class="sub-title">
                                    <span class="left"></span>
                                    <h4>Our Testimonials</h4>
                                    <span class="right"></span>
                                </div>
                                <h3>What Our Client’s Say About Us</h3>
                            </div>
                            <div class="owl-carousel owl-theme" id="testimonials">
                                @foreach ($testimonials as $testimonial)
                                <div class="item">
                                    <div class="testi-list">
                                        <span>
                                            {!! html_entity_decode($testimonial->first_description) !!}

                                        </span>
                                        <p>
                                            {!! html_entity_decode($testimonial->second_description) !!}
                                        </p>
                                        <div class="testi-info">
                                            <div class="testi-icon">
                                                <i class="las la-quote-right"></i>
                                            </div>
                                            <div class="testi-des">
                                                <h3>{{ $testimonial->name }}</h3>
                                                <b>{{ $testimonial->designation }}</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Testimonaials End -->
