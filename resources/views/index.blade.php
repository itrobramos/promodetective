<!DOCTYPE html>
<html lang="en">

<head>
  <title>PromoDetective</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <meta name="mobile-web-app-capable" content="yes">  
  <meta name="author" content="">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script>
    window.csrfToken = '{{ csrf_token() }}';
  </script>

  <link href="{{asset('css/swiper.css')}}" rel="stylesheet">
  <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
  <link href="{{asset('css/vendor.css')}}" rel="stylesheet">
  <link href="{{asset('css/style.css')}}" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Chilanka&family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  
</head>

<body>

 
  @include('partials._preloader')

  @include('partials._nav')

  @include('partials._header')

  @include('partials._banner', ['categories' => $categories])

  <br>
  {{-- @include('partials._categories', ['categories' => $categories]) --}}

  @include('partials._productCategory', ['result' => $result])

  

  {{-- <section id="banner-2" class="my-3" style="background: #F9F3EC;">
    <div class="container">
      <div class="row flex-row-reverse banner-content align-items-center">
        <div class="img-wrapper col-12 col-md-6">
          <img src="images/banner-img2.png" class="img-fluid">
        </div>
        <div class="content-wrapper col-12 offset-md-1 col-md-5 p-5">
          <div class="secondary-font text-primary text-uppercase mb-3 fs-4">Upto 40% off</div>
          <h2 class="banner-title display-1 fw-normal">Clearance sale !!!
          </h2>
          <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
            shop now
            <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
              <use xlink:href="#arrow-right"></use>
            </svg></a>
        </div>

      </div>
    </div>
  </section> --}}

  <section id="insta" class="my-5">
    <div class="row g-0 py-5">
      <div class="col instagram-item  text-center position-relative">
        <div class="icon-overlay d-flex justify-content-center position-absolute">
          <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
        </div>
        <a href="#">
          <img src="images/insta1.jpg" alt="insta-img" class="img-fluid rounded-3">
        </a>
      </div>
      <div class="col instagram-item  text-center position-relative">
        <div class="icon-overlay d-flex justify-content-center position-absolute">
          <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
        </div>
        <a href="#">
          <img src="images/insta2.jpg" alt="insta-img" class="img-fluid rounded-3">
        </a>
      </div>
      <div class="col instagram-item  text-center position-relative">
        <div class="icon-overlay d-flex justify-content-center position-absolute">
          <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
        </div>
        <a href="#">
          <img src="images/insta3.jpg" alt="insta-img" class="img-fluid rounded-3">
        </a>
      </div>
      <div class="col instagram-item  text-center position-relative">
        <div class="icon-overlay d-flex justify-content-center position-absolute">
          <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
        </div>
        <a href="#">
          <img src="images/insta4.jpg" alt="insta-img" class="img-fluid rounded-3">
        </a>
      </div>
      <div class="col instagram-item  text-center position-relative">
        <div class="icon-overlay d-flex justify-content-center position-absolute">
          <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
        </div>
        <a href="#">
          <img src="images/insta5.jpg" alt="insta-img" class="img-fluid rounded-3">
        </a>
      </div>
      <div class="col instagram-item  text-center position-relative">
        <div class="icon-overlay d-flex justify-content-center position-absolute">
          <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
        </div>
        <a href="#">
          <img src="images/insta6.jpg" alt="insta-img" class="img-fluid rounded-3">
        </a>
      </div>
    </div>
  </section>

  {{-- @include('partials._testimonial') --}}

  <x-price-chart-modal />

  @include('partials._footer')

  <script src="{{asset('js/jquery-1.11.0.min.js')}}"></script>
  <script src="{{asset('js/swiper.js')}}"></script>
  <script src="{{asset('js/bootstrap.bundle.js')}}"></script>
  <script src="{{asset('js/plugins.js')}}"></script>
  <script src="{{asset('js/script.js')}}"></script>  <script src="{{asset('js/iconify.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById("myModal");
        const openModalBtns = document.querySelectorAll(".openModalBtn");
        const closeModalBtn = document.querySelector(".close");
        const iframe = document.getElementById("dynamicIframe");
        const productTitle = document.getElementById("productTitle");

        // Manejo de likes
        document.querySelectorAll('.btn-like').forEach(btn => {
            btn.addEventListener('click', async function() {
                if (!this.dataset.productId) return;

                const isLiked = this.classList.contains('already-liked');
                const productId = this.dataset.productId;
                const method = isLiked ? 'DELETE' : 'POST';
                const url = isLiked ? `/product/like/${productId}` : `/product/like/${productId}`;

                try {
                    const response = await fetch(url, {
                        method: method,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (response.ok) {
                        this.classList.toggle('already-liked');
                        // Actualizar el contador de likes si existe
                        const likesCounter = this.querySelector('.likes-count');
                        if (likesCounter) {
                            likesCounter.textContent = data.likes;
                        }
                    } else {
                        console.error('Error:', data.error);
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            });
        });

        modal.style.cssText = `
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            align-items: center;
            justify-content: center;
        `;

        openModalBtns.forEach(btn => {
            btn.addEventListener("click", () => {
                const asin = btn.getAttribute("data-asin");
                const title = btn.closest('.product-card').querySelector('.card-title').textContent;
                if (asin) {
                    iframe.src = `https://graph.keepa.com/pricehistory.png?asin=${asin}&domain=com.mx&width=800&height=400`;
                    productTitle.textContent = title;
                    modal.style.display = "flex";
                }
            });
        });

        closeModalBtn.addEventListener("click", () => {
            modal.style.display = "none";
            iframe.src = "";
            productTitle.textContent = "";
        });

        window.addEventListener("click", (event) => {
            if (event.target === modal) {
                modal.style.display = "none";
                iframe.src = "";
                productTitle.textContent = "";
            }
        });
    });
  </script>
</body>

</html>