<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="header-elements-md-inline mb-2">
                    <div class="d-flex">
                        <div class="breadcrumb">
                            <a href="{{ route('home') }}" class="breadcrumb-item">Dashboard</a>

                            @yield('breadcrumb')
                        </div>

                        @hasSection('breadcrumbHeader')
                            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                        @endif
                    </div>

                    @hasSection('breadcrumbHeader')
                        <div class="header-elements d-none">
                            @yield('breadcrumbHeader')
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
