<!DOCTYPE html>
<html lang="en">

@include('admin_jurusan.layouts.header')

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('admin_jurusan.layouts.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                @include('admin_jurusan.layouts.topbar')
                @yield('content')
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    @include('admin_jurusan.layouts.footer')

</body>

</html>
