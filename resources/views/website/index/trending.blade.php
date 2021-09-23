        <!-- Trending Software -->
        <section class="features pt pb">
            <div class="container">
                <div class="main-title">
                    <div class="sub-title">
                        <span class="left"></span>
                        <h4>How Can Help You</h4>
                        <span class="right"></span>
                    </div>
                    <h3>Most Trending Account Software</h3>
                </div>
                <div class="owl-carousel owl-theme" id="features">

                    @foreach ($trends as $trend)
                    <div class="item">
                        <div class="features-wrap">
                            <div class="feature-col" style="background-image: url({{ asset('img/feature-img1.jpg')}})">
                            </div>
                            <div class="feature-col-content">
                                <div class="feature-icon">
                                    <img src="{{ $trend->image }}" alt="{{ $trend->title }}">

                                </div>
                                <div class="feature-content">
                                    <h3><a href="#">{{ $trend->title }}</a></h3>
                                    <p>
                                        {!! html_entity_decode($trend->description) !!}
                                    </p>
                                    <a href="#" class="feature-btn"><i class="las la-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Trending Software End -->
