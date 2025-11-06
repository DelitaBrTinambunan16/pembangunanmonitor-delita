<!-- Footer Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded-top p-4 text-center text-sm-start d-flex justify-content-between align-items-center flex-wrap">
        <div class="text-light mb-2 mb-sm-0">
            &copy; <a href="#" class="text-danger text-decoration-none">Pembangunan & Monitoring Proyek - Bina Desa</a>
        </div>

        @if (!Request::is('login'))
            <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20ingin%20bertanya%20tentang%20pembangunan%20desa."
               target="_blank"
               class="btn btn-success d-flex align-items-center justify-content-center"
               style="gap: 8px; border-radius: 25px; padding: 8px 15px; font-weight: 500;">
                <i class="fab fa-whatsapp fa-lg"></i> Hubungi Admin
            </a>
        @endif
    </div>
</div>
<!-- Footer End -->
