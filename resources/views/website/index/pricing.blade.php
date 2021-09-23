        <!-- Pricing -->
        <section class="pricing pb">
            <div class="pricing-bg1"></div>
            <div class="pricing-bg2"></div>
            <div class="container">
                <div class="pricing-col">
                    <div class="shape1 float-bob-y">
                        <img src="{{ asset('img/shape6.png')}}" alt="images">
                    </div>
                    <div class="shape2 float-bob-y">
                        <img src="{{ asset('img/shape7.png')}}" alt="images">
                    </div>
                    <div class="shape3 zoominout">
                        <img src="{{ asset('img/shape8.png')}}" alt="images">
                    </div>
                    <div class="shape4 zoominout">
                        <img src="{{ asset('img/shape9.png')}}" alt="images">
                    </div>
                    <div class="main-title">
                        <div class="sub-title">
                            <span class="left"></span>
                            <h4>Our Pricing Plan</h4>
                            <span class="right"></span>
                        </div>
                        <h3>Smart Pricing Plan For Marketing</h3>
                    </div>
                    <div class="row">
                        @foreach ($plans as $plan)
                        <div class="col-lg-3 col-md-6">
                            <div class="pricing-wrap">
                                <div class="pricing-head">
                                    <div class="pricing-bg"></div>
                                    <span>{{ $plan->title }}</span>
                                    <h3>{{ $plan->plan_basis }}</h3>
                                    <b>Rs. {{ $plan->price }}</b>
                                </div>
                                <div class="pricing-content">
                                    {!! html_entity_decode($plan->list) !!}
                                    <div class="main-btn white">
                                        <a href="#">Select Plan <i class="las la-angle-double-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- Pricing End -->
