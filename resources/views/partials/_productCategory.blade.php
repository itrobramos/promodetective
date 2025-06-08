<section id="clothing" class="my-5 overflow-hidden">
    <div class="container pb-5">


        @foreach ($result as $category => $products)
            @if (empty($products))
                @continue
            @endif

            <div class="section-header d-md-flex justify-content-between align-items-center mb-3">
                <h2 class="display-3 fw-normal">{{ $category }}</h2>
                <div>
                    <a href="{{route('categoryOffers', ['name' => $category])}}" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                        Ver más
                        <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                            <use xlink:href="#arrow-right"></use>
                        </svg></a>
                </div>
            </div>

            <div class="products-carousel swiper">
                <div class="swiper-wrapper">

                    @foreach ($products as $product)
                        @include('partials._productCard', ['product' => $product])
                    @endforeach

                </div>
            </div>

            <br><br>
        @endforeach
    </div>


    <script>
        // JavaScript para abrir y cerrar el modal
        const modal = document.getElementById("myModal");
        const openModalBtn = document.querySelectorAll(".openModalBtn");

        const closeModalBtn = document.querySelector(".close");
        const iframe = document.getElementById("dynamicIframe");

        // Evento para abrir el modal y cargar el iframe

        openModalBtn.forEach((container, index) => {
            container.addEventListener("click", () => {
                const parametro = container.getAttribute("data-asin"); // Obtiene el valor de data-valor

                iframe.src = "https://graph.keepa.com/pricehistory.png?asin=" + parametro +
                "&domain=com.mx&width=800&height=400"; // Cambia a la URL dinámica que desees
                modal.style.display = "flex";
            });
        });


        // Evento para cerrar el modal
        closeModalBtn.addEventListener("click", () => {
            modal.style.display = "none";
            iframe.src = ""; // Limpia el iframe al cerrar
        });

        // Cerrar el modal al hacer clic fuera de él
        window.addEventListener("click", (event) => {
            if (event.target === modal) {
                modal.style.display = "none";
                iframe.src = "";
            }
        });
    </script>


</section>
