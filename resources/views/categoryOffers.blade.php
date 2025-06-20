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
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
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
          <h1 class="display-4 fw-normal">{{ $category->name ?? 'Categoría' }}</h1>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
              <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Inicio</a></li>
              @if($category && $category->parent_category_id)
                @php
                  $parentCategory = \App\Models\Category::find($category->parent_category_id);
                  $breadcrumb = collect();
                  while($parentCategory) {
                    $breadcrumb->push($parentCategory);
                    $parentCategory = \App\Models\Category::find($parentCategory->parent_category_id);
                  }
                @endphp
                @foreach($breadcrumb->reverse() as $parent)
                  <li class="breadcrumb-item"><a href="{{ route('categoryOffers', ['name' => $parent->name]) }}" class="text-decoration-none">{{ $parent->name }}</a></li>
                @endforeach
              @endif
              <li class="breadcrumb-item active" aria-current="page">{{ $category->name ?? 'Categoría' }}</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>

  {{-- @include('partials._categories', ['categories' => $categories])

  @include('partials._productCategory', ['result' => $result]) --}}

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

  <section class="products-grid py-5">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                @if($subcategories && count($subcategories) > 0)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Subcategorías</h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach($subcategories as $subcategory)
                            <li class="list-group-item">
                                <a href="{{ route('categoryOffers', ['name' => $subcategory->name]) }}" 
                                   class="text-decoration-none text-dark d-flex justify-content-between align-items-center">
                                    {{ $subcategory->name }}
                                    <span class="badge bg-primary rounded-pill">
                                        {{ $subcategory->products_count ?? 0 }}
                                    </span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <!-- Filtros adicionales -->
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
                    @foreach($result as $product)
                        @include('partials._productCard', ['product' => $product])
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-5">
                    {{ $result->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</section>

<x-price-chart-modal />

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
  <script src="{{asset('js/iconify.js')}}"></script>  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Inicializar todos los tooltips
      const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
        // Manejo del ordenamiento
        const orderSelect = document.getElementById('orderSelect');
        const applyFilters = document.getElementById('applyFilters');

        applyFilters.addEventListener('click', function() {
            const currentUrl = new URL(window.location.href);
            const selectedOrder = orderSelect.value;
            const minPrice = document.getElementById('minPrice').value;
            const maxPrice = document.getElementById('maxPrice').value;
            
            // Actualizar o agregar los parámetros
            currentUrl.searchParams.set('order', selectedOrder);
            
            // Solo agregar los parámetros de precio si tienen valor
            if (minPrice) {
                currentUrl.searchParams.set('min_price', minPrice);
            } else {
                currentUrl.searchParams.delete('min_price');
            }
            
            if (maxPrice) {
                currentUrl.searchParams.set('max_price', maxPrice);
            } else {
                currentUrl.searchParams.delete('max_price');
            }
            
            // Redirigir a la nueva URL con los parámetros
            window.location.href = currentUrl.toString();
        });

        // Modal code
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
                const title = btn.closest('.product-card').querySelector('.card-title').innerText.trim();
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