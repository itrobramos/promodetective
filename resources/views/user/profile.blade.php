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
      color: white;
      background-color: #DEAD6F;
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
    }    .stats-card:hover {
      transform: translateY(-5px);
    }

    .profile-section .mb-3 img,
    .profile-section .mb-3 .rounded-circle {
      width: 150px !important;
      height: 150px !important;
      margin: 0 auto;
    }

    .profile-section .mb-3 {
      margin-bottom: 1.5rem !important;
    }

    .profile-photo-container {
      position: relative;
      display: inline-block;
    }

    .profile-photo-actions {
      margin-top: 1rem;
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
    </div>  </section>
  <section class="profile-section pt-1 pb-3">
    <div class="container">
      <!-- Información del perfil -->
      <div class="text-center mb-4">
        <div class="mb-3">@if(auth()->user()->profile_photo_path)
                    <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" 
                         class="rounded-circle" width="100" height="100" alt="Foto de perfil"
                         id="currentProfilePhoto"                         onerror="this.onerror=null; const initial = '{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}'; this.style.display='none'; this.insertAdjacentHTML('afterend', `<div class='rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto' style='width: 100px; height: 100px; font-size: 2.5rem;' id='currentProfilePhoto'>${initial}</div>`); document.getElementById('removePhotoBtn')?.classList.add('d-none');">
                  @else
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto" 
                         style="width: 100px; height: 100px; font-size: 2.5rem;"
                         id="currentProfilePhoto">
                      {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                  @endif
                  
                  <!-- Botones para cambiar/eliminar foto -->
                  <form id="profilePhotoForm" class="mt-3">
                    @csrf
                    <div class="d-flex flex-column align-items-center">
                      <input type="file" name="photo" id="photoInput" class="d-none" accept="image/*">
                      <button type="button" class="btn btn-outline-primary btn-sm mb-2" onclick="document.getElementById('photoInput').click()">
                        <i class="fas fa-camera me-1"></i> Cambiar foto
                      </button>
                      @if(auth()->user()->profile_photo_path)
                        <button type="button" class="btn btn-outline-danger btn-sm" id="removePhotoBtn">
                          <i class="fas fa-trash-alt me-1"></i> Eliminar foto
                        </button>
                      @endif
                    </div>
                  </form>

                  <!-- Preview de la nueva foto -->
                  <div id="previewContainer" class="mt-2 d-none">
                    <img id="photoPreview" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                  </div>                </div>
                <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                <p class="text-muted mb-0">{{ auth()->user()->email }}</p>
      </div>

      <div class="row mt-4">
        <!-- Sidebar -->
        <div class="col-lg-3 mb-4">
          <div class="profile-sidebar card profile-card">
            <div class="card-body">
              <nav class="nav flex-column">
                <a class="nav-link active d-flex align-items-center" href="#info-personal">
                  <i class="fas fa-user-circle me-2"></i>
                  Información Personal
                </a>
                <a class="nav-link d-flex align-items-center" href="#favoritos">
                  <i class="fas fa-heart me-2"></i>
                  Productos Favoritos
                </a>
                <a class="nav-link d-flex align-items-center" href="#monitorear" id="monitorearLink">
                  <i class="fas fa-search-dollar me-2"></i>
                  Monitorear Producto
                </a>
                <a class="nav-link d-flex align-items-center" href="#alertas">
                  <i class="fas fa-bell me-2"></i>
                  Mis Alertas
                </a>
                <a class="nav-link d-flex align-items-center" href="#configuracion">
                  <i class="fas fa-cog me-2"></i>
                  Configuración
                </a>
              </nav>
            </div>
          </div>          <!-- Estadísticas del Usuario -->
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
          <!-- Información Personal -->
          <div class="card profile-card mb-4" id="info-personal">
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
          </div>          <!-- Productos Favoritos Recientes -->
          <div class="card profile-card" id="favoritos">
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

          <!-- Contenido principal -->
          <div class="tab-content mt-4">            
            <!-- Sección para Monitorear Productos -->
            <div class="card profile-card mb-4" id="monitorear">
              <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                  <i class="fas fa-search-dollar me-2"></i>
                  Monitorear Nuevo Producto
                </h5>
              </div>
              <div class="card-body">
                <div class="alert alert-info alert-banner">
                  <i class="fas fa-info-circle me-2"></i>
                  Ingresa el ASIN del producto de Amazon que deseas monitorear. El ASIN es un código único de 10 caracteres que puedes encontrar en la URL del producto.
                </div>

                <form id="monitorProductForm" class="mt-3">
                  <div class="mb-3">
                    <label for="asin" class="form-label">ASIN del Producto</label>
                    <div class="input-group">
                      <input type="text" 
                             class="form-control" 
                             id="asin" 
                             name="asin" 
                             placeholder="Ej: B01EXAMPLE" 
                             pattern="[A-Z0-9]{10}" 
                             required>
                      <button class="btn btn-primary" type="submit">
                        <i class="fas fa-plus me-2"></i>
                        Agregar
                      </button>
                    </div>
                    <div class="form-text">
                      El ASIN debe tener exactamente 10 caracteres alfanuméricos.
                    </div>
                  </div>
                </form>

                <div id="monitorResponse" class="alert d-none">
                </div>
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

      // Formulario de monitoreo de productos
      const monitorProductForm = document.getElementById('monitorProductForm');
      const monitorResponse = document.getElementById('monitorResponse');

      monitorProductForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const submitButton = this.querySelector('button[type="submit"]');
        const originalButtonContent = submitButton.innerHTML;
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Agregando...';
        
        try {
          const response = await fetch('/products/monitor', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
              asin: this.asin.value.toUpperCase()
            })
          });

          const data = await response.json();
          
          monitorResponse.classList.remove('d-none', 'alert-success', 'alert-danger');
          
          if (response.ok) {
            monitorResponse.classList.add('alert-success');
            monitorResponse.innerHTML = '<i class="fas fa-check-circle me-2"></i>' + data.message;
            this.reset();
          } else {
            monitorResponse.classList.add('alert-danger');
            monitorResponse.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i>' + data.message;
          }
        } catch (error) {
          monitorResponse.classList.remove('d-none');
          monitorResponse.classList.add('alert-danger');
          monitorResponse.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i>Error al procesar la solicitud. Por favor, intenta de nuevo.';
        } finally {
          submitButton.disabled = false;
          submitButton.innerHTML = originalButtonContent;
        }
      });      // Manejar la navegación del sidebar
      const navLinks = document.querySelectorAll('.profile-sidebar .nav-link');
      const allSections = document.querySelectorAll('.card[id]');
      
      // Función para mostrar una sección y ocultar las demás
      function showSection(sectionId) {
        // Ocultar todas las secciones
        allSections.forEach(section => {
          section.style.display = 'none';
        });
        
        // Mostrar la sección seleccionada
        const targetSection = document.querySelector(sectionId);
        if (targetSection) {
          targetSection.style.display = 'block';
        }
        
        // Actualizar estado activo de los enlaces
        navLinks.forEach(link => {
          link.classList.toggle('active', link.getAttribute('href') === sectionId);
        });
      }
      
      // Mostrar la sección inicial (Información Personal)
      showSection('#info-personal');
      
      // Manejar clics en los enlaces del sidebar
      navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          showSection(this.getAttribute('href'));
        });
      });

      // Photo upload functionality
      document.getElementById('photoInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function(e) {
            const preview = document.getElementById('photoPreview');
            const previewContainer = document.getElementById('previewContainer');
            preview.src = e.target.result;
            previewContainer.classList.remove('d-none');
            
            // Submit the form automatically when a file is selected
            const formData = new FormData(document.getElementById('profilePhotoForm'));
            fetch('{{ route('user-profile-photo.store') }}', {
              method: 'POST',
              body: formData,
              headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
              }
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                // Update the current profile photo
                const currentPhoto = document.getElementById('currentProfilePhoto');
                if (currentPhoto.tagName === 'IMG') {
                  currentPhoto.src = e.target.result;
                } else {
                  // Replace the initial div with an img
                  const newImg = document.createElement('img');
                  newImg.src = e.target.result;
                  newImg.className = 'rounded-circle';
                  newImg.width = 100;
                  newImg.height = 100;
                  newImg.alt = 'Foto de perfil';
                  newImg.id = 'currentProfilePhoto';
                  currentPhoto.parentNode.replaceChild(newImg, currentPhoto);
                }
                previewContainer.classList.add('d-none');
                
                // Show success message
                toastr.success('Foto de perfil actualizada exitosamente');
              } else {
                toastr.error('Error al actualizar la foto de perfil');
              }
            })
            .catch(error => {
              console.error('Error:', error);
              toastr.error('Error al actualizar la foto de perfil');
            });
          }
          reader.readAsDataURL(file);
        }
      });

      if (document.getElementById('removePhotoBtn')) {
        document.getElementById('removePhotoBtn').addEventListener('click', function() {
          if (confirm('¿Estás seguro de que deseas eliminar tu foto de perfil?')) {
            fetch('{{ route('user-profile-photo.destroy') }}', {
              method: 'DELETE',
              headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
              }
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                // Replace img with initial div showing first letter
                const currentPhoto = document.getElementById('currentProfilePhoto');
                const div = document.createElement('div');
                div.className = 'rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto';
                div.style = 'width: 100px; height: 100px; font-size: 2.5rem;';
                div.id = 'currentProfilePhoto';
                div.textContent = '{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}';
                currentPhoto.parentNode.replaceChild(div, currentPhoto);
                
                // Hide the remove button
                document.getElementById('removePhotoBtn').classList.add('d-none');
                toastr.success('Foto de perfil eliminada exitosamente');
              } else {
                toastr.error('Error al eliminar la foto de perfil');
              }
            })
            .catch(error => {
              console.error('Error:', error);
              toastr.error('Error al eliminar la foto de perfil');
            });
          }
        });
      }
    });
  </script>
</body>
</html>
