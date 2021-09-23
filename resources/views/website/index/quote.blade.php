        <!-- Quote Section -->
        <section class="quote pt pb">
            <div class="container">
                <div class="quote-wrap">
                    <div class="quote-left">
                        <div class="main-title">
                            <div class="sub-title">
                                <span class="left"></span>
                                <h4>Request A Quote</h4>
                                <span class="right"></span>
                            </div>
                            <h3>Let’s Get To Work Together Ready To Work Us</h3>
                        </div>
                        <div class="main-btn">
                            <a href="#">Get a Free Quote <i class="las la-angle-double-right"></i></a>
                        </div>
                        <div class="main-btn white">
                            <a href="#">Watch Videos <i class="las la-angle-double-right"></i></a>
                        </div>
                    </div>
                    <div class="quote-right">
                        <a href="#">
                            <i class="las la-play"></i>
                        </a>
                        <span class="border-animation border-1"></span>
                        <span class="border-animation border-2"></span>
                        <span class="border-animation border-3"></span>
                    </div>
                </div>
                <div class="quote-list">
                    @foreach ($works as $work)
                    <div class="quote-list-wrap">
                        <div class="quote-list-left">
                            <div class="quote-list-icon">
                                <img src="{{ $work->featured_image }}" alt="images">
                            </div>
                            <div class="quote-list-info">
                                <h3>{!! html_entity_decode($work->description) !!}</h3>
                            </div>
                        </div>
                        <div class="quote-list-right">
                            <div class="icon-btn">
                                <a href="#"><i class="las la-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Quote Section End -->
