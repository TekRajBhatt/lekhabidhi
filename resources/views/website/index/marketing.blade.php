      <!-- Marketing Service -->
        <section class="service pt pb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="service-wrap">
                            <div class="main-title">
                                <div class="sub-title">
                                    <span class="left"></span>
                                    <h4>How Can Help You</h4>
                                    <span class="right"></span>
                                </div>
                                <h3>We Provide Exclusive Marketing Service</h3>
                            </div>
                            <div class="row">
                                @foreach ($marketings as $marketing)
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="sp-wrap">
                                        <div class="sp-icon">
                                            <img src="{{ $marketing->image }}" alt="images">
                                        </div>
                                        <div class="sp-content">
                                            <h3><a href="#">{{ $marketing->title }}</a></h3>
                                            <p>
                                                {!! html_entity_decode($marketing->description) !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="main-btn">
                                <a href="#">Learn More <i class="las la-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="service-right-img">
                            <img src="{{ asset('img/service.png')}}" alt="images">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Marketing Service End -->
