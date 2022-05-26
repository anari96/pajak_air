<style>
    #side-menu a,i{
        color: white !important;
    }

    .vertical-menu{
        background-color: #5541D7 !important;
    }
    .menu-title{
        color: white !important;
    }
</style>
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu" >
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                
                
                <li>
                    <a href="/" class="waves-effect">
                        <i class="mdi mdi-home"></i>
                        <span>Home</span>
                    </a>
                </li>
                @if (Auth::user()->role->nama_role != 'Kasir')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-book-open"></i>
                        <span>Data Master</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('user.index') }}">User</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-book-open"></i>
                        <span>Perusahaan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('pelanggan.index') }}">Perusahaan</a></li>
                        <li><a href="{{ route('tagihan.index') }}">Penggunaan</a></li>
                    </ul>
                </li>

                @endif
                @if (Auth::user()->role->nama_role != 'Kasir')
                <li class="menu-title">Tagihan Penggunaan</li>

                <li>
                    <a href="{{ route('pembayaran.index') }}" class=" waves-effect">
                        <i class="mdi mdi-clipboard-check"></i>
                        <span>Tagihan</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('pelunasan.index') }}" class=" waves-effect">
                        <i class="mdi mdi-clipboard-check"></i>
                        <span>Pembayaran</span>
                    </a>
                </li>
                 
                @endif
            
                @if (Auth::user()->role->nama_role != 'Kasir')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-archive"></i>
                        <span>Pesan Whatsapp</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('template_pesan.index') }}">Template Pesan</a></li>
                        <li><a href="{{ route('history_pesan.index') }}">History Pesan</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-archive"></i>
                        <span>Laporan</span>
                    </a>    
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('laporan.pelanggan') }}">Pelanggan</a></li>
                        <li><a href="{{ route('laporan.tagihan') }}">Tagihan</a></li>
                        <li><a href="{{ route('laporan.tagihan_pemasangan') }}">Tagihan Pemasangan</a></li>
                        <li><a href="{{ route('laporan.pembayaran') }}">Pembayaran</a></li>
                        <li><a href="{{ route('laporan.pembayaran_pemasangan') }}">Pembayaran Pemasangan</a></li>
                    </ul>
                </li>
                @endif


    
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>