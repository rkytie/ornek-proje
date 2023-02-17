<div class="container-fluid" style="background-color:#ededed">
    <div class="container">
        <footer class="row py-5 border-top">
            <div class="col-lg-2 col-6">
                <a href="/" class="d-flex align-items-center mb-3 link-dark text-decoration-none">
                    <img src="https://fonstersida.se/front/assets/images/logo.png" class="img-fluid" alt="">
                </a>
                <p class="text-muted">© 2022</p>
                <p style="font-size: 0.9rem;">Fönstersida erbjuder dig ett obegränsat sortiment. Bygg dina drömfönster
                    och dörrsystem själv.</p>
            </div>

            <div class="col-lg-2 col-6">

            </div>

            <div class="col-lg-2 col-6">
                <h5>Institutionell</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted"
                            style="color: #03468f !important;">Hemsida</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('aboutUs') }}" class="nav-link p-0 text-muted"
                            style="color: #03468f !important;">Om Oss</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted"
                            style="color: #03468f !important;">Bloggar</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted"
                            style="color: #03468f !important;">Kommunikation</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('contact') }}" class="nav-link p-0 text-muted"
                            style="color: #03468f !important;">Få Specialerbjudande</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-6">
                <h5>Innehåll</h5>
                <ul class="nav flex-column">
                    @foreach (blogs() as $blog)
                        <li class="nav-item mb-2"><a href="{{ route('blogView', ['slug' => $blog->slug]) }}"
                                class="nav-link p-0 text-muted"
                                style="color: #03468f !important;">{{ $blog->title }}</a></li>
                    @endforeach
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted"
                            style="color: #03468f !important;">Vanliga frågor</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-6">
                <h5>Rättslig</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted"
                            style="color: #03468f !important;">Personlig information</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted"
                            style="color: #03468f !important;">Långdistansförsäljningsavtal</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted"
                            style="color: #03468f !important;">Avbokning och återbetalning</a></li>
                </ul>
            </div>

            <div class="col-lg-12 mt-5 text-center align-center">
                <img src="{{ asset('front/assets/images/bank/visa.png') }}" alt="" />
                <img src="{{ asset('front/assets/images/bank/mastercard.png') }}" alt="" />
            </div>
        </footer>
    </div>


</div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="{{ asset('front/assets/js/custom.js') }}"></script>
<script src="{{ asset('front/assets/slider/owl.carousel.min.js') }}"></script>


</body>

</html>
