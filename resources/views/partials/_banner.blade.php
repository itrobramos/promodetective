<section id="banner" style="background: #F9F3EC;">
    <div class="container">
      <div class="swiper main-swiper">
        <div class="swiper-wrapper">

          <div class="swiper-slide py-5">
            <div class="row banner-content align-items-center">
              <div class="img-wrapper col-md-5">
                <img src="{{ asset('images/banner/ecommerce-offer1.jpg') }}" class="img-fluid" alt="Ofertas en línea">
              </div>
              <div class="content-wrapper col-md-7 p-5 mb-5">
                <div class="secondary-font text-primary text-uppercase mb-4">¡Grandes descuentos!</div>
                <h2 class="banner-title display-1 fw-normal">Encuentra las <span class="text-primary">mejores ofertas</span>
                </h2>
                <a href="{{ route('search') }}" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                  Ver ofertas
                  <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                    <use xlink:href="#arrow-right"></use>
                  </svg></a>
              </div>
            </div>
          </div>

          <div class="swiper-slide py-5">
            <div class="row banner-content align-items-center">
              <div class="img-wrapper col-md-5">
                <img src="{{ asset('images/banner/ecommerce-offer2.jpg') }}" class="img-fluid" alt="Ahorra en tus compras">
              </div>
              <div class="content-wrapper col-md-7 p-5 mb-5">
                <div class="secondary-font text-primary text-uppercase mb-4">Ahorra hasta un 70%</div>
                <h2 class="banner-title display-1 fw-normal">Compara precios y <span class="text-primary">ahorra</span>
                </h2>
                <a href="{{ route('search') }}" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                  Comparar precios
                  <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                    <use xlink:href="#arrow-right"></use>
                  </svg></a>
              </div>
            </div>
          </div>

          <div class="swiper-slide py-5">
            <div class="row banner-content align-items-center">
              <div class="img-wrapper col-md-5">
                <img src="{{ asset('images/banner/ecommerce-offer3.jpg') }}" class="img-fluid" alt="Ofertas especiales">
              </div>
              <div class="content-wrapper col-md-7 p-5 mb-5">
                <div class="secondary-font text-primary text-uppercase mb-4">Ofertas exclusivas</div>
                <h2 class="banner-title display-1 fw-normal">Las mejores <span class="text-primary">promociones</span>
                </h2>
                <a href="{{ route('search') }}" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                  Descubrir
                  <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                    <use xlink:href="#arrow-right"></use>
                  </svg></a>
              </div>
            </div>
          </div>
          
        </div>

        <div class="swiper-pagination mb-5"></div>

      </div>
    </div>
  </section>