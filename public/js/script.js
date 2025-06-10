(function($) {

  "use strict";

  var initPreloader = function() {
    $(document).ready(function($) {
    var Body = $('body');
        Body.addClass('preloader-site');
    });
    $(window).load(function() {
        $('.preloader-wrapper').fadeOut();
        $('body').removeClass('preloader-site');
    });
  }

  // init Chocolat light box
	var initChocolat = function() {
		Chocolat(document.querySelectorAll('.image-link'), {
		  imageSize: 'contain',
		  loop: true,
		})
	}

  var initSwiper = function() {

    var swiper = new Swiper(".main-swiper", {
      speed: 500,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });

    var bestselling_swiper = new Swiper(".bestselling-swiper", {
      slidesPerView: 4,
      spaceBetween: 30,
      speed: 500,
      breakpoints: {
        0: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 3,
        },
        991: {
          slidesPerView: 4,
        },
      }
    });

    var testimonial_swiper = new Swiper(".testimonial-swiper", {
      slidesPerView: 1,
      speed: 500,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });

    var products_swiper = new Swiper(".products-carousel", {
      slidesPerView: 4,
      spaceBetween: 30,
      speed: 500,
      breakpoints: {
        0: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 3,
        },
        991: {
          slidesPerView: 4,
        },

      }
    });

  }

  var initProductQty = function(){

    $('.product-qty').each(function(){

      var $el_product = $(this);
      var quantity = 0;

      $el_product.find('.quantity-right-plus').click(function(e){
          e.preventDefault();
          var quantity = parseInt($el_product.find('#quantity').val());
          $el_product.find('#quantity').val(quantity + 1);
      });

      $el_product.find('.quantity-left-minus').click(function(e){
          e.preventDefault();
          var quantity = parseInt($el_product.find('#quantity').val());
          if(quantity>0){
            $el_product.find('#quantity').val(quantity - 1);
          }
      });

    });

  }

  // init jarallax parallax
  var initJarallax = function() {
    jarallax(document.querySelectorAll(".jarallax"));

    jarallax(document.querySelectorAll(".jarallax-keep-img"), {
      keepImg: true,
    });
  }

  // document ready
  $(document).ready(function() {
    
    initPreloader();
    initSwiper();
    initProductQty();
    initJarallax();
    initChocolat();

        // product single page
        var thumb_slider = new Swiper(".product-thumbnail-slider", {
          spaceBetween: 8,
          slidesPerView: 3,
          freeMode: true,
          watchSlidesProgress: true,
        });
    
        var large_slider = new Swiper(".product-large-slider", {
          spaceBetween: 10,
          slidesPerView: 1,
          effect: 'fade',
          thumbs: {
            swiper: thumb_slider,
          },
        });

    window.addEventListener("load", (event) => {
      //isotope
      $('.isotope-container').isotope({
        // options
        itemSelector: '.item',
        layoutMode: 'masonry'
      });


      var $grid = $('.entry-container').isotope({
        itemSelector: '.entry-item',
        layoutMode: 'masonry'
      });


      // Initialize Isotope
      var $container = $('.isotope-container').isotope({
        // options
        itemSelector: '.item',
        layoutMode: 'masonry'
      });

      $(document).ready(function () {
        //active button
        $('.filter-button').click(function () {
          $('.filter-button').removeClass('active');
          $(this).addClass('active');
        });
      });

      // Filter items on button click
      $('.filter-button').click(function () {
        var filterValue = $(this).attr('data-filter');
        if (filterValue === '*') {
          // Show all items
          $container.isotope({ filter: '*' });
        } else {
          // Show filtered items
          $container.isotope({ filter: filterValue });
        }
      });

    });

  }); // End of a document    // Product filter functionality
  document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-tags button');
    const productsContainer = document.querySelector('.products-grid .col-lg-9 .row');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            button.classList.add('active');

            const filter = button.getAttribute('data-filter');
            const productCards = document.querySelectorAll('.products-grid .col-lg-9 .product-card').forEach(card => {
                const parentCol = card.closest('.col-12');
                
                if (filter === 'all') {
                    parentCol.classList.remove('d-none');
                    return;
                }

                const hasBestHistorical = card.querySelector('.badge.bg-success') !== null;
                const hasBest30Days = card.querySelector('.badge.bg-primary') !== null;
                const hasGoodPrice = card.querySelector('.badge.bg-danger') !== null;

                let shouldShow = false;
                switch (filter) {
                    case 'best-historical':
                        shouldShow = hasBestHistorical;
                        break;
                    case 'best-30-days':
                        shouldShow = hasBest30Days;
                        break;
                    case 'good-price':
                        shouldShow = hasGoodPrice;
                        break;
                }

                if (shouldShow) {
                    parentCol.classList.remove('d-none');
                } else {
                    parentCol.classList.add('d-none');
                }
            });

            // Reorder visible cards
            const visibleCards = Array.from(document.querySelectorAll('.products-grid .col-lg-9 .row > div:not(.d-none)'));
            visibleCards.forEach(card => productsContainer.appendChild(card));

            // Trigger animation for visible cards
            setTimeout(() => {
                visibleCards.forEach(card => {
                    card.querySelector('.product-card').classList.add('animate');
                });
            }, 100);
        });
    });
  });

  // Like button functionality
  document.addEventListener('DOMContentLoaded', function() {    document.querySelectorAll('.btn-like').forEach(button => {
        // Si ya tiene like, asegurarnos que tenga la clase correcta
        if (button.classList.contains('already-liked')) {
            button.querySelector('.heart-icon').style.opacity = '1';
        }

        button.addEventListener('click', async function(e) {
            e.preventDefault();
              // Si ya tiene like, no hacer nada
            if (this.classList.contains('already-liked') || this.classList.contains('loading')) {
                return;
            }

            const productId = this.dataset.productId;
            const likeCount = this.querySelector('.likes-count');
            
            // Add loading state
            this.classList.add('loading');
            
            try {                const response = await fetch(`/product/like/${productId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });
                const data = await response.json();
                
                if (response.status === 401) {
                    // Usuario no autenticado, redirigir a login
                    window.location.href = '/auth/google';
                } else if (response.status === 400 && data.has_liked) {
                    // Ya dio like antes
                    this.classList.add('already-liked');
                    button.querySelector('.heart-icon').style.opacity = '1';
                } else if (response.ok) {
                    // Add animation and liked class
                    this.classList.add('liked');
                    this.classList.add('already-liked');
                    button.querySelector('.heart-icon').style.opacity = '1';
                }            } catch (error) {
                console.error('Error:', error);
            } finally {
                // Remove loading state regardless of success or failure
                this.classList.remove('loading');
            }
        });
    });
  });

  // Share button functionality
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.share-button').forEach(button => {
        button.addEventListener('click', async function() {
            const url = this.dataset.url;
            const title = this.dataset.title;
            const text = `¡Mira esta oferta! ${title}`;

            try {
                if (navigator.share) {
                    await navigator.share({
                        title: title,
                        text: text,
                        url: url
                    });
                } else {
                    // Fallback para navegadores que no soportan Web Share API
                    const tempInput = document.createElement('input');
                    document.body.appendChild(tempInput);
                    tempInput.value = url;
                    tempInput.select();
                    document.execCommand('copy');
                    document.body.removeChild(tempInput);
                    
                    // Mostrar feedback al usuario
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-check"></i>';
                    setTimeout(() => {
                        this.innerHTML = originalText;
                    }, 2000);

                    // Opcional: mostrar un toast o alert
                    alert('¡Enlace copiado al portapapeles!');
                }
            } catch (error) {
                console.error('Error al compartir:', error);
            }
        });
    });
  });

})(jQuery);

