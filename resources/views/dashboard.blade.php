<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="/img/logo.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="/css/google_font.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <script src="/plugins/sweetalert2/sweetalert2.all.min.js"></script>

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="/js/adminlte.js"></script>

    {{-- <!-- DataTables  & Plugins -->
    <script src="//plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="//plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="//plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="//plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="//plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="//plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="//plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="//plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="//plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="//plugins/jszip/jszip.min.js"></script>
    <script src="//plugins/pdfmake/pdfmake.min.js"></script>
    <script src="//plugins/pdfmake/vfs_fonts.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="//plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="//plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="//plugins/datatables-buttons/css/buttons.bootstrap4.min.css"> --}}

    <script src="/js/jquery-3.7.0.js"></script>
    <script src="/js/jquery.dataTables.min.js"></script>
    <script src="/js/dataTables.buttons.min.js"></script>
    <script src="/js/jszip.min.js"></script>
    <script src="/js/pdfmake.min.js"></script>
    <script src="/js/vfs_fonts.js"></script>
    <script src="/js/buttons.html5.min.js"></script>
    <script src="/js/buttons.print.min.js"></script>
    <script src="/js/dataTables.rowReorder.min.js"></script>
    <script src="/js/dataTables.responsive.min.js"></script>

    <link rel="stylesheet" href="/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="/css/responsive.dataTables.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>

            {{-- <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">                
            </ul> --}}
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/dashboard" class="brand-link text-center">
                <span class="brand-text font-weight-light">Cục thuế tỉnh Quảng Bình</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{ route('congchuc.show', Auth::user()->so_hieu_cong_chuc) }}" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                {{-- <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div> --}}

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="fas fa-cogs"></i>
                                <p>
                                    1. Hệ thống
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item pl-3">
                                    <a href="/donvi" class="nav-link">
                                        <p>1.1. Danh mục đơn vị</p>
                                    </a>
                                </li>
                                <li class="nav-item pl-3">
                                    <a href="/phong" class="nav-link">
                                        <p>1.2. Danh mục phòng/đội</p>
                                    </a>
                                </li>
                                <li class="nav-item pl-3">
                                    <a href="/congchuc" class="nav-link">
                                        <p>1.3. Danh sách công chức</p>
                                    </a>
                                </li>
                                <li class="nav-item pl-3">
                                    <a href="/xeploai" class="nav-link">
                                        <p>1.4. Danh mục xếp loại</p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item pl-3">
                                    <a href="/" class="nav-link">
                                        <p>1.5. Phân quyền sử dụng</p>
                                    </a>
                                </li> --}}
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="fas fa-chart-bar"></i>
                                <p>
                                    2. Đánh giá, xếp loại cá nhân hàng tháng
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: block;">
                                <li class="nav-item pl-3">
                                    <a href="/phieudanhgia/canhanList" class="nav-link">
                                        <p>2.1. Công chức tự đánh giá</p>
                                    </a>
                                </li>
                                <li class="nav-item pl-3">
                                    <a href="/phieudanhgia/captrenList" class="nav-link">
                                        <p>2.2. Cấp trên đánh giá</p>
                                    </a>
                                </li>
                                <li class="nav-item pl-3">
                                    <a href="/phieudanhgia/capqdList" class="nav-link">
                                        <p>2.3. Hội đồng/Cấp có thẩm quyền quyết định đánh giá</p>
                                    </a>
                                </li>
                                <li class="nav-item pl-3">
                                    <a href="/phieudanhgia/thongbaoKQXL" class="nav-link">
                                        <p>2.4. Thông báo KQ xếp loại</p>
                                    </a>
                                </li>
                                <li class="nav-item pl-3">
                                    <a href="/" class="nav-link">
                                        <p>2.5. Báo cáo theo tháng </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="fas fa-chart-bar"></i>
                                <p>
                                    3. Đánh giá, xếp loại cá nhân hàng quý
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                {{-- <li class="nav-item pl-3">
                                    <a href="#" class="nav-link">
                                        <p>3.1. Tổng hợp kết quả đánh giá</p>
                                    </a>
                                </li> --}}
                                <li class="nav-item pl-3">
                                    <a href="/phieudanhgia/capqdListQuarter" class="nav-link">
                                        <p>3.1. Hội đồng/Cấp có thẩm quyền quyết định đánh giá</p>
                                    </a>
                                </li>
                                <li class="nav-item pl-3">
                                    <a href="#" class="nav-link">
                                        <p>3.2. Thông báo KQ xếp loại</p>
                                    </a>
                                </li>
                                <li class="nav-item pl-3">
                                    <a href="/" class="nav-link">
                                        <p>3.3. Báo cáo theo quý</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="fas fa-chart-bar"></i>
                                <p>
                                    4. Đánh giá, xếp loại cá nhân theo năm
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <p>4.1. Công chức tự đánh giá</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <p>4.2. Cấp có thẩm quyền đánh giá</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <p>4.3. Lấy kiến của Hội đồng</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <p>4.4. Thông báo kết quả đánh giá, xếp loại</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <p>4.5. Danh sách kết quả đánh giá, xếp loại</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <p>4.6. Báo cáo tổng hợp kết quả đánh giá, xếp loại</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('heading')</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                @if (session()->has('msg_success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            text: `{{ session()->get('msg_success') }}`,
                            showConfirmButton: false,
                            timer: 3000
                        })
                    </script>
                @elseif (session()->has('msg_error'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            text: `{{ session()->get('msg_error') }}`,
                            showConfirmButton: false,
                            timer: 3000
                        })
                    </script>
                @endif
                @yield('content')
            </section>
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Cục Thuế tỉnh Quảng Bình - 2024</strong>
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    @yield('css')
    @yield('js')
</body>

</html>
