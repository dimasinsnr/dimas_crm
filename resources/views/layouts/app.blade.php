<!--
=========================================================
* Soft UI Dashboard - v1.0.3
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>

@if (\Request::is('rtl'))
  <html dir="rtl" lang="ar">
@else
  <html lang="en" >
@endif

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  @if (env('IS_DEMO'))
      <x-demo-metas></x-demo-metas>
  @endif

  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <title>
    CRM Dimas Insan
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Link CSS DataTables -->
  <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

  <!-- Script JavaScript DataTables -->
  <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/moment/moment.min.js"></script>

  <style>
    table.dataTable tr {
        height: 50px; /* Mengatur tinggi baris secara eksplisit */
    }
    table.dataTable th,
    table.dataTable td {
        font-size: 0.90rem; /* Atur ukuran font */
        font-weight: 600; /* Atur ketebalan font */
        color: #6c757d; /* Set warna teks */
        padding: 12px 15px; /* Menambahkan padding untuk menambah ruang dalam sel */
        vertical-align: middle; /* Vertikal alignment untuk memastikan teks berada di tengah */
    }

    .dataTables_info {
        font-size: 0.90rem; /* Ukuran font untuk tombol pagination */
        font-weight: 600; /* Ketebalan font */
        color: #6c757d;
    }

    .dataTables_wrapper .dataTables_filter input {
        border-radius: 16px;
        padding-left: 10px;
    }

    /* Menyesuaikan tombol pagination ketika hover */
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #f8f9fa; /* Warna latar belakang saat hover */
        color: #007bff; /* Warna teks saat hover */
    }

    /* Menyesuaikan pagination untuk elemen "Previous" dan "Next" */
    .dataTables_wrapper .dataTables_paginate .paginate_button.previous,
    .dataTables_wrapper .dataTables_paginate .paginate_button.next {
        font-size: 0.90rem; /* Ukuran font untuk Previous dan Next */
        font-weight: 600; /* Ketebalan font */
        color: #6c757d; /* Warna teks */
    }

    /* Menyesuaikan tombol aktif (current page) */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        font-size: 0.90rem; /* Ukuran font untuk halaman saat ini */
        font-weight: 600; /* Ketebalan font */
        color: #fff; /* Warna teks halaman aktif */
        border-radius: 9px;
    }

    /* CSS untuk dropdown */
    .custom-dropdown {
        position: relative;
        display: inline-block;
    }

    /* Styling dropdown */
    .custom-dropdown-menu {
        display: none;
        position: absolute;
        z-index: 1000;
        min-width: 160px;
        margin: 0;
        font-size: 14px;
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.2);
        right: 0; /* Menggeser elemen ke kanan layar */
    }

    .custom-dropdown-menu a {
        display: block;
        padding: 8px 15px;
        color: #333;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .custom-dropdown-menu a:hover {
        background-color: #f2f3f8;
    }

    .custom-dropdown-menu.show {
        display: block;
        background-color: white;
        border-radius: 5px;
    }
    .custom-dropdown-toggle:focus,
    .custom-dropdown-toggle:active {
        outline: none;
        border: none; /* Menghilangkan border saat tombol dalam keadaan aktif/di-klik */
    }

    .custom-dropdown-menu a:hover {
        background-color: #f0f0f0; /* Warna latar belakang saat tautan dihover */
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 40px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 26px;
        position: absolute;
        top: 7px;
        right: 1px;
        width: 20px;
    }

    .select2-container--default .select2-selection--single {
        height: 40px !important;
        background-color: #fff !important;
        border: 1px solid #cbd5e0 !important;
        border-radius: .35rem !important;
    }

    .select2-container--default .select2-search--dropdown input {
        border: 1px solid #cbd5e0 !important;
        border-radius: .35rem !important;
    }
    
    /* Menghilangkan border hitam pada input pencarian Select2 saat aktif */
    .select2-container--default .select2-search--dropdown input:focus {
        border: 1px solid #cbd5e0 !important;
        border-radius: .35rem !important;
    }

    /* Menghilangkan border hitam pada input pencarian Select2 saat aktif pada dropdown */
    .select2-container--default .select2-search--dropdown .select2-search__field {
        /* border: none !important; */
        outline: none !important;
        box-shadow: none !important;
    }
  </style>
</head>

<body class="g-sidenav-show  bg-gray-100 {{ (\Request::is('rtl') ? 'rtl' : (Request::is('virtual-reality') ? 'virtual-reality' : '')) }} ">
  @auth
    @yield('auth')
  @endauth
  @guest
    @yield('guest')
  @endguest

  {{-- @if(session()->has('success'))
    <div x-data="{ show: true}"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        class="position-fixed bg-success rounded right-3 text-sm py-2 px-4">
      <p class="m-0">{{ session('success')}}</p>
    </div>
  @endif --}}
    <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/fullcalendar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  @stack('rtl')
  @stack('dashboard')
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  <script type="text/javascript">
    // APP_URL = "{url}manages/";
    BASE_URL = "{{ env('APP_URL') }}";
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <script src="{{ asset('js/helper.js') }}"></script>
  <script src="{{ asset('js/jquery.blockUI.js') }}"></script>
  <script src="{{ asset('js/jquery-confirm.js') }}"></script>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
</body>

</html>
