@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{$title}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{$title}}</a></li>
                        <li class="breadcrumb-item active">{{$title}}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    {{-- <h4 class="card-title">Textual inputs</h4>
                    <p class="card-title-desc">Here are examples of <code>.form-control</code> applied to each
                        textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p> --}}

                        {{-- @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}
                    <form action="{{ route($route.'.update') }}" method='POST'>
                        @csrf
                    {{-- <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">ID Pelanggan</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="id_pelanggan" id="example-text-input">
                        </div>
                    </div> --}}

                    <div class="mb-3 row">
                        <label for="alamat" class="col-md-2 col-form-label">Alamat</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="alamat" >{{$datas->alamat}}</textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="harga_per_kubik" class="col-md-2 col-form-label">Harga Per-kubik</label>
                        <div class="col-md-10">
                            <input class="form-control" type="number" name="harga_per_kubik" id="harga_per_kubik" value="{{ $datas->harga_per_kubik }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="harga_pemasangan" class="col-md-2 col-form-label">Harga Pemasangan</label>
                        <div class="col-md-10">
                            <input class="form-control" type="number" name="harga_pemasangan" id="harga_pemasangan" value="{{ $datas->harga_pemasangan }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="harga_pemasangan_dp" class="col-md-2 col-form-label">DP Pemasangan</label>
                        <div class="col-md-10">
                            <input class="form-control" type="number" name="harga_pemasangan_dp" id="harga_pemasangan_dp" value="{{ $datas->harga_pemasangan_dp }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">Template Pesan Tagihan</label>
                        <div class="col-md-10">
                            <select class="form-select" name="template_pesan_id">
                                <option>-- Pilih Template Pesan --</option>
                                @foreach ($templates as $template)
                                    <option value="{{ $template->id }}" @if($template->id == $datas->template_pesan_id) selected @endif>{{ $template->nama_pesan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">Template Pesan Tagihan Terlambat</label>
                        <div class="col-md-10">
                            <select class="form-select" name="template_pesan_terlambat_id">
                                <option>-- Pilih Template Pesan --</option>
                                @foreach ($templates as $template)
                                    <option value="{{ $template->id }}" @if($template->id == $datas->template_pesan_terlambat_id) selected @endif>{{ $template->nama_pesan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">Notif Tagihan Terlambat Untuk Manager</label>
                        <div class="col-md-10">
                            <select class="form-select" name="template_pesan_terlambat_manager_id">
                                <option>-- Pilih Template Pesan --</option>
                                @foreach ($templates as $template)
                                    <option value="{{ $template->id }}" @if($template->id == $datas->template_pesan_terlambat_manager_id) selected @endif>{{ $template->nama_pesan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-11">
                            
                        </div>
                        <div class="col-md-1">
                            <input type="submit" value="Submit" class="btn btn-primary">
                        </div>
                        
                    </div>

                                            
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->

    @push('scripts')
        <script>
            // setInputFilter(document.getElementById("nik"), function(value) {
            //     return /^-?\d*$/.test(value) && (value === "" || value.length <= 16); 
            // });
        </script>
    @endpush


</div>
@endsection