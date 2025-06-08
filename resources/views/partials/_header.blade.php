<header>
  <div class="container py-2">
    <div class="row py-4 pb-0 pb-sm-4 align-items-center ">
      
      <div class="col-sm-4 col-lg-3 text-center text-sm-start">
        <div class="main-logo">
          <a href="{{ route('home') }}" class="d-block">
            <img src="{{ asset('images/logo.jpg') }}" alt="logo" class="img-fluid">
          </a>
        </div>
      </div>
        <div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-5 d-none d-lg-block">
        <div class="search-bar border rounded-2 px-3 border-dark-subtle">
          <form id="search-form" class="text-center d-flex align-items-center" action="{{ route('search') }}" method="GET">
            <input type="text" name="query" class="form-control border-0 bg-transparent" 
            placeholder="Buscar un producto" required
            value="{{ $query ?? '' }}"/>
            <button type="submit" class="btn btn-link border-0 bg-transparent p-0">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="currentColor" 
                d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
              </svg>
            </button>
          </form>
        </div>
      </div>

      <div class="col-lg-4 d-none d-lg-block text-end">
        <ul class="d-flex list-unstyled m-0 align-items-center justify-content-end">
          @auth
          <a href="{{ route('profile.show') }}" class="mx-3">
            <iconify-icon icon="healthicons:person" class="fs-4"></iconify-icon>
          </a>
          <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm">
              <iconify-icon icon="material-symbols:logout" class="align-middle"></iconify-icon>
              Cerrar sesión
            </button>
          </form>          @else
          <a href="{{ route('auth.google') }}" class="btn google-btn">
            <svg class="google-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
              <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
              <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
              <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
              <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
            </svg>
            <span>Iniciar sesión con Google</span>
          </a>
          <style>
            .google-btn {
              background-color: white;
              border: 1px solid #dadce0;
              border-radius: 4px;
              padding: 8px 16px;
              display: inline-flex;
              align-items: center;
              font-weight: 500;
              font-size: 14px;
              color: #3c4043;
              transition: all 0.2s ease;
            }
            .google-btn:hover {
              background-color: #f8f9fa;
              border-color: #dadce0;
              box-shadow: 0 1px 2px rgba(0,0,0,0.1);
              color: #3c4043;
            }
            .google-icon {
              width: 18px;
              height: 18px;
              margin-right: 8px;
            }
          </style>
          @endauth
        </ul>
      </div>
    </div>
  </div>
  
</header>