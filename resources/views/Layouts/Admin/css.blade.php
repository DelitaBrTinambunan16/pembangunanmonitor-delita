{{-- start css --}}
<!-- Customized Bootstrap Stylesheet -->
<link href="{{ asset('asset-admin/css/bootstrap.min.css') }}" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="{{ asset('asset-admin/css/style.css') }}" rel="stylesheet">
{{-- end css --}}
<style>
<style>
    /* === Sidebar Toggle Fix === */
    .sidebar {
        width: 250px;
        transition: all 0.3s ease;
    }

    .content {
        width: calc(100% - 250px);
        transition: all 0.3s ease;
        margin-left: 250px;
    }

    /* Ketika sidebar ditutup */
    .sidebar.closed {
        margin-left: -250px;
    }

    .content.full {
        width: 100%;
        margin-left: 0;
    }

    /* Mobile */
    @media (max-width: 992px) {
        .sidebar {
            margin-left: -250px;
        }

        .sidebar.open {
            margin-left: 0;
        }

        .content {
            width: 100%;
            margin-left: 0;
        }
    }
</style>
<style>
/* Floating WhatsApp Button */
.whatsapp-float {
    position: fixed;
    width: 60px;
    height: 60px;
    bottom: 90px; /* biar gak tabrakan sama Back-to-Top */
    right: 25px;
    background-color: #25D366;
    color: #fff;
    border-radius: 50%;
    text-align: center;
    font-size: 35px;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
    z-index: 1000;
    transition: transform 0.3s ease, background 0.3s ease;
}

.whatsapp-float:hover {
    transform: scale(1.1);
    background-color: #20ba5a;
}

.whatsapp-float i {
    margin-top: 12px;
}

/* Tooltip style */
.tooltip-text {
    visibility: hidden;
    width: 120px;
    background-color: #222;
    color: #fff;
    text-align: center;
    border-radius: 5px;
    padding: 5px 0;
    position: absolute;
    bottom: 70px;
    right: 70px;
    font-size: 13px;
    opacity: 0;
    transition: opacity 0.3s;
}

.whatsapp-float:hover .tooltip-text {
    visibility: visible;
    opacity: 1;
}

/* Efek berdenyut */
.whatsapp-float::after {
    content: "";
    position: absolute;
    width: 60px;
    height: 60px;
    border: 2px solid #25D366;
    border-radius: 50%;
    left: 0;
    top: 0;
    animation: pulse 1.8s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    100% {
        transform: scale(1.8);
        opacity: 0;
    }
}
</style>
