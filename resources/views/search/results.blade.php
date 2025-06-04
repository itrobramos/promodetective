@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1>Resultados de búsqueda para: "{{ $query }}"</h1>
    
    @if($products->isEmpty())
        <div class="alert alert-info">
            No se encontraron productos que coincidan con tu búsqueda.
        </div>
    @else
        <div class="row mt-4">
            @foreach($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-primary font-weight-bold">${{ $product->price }}</span>
                            <a href="{{ $product->url }}" class="btn btn-primary" target="_blank">Ver oferta</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {{ $products->appends(['query' => $query])->links() }}
        </div>
    @endif
</div>
@endsection