@include('panel.partials.head', ['title' => $title])
@yield('custom-css')
<div id="wrapper">
    <!-- Sidebar -->
    @include('panel.partials.sidebar')
    <!-- End of Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            @include('panel.partials.top-bar')
            <!-- End of Topbar -->
            <!-- Begin Page Content -->
            <div class="container-fluid">
                    @yield('content')
            </div>
        </div>
        <!-- Footer -->
        @include('panel.partials.footer')
        <!-- End of Footer -->

    </div>

</div>
@include('panel.partials.to-top')
@include('panel.partials.bottom-js')
@yield('custom-js')
@include('panel.partials.end')