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

