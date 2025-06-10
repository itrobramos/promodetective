<!DOCTYPE html>
<html lang="en">

<head>
  <title>Mi Perfil - PromoDetective</title>
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

  <style>
    .profile-sidebar .nav-link {
      color: #6c757d;
      padding: 0.8rem 1rem;
      border-radius: 0.5rem;
      transition: all 0.3s ease;
    }

    .profile-sidebar .nav-link:hover,
    .profile-sidebar .nav-link.active {
      color: var(--bs-primary);
      background-color: rgba(var(--bs-primary-rgb), 0.1);
    }

    .profile-sidebar .nav-link i {
      width: 1.5rem;
    }

    .profile-card {
      border: none;
      box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
      border-radius: 1rem;
    }

    .alert-banner {
      border-left: 4px solid var(--bs-primary);
    }

    .stats-card {
      transition: transform 0.3s ease;
    }

    .stats-card:hover {
      transform: translateY(-5px);
    }
  </style>
</head>

<body>

  @include('partials._preloader')
  @include('partials._header')

  <section class="page-title bg-light py-5">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center">
          <h1 class="display-4 fw-normal">Mi Perfil</h1>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
              <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Inicio</a></li>
              <li class="breadcrumb-item active" aria-current="page">Mi Perfil</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>

  <section class="profile-section py-5">
    <div class="container">
      <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3 mb-4">
          <div class="profile-sidebar card profile-card">
            <div class="card-body">
              <div class="text-center mb-4">
                <div class="mb-3">
                  @if(auth()->user()->profile_photo_path)
                    <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" 
                         class="rounded-circle" width="100" height="100" alt="Foto de perfil">
                  @else
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto" 
                         style="width: 100px; height: 100px; font-size: 2.5rem;">
                      {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                  @endif
                </div>
                <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                <p class="text-muted mb-0">{{ auth()->user()->email }}</p>
              </div>
              <nav class="nav flex-column">
                <a class="nav-link active d-flex align-items-center" href="#">
                  <i class="fas fa-user-circle me-2"></i>
                  Información Personal
                </a>
                <a class="nav-link d-flex align-items-center" href="#">
                  <i class="fas fa-heart me-2"></i>
                  Productos Favoritos
                </a>
                <a class="nav-link d-flex align-items-center" href="#">
                  <i class="fas fa-bell me-2"></i>
                  Mis Alertas
                </a>
                <a class="nav-link d-flex align-items-center" href="#">
                  <i class="fas fa-cog me-2"></i>
                  Configuración
                </a>
              </nav>
            </div>
          </div>

          <!-- Estadísticas del Usuario -->
          <div class="card profile-card mt-4">
            <div class="card-body">
              <h5 class="card-title mb-4">Mis Estadísticas</h5>
              <div class="d-grid gap-3">
                <div class="stats-card bg-light p-3 rounded">
                  <h6 class="mb-1">
                    <i class="fas fa-heart text-danger me-2"></i>
                    Productos Favoritos
                  </h6>
                  <p class="h4 mb-0">{{ auth()->user()->likes()->count() }}</p>
                </div>
                <div class="stats-card bg-light p-3 rounded">
                  <h6 class="mb-1">
                    <i class="fas fa-bell text-primary me-2"></i>
                    Alertas Activas
                  </h6>
                  <p class="h4 mb-0">0</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Contenido Principal -->
        <div class="col-lg-9">
          <!-- Banner de Bienvenida -->
          <div class="alert alert-banner bg-white shadow-sm mb-4">
            <div class="d-flex align-items-center">
              <div class="flex-grow-1">
                <h4 class="alert-heading mb-1">¡Bienvenido de vuelta, {{ explode(' ', auth()->user()->name)[0] }}!</h4>
                <p class="mb-0 text-muted">Mantente al día con tus productos favoritos y alertas de precios.</p>
              </div>
              <img src="{{ asset('images/logo.png') }}" alt="Logo" height="50">
            </div>
          </div>

          <!-- Información Personal -->
          <div class="card profile-card mb-4">
            <div class="card-header bg-white py-3">
              <h5 class="card-title mb-0">Información Personal</h5>
            </div>
            <div class="card-body">
              <form id="profileForm">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" value="{{ auth()->user()->name }}">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" value="{{ auth()->user()->email }}" disabled>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">Teléfono</label>
                    <input type="tel" class="form-control" id="phone" placeholder="Tu número de teléfono">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="notifications" class="form-label">Notificaciones</label>
                    <select class="form-select" id="notifications">
                      <option value="all">Todas las notificaciones</option>
                      <option value="important">Solo importantes</option>
                      <option value="none">Ninguna</option>
                    </select>
                  </div>
                </div>
                <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>
                    Guardar Cambios
                  </button>
                </div>
              </form>
            </div>
          </div>

          <!-- Productos Favoritos Recientes -->
          <div class="card profile-card">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
              <h5 class="card-title mb-0">Productos Favoritos Recientes</h5>
              <a href="#" class="btn btn-link text-decoration-none">
                Ver todos <i class="fas fa-arrow-right ms-1"></i>
              </a>
            </div>
            <div class="card-body">              <div class="row g-4">
                @forelse(auth()->user()->likes()->latest()->take(4)->get() as $product)
                  <div class="col-md-6">
                    <div class="card h-100 shadow-sm">
                      <div class="position-relative">
                        <img src="{{ $product->image_url }}" class="card-img-top p-3" alt="{{ $product->friendly_name }}">
                        <button class="btn-like position-absolute top-0 end-0 m-3 already-liked" 
                                data-product-id="{{ $product->id }}">
                          <iconify-icon class="heart-icon" icon="mdi:cards-heart"></iconify-icon>
                        </button>
                      </div>
                      <div class="card-body">
                        <h6 class="card-title">{{ $product->friendly_name }}</h6>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                          <span class="text-primary fw-bold">${{ $product->last_price }}</span>
                          <a href="{{ $product->affiliate_url }}" target="_blank" 
                             class="btn btn-sm btn-outline-primary">
                            Ver en Amazon
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                @empty
                  <div class="col-12">
                    <div class="text-center py-4">
                      <i class="fas fa-heart text-muted mb-3" style="font-size: 3rem;"></i>
                      <p class="text-muted mb-0">Aún no tienes productos favoritos</p>
                      <a href="/" class="btn btn-outline-primary mt-3">Explorar productos</a>
                    </div>
                  </div>
                @endforelse
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  @include('partials._footer')

  <script src="{{asset('js/jquery-1.11.0.min.js')}}"></script>
  <script src="{{asset('js/plugins.js')}}"></script>
  <script src="{{asset('js/script.js')}}"></script>
  <script src="{{asset('js/iconify.js')}}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Manejar el envío del formulario
      const profileForm = document.getElementById('profileForm');
      profileForm.addEventListener('submit', function(e) {
        e.preventDefault();
        // Aquí iría la lógica para guardar los cambios
        alert('Cambios guardados correctamente');
      });

      // Manejar los botones de like
      document.querySelectorAll('.btn-like').forEach(btn => {
        btn.addEventListener('click', function() {
          const productId = this.dataset.productId;
          // Aquí iría la lógica para quitar de favoritos
          this.closest('.col-md-6').remove();
        });
      });
    });
  </script>
</body>
</html>
