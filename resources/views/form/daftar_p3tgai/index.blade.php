@extends('layout.main')
@section('container')
    <style>
        .table {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Atur bayangan tabel */
            transition: box-shadow 0.3s ease;
            /* Efek transisi saat bayangan berubah */
        }

        .table:hover {
            box-shadow: 0 8px 12px rgba(230, 138, 38, 0.9);
            /* Bayangan saat cursor dihover */
        }

        .table th,
        .table td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 250px;
            vertical-align: top;
            padding: 5px;
        }

        .card {
            max-width: 100%;
            overflow-x: auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.);
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 8px 12px rgba(230, 138, 38, 1);
        }

        .button1:hover {
            box-shadow: 0 8px 12px rgba(92, 133, 251, 1);
        }

        .input-group:hover input[type="text"] {
            /* border-color: #93fa0c; */
            /* Warna border saat dihover */
            /* box-shadow: 0 0 5px rgba(230, 138, 38, 1); */
            /* Efek bayangan saat dihover */
        }
    </style>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Daftar Penerima P3-TGAI</h5>
                <form action="/dashboard/daerah-irigasi">
                    <div class="row">
                        <div class="col-6 col-sm-12">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control " placeholder="Pencarian Berdasarkan Daerah Irigasi"
                                    name="search" value="{{ request('search') }}">
                                <button class="btn btn-primary " type="submit" id="basic-addon2">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="mt-2 mb-2">
                    <a href="/dashboard/daerah-irigasi/create" class="btn btn-info">Tambah Data</a>

                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th scope="col">No</th>
                                        <th scope="col">Daerah Irigasi </th>
                                        <th scope="col">Nama P3A/GP3A</th>
                                        <th scope="col">Kecamatan </th>
                                        <th scope="col">Desa</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penerimas as $penerima)
                                        <tr style="text-align: center;">
                                            <td> {{ $loop->iteration }}</td>
                                            <td> {{ $penerima->daerahIrigasi->nama }}</td>
                                            <td> {{ $penerima->names }}</td>
                                            <td> {{ $penerima->kecamatan->dis_name }}</td>
                                            <td> {{ $penerima->desa->subdis_name }}</td>

                                            <td>
                                                <button class="btn badge bg-info border-0 show-DI-modal"
                                                    data-id="{{ $penerima->id }}"
                                                    data-daerah_irigasi_id="{{ $penerima->daerahIrigasi->nama }}"
                                                    data-kabupaten="{{ $penerima->kabupaten->city_name }}"
                                                    data-kecamatan="{{ $penerima->kecamatan->dis_name }}"
                                                    data-desa="{{ $penerima->desa->subdis_name }}"
                                                    data-names="{{ $penerima->names }}"
                                                    data-terbangun="{{ $penerima->IrigasiDesaTerbangun }}"
                                                    data-belum_terbangun="{{ $penerima->IrigasiDesaTerbangun }}"
                                                    data-irigasiDesaBelumTerbangun="{{ $penerima->IrigasiDesaBelumTerbangun }}"
                                                    data-pola="{{ $penerima->PolaTanamSaatIni }}"
                                                    data-jenis="{{ $penerima->JenisVegetasi }}"
                                                    data-mendapatkan="{{ $penerima->MendapatkanP4_ISDA }}"
                                                    data-tahun="{{ $penerima->TahunMendapatkan }}"
                                                    data-peta_pdf="{{ $penerima->peta_pdf }}"
                                                    data-jaringan_pdf="{{ $penerima->jaringan_pdf }}"
                                                    data-dokumentasi_pdf="{{ $penerima->dokumentasi_pdf }}">
                                                    <span data-feather="eye"></span> Detail
                                                </button>
                                                <a href="/dashboard/update/perkembangan-daerah-irigasi/{{ $penerima->id }}"
                                                    class="btn btn-info">Progres</a>
                                                <a href="/dashboard/daerah-irigasi/{{ $penerima->id }}/edit"
                                                    class="badge bg-warning border-0 "><span data-feather="edit">
                                                    </span>Edit</a>

                                                {{-- <form action="/dashboard/daerah-irigasi/{{ $penerima->id }}"
                                                    class="d-inline" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="badge bg-danger border-0"
                                                        onclick="return confirm('Yakin Ingin Menghapus Data yang berhubungan dengan? {{ $penerima->DaerahIrigasi }}')"><span
                                                            data-feather="file-minus"></span></button>
                                                </form> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="progresModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Daerah Irigasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="progresModalBody">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>

    <script>
        $(document).ready(function() {
            // Ketika tombol "Tampilkan Data" di klik
            $('.show-DI-modal').on('click', function() {
                // Ambil data dari atribut data
                var id = $(this).data('id');
                var daerah_irigasi_id = $(this).data('daerah_irigasi_id');
                var Kabupaten = $(this).data('kabupaten');
                var Kecamatan = $(this).data('kecamatan');
                var Desa = $(this).data('desa');
                var names = $(this).data('names');
                var terbangun = $(this).data('terbangun');
                var belum_terbangun = $(this).data('belum_terbangun');
                var irigasiDesaBelumTerbangun = $(this).data('IrigasiDesaBelumTerbangun');
                var pola = $(this).data('pola');
                var jenis = $(this).data('jenis');
                var mendapatkan = $(this).data('mendapatkan');
                var tahun = $(this).data('tahun');
                var peta_pdf = $(this).data('peta_pdf');
                var jaringan_pdf = $(this).data('jaringan_pdf');
                var dokumentasi_pdf = $(this).data('dokumentasi_pdf');
                // Tampilkan data dalam modal dengan tabel horizontal
                var originalString = peta_pdf;
                var trimmedString = originalString.substring(6);
                console.log(trimmedString);

                $('#progresModalBody').html(`
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <td>${id}</td>
                        </tr>
                        <tr>
                            <th>Daerah Irigasi</th>
                            <td>${daerah_irigasi_id}</td>
                        </tr>
                        <tr>
                            <th>Kabupaten</th>
                            <td>${Kabupaten}</td>
                        </tr>
                        <tr>
                            <th>Kecamatan</th>
                            <td>${Kecamatan}</td>
                        </tr>
                        <tr>
                            <th>Desa</th>
                            <td>${Desa}</td>
                        </tr>
                        <tr>
                            <th>Nama P3-TGAI</th>
                            <td>${names}</td>
                        </tr>
                        <tr>
                            <th>Irigasi Terbangun</th>
                            <td>${terbangun}</td>
                        </tr>
                        <tr>
                            <th>Irigasi Belum Terbangun</th>
                            <td>${belum_terbangun}</td>
                        <tr>
                            <th>Pola Tanam Saat Ini</th>
                            <td>${pola}</td>
                        </tr>
                        <tr>
                            <th>Jenis Vegetasi</th>
                            <td>${jenis}</td>
                        </tr>
                        <tr>
                            <th>Mendapatkan P3-TGAI Kali</th>
                            <td>${mendapatkan}</td>
                        </tr>
                        <tr>
                            <th>Tahun Mendapatkan P3-TGAI</th>
                            <td>${tahun}</td>
                        </tr>
                        <tr>
                            <th>Peta PDF</th>
                            <td>
                                <a href="{{ url('/tampilkan-peta-pdf/${id}') }}">Unduh PDF</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Jaringan PDF</th>
                            <td>
                                <a href="{{ url('/tampilkan-jaringan-pdf/${id}') }}">Unduh PDF</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Dokumentasi PDF</th>
                            <td>
                                <a href="{{ url('/tampilkan-dokumen-pdf/${id}') }}">Unduh PDF</a>
                            </td>
                        </tr>
                    </table>
                `);

                // Tampilkan modal
                $('#progresModal').modal('show');
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            @if (Session::has('success'))
                iziToast.success({
                    title: 'Success',
                    message: '{{ Session::get('success') }}',
                    position: 'topRight',
                });
            @endif
            @if (Session::has('fail'))
                iziToast.warning({
                    title: 'Warning',
                    message: '{{ Session::get('fail') }}',
                    position: 'topRight',
                });
            @endif
        });
    </script>
@endsection
