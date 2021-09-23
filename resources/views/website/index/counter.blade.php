        <!-- Counter -->
        <section class="counter bg-grey">
            <div class="counter-wrap">
                <div class="shapes">
                    <img src="{{ asset('img/shape.png')}}" alt="images">
                </div>
                <div class="row">
                    @foreach ($satifies as $satisfy)
                    <div class="col-lg-3 col-md-6">
                    <div class="counter-col">
                            <div class="counter-icon">
                                <img src="{{ $satisfy->image }}" alt="images">
                            </div>
                            <div class="counter-content">
                                <span>{{ $satisfy->number }}+</span>
                                <p>{{ $satisfy->title }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-lg-3 col-md-6">
                        <div class="counter-col counter-img-col">
                            <b>Company Achievement</b>
                            <div class="main-btn white">
                                <a href="#">Learn More <i class="las la-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Counter End -->
