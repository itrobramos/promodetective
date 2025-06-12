<div class="col-12 col-sm-6 col-lg-4 col-xl-3">
    <div class="card product-card h-100 border rounded-3 shadow-sm">

    <div class="card product-card h-100 border rounded-3 shadow-sm d-flex flex-column">
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
                </div>                @else
                <div class="badge bg-dark px-2 py-1">
                    <i class="fas fa-xmark"></i> No es una oferta
                </div>
                @endif
            </div>              <a href="{{$product['affiliate_url']}}" target="_blank">
                <img src="{{$product['image_url']}}" class="card-img-top p-3 imgProduct" alt="{{$product['friendly_name']}}">
            </a>
        </div>
        <div class="card-body d-flex flex-column">            
            <a href="{{$product['affiliate_url']}}" target="_blank" class="text-decoration-none">
                <h5 class="card-title text-dark">{{$product['friendly_name']}}</h5>
            </a>            
            <div class="text-center mt-3">
                <h4 class="text-primary mb-3 fw-bold">${{$product['last_price']}}</h4>
            </div>            <div class="d-flex justify-content-center gap-2 mb-3">
                <button class="btn-like btn btn-outline-danger btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center {{$product['has_liked'] ? 'already-liked' : ''}}" 
                        style="width: 35px; height: 35px;"
                        data-product-id="{{$product['id']}}"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Me gusta">
                    <iconify-icon class="heart-icon" icon="mdi:cards-heart"></iconify-icon>
                </button>
                <button class="btn btn-outline-primary btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center openModalBtn"
                        style="width: 35px; height: 35px;"
                        data-asin="{{$product['asin']}}"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Ver gráfica de precios">
                    <i class="fas fa-chart-bar"></i>
                </button>                
                <button class="btn btn-outline-secondary btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center share-button" 
                        style="width: 35px; height: 35px;"
                        data-url="{{$product['affiliate_url']}}" 
                        data-title="{{$product['friendly_name']}}"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Compartir producto">
                    <iconify-icon class="share-icon" icon="mdi:share"></iconify-icon>
                </button>                <button class="btn btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center report-button" 
                        style="width: 35px; height: 35px; border-color: #DEAD6F; color: #DEAD6F;"
                        onmouseover="this.style.backgroundColor='#DEAD6F'; this.style.color='white';"
                        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#DEAD6F';"
                        data-product-id="{{$product['id']}}"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Reportar precio equivocado">
                    <i class="fas fa-flag"></i>
                </button>
            </div>
            </div>
            <div class="d-grid">
                <a href="{{$product['affiliate_url']}}" target="_blank" class="btn py-3" style="background-color: #DEAD6F; border-color: #DEAD6F; color: white;">
                    Ver en Amazon
                </a>
            </div>
        </div>
    </div>
</div>
