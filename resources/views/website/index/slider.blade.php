   <!-- Slider -->
        <section class="slider">
            <div class="overlay"></div>
            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">

                    @foreach ($sliders as $slider)
                    <div class="carousel-item @if ($loop->first) {{ 'active' }} @endif" data-bs-interval="3000">
                        <img src="{{ $slider->image }}" alt="{{ $slider->title }}">
                        <div class="slider-info">
                            <span>Accounting Software</span>
                            <h2>Business Accounting <br>Solutions</h2>
                            <div class="main-btn">
                                <a href="#">Get a Free Quote <i class="las la-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>
        <!-- Slider End -->
