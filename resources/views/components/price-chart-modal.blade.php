<div id="myModal" class="modal" style="z-index: 1050; display: none;">
    <div class="modal-content" style="max-width: 90%; width: 1200px; margin: auto;">
        <span class="close" style="position: absolute; right: 15px; top: 10px; font-size: 24px; cursor: pointer;">&times;</span>
        <div class="modal-header">
            <h5 class="modal-title mb-0">Gráfica de Precios - <span id="productTitle" style="display: inline;"></span></h5>
        </div>
        <div class="modal-body">
            <div class="iframe-container" style="width: 100%; height: 500px;">
                <iframe id="dynamicIframe" style="width: 100%; height: 100%; border: none;" src=""></iframe>
            </div>
        </div>
    </div>
</div>

<style>
.modal {
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.4);
    display: none;
    align-items: center;
    justify-content: center;
}

.modal-content {
    background: #fff;
    border-radius: 8px;
    position: relative;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.modal-header {
    border-bottom: 1px solid #dee2e6;
    padding-bottom: 15px;
    margin-bottom: 15px;
}

.modal-title {
    font-size: 1.25rem;
    color: #333;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById("myModal");
        const openModalBtns = document.querySelectorAll(".openModalBtn");
        const closeModalBtn = document.querySelector(".close");
        const iframe = document.getElementById("dynamicIframe");
        const productTitle = document.getElementById("productTitle");

        openModalBtns.forEach(btn => {
            btn.addEventListener("click", () => {
                const asin = btn.getAttribute("data-asin");
                const title = btn.closest('.product-card').querySelector('.card-title').innerText.trim();
                if (asin) {
                    iframe.src = `https://graph.keepa.com/pricehistory.png?asin=${asin}&domain=com.mx&width=800&height=400`;
                    productTitle.textContent = title;
                    modal.style.display = "flex";
                }
            });
        });

        closeModalBtn.addEventListener("click", () => {
            modal.style.display = "none";
            iframe.src = "";
            productTitle.textContent = "";
        });

        window.addEventListener("click", (event) => {
            if (event.target === modal) {
                modal.style.display = "none";
                iframe.src = "";
                productTitle.textContent = "";
            }
        });
    });
</script>