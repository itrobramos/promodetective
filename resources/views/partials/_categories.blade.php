<style>
  .category-card {
    padding: 1.5rem;
    border-radius: 15px;
    transition: all 0.3s ease;
    background: white;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(0, 0, 0, 0.05);
    text-decoration: none;
    display: block;
  }

  .category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    border-color: var(--bs-primary);
  }

  .category-badge {
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 30px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 1rem;
    background: linear-gradient(45deg, #f8f9fa, #e9ecef);
    color: #495057;
  }

  .category-title {
    color: #212529;
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
  }

  .category-description {
    color: #6c757d;
    font-size: 0.9rem;
    margin-top: 0.5rem;
  }

  .badge {
    font-size: 0.85rem;
    padding: 0.5em 1em;
  }
</style>

<section id="categories" class="bg-gray-50">
    <div class="container my-3 py-5">
        <div class="row g-4">
            @foreach ($categories as $category)
                <div class="col-md-3 col-sm-6">
                    <a href="{{route('categoryOffers', ['name' => $category->name])}}" class="text-decoration-none">
                        <div class="category-card p-4 bg-white rounded-lg shadow-sm hover:shadow-lg transition-all">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-2 font-weight-bold text-gray-800">{{$category->name}}</h5>
                                <i class="fas fa-chevron-right text-primary"></i>
                            </div>
                            <div class="d-flex justify-content-start">
                                <span class="badge badge-primary category-badge">
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
