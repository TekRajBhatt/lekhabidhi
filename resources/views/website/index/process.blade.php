
        <!-- Process -->
        <section class="process pt pb mb">
            <div class="container">
                <div class="main-title">
                    <div class="sub-title">
                        <span class="left"></span>
                        <h4>Working Process</h4>
                        <span class="right"></span>
                    </div>
                    <h3>We Follw Some Steps To Grow Business</h3>
                </div>


                <div class="process-wrap">

                    <div class="process-shape">
                        <img src="{{ asset('img/shape5.png')}}" alt="images">
                    </div>
                    <ul>
                        @foreach ($steps as $step)
                        <li>
                            <div class="process-icon">
                                <i class="{{ $step->image }}"></i>
                                <span>{{ $step->position }}</span>
                            </div>
                            <h3>{{ $step->title }}</h3>
                            <p>{!! html_entity_decode($step->description) !!}</p>
                        </li>
                        @endforeach
                    </ul>

                </div>

            </div>
        </section>
        <!-- Process End -->
