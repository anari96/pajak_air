{{-- <a href={{ $url }} target="_blank" class="btn btn-sm btn-primary m-2">Download Gambar</a> --}}
<button type="button" class="btn btn-primary btn-sm waves-effect waves-light image_button" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center" data-url='{{ asset($url) }}' onclick="image_show('{{ asset($url) }}')">Lihat Gambar</button>
