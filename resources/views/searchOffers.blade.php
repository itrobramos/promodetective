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
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
  
   @include('partials._preloader')

  @include('partials._header')

  <section class="page-title bg-light py-5">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center">
          <h1 class="display-4 fw-normal">Resultados: {{ $query }}</h1>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
              <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Inicio</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ $query }}</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  
  {{-- @include('partials._categories', ['categories' => $categories])
  
  @include('partials._productCategory', ['result' => $result]) --}}
  
  @if($products->isEmpty())
  <div class="alert alert-info">
    No se encontraron productos que coincidan con tu búsqueda.
  </div>
  @else
  <section class="filter-tags py-3 bg-light">
    <div class="container">
      <div class="d-flex gap-3 justify-content-center flex-wrap">
        <button class="btn btn-outline-primary rounded-pill active" data-filter="all">
          Todos
        </button>
        <button class="btn btn-outline-success rounded-pill" data-filter="best-historical">
          <i class="fas fa-crown"></i> Mejor precio histórico
        </button>
        <button class="btn btn-outline-primary rounded-pill" data-filter="best-30-days">
          <i class="fas fa-clock"></i> Mejor precio en 30 días
        </button>
        <button class="btn btn-outline-danger rounded-pill" data-filter="good-price">
          <i class="fas fa-fire"></i> Buen precio
        </button>
      </div>
    </div>
  </section>
  
</div>
</section>

<section class="products-grid py-5">
  <div class="container">
      <div class="row g-4">
          @foreach($products as $product)
          <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
              <div class="card product-card h-100 border rounded-3 shadow-sm">
                  <div class="position-relative">
                      <div class="price-badges position-absolute top-0 start-0 m-3 d-flex flex-column gap-2">
                          @if($product['is_lowest_price'] ?? false)
                          <div class="badge bg-success px-2 py-1">
                              <i class="fas fa-crown"></i> Mejor precio histórico
                          </div>
                          @elseif ($product['is_best_price_30_days'] ?? false)
                          <div class="badge bg-primary px-2 py-1">
                              <i class="fas fa-clock"></i> Mejor precio en 30 días
                          </div>
                          @elseif ($product['last_price'] < $product['price_goal'] ?? false)
                          <div class="badge bg-danger px-2 py-1">
                              <i class="fas fa-fire"></i> Buen precio
                          </div>
                          @else
                          <div class="badge bg-dark px-2 py-1">
                              <i class="fas fa-xmark"></i> No es una oferta
                          </div>
                          @endif
                      </div>
                      <button class="btn-like position-absolute top-0 end-0 m-3 bg-white rounded-circle border-0 shadow-sm" 
                              data-product-id="{{$product['id']}}" 
                              data-likes="{{$product['likes'] ?? 0}}">
                          <i class="fas fa-heart"></i>
                          <span class="likes-count">{{$product['likes'] ?? 0}}</span>
                      </button>
                      <a href="{{$product['affiliate_url']}}" target="_blank">
                          <img src="{{$product['image_url']}}" class="card-img-top p-3 imgProduct" alt="{{$product['friendly_name']}}">
                      </a>
                  </div>
                  <div class="card-body d-flex flex-column">
                      <a href="{{$product['affiliate_url']}}" target="_blank" class="text-decoration-none">
                          <h5 class="card-title text-dark">{{$product['friendly_name']}}</h5>
                      </a>
                      <div class="d-flex justify-content-between align-items-center mt-3">
                          <h4 class="text-primary mb-0">${{$product['last_price']}}</h4>
                          <button class="btn btn-primary rounded-2 d-flex align-items-center gap-2 openModalBtn" data-asin="{{$product['asin']}}">
                              <i class="fas fa-chart-bar"></i>
                              <span></span>
                          </button>
                      </div>
                      <div class="d-flex gap-2 mt-3">
                          <a href="{{$product['affiliate_url']}}" target="_blank" class="btn btn-outline-primary flex-grow-1">
                              Ver en Amazon
                          </a>
                          <button class="btn btn-outline-secondary share-button" 
                                  data-url="{{$product['affiliate_url']}}" 
                                  data-title="{{$product['friendly_name']}}"
                                  title="Compartir producto">
                              <i class="fas fa-share-alt"></i>
                          </button>
                      </div>
                  </div>
              </div>
          </div>
          @endforeach
      </div>
  </div>
</section>


@endif



<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="modal-header">
      <h2 class="modal-title">Gráfica de Precios</h2>
    </div>
    <div class="modal-body">
      <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    </div>
  </div>
</div>


<section id="insta" class="my-5">
  <div class="row g-0 py-5">
    <div class="col instagram-item  text-center position-relative">
      <div class="icon-overlay d-flex justify-content-center position-absolute">
        <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
      </div>
      <a href="#">
        <img src="{{ asset('images/insta1.jpg') }}" alt="insta-img" class="img-fluid rounded-3">
      </a>
    </div>
    <div class="col instagram-item  text-center position-relative">
      <div class="icon-overlay d-flex justify-content-center position-absolute">
        <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
      </div>
      <a href="#">
        <img src="{{ asset('images/insta2.jpg') }}" alt="insta-img" class="img-fluid rounded-3">
      </a>
    </div>
    <div class="col instagram-item  text-center position-relative">
      <div class="icon-overlay d-flex justify-content-center position-absolute">
        <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
      </div>
      <a href="#">
        <img src="{{ asset('images/insta3.jpg') }}" alt="insta-img" class="img-fluid rounded-3">
      </a>
    </div>
    <div class="col instagram-item  text-center position-relative">
      <div class="icon-overlay d-flex justify-content-center position-absolute">
        <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
      </div>
      <a href="#">
        <img src="{{ asset('images/insta4.jpg') }}" alt="insta-img" class="img-fluid rounded-3">
      </a>
    </div>
    <div class="col instagram-item  text-center position-relative">
      <div class="icon-overlay d-flex justify-content-center position-absolute">
        <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
      </div>
      <a href="#">
        <img src="{{ asset('images/insta5.jpg') }}" alt="insta-img" class="img-fluid rounded-3">
      </a>
    </div>
    <div class="col instagram-item  text-center position-relative">
      <div class="icon-overlay d-flex justify-content-center position-absolute">
        <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
      </div>
      <a href="#">
        <img src="{{ asset('images/insta6.jpg') }}" alt="insta-img" class="img-fluid rounded-3">
      </a>
    </div>
  </div>
</section>


<footer id="footer" class="my-5">
  <div class="container py-5 my-5">
    <div class="row">
      <div class="col-md-3">
        <div class="footer-menu">
          <img src="{{asset('images/logo.png')}}" alt="logo">
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
          <p class="secondary-font">© 2023 Waggy. All rights reserved.</p>
        </div>
        <div class="col-md-6 text-md-end">
          <p class="secondary-font">Free HTML Template by <a href="https://templatesjungle.com/" target="_blank"
            class="text-decoration-underline fw-bold text-black-50"> TemplatesJungle</a> </p>
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
  </body>
  
  </html>