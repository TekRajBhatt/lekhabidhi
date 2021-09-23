        <!-- Buid Your Business Section -->
        <section class="about-sec">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="about-content">
                            <div class="about-text">
                                <h2>Lekha</h2>
                            </div>
                            <div class="about-content-img">
                                <div class="about-media">
                                    <img src="{{ $businesses->image }}" alt="images">
                                </div>
                                <div class="video-sec">
                                    <img src="{{ $businesses->video }}" alt="images">
                                    <div class="video-box">
                                        <a href="" class="video-popup wow zoomIn animated animated animated" data-wow-delay="300ms" data-wow-duration="1500ms" href="https://www.youtube.com/watch?v=TKnufs85hXk" title=" Video Gallery"><i class="las la-play"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="about-right">
                            <div class="main-title">
                                <div class="sub-title">
                                    <span class="left"></span>
                                    <h4>How Can Help You</h4>
                                    <span class="right"></span>
                                </div>
                                <h3>{{ $businesses->title }}</h3>
                            </div>
                            <p>
                                {!! html_entity_decode($businesses->description) !!}
                            </p>
                            <div class="main-btn">
                                <a href="#">Learn More <i class="las la-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Buid Your Business Section End -->