@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Upzet</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    
    <div class="row">
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex text-muted">
                        <div class="flex-shrink-0  me-3 align-self-center">
                            <div class="avatar-sm">
                                <div class="avatar-title bg-dark rounded-circle text-primary font-size-20" style="background-color: #5541D7 !important;">
                                    <i class="ri-group-line"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-1">Data Pelanggan</p>
                            <h5 class="mb-3">{{ $pelanggan }}</h5>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0  me-3 align-self-center">
                            <div class="avatar-sm">
                                <div class="avatar-title bg-dark rounded-circle text-primary font-size-20" style="background-color: #5541D7 !important;">
                                    <i class="mdi mdi-clipboard-text"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-1">Jumlah Tagihan</p>
                            <h5 class="mb-3">{{ $tagihan }}</h5>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex text-muted">
                        <div class="flex-shrink-0  me-3 align-self-center">
                            <div class="avatar-sm">
                                <div class="avatar-title bg-dark rounded-circle text-primary font-size-20" style="background-color: #5541D7 !important;">
                                    <i class="mdi mdi-clipboard-check"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-1">Jumlah Bayar</p>
                            <h5 class="mb-3">{{ $pembayaran }}</h5>
                        </div>
                    </div>                                        
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex text-muted">
                        <div class="flex-shrink-0  me-3 align-self-center">
                            <div class="avatar-sm">
                                <div class="avatar-title bg-dark rounded-circle text-primary font-size-20" style="background-color: #5541D7 !important;">
                                    <i class="mdi mdi-exclamation-thick"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-1">Jumlah Bayar Telat</p>
                            <h5 class="mb-3">{{ $pembayaran_telat }}</h5>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="card-title">Overview</h5>
                        </div>
                        {{-- <div class="flex-shrink-0">
                            <div>
                                <button type="button" class="btn btn-soft-secondary btn-sm">
                                    ALL
                                </button>
                                <button type="button" class="btn btn-soft-primary btn-sm">
                                    1M
                                </button>
                                <button type="button" class="btn btn-soft-secondary btn-sm">
                                    6M
                                </button>
                                <button type="button" class="btn btn-soft-secondary btn-sm active">
                                    1Y
                                </button>
                            </div>
                        </div> --}}
                    </div>

                    <div>
                        <div id="mixed-chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!-- end card-body -->

                
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

    </div>
    <!-- end row -->



    <!-- end row -->
    
</div>

@push('scripts')
            <!-- apexcharts js -->
            <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

            <!-- jquery.vectormap map -->
            <script src="assets/libs/jqvmap/jquery.vmap.min.js"></script>
            <script src="assets/libs/jqvmap/maps/jquery.vmap.usa.js"></script>
    
            <script src="assets/js/pages/dashboard.init.js"></script>
@endpush
@endsection