<style>
  .banner-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 100%);
  }
  
  .banner-content-box {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
  }

  .swiper-nav-button {
    width: 50px;
    height: 50px;
    background-color: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    transition: all 0.3s ease;
}

.swiper-nav-button:hover {
    background-color: rgba(255, 255, 255, 0.3);
}

.swiper-nav-button::after {
    font-size: 20px;
    font-weight: bold;
}

.swiper-button-disabled {
    opacity: 0.35;
    pointer-events: none;
}
.swiper-button-next,
.swiper-button-prev {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 50px !important;
    height: 50px !important;
    margin-top: 0 !important;
    z-index: 10;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff !important;
    background-color: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
}

.swiper-button-next {
    right: 20px;
}

.swiper-button-prev {
    left: 20px;
}

.swiper-button-next::after,
.swiper-button-prev::after {
    font-size: 24px !important;
    font-weight: bold;
}

.swiper-button-next:hover,
.swiper-button-prev:hover {
    background-color: rgba(255, 255, 255, 0.3);
}

.main-swiper .swiper-pagination-bullet {
    background: white;
    opacity: 0.7;
  }

  .main-swiper .swiper-pagination-bullet-active {
    background: #fff;
    opacity: 1;
  }

  .discover-btn {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
    padding: 0.8rem 2rem;
    font-weight: 500;
    letter-spacing: 0.5px;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
  }

  .discover-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
  }

  .discover-btn .arrow-icon {
    transition: transform 0.3s ease;
    font-size: 1.2rem;
  }

  .discover-btn:hover .arrow-icon {
    transform: translateX(4px);
  }
</style>

<section id="banner" class="position-relative" style="background: linear-gradient(135deg, #1a1a1a 0%, #363636 100%);">
  <div class="swiper main-swiper">
    <div class="swiper-wrapper">

      @foreach($categories as $category)
      
        <div class="swiper-slide">
          <div class="position-relative">
            <img src="{{ asset('banner/' . $category->slug . '.png') }}" class="w-100" style="height: 600px; object-fit: cover; filter: brightness(0.9);" alt="Ofertas en {{ $category->name }}">
            <div class="banner-overlay"></div>
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center">
              <div class="container">
                <div class="row justify-content-center">
                  <div class="col-md-6 p-5 banner-content-box">
                    <div class="secondary-font text-primary text-uppercase mb-4 fw-bold">Ofertas exclusivas</div>
                    <h2 class="banner-title display-1 fw-normal mb-4">Las mejores ofertas en  <span class="text-primary">{{ $category->name }}</span></h2>
                    <a href="{{route('categoryOffers', ['name' => $category->name ])}}" class="btn btn-primary discover-btn">
                      Descubrir
                      <i class="fas fa-arrow-right arrow-icon"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

       @endforeach

        </div>
    <div class="swiper-pagination"></div>
    {{-- <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div> --}}
  </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const swiper = new Swiper('.main-swiper', {
    init: true,
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    effect: 'fade',
    fadeEffect: {
      crossFade: true
    },
    speed: 1000,
    on: {
      init: function() {
        console.log('Swiper initialized');
      }
    }
  });

  // Asegurarse de que el autoplay comience
  swiper.autoplay.start();
});
</script>
@endpush