       <!-- Case Studies -->
        <section class="case-studies pt pb bg-grey">
            <div class="container">
                <div class="main-title">
                    <div class="sub-title">
                        <span class="left"></span>
                        <h4>Case Studies</h4>
                        <span class="right"></span>
                    </div>
                    <h3>We’re Committed To Creating Change That Matters</h3>
                </div>
                <div class="row">
                    @foreach ($commits as $commit)
                    <div class="col-lg-3 col-md-6">
                        <div class="cs-wrap">
                            <div class="cs-img">
                                <img src="{{ asset('img/cs1.jpg')}}" alt="images">
                                <a href="#"><i class="las la-angle-double-right"></i></a>
                            </div>
                            <div class="cs-content">
                                <h3><a href="#">{{ $commit->title }}</a></h3>
                                <p>
                                    {!! html_entity_decode($commit->description) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Case Studies End -->
