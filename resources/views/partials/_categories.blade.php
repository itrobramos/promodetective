<section id="categories">
    <div class="container my-3 py-5">
      <div class="row my-5">

        @foreach ($categories as $category)
        
            <div class="col text-center">
                <a href="{{route('categoryOffers', ['name' => $category->name])}}" class="categories-item">
                <iconify-icon class="category-icon" icon="ph:bowl-food"></iconify-icon>
                <h5>{{$category->name}}</h5>
                </a>
            </div>
            
        @endforeach

      </div>
    </div>
  </section>
