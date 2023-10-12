@extends('layout.main')
@section('container')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
        integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
  crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <style>
        .card {
            max-width: 100%;
            overflow-x: auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.);
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 8px 12px rgba(230, 138, 38, 1);
        }
    </style>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Daftar Calon Daerah Irigasi Penerima P3-TGAI</h5>
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="/dashboard/daerah-irigasi/create" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-3 mb-3">
                                <label for="daerah_irigasi_id" class="form-label">Daerah Irigasi</label>
                                <select class="form-select" id="daerah_irigasi_id" name="daerah_irigasi_id" required>
                                    <option value="">Pilih salah satu opsi</option>
                                    @foreach ($DaerahIrigasi as $DI)
                                        @if (old('daerah_irigasi_id') == $DI->id)
                                            <option value="{{ $DI->id }}" selected>{{ $DI->nama }}</option>
                                        @else
                                            <option value="{{ $DI->id }}">{{ $DI->nama }}</option>
                                        @endif
                                    @endforeach
                                    <option value="lainnya" {{ old('daerah_irigasi_id') == 'lainnya' ? 'selected' : '' }}>
                                        Pilihan Lainnya</option>
                                </select>

                                <div id="inputLainnyadaerah_irigasi_id"
                                    style="display: {{ old('daerah_irigasi_id') == 'lainnya' ? 'block' : 'none' }}">
                                    <label for="pilihanLainnyadaerah_irigasi_id">Pilihan Lainnya:</label>
                                    <input type="text" class="form-control" id="pilihanLainnyadaerah_irigasi_id"
                                        name="pilihanLainnyadaerah_irigasi_id"
                                        value="{{ old('pilihanLainnyadaerah_irigasi_id') }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="Provinsi" class="form-label">Provinsi</label>
                                <select class="form-control" id="provinsi" name="provinsi" onchange="updateKabupaten()"
                                    required>
                                    <option value="">Pilih Provinsi</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="Kabupaten" class="form-label">Kota/Kabupaten</label>
                                <select class="form-control" id="Kabupaten" name="Kabupaten" onchange="updateKecamatan()"
                                    required>
                                    <option value="">Pilih Kabupaten/Kota</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="Kecamatan" class="form-label">Kecamatan</label>
                                <select class="form-control" id="Kecamatan" name="Kecamatan" onchange="updateDesa()"
                                    required>
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="Desa" class="form-label">Desa</label>
                                <select class="form-control" id="Desa" name="Desa" required>
                                    <option value="">Pilih Desa</option>
                                </select>
                            </div>



                            <div class="mb-3">
                                <label for="IrigasiDesaTerbangun" class="form-label">Total Saluran Irigasi Tersier &
                                    Irigasi
                                    Desa Terbangun</label>
                                <div class="input-group">
                                    <input type="number" step="0.000001" class="form-control" id="IrigasiDesaTerbangun"
                                        name="IrigasiDesaTerbangun" value="{{ old('IrigasiDesaTerbangun') }}"
                                        placeholder="Hanya Menerima Masukan Angka Saja" required>
                                    <span class="input-group-text">M</sup></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="IrigasiDesaBelumTerbangun" class="form-label">Total Saluran Irigasi Tersier &
                                    Irigasi Desa Belum Terbangun</label>
                                <div class="input-group">
                                    <input type="number" step="0.000001" class="form-control"
                                        id="IrigasiDesaBelumTerbangun" name="IrigasiDesaBelumTerbangun"
                                        value="{{ old('IrigasiDesaBelumTerbangun') }}"
                                        placeholder="Hanya Menerima Masukan Angka Saja" required>
                                    <span class="input-group-text">M</sup></span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="PolaTanamSaatIni" class="form-label">Pola Tanam Saat Ini</label>
                                <input type="text" class="form-control" id="PolaTanamSaatIni" name="PolaTanamSaatIni"
                                    value="{{ old('PolaTanamSaatIni') }}" placeholder="Pola Tanam Saat Ini" required>
                            </div>

                            <div class="mb-3">
                                <label for="JenisVegetasi" class="form-label">Jenis Vegetasi</label>
                                <input type="text" class="form-control" id="JenisVegetasi" name="JenisVegetasi"
                                    value="{{ old('JenisVegetasi') }}" placeholder="Jenis Vegetasi" required>
                            </div>

                            <div class="mb-3">
                                <label for="MendapatkanP4_ISDA" class="form-label">Mendapatkan P4-ISDA/P3-TGAI</label>
                                <div class="input-group">
                                    <input type="number" step="0.01" class="form-control" id="MendapatkanP4_ISDA"
                                        name="MendapatkanP4_ISDA" value="{{ old('MendapatkanP4_ISDA') }}"
                                        placeholder="Hanya Menerima Masukan Angka Saja" required>
                                    <span class="input-group-text">Kali</sup></span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="TahunMendapatkan" class="form-label">Tahun Mendapatkan</label>
                                <input type="text" class="form-control" id="TahunMendapatkan" name="TahunMendapatkan"
                                    value="{{ old('TahunMendapatkan') }}" placeholder="Tahun Mendapatkan" required>
                            </div>

                            <div class="mb-3">
                                <label for="names" class="form-label">Nama P3A/GP3A</label>
                                <input type="text" class="form-control" id="names" name="names"
                                    value="{{ old('names') }}" placeholder="Nama P3A/GP3A" required>
                            </div>

                            <div class="mt-3 mb-3">
                                <label for="peta_pdf">Peta Desa</label>
                                <input type="file" class="form-control " id="peta_pdf" name="peta_pdf"
                                    accept="application/pdf">
                                <h6>PDF Max 5 MB</h6>

                            </div>

                            <div class="mt-3 mb-3">
                                <label for="pdf">Skema jaringan Irigasi</label>
                                <input type="file" class="form-control " id="jaringan_pdf" name="jaringan_pdf"
                                    accept="application/pdf">
                                <div class="form-text">PDF Max 5 MB
                                </div>

                            </div>

                            <div class="mt-3 mb-3">
                                <label for="pdf">Dokumentasi Saluran Irigasi Tersier</label>
                                <input type="file" class="form-control" id="dokumentasi_pdf" name="dokumentasi_pdf"
                                    accept="application/pdf">
                                <div class="form-text">PDF Max 5 MB
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="latitude" class="form-label">latitude</label>
                                <input type="number" step="0.000000000000000001" class="form-control" id="xAx"
                                    name="xAx" value="{{ old('xAx') }}" placeholder="latitude">
                            </div>
                            <div class="mb-3">
                                <label for="longitude" class="form-label">longitude</label>
                                <input type="number" step="0.000000000000000001" class="form-control" id="yAx"
                                    name="yAx" value="{{ old('yAx') }}" placeholder="longitude">
                            </div>


                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
        integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {

            @if (Session::has('success'))
                iziToast.success({
                    title: 'Success',
                    message: '{{ Session::get('success') }}',
                    position: 'bottomRight',
                });
            @endif
            @if (Session::has('fail'))
                iziToast.warning({
                    title: 'Warning',
                    message: '{{ Session::get('fail') }}',
                    position: 'bottomRight',
                });
            @endif
        });
    </script>

    <script>
        function addNamaField() {
            var namaContainer = document.getElementById('nama-container');
            var inputGroup = document.createElement('div');
            inputGroup.className = 'input-group mb-3';

            var input = document.createElement('input');
            input.type = 'text';
            input.className = 'form-control';
            input.name = 'names[]';
            input.placeholder = 'Nama';

            var appendDiv = document.createElement('div');
            appendDiv.className = 'input-group-append';

            var removeButton = document.createElement('button');
            removeButton.className = 'btn btn-outline-secondary';
            removeButton.type = 'button';
            removeButton.textContent = '-';
            removeButton.onclick = function() {
                namaContainer.removeChild(inputGroup);
            };

            appendDiv.appendChild(removeButton);
            inputGroup.appendChild(input);
            inputGroup.appendChild(appendDiv);
            namaContainer.appendChild(inputGroup);
        }
    </script>
    <script>
        // Fungsi untuk mengambil data provinsi dari API
        function fetchProvinsi() {
            fetch('/getProvinsi')
                .then(response => response.json())
                .then(data => {
                    const provinsiSelect = document.getElementById("provinsi");
                    provinsiSelect.innerHTML = '<option value="">Pilih Provinsi</option>';
                    data.forEach(provinsi => {
                        const option = document.createElement("option");
                        option.value = provinsi.id; // Ganti dengan atribut yang sesuai
                        option.text = provinsi.prov_name; // Ganti dengan atribut yang sesuai
                        provinsiSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        // Fungsi untuk mengambil data kabupaten berdasarkan provinsi yang dipilih
        function updateKabupaten() {
            const provinsiSelect = document.getElementById("provinsi");
            const kabupatenSelect = document.getElementById("Kabupaten");
            const selectedProvinsi = provinsiSelect.value;

            fetch(`/getKabupaten/${selectedProvinsi}`)
                .then(response => response.json())
                .then(data => {
                    kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
                    data.forEach(kabupaten => {
                        const option = document.createElement("option");
                        option.value = kabupaten.id; // Ganti dengan atribut yang sesuai
                        option.text = kabupaten.city_name; // Ganti dengan atribut yang sesuai
                        kabupatenSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        // Fungsi untuk mengambil data kecamatan berdasarkan kabupaten yang dipilih
        function updateKecamatan() {
            const kabupatenSelect = document.getElementById("Kabupaten");
            const kecamatanSelect = document.getElementById("Kecamatan");
            const selectedKabupaten = kabupatenSelect.value;

            fetch(`/getKecamatan/${selectedKabupaten}`)
                .then(response => response.json())
                .then(data => {
                    kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    data.forEach(kecamatan => {
                        const option = document.createElement("option");
                        option.value = kecamatan.id; // Ganti dengan atribut yang sesuai
                        option.text = kecamatan.dis_name; // Ganti dengan atribut yang sesuai
                        kecamatanSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        // Fungsi untuk mengambil data desa berdasarkan kecamatan yang dipilih
        function updateDesa() {
            const kecamatanSelect = document.getElementById("Kecamatan");
            const desaSelect = document.getElementById("Desa");
            const selectedKecamatan = kecamatanSelect.value;

            fetch(`/getDesa/${selectedKecamatan}`)
                .then(response => response.json())
                .then(data => {
                    desaSelect.innerHTML = '<option value="">Pilih Desa</option>';
                    data.forEach(Desa => {
                        const option = document.createElement("option");
                        option.value = Desa.id; // Ganti dengan atribut yang sesuai
                        option.text = Desa.subdis_name; // Ganti dengan atribut yang sesuai
                        desaSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        // Panggil fungsi fetchProvinsi() saat halaman dimuat
        fetchProvinsi();
    </script>
    <script>
        const TahunPengerjaan = document.getElementById('daerah_irigasi_id');
        const inputLainnyadaerah_irigasi_id = document.getElementById('inputLainnyadaerah_irigasi_id');

        // Tambahkan event listener untuk memantau perubahan pada select
        daerah_irigasi_id.addEventListener('change', function() {
            if (daerah_irigasi_id.value === 'lainnya') {
                inputLainnyadaerah_irigasi_id.style.display = 'block';
            } else {
                inputLainnyadaerah_irigasi_id.style.display = 'none';
            }
        });
    </script>


    
@endsection
