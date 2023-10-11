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
            padding: 10px;
            text-align: center;
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

        .fancybox-content {
            z-index: 9999;
            /* Nilai z-index yang tinggi */
            /* Gaya lainnya untuk tampilan popup, seperti posisi dan latar belakang */
        }
    </style>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Progres Perkembangan Irigasi P3-TGAI</h5>
                <div class="card">
                    <div class="card-body">
                        <div class="mt-2 mb-2">
                            <a href="/dashboard/update/perkembangan-daerah-irigasi/create/{{ $penerimas->id }}"
                                class="btn btn-info">Tambah Progres</a>
                        </div>
                        <h1 style="text-align: center;">Data Utama</h1>
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr style="text-align: center; background-color: lightblue;">
                                        <th scope="col">Daerah Irigasi </th>
                                        <th scope="col">Nama P3A/GP3A</th>
                                        <th scope="col">Kabupaten</th>
                                        <th scope="col">Kecamatan </th>
                                        <th scope="col">Desa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $penerimas->DaerahIrigasi->nama }}</td>
                                        <td>{{ $penerimas->names }}</td>
                                        <td>{{ $kabupaten->where('id', $penerimas->Kabupaten)->first()->city_name }}</td>
                                        <td>{{ $kecamatan->where('id', $penerimas->Kecamatan)->first()->dis_name }}</td>
                                        <td>{{ $desa->where('id', $penerimas->Desa)->first()->subdis_name }}</td>
                                    </tr>
                                </tbody>
                                <thead>
                                    <tr style="text-align: center; background-color: lightblue;">
                                        <th scope="col">Terbangun (KM)</th>
                                        <th scope="col">Belum Terbangun (KM)</th>
                                        <th scope="col">Pola Tanam</th>
                                        <th scope="col">Jenis Vegetasi </th>
                                        <th scope="col">Mendapatkan (Kali)</th>
                                        <th scope="col">Tahun Mendapatkan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $penerimas->IrigasiDesaTerbangun }}</td>
                                        <td>{{ $penerimas->IrigasiDesaBelumTerbangun }}</td>
                                        <td>{{ $penerimas->PolaTanamSaatIni }}</td>
                                        <td>{{ $penerimas->JenisVegetasi }}</td>
                                        <td>{{ $penerimas->MendapatkanP4_ISDA }}</td>
                                        <td>{{ $penerimas->TahunMendapatkan }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="card">
                    <div class="card-body">
                        <h1 style="text-align: center; ">Progres Tahunan</h1>
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-sm mb-3">
                                <thead>
                                    <tr style="text-align: center; background-color: lightblue;">
                                        <th scope="col">No</th>
                                        <th scope="col">Tahun Pengerjaan </th>
                                        <th scope="col">jenis Pekerjaan</th>
                                        <th scope="col">langsir Material</th>
                                        <th scope="col">jarak Langsir</th>
                                        <th scope="col">Aksi </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($progress as $progres)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td> {{ $progres->TahunPengerjaan }}</td>
                                            <td> {{ $progres->jenisPekerjaan }}</td>
                                            <td> {{ $progres->langsirMaterial }}</td>
                                            <td> {{ $progres->jarakLangsir }}</td>

                                            <td>
                                                <button class="btn badge bg-info border-0 show-progres-modal"
                                                    data-id="{{ $progres->id }}"
                                                    data-tahun="{{ $progres->TahunPengerjaan }}"
                                                    data-jenis="{{ $progres->jenisPekerjaan }}"
                                                    data-langsir="{{ $progres->langsirMaterial }}"
                                                    data-jarak="{{ $progres->jarakLangsir }}"
                                                    data-beda="{{ $progres->bedaLangsir }}"
                                                    data-metode="{{ $progres->metodeLangsir }}"
                                                    data-kondisi-lokasi="{{ $progres->KondisiLokasiPekerjaan }}"
                                                    data-kondisi-tanah="{{ $progres->KondisiTanahLokasiPekerjaan }}"
                                                    data-potensi="{{ $progres->PotensiMasalahSosial }}">
                                                    <span data-feather="eye"></span>
                                                </button>

                                                <a href="/dashboard/update/perkembangan-daerah-irigasi/edit/{{ $progres->id }}"
                                                    class="badge bg-warning border-0 "><span data-feather="edit"></span></a>

                                                <form
                                                    action="/dashboard/update/perkembangan-daerah-irigasi/{{ $progres->id }}"
                                                    class="d-inline" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="badge bg-danger border-0"
                                                        onclick="return confirm('Yakin Ingin Menghapus Data yang berhubungan dengan? {{ $progres->DaerahIrigasi }}')"><span
                                                            data-feather="file-minus"></span></button>
                                                </form>
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
                    <h5 class="modal-title" id="exampleModalLabel">Detail Progres Tahunan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="progresModalBody">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Ketika tombol "Tampilkan Data" di klik
            $('.show-progres-modal').on('click', function() {
                // Ambil data dari atribut data
                var id = $(this).data('id');
                var tahun = $(this).data('tahun');
                var jenis = $(this).data('jenis');
                var langsir = $(this).data('langsir');
                var jarak = $(this).data('jarak');
                var beda = $(this).data('beda');
                var metode = $(this).data('metode');
                var kondisiLokasi = $(this).data('kondisi-lokasi');
                var kondisiTanah = $(this).data('kondisi-tanah');
                var potensi = $(this).data('potensi');

                // Tampilkan data dalam modal dengan tabel horizontal
                $('#progresModalBody').html(`
                    <table class="table table-bordered">
                        <tr>
                            <th>Tahun Pengerjaan</th>
                            <td>${tahun}</td>
                        </tr>
                        <tr>
                            <th>Jenis Pekerjaan</th>
                            <td>${jenis}</td>
                        </tr>
                        <tr>
                            <th>Langsir Material</th>
                            <td>${langsir}</td>
                        </tr>
                        <tr>
                            <th>Jarak Langsir</th>
                            <td>${jarak}</td>
                        </tr>
                        <tr>
                            <th>Beda Langsir</th>
                            <td>${beda}</td>
                        </tr>
                        <tr>
                            <th>Metode Langsir</th>
                            <td>${metode}</td>
                        </tr>
                        <tr>
                            <th>Kondisi Lokasi Pekerjaan</th>
                            <td>${kondisiLokasi}</td>
                        </tr>
                        <tr>
                            <th>Kondisi Tanah Lokasi Pekerjaan</th>
                            <td>${kondisiTanah}</td>
                        </tr>
                        <tr>
                            <th>Potensi Masalah Sosial</th>
                            <td>${potensi}</td>
                        </tr>
                        <tr>
                            <th>Akta PDF</th>
                            <td>
                                <a href="{{ url('/tampilkan-akta-pdf/${id}') }}">Unduh PDF</a>
                            </td>
                        </tr>
                        <tr>
                            <th>NPWP PDF</th>
                            <td>
                                <a href="{{ url('/tampilkan-npwp-pdf/${id}') }}">Unduh PDF</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Buku Rekening PDF</th>
                            <td>
                                <a href="{{ url('/tampilkan-rek-pdf/${id}') }}">Unduh PDF</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Progres Tahunan</th>
                            <td>
                                <a href="{{ url('/tampilkan-img/${id}') }}" download >Unduh Gambar</a>
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
