@extends('layout.main')
@section('container')
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
                                    <input type="number" step="0.01" class="form-control" id="IrigasiDesaTerbangun"
                                        name="IrigasiDesaTerbangun" value="{{ old('IrigasiDesaTerbangun') }}"
                                        placeholder="Hanya Menerima Masukan Angka Saja" required>
                                    <span class="input-group-text">KM</sup></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="IrigasiDesaBelumTerbangun" class="form-label">Total Saluran Irigasi Tersier &
                                    Irigasi Desa Belum Terbangun</label>
                                <div class="input-group">
                                    <input type="number" step="0.01" class="form-control" id="IrigasiDesaBelumTerbangun"
                                        name="IrigasiDesaBelumTerbangun" value="{{ old('IrigasiDesaBelumTerbangun') }}"
                                        placeholder="Hanya Menerima Masukan Angka Saja" required>
                                    <span class="input-group-text">KM</sup></span>
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
                                <h6>PDF Max 1 MB</h6>

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





    {{--  --}}

    {{--  --}}

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


<script>
    $('#provinsi').selectize({ normalize: true });
</script>

    {{-- <script>
        // Data wilayah dalam format JSON
        var dataWilayah = {
            "Jawa Tengah": {
                "Banjarnegara": {
                    "Banjarnegara": ['Tlagawera', 'Ampelsari', 'Cendana', 'Sokayasa'],
                    "Batur": ['Dieng Kulon', 'Bakal', 'Batur', 'Karangtengah', 'Kepakisan', 'Pasurenan', 'Pekasiran',
                        'Sumberejo'
                    ],
                    // "Binangun": [],
                    "Kalibening": ['Gununglangit', 'Asinan', 'Bedana', 'Kalibening', 'Kalibombong', 'Kalisat Kidul',
                        'Karang Anyar', 'Kasinoman', 'Kertasari', 'Majatengah', 'Plorengan', 'Sembawa',
                        'Sidakangen', 'Sikumpul', 'Sirukem', 'Sirukun'
                    ],
                    "Karangkobar": ['Leksana', 'Ambal', 'Binangun', 'Gumelar', 'Jlegong', 'Karanggondang',
                        'Karangkobar', 'Pagerpelah', 'Pasuruhan', 'Paweden', 'Purwodadi', 'Sampang', 'Slatri'
                    ],
                    "Mandiraja": ['Kertayasa', 'Salamerta', 'Kaliwungu', 'Purwasaba', 'Panggisari', 'Banjengan',
                        'Blimbing', 'Candiwulan', 'Glempang', 'Jalatunda', 'Kebakalan', 'Kebanaran',
                        'Mandirajakulon', 'Mandirajawetan', 'Simbang', 'Somawangi'
                    ],
                    "Pagedongan": ['Duren', 'Gentansari', 'Gunungjati', 'Kebutuhduwur', 'Kebutuhjurang', 'Lebakwangi',
                        'Pagedongan', 'Pesangkalan', 'Twelagiri', 'Jalatunda', 'Kebakalan', 'Kebanaran',
                        'Mandirajakulon', 'Mandirajawetan', 'Simbang', 'Somawangi'
                    ],
                    "Pagentan": ['Pagentan', 'Aribaya', 'Babadan', 'Gumingsir', 'Kalitlaga', 'Karangnangka', 'Karekan',
                        'Kasmaran', 'Kayuares', 'Larangan', 'Majasari', 'Metawana', 'Nagasari', 'Plumbungan',
                        'Sokaraja', 'Tegaljeruk'
                    ],
                    "Pekajangan": ['Condong Campur', 'Gembol', 'Sidengok', 'Giritirta', 'Sarwodadi', 'Tlahab', 'Beji',
                        'Biting', 'Darmayasa', 'Grogol', 'Kalilunjar', 'Karangsari', 'Panusupan', 'Pagundungan',
                        'Pejawaran', 'Ratamba', 'Semangkung'
                    ],
                    "Purwanegara": ['Danaraja', 'Gumiwang', 'Kaliajir', 'Kalipelus', 'Kalitengah', 'Karanganyar',
                        'Kutawuluh', 'Merden', 'Mertasari', 'Parakan', 'Petir', 'Pucungbedug', 'Purwonegoro'
                    ],
                    "Punggelan": ['Badakarya', 'Bondolharjo', 'Danakerta', 'Jembangan', 'Karangsari', 'Kecepit',
                        'Klapa', 'Mlaya', 'Petuguran', 'Punggelan', 'Purwasana', 'Sambong', 'Sawangan', 'Sidarata',
                        'Tanjungtirta', 'Tlaga', 'Tribuana'
                    ],
                    "Sigaluh": ['Wanacipta', 'Gembongan', 'Bandingan', 'Bojanegara', 'Karangmangu', 'Kemiri',
                        'Panawaren', 'Prigi', 'Pringamba', 'Randegan', 'Sawal', 'Sigaluh', 'Singomerto', 'Tunggara'
                    ],
                    "Susukan": ['Berta', 'Brengkok', 'Derik', 'Dermasari', 'Gumelem Kulon', 'Gumelem Wetan',
                        'Karangjati', 'Karangsalam', 'Kedawung', 'Kemranggon', 'Pakikiran', 'Panerusan Kulon',
                        'Panerusan Wetan', 'Piasa Wetan', 'Susukan'
                    ],
                    "Wanadadi": ['Linggasari', 'Kasilib', 'Karangkemiri', 'Gumingsir', 'Kandangwangi', 'Karangjambe',
                        'Lemahjaya', 'Wanadadi', 'Medayu', 'Tapen', 'Wanakarsa'
                    ],
                    "Wanayasa": ['Balun', 'Bantar', 'Dawuhan', 'Jatilawang', 'Karangtengah', 'Kasimpar', 'Kubang',
                        'Legoksayem', 'Pagergunung', 'Pandansari', 'Penanggungan', 'Kalideres', 'Susukan',
                        'Suwidak', 'Tempuran', 'Wanaraja', 'Wanayasa'
                    ]

                },
                "Banyumas": {
                    "Ajibarang": [],
                    "Banyumas": [],
                    "Baturaden": [],
                    "Cilongok": [],
                    "Gumelar": [],
                    "Jatilawang": [],
                    "Kalibagor": [],
                    "Karanglewas": [],
                    "Kembaran": [],
                    "Kebasen": [],
                    "Kedung Banteng": [],
                    "Kemranjen": [],
                    "Lumbir": [],
                    "Patikraja": [],
                    "Purwojati": [],
                    "Purwokerto Barat": [],
                    "Purwokerto Selatan": [],
                    "Purwokerto Timur": [],
                    "Purwokerto Utara": [],
                    "Rawsinkambing": [],
                    "Sumpiuh": [],
                    "Tambak": [],
                    "Wangon": []

                },
                "Batang": {
                    "Batang": [],
                    "Gringsing": [],
                    "Limpung": [],
                    "Tersono": [],
                    "Warungasem": [],
                    "Kandeman": [],
                    "Subah": [],
                    "Bawang": [],
                    "Tulis": [],
                    "Blado": [],
                    "Reban": [],
                    "Pecalungan": []


                },
                "Blora": {
                    "Blora": [],
                    "Cepu": [],
                    "Jiken": [],
                    "Kunduran": [],
                    "Ngawen": [],
                    "Randublatung": [],
                    "Sambong": [],
                    "Todanan": [],
                    "Tunjungan": [],
                    "Jepon": [],
                    "Juwana": [],
                    "Kedungtuban": [],
                    "Kradenan": [],
                    "Mejobo": [],
                    "Bojongsari": [],
                    "Jepara": [],
                    "Kunir": [],
                    "Malangbong": [],
                    "Sumber": [],
                    "Binangun": [],
                    "Wonosobo": [],
                    "Banjarejo": [],
                    "Jati": [],
                    "Jatipuro": [],
                    "Kedungjati": [],
                    "Keling": [],
                    "Kutorejo": [],
                    "Madukara": [],
                    "Mlati": [],
                    "Pelor": [],
                    "Randugunting": [],
                    "Sikumpul": [],
                    "Tembarak": []

                },
                "Boyolali": {
                    "Boyolali": [],
                    "Mojosongo": [],
                    "Musuk": [],
                    "Selo": [],
                    "Teras": [],
                    "Sawit": [],
                    "Banyudono": [],
                    "Sambi": [],
                    "Ngemplak": [],
                    "Kalitidu": [],
                    "Kemusu": [],
                    "Selo": [],
                    "Sawit": [],
                    "Simbo": [],
                    "Karanggede": []

                },
                "Brebes": {
                    "Banasari": [],
                    "Beji": [],
                    "Blogo": [],
                    "Bumiayu": [],
                    "Jatibarang": [],
                    "Kalangbret": [],
                    "Kembaran": [],
                    "Kersana": [],
                    "Ketanggungan": [],
                    "Larangan": [],
                    "Losari": [],
                    "Paguyangan": [],
                    "Salem": [],
                    "Salem": [],
                    "Sirampog": [],
                    "Songsong": [],
                    "Sokaraja": [],
                    "Tanjung": [],
                    "Tonjong": [],
                    "Wanasari": [],
                    "Warungpring": []

                },
                "Cilacap": {
                    "Adipala": [],
                    "Bantarsari": [],
                    "Binangun": [],
                    "Cilacap Selatan": [],
                    "Cilacap Tengah": [],
                    "Cilacap Utara": [],
                    "Dukuhseti": [],
                    "Gandrungmangu": [],
                    "Jeruklegi": [],
                    "Kampung Laut": [],
                    "Karangpucung": [],
                    "Kawunganten": [],
                    "Kedungreja": [],
                    "Kesugihan": [],
                    "Kroya": [],
                    "Majenang": [],
                    "Maos": [],
                    "Nusawungu": [],
                    "Pangandaran": [],
                    "Patimuan": [],
                    "Sampang": [],
                    "Sidareja": [],
                    "Wanareja": [],

                },
                "Demak": {
                    "Bonang": [],
                    "Demak": [],
                    "Dempet": [],
                    "Gajah": [],
                    "Guntur": [],
                    "Karang Tengah": [],
                    "Karanganyar": [],
                    "Karangawen": [],
                    "Karangjati": [],
                    "Karanganyar": [],
                    "Kebonagung": [],
                    "Kemusu": [],
                    "Mijen": [],
                    "Mranggen": [],
                    "Pagedangan": [],
                    "Sayung": [],
                    "Wedung": []

                },
                "Grobogan": {
                    "Brati": [],
                    "Batealit": [],
                    "Gabus": [],
                    "Gabuswetan": [],
                    "Geyer": [],
                    "Godong": [],
                    "Grokgak": [],
                    "Kaedanan": [],
                    "Kartasura": [],
                    "Karangrayung": [],
                    "Karangsempu": [],
                    "Karangtengah": [],
                    "Kedungjati": [],
                    "Klagen": [],
                    "Kradenan": [],
                    "Ngaringan": [],
                    "Penawangan": [],
                    "Pulokulon": [],
                    "Rowosari": [],
                    "Toroh": []

                },
                "Jepara": {
                    "Bangsri": [],
                    "Batealit": [],
                    "Donorojo": [],
                    "Jepara": [],
                    "Kalinyamatan": [],
                    "Karimunjawa": [],
                    "Kedung": [],
                    "Keling": [],
                    "Kembang": [],
                    "Keling": [],
                    "Kembang": [],
                    "Mayong": [],
                    "Mlonggo": [],
                    "Pakis Aji": [],
                    "Pecangaan": [],
                    "Tahunan": []

                },
                "Karanganyar": {
                    "Colomadu": [],
                    "Gondangrejo": [],
                    "Jaten": [],
                    "Jatipuro": [],
                    "Jatiyoso": [],
                    "Jenawi": [],
                    "Jumapolo": [],
                    "Jumantono": [],
                    "Karanganyar": [],
                    "Karangpandan": [],
                    "Kebakkramat": [],
                    "Kerjo": [],
                    "Klambu": [],
                    "Klaten Utara": [],
                    "Klaten Tengah": [],
                    "Klaten Selatan": [],
                    "Masaran": [],
                    "Ngargoyoso": [],
                    "Tasikmadu": [],
                    "Tawangmangu": []

                },
                "Kebumen": {
                    "Andong": [],
                    "Bagelen": [],
                    "Baturaden": [],
                    "Buayan": [],
                    "Buluspesantren": [],
                    "Gombong": [],
                    "Karanganyar": [],
                    "Karanggayam": [],
                    "Karangpari": [],
                    "Kebumen": [],
                    "Klirong": [],
                    "Kutowinangun": [],
                    "Kuwarasan": [],
                    "Prembun": [],
                    "Pejagoan": [],
                    "Petanahan": [],
                    "Poncowarno": [],
                    "Puring": [],
                    "Rowokele": [],
                    "Sadang": [],
                    "Sempor": [],
                    "Srumbung": [],
                    "Somagede": [],
                    "Somagede": [],
                    "Klirong": [],
                    "Alian": [],
                    "Karangbolong": [],
                    "Karanggayam": [],
                    "Karangsambung": [],
                    "Karangsembung": [],
                    "Karangpari": [],
                    "Karanggayam": [],
                    "Kawak": [],
                    "Buluspesantren": [],
                    "Kutowinangun": [],
                    "Karanggayam": [],
                    "Sadang": [],
                    "Karangsambung": [],
                    "Kebumen": [],
                    "Alian": [],
                },
                "Kendal": {
                    "Boja": [],
                    "Brangsong": [],
                    "Cepiring": [],
                    "Gabus": [],
                    "Kaliwungu": [],
                    "Kangkung": [],
                    "Kendal": [],
                    "Kendal": [],
                    "Kwadungan": [],
                    "Kaliwungu Selatan": [],
                    "Kaliwungu Tengah": [],
                    "Kaliwungu Utara": [],
                    "Limbangan": [],
                    "Ngampel": [],
                    "Pagerruyung": [],
                    "Patean": [],
                    "Patebon": [],
                    "Pegandon": [],
                    "Plantungan": [],
                    "Punggelan": [],
                    "Rowosari": [],
                    "Sukorejo": [],
                    "Singorojo": [],
                    "Slawi": [],
                    "Tambakrejo": [],
                    "Weleri": []

                },
                "Klaten": {
                    "Bayat": [],
                    "Bener": [],
                    "Boja": [],
                    "Cawas": [],
                    "Delanggu": [],
                    "Gantiwarno": [],
                    "Jatinom": [],
                    "Jogonalan": [],
                    "Juwiring": [],
                    "Kalikotes": [],
                    "Karanganom": [],
                    "Kebonarum": [],
                    "Kemalang": [],
                    "Klaten Selatan": [],
                    "Klaten Tengah": [],
                    "Klaten Utara": [],
                    "Manisrenggo": [],
                    "Ngawen": [],
                    "Pedan": [],
                    "Polanharjo": [],
                    "Prambanan": [],
                    "Trucuk": [],
                    "Tulung": [],
                    "Wedi": []

                },
                "Kudus": {
                    "Dawe": [],
                    "Getasan": [],
                    "Jati": [],
                    "Jekulo": [],
                    "Kaliwungu": [],
                    "Kudus": [],
                    "Mejobo": [],
                    "Undaan": [],

                },
                "Magelang": {
                    "Bandongan": [],
                    "Borobudur": [],
                    "Candimulyo": [],
                    "Dukun": [],
                    "Grabag": [],
                    "Kajoran": [],
                    "Kaliangkrik": [],
                    "Kemalang": [],
                    "Kepil": [],
                    "Kota Mungkid": [],
                    "Magelang Selatan": [],
                    "Magelang Tengah": [],
                    "Magelang Utara": [],
                    "Mertoyudan": [],
                    "Mungkid": [],
                    "Ngablak": [],
                    "Ngadiharjo": [],
                    "Pagak": [],
                    "Pakis": [],
                    "Salaman": [],
                    "Sawangan": [],
                    "Secang": [],
                    "Tegalrejo": [],
                    "Tempuran": [],

                },
                "Pati": {
                    "Batangan": [],
                    "Cluwak": [],
                    "Dukuhseti": [],
                    "Gabus": [],
                    "Gembong": [],
                    "Gunungwungkal": [],
                    "Jaken": [],
                    "Jakenan": [],
                    "Juwana": [],
                    "Kayen": [],
                    "Margorejo": [],
                    "Margoyoso": [],
                    "Ngawen": [],
                    "Pati": [],
                    "Patikraja": [],
                    "Sukolilo": [],
                    "Tambakromo": [],
                    "Wedarijaksa": [],
                    "Winong": []

                },
                "Pekalongan": {
                    "Ambarawa": [],
                    "Babadan": [],
                    "Bajong": [],
                    "Belik": [],
                    "Bodeh": [],
                    "Comal": [],
                    "Moga": [],
                    "Ngampel": [],
                    "Pekalongan Barat": [],
                    "Pekalongan Selatan": [],
                    "Pekalongan Timur": [],
                    "Pekalongan Utara": [],
                    "Pulosari": [],
                    "Warungpring": []

                },
                "Pemalang": {
                    "Belik": [],
                    "Bodeh": [],
                    "Comal": [],
                    "Moga": [],
                    "Pemalang": [],
                    "Pulosari": [],
                    "Taman": [],
                    "Ulujami": [],

                },
                "Purbalingga": {
                    "Babakan": [],
                    "Banyumas": [],
                    "Candradimuka": [],
                    "Karanganyar": [],
                    "Karangmoncol": [],
                    "Karangreja": [],
                    "Kejobong": [],
                    "Kemangkon": [],
                    "Kertanegara": [],
                    "Kutasari": [],
                    "Mrebet": [],
                    "Padamara": [],
                    "Purbalingga": [],
                    "Rembang": [],
                    "Warungpring": []

                },
                "Purworejo": {
                    "Banyuurip": [],
                    "Bener": [],
                    "Binangun": [],
                    "Brondong": [],
                    "Giriwoyo": [],
                    "Kaligesing": [],
                    "Kebonarum": [],
                    "Kemiri": [],
                    "Kutoarjo": [],
                    "Loano": [],
                    "Pituruh": [],
                    "Purwodadi": [],
                    "Purworejo": [],
                    "Roban": [],
                    "Selomerto": [],
                    "Kaligesing": [],
                    "Sukoharjo": [],
                    "Wangon": []

                },
                "Rembang": {
                    "Bulu": [],
                    "Grobogan": [],
                    "Gunem": [],
                    "Kradenan": [],
                    "Lasem": [],
                    "Pamotan": [],
                    "Pancur": [],
                    "Rembang": [],
                    "Sedan": [],
                    "Sulang": [],

                },
                "Semarang": {
                    "Ambarawa": [],
                    "Bandungan": [],
                    "Banyubiru": [],
                    "Bawen": [],
                    "Bringin": [],
                    "Getasan": [],
                    "Jambu": [],
                    "Kaliwungu": [],
                    "Karangawen": [],
                    "Kendal": [],
                    "Klampok": [],
                    "Langon": [],
                    "Ngablak": [],
                    "Pabelan": [],
                    "Pagentan": [],
                    "Pringapus": [],
                    "Sumowono": [],
                    "Tengaran": [],
                    "Tuntang": [],
                    "Ungaran Barat": [],
                    "Ungaran Timur": []

                },
                "Sragen": {
                    "Binodadi": [],
                    "Bumiayu": [],
                    "Jenar": [],
                    "Jumiang": [],
                    "Kedawung": [],
                    "Masaran": [],
                    "Miri": [],
                    "Mondokan": [],
                    "Ngaringan": [],
                    "Plupuh": [],
                    "Sambirejo": [],
                    "Somagede": [],
                    "Sragen": [],
                    "Sukodono": [],
                    "Sumberlawang": [],
                    "Tangen": [],
                    "Tanon": [],

                },
                "Sukoharjo": {
                    "Baki": [],
                    "Banjaran": [],
                    "Bulakamba": [],
                    "Colomadu": [],
                    "Grogol": [],
                    "Karanganyar": [],
                    "Kartasura": [],
                    "Mojolaban": [],
                    "Nguter": [],
                    "Polokarto": [],
                    "Tawangsari": [],
                    "Weru": []

                },
                "Tegal": {
                    "Adiwerna": [],
                    "Bumiayu": [],
                    "Dukuhwaru": [],
                    "Jatinegara": [],
                    "Kedungbanteng": [],
                    "Kramat": [],
                    "Lebaksiu": [],
                    "Margaasih": [],
                    "Pangkah": [],
                    "Slawi": [],
                    "Surodadi": [],
                    "Talang": [],
                    "Tarub": [],
                    "Warureja": [],

                },
                "Temanggung": {
                    "Bancak": [],
                    "Bejen": [],
                    "Boja": [],
                    "Bulu": [],
                    "Candiroto": [],
                    "Gembong": [],
                    "Karanganyar": [],
                    "Kedu": [],
                    "Kledung": [],
                    "Kranggan": [],
                    "Ngadirejo": [],
                    "Parakan": [],
                    "Prambanan": [],
                    "Pringsurat": [],
                    "Selopampang": [],
                    "Temanggung": [],
                    "Tembarak": [],
                    "Tlogomulyo": [],
                    "Tremes": [],

                },
                "Wonogiri": {
                    "Baturetno": [],
                    "Binangun": [],
                    "Bulukerto": [],
                    "Eromoko": [],
                    "Girimarto": [],
                    "Giritontro": [],
                    "Giriwoyo": [],
                    "Jatipurno": [],
                    "Jatisrono": [],
                    "Karangtengah": [],
                    "Kismantoro": [],
                    "Manyaran": [],
                    "Ngadirojo": [],
                    "Purwantoro": [],
                    "Slogohimo": [],
                    "Tirtomoyo": [],
                    "Wuryantoro": [],

                },
                "Wonosobo": {
                    "Kaliwiro": [],
                    "Kalibawang": [],
                    "Kejajar": [],
                    "Kepil": [],
                    "Kertek": [],
                    "Leksono": [],
                    "Mojotengah": [],
                    "Sapuran": [],
                    "Selomerto": [],
                    "Sukoharjo": [],
                    "Wadaslintang": [],
                    "Watumalang": [],
                    "Wonosobo": [],

                }
            },
            "DI.Yogyakarta": {
                "Kab. Bantul": {
                    "Bambanglipuro": [],
                    "Banguntapan": [],
                    "Bantul": [],
                    "Dlingo": [],
                    "Imogiri": [],
                    "Jetis": [],
                    "Kasihan": [],
                    "Kretek": [],
                    "Pandak": [],
                    "Pajangan": [],
                    "Pleret": [],
                    "Piyungan": [],
                    "Pundong": [],
                    "Sanden": [],
                    "Sedayu": [],
                    "Srandakan": []


                },
                "Kab. Gunungkidul": {
                    "Gedangsari": [],
                    "Girisubo": [],
                    "KarangMojo": [],
                    "Nglipar": [],
                    "Ngawen": [],
                    "Paliyan": [],
                    "Panggang": [],
                    "Patuk": [],
                    "Ponjong": [],
                    "Playen": [],
                    "Purwosari": [],
                    "Rongkop": [],
                    "Saptosari": [],
                    "Semin": [],
                    "Semanu": [],
                    "Tanjungsari": [],
                    "Tepus": [],
                    "Wonosari": []

                },
                "Kab. Kulon Progo": {
                    "Galur": [],
                    "Girimulyo": [],
                    "Kalibawang": [],
                    "Kokap": [],
                    "Lendah": [],
                    "Nanggulan": [],
                    "Panjatan": [],
                    "Pengasih": [],
                    "Samigaluh": [],
                    "Sentolo": [],
                    "Temon": [],
                    "Wates": []

                },
                "Kab. Sleman": {
                    "Gamping": [],
                    "Godean": [],
                    "Kalasan": [],
                    "Minggir": [],
                    "Mlati": [],
                    "Moyudan": [],
                    "Ngaglik": [],
                    "Ngemplak": [],
                    "Pakem": [],
                    "Prambanan": [],
                    "Seyegan": [],
                    "Sleman": [],
                    "Tempel": [],
                    "Turi": []

                },
                "Kota Yogyakarta": {
                    "Baciro": [],
                    "Danurejan": [],
                    "Gedong Tengen": [],
                    "Gondokusuman": [],
                    "Gondomanan": [],
                    "Jetis": [],
                    "Kotabaru": [],
                    "Kotagede": [],
                    "Kraton": [],
                    "Mantrijeron": [],
                    "Mergangsan": [],
                    "Ngampilan": [],
                    "Pakualaman": [],
                    "Prawirodirjan": [],
                    "Purwokerto": [],
                    "Suryatmajan": [],
                    "Tegalrejo": [],
                    "Wirobrajan": []

                }
            }
            // Tambahkan lebih banyak data wilayah sesuai kebutuhan Anda
        };

        var provinsiSelect = document.getElementById("provinsi");
        var kabupatenSelect = document.getElementById("Kabupaten");
        var kecamatanSelect = document.getElementById("Kecamatan");
        var desaSelect = document.getElementById("Desa");

        // Mengisi dropdown provinsi saat halaman dimuat
        for (var provinsi in dataWilayah) {
            var option = document.createElement("option");
            option.value = provinsi;
            option.text = provinsi;
            provinsiSelect.add(option);
        }

        function updateKabupaten() {
            // Mengisi dropdown kabupaten/kota berdasarkan provinsi yang dipilih
            var provinsi = provinsiSelect.value;
            kabupatenSelect.innerHTML = "<option value=''>Pilih Kabupaten/Kota</option>";
            kecamatanSelect.innerHTML = "<option value=''>Pilih Kecamatan</option>";
            desaSelect.innerHTML = "<option value=''>Pilih Desa/Kelurahan</option>";

            if (provinsi in dataWilayah) {
                for (var kabupaten in dataWilayah[provinsi]) {
                    var option = document.createElement("option");
                    option.value = kabupaten;
                    option.text = kabupaten;
                    kabupatenSelect.add(option);
                }
            }
        }

        function updateKecamatan() {
            // Mengisi dropdown kecamatan berdasarkan kabupaten/kota yang dipilih
            var provinsi = provinsiSelect.value;
            var kabupaten = kabupatenSelect.value;
            kecamatanSelect.innerHTML = "<option value=''>Pilih Kecamatan</option>";
            desaSelect.innerHTML = "<option value=''>Pilih Desa/Kelurahan</option>";

            if (provinsi in dataWilayah && kabupaten in dataWilayah[provinsi]) {
                for (var kecamatan in dataWilayah[provinsi][kabupaten]) {
                    var option = document.createElement("option");
                    option.value = kecamatan;
                    option.text = kecamatan;
                    kecamatanSelect.add(option);
                }
            }
        }

        function updateDesa() {
            // Mengisi dropdown desa/kelurahan berdasarkan kecamatan yang dipilih
            var provinsi = provinsiSelect.value;
            var kabupaten = kabupatenSelect.value;
            var kecamatan = kecamatanSelect.value;
            desaSelect.innerHTML = "<option value=''>Pilih Desa/Kelurahan</option>";

            if (provinsi in dataWilayah && kabupaten in dataWilayah[provinsi] && kecamatan in dataWilayah[provinsi][
                    kabupaten
                ]) {
                var desaOptions = dataWilayah[provinsi][kabupaten][kecamatan];
                for (var i = 0; i < desaOptions.length; i++) {
                    var option = document.createElement("option");
                    option.value = desaOptions[i];
                    option.text = desaOptions[i];
                    desaSelect.add(option);
                }
            }
        }
    </script> --}}
@endsection
