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
                </div>                @else
                <div class="badge bg-dark px-2 py-1">
                    <i class="fas fa-xmark"></i> No es una oferta
                </div>
                @endif
            </div>            <button class="btn-like position-absolute top-0 end-0 m-3 {{$product['has_liked'] ? 'already-liked' : ''}}" 
                    data-product-id="{{$product['id']}}"
                    aria-label="Me gusta">
                <iconify-icon class="heart-icon" icon="mdi:cards-heart"></iconify-icon>
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
                <button class="btn btn-primary btn-sm rounded-2 d-flex align-items-center gap-1 openModalBtn" data-asin="{{$product['asin']}}">
                    <i class="fas fa-chart-bar"></i>
                </button>
            </div>
            <div class="d-flex gap-2 mt-3">
                <a href="{{$product['affiliate_url']}}" target="_blank" class="btn btn-outline-primary btn-sm flex-grow-1">
                    Ver en Amazon
                </a>
                <button class="btn btn-outline-secondary btn-sm share-button" 
                    data-url="{{$product['affiliate_url']}}" 
                    data-title="{{$product['friendly_name']}}"
                    title="Compartir producto">
                    <iconify-icon class="share-icon" icon="mdi:share"></iconify-icon>
                </button>
            </div>
        </div>
    </div>
</div>
