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

  

  <section id="banner-2" class="my-3" style="background: #F9F3EC;">
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
  </section>

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

  <footer id="footer" class="my-5">
    <div class="container py-5 my-5">
      <div class="row">
        <div class="col-md-3">
          <div class="footer-menu"> 
            <img src="images/logo.png" alt="logo">
            <p class="blog-paragraph fs-6 mt-3">Subscribe to our newsletter to get updates about our grand offers.</p>
            <div class="social-links">
              <ul class="d-flex list-unstyled gap-2">
                <li class="social">
                  <a href="#">
                    <iconify-icon class="social-icon" icon="ri:facebook-fill"></iconify-icon>
                  </a>
                </li>
                <li class="social">
                  <a href="#">
                    <iconify-icon class="social-icon" icon="ri:twitter-fill"></iconify-icon>
                  </a>
                </li>
                <li class="social">
                  <a href="#">
                    <iconify-icon class="social-icon" icon="ri:pinterest-fill"></iconify-icon>
                  </a>
                </li>
                <li class="social">
                  <a href="#">
                    <iconify-icon class="social-icon" icon="ri:instagram-fill"></iconify-icon>
                  </a>
                </li>
                <li class="social">
                  <a href="#">
                    <iconify-icon class="social-icon" icon="ri:youtube-fill"></iconify-icon>
                  </a>
                </li>

              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="footer-menu">
            <h3>Quick Links</h3>
            <ul class="menu-list list-unstyled">
              <li class="menu-item">
                <a href="#" class="nav-link">Home</a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link">About us</a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link">Offer </a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link">Services</a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link">Conatct Us</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-3">
          <div class="footer-menu">
            <h3>Help Center</h5>
              <ul class="menu-list list-unstyled">
                <li class="menu-item">
                  <a href="#" class="nav-link">FAQs</a>
                </li>
                <li class="menu-item">
                  <a href="#" class="nav-link">Payment</a>
                </li>
                <li class="menu-item">
                  <a href="#" class="nav-link">Returns & Refunds</a>
                </li>
                <li class="menu-item">
                  <a href="#" class="nav-link">Checkout</a>
                </li>
                <li class="menu-item">
                  <a href="#" class="nav-link">Delivery Information</a>
                </li>
              </ul>
          </div>
        </div>
        <div class="col-md-3">
          <div>
            <h3>Our Newsletter</h3>
            <p class="blog-paragraph fs-6">Subscribe to our newsletter to get updates about our grand offers.</p>
            <div class="search-bar border rounded-pill border-dark-subtle px-2">
              <form class="text-center d-flex align-items-center" action="" method="">
                <input type="text" class="form-control border-0 bg-transparent" placeholder="Enter your email here" />
                <iconify-icon class="send-icon" icon="tabler:location-filled"></iconify-icon>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </footer>

  <div id="footer-bottom">
    <div class="container">
      <hr class="m-0">
      <div class="row mt-3">
        <div class="col-md-6 copyright">
          <p class="secondary-font">© 2025 PromoDetective. Todos los derechos reservados.</p>
        </div>
      </div>
    </div>
  </div>

  <script src="{{asset('js/jquery-1.11.0.min.js')}}"></script>
  <script src="{{asset('js/swiper.js')}}"></script>
  <script src="{{asset('js/bootstrap.bundle.js')}}"></script>
  <script src="{{asset('js/plugins.js')}}"></script>
  <script src="{{asset('js/script.js')}}"></script>
  <script src="{{asset('js/iconify.js')}}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById("myModal");
        const openModalBtns = document.querySelectorAll(".openModalBtn");
        const closeModalBtn = document.querySelector(".close");
        const iframe = document.getElementById("dynamicIframe");
        const productTitle = document.getElementById("productTitle");

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