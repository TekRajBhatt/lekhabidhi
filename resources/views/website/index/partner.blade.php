
        <!-- Logo Partner -->
        <section class="logo-partner mt mb">
            <div class="container">
                <div class="main-title">
                    <div class="sub-title">
                        <span class="left"></span>
                        <h4>Trusted Partners</h4>
                        <span class="right"></span>
                    </div>
                    <h3>We’ve More Than 259+ Global Clients</h3>
                </div>
                <div class="owl-carousel owl-theme" id="partners">
                    @foreach ($clients as $client)
                    <div class="item">
                        <div class="logo-wrap">
                            <img src="{{ $client->logo }}" alt="images">
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </section>
        <!-- Logo Partner End -->