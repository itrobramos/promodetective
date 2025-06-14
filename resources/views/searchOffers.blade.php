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
  <link href="{{asset('css/pagination.css')}}" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Chilanka&family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
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
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <!-- Filtros -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Filtros</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Rango de Precio</label>
                            <div class="d-flex align-items-center gap-2">
                                <input type="number" id="minPrice" class="form-control" placeholder="Min" value="{{ request('min_price') }}">
                                <span>-</span>
                                <input type="number" id="maxPrice" class="form-control" placeholder="Max" value="{{ request('max_price') }}">
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Ordenar por</label>
                            <select class="form-select" id="orderSelect">
                                <option value="likes">Más relevantes</option>
                                <option value="price_asc" {{ request('order') == 'price_asc' ? 'selected' : '' }}>Menor precio</option>
                                <option value="price_desc" {{ request('order') == 'price_desc' ? 'selected' : '' }}>Mayor precio</option>
                                <option value="name_asc" {{ request('order') == 'name_asc' ? 'selected' : '' }}>Nombre A - Z</option>
                                <option value="name_desc" {{ request('order') == 'name_desc' ? 'selected' : '' }}>Nombre Z - A</option>
                            </select>
                        </div>

                        <button class="btn btn-outline-primary w-100 rounded-pill d-flex align-items-center justify-content-center gap-2" 
                                id="applyFilters">
                            <i class="fas fa-filter"></i>
                            <span>Aplicar filtros</span>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Products Grid -->
            <div class="col-lg-9">
                <div class="row g-4">
                    @foreach($products as $product)
                        @include('partials._productCard', ['product' => $product])
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-5">
                    {{ $products->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</section>

<x-price-chart-modal />


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

@include('partials._footer')

<script src="{{asset('js/jquery-1.11.0.min.js')}}"></script>
<script src="{{asset('js/swiper.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('js/plugins.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
<script src="{{asset('js/iconify.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

</body>
</html>