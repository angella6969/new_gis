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

        .line {
            border-top: 1px solid rgba(230, 138, 38, 1);
            margin: 10px 0;
        }
    </style>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Progres Perkembangan Irigasi P3-TGAI</h5>
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="/dashboard/update/perkembangan-daerah-irigasi/edit/{{ $progres->id }}"
                            enctype="multipart/form-data">
                            @csrf
                            {{-- <input type="hidden" name="penerima_id" value="{{ $id }}"> --}}
                            {{-- <div class="mb-3">
                                <label for="DaerahIrigasi" class="form-label">Daerah Irigasi</label>
                                <input type="text" class="form-control" id="DaerahIrigasi" placeholder="Daerah Irigasi"
                                    disabled value="{{ $penerima->DaerahIrigasi }}">
                            </div>
                            <div class="mb-3">
                                <label for="Desa" class="form-label">Desa</label>
                                <input type="text" class="form-control" id="Desa" placeholder="Desa" disabled
                                    value="{{ $penerima->Desa }}">
                            </div>
                            <div class="mb-3">
                                <label for="names" class="form-label">Nama P3A/GP3A</label>
                                <input type="text" class="form-control" id="names" placeholder="names" disabled
                                    value="{{ $penerima->names }}">
                            </div> --}}

                            <div class="mt-3 mb-3">
                                <label for="TahunPengerjaan" class="form-label">Tahun Pengerjaan</label>
                                {{-- <input type="text" class="form-control" disabled
                                    value="Data Lama : {{ $progres->TahunPengerjaan }}"> --}}
                                <select class="form-select" id="TahunPengerjaan" name="TahunPengerjaan">
                                    {{-- <option value="{{ $progres->TahunPengerjaan }}">{{ $progres->TahunPengerjaan }}</option> --}}
                                    <option value="Tahun Petama"
                                        {{ old('TahunPengerjaan', $progres->TahunPengerjaan) == 'Tahun Petama' ? 'selected' : '' }}>
                                        Tahun Petama
                                    </option>
                                    <option value="Tahun Kedua"
                                        {{ old('TahunPengerjaan', $progres->TahunPengerjaan) == 'Tahun Kedua' ? 'selected' : '' }}>
                                        Tahun Kedua</option>
                                    <option value="Tahun Ketiga"
                                        {{ old('TahunPengerjaan', $progres->TahunPengerjaan) == 'Tahun Ketiga' ? 'selected' : '' }}>
                                        Tahun Ketiga
                                    </option>
                                    <option value="Tahun Keempat"
                                        {{ old('TahunPengerjaan', $progres->TahunPengerjaan) == 'Tahun Keempat' ? 'selected' : '' }}>
                                        Tahun Keempat
                                    </option>
                                    <option value="Tahun Kelima"
                                        {{ old('TahunPengerjaan', $progres->TahunPengerjaan) == 'Tahun Kelima' ? 'selected' : '' }}>
                                        Tahun Kelima
                                    </option>
                                    <option value="lainnya"
                                        {{ old('TahunPengerjaan', $progres->TahunPengerjaan) == 'lainnya' ? 'selected' : '' }}>
                                        Pilihan Lainnya</option>
                                </select>
                            </div>

                            <div id="inputLainnyaTahunPengerjaan"
                                style="display: {{ old('TahunPengerjaan') == 'lainnya' ? 'block' : 'none' }}">
                                <label for="pilihanLainnyaTahunPengerjaan">Pilihan Lainnya:</label>
                                <input type="text" class="form-control" id="pilihanLainnyaTahunPengerjaan"
                                    name="pilihanLainnyaTahunPengerjaan" value="{{ old('pilihanLainnyaTahunPengerjaan') }}">
                            </div>

                            <div class="mt-3 mb-3">
                                <label for="jenisPekerjaan" class="form-label">Jenis Pekerjaan</label>
                                {{-- <input type="text" class="form-control" disabled
                                    value="Data Lama : {{ $progres->jenisPekerjaan }}"> --}}
                                <select class="form-select" id="jenisPekerjaan" name="jenisPekerjaan">
                                    {{-- <option value="">Pilih salah satu opsi</option> --}}
                                    <option value="Rehabilitasi"
                                        {{ old('jenisPekerjaan', $progres->jenisPekerjaan) == 'Rehabilitasi' ? 'selected' : '' }}>
                                        Rehabilitasi
                                    </option>
                                    <option value="Peningkatan"
                                        {{ old('jenisPekerjaan', $progres->jenisPekerjaan) == 'Peningkatan' ? 'selected' : '' }}>
                                        Peningkatan</option>
                                    <option value="Pembangunan"
                                        {{ old('jenisPekerjaan', $progres->jenisPekerjaan) == 'Pembangunan' ? 'selected' : '' }}>
                                        Pembangunan</option>
                                </select>
                            </div>

                            <div class="mt-3 mb-3">
                                <label for="langsirMaterial" class="form-label">Langsir Material</label>
                                {{-- <input type="text" class="form-control" disabled
                                    value="Data Lama : {{ $progres->langsirMaterial }}"> --}}
                                <select class="form-select" id="langsirMaterial" name="langsirMaterial">
                                    {{-- <option value="">Pilih salah satu opsi</option> --}}
                                    <option value="Ada" {{ old('langsirMaterial') == 'Ada' ? 'selected' : '' }}>Ada
                                    </option>
                                    <option value="Tidak Ada"
                                        {{ old('langsirMaterial') == 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jarakLangsir" class="form-label">Jarak Langsir</label>
                                {{-- <input type="text" class="form-control" disabled
                                    value="Data Lama : {{ $progres->jarakLangsir }}"> --}}
                                <div class="input-group">
                                    <input type="text" class="form-control" id="jarakLangsir" name="jarakLangsir"
                                        placeholder="jarak Langsir"
                                        value="{{ old('jarakLangsir', $progres->jarakLangsir) }}">
                                    <span class="input-group-text">M</sub></span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="BedaLangsir" class="form-label">Beda Tinggi Langsir</label>
                                {{-- <input type="text" class="form-control" disabled
                                    value="Data Lama : {{ $progres->bedaLangsir }}"> --}}
                                <div class="input-group">
                                    <input type="text" class="form-control" id="BedaLangsir" name="bedaLangsir"
                                        placeholder="Beda Tinggi Langsir"
                                        value="{{ old('bedaLangsir', $progres->bedaLangsir) }}">
                                    <span class="input-group-text">M</sub></span>
                                </div>
                            </div>

                            <div class="mt-3 mb-3">
                                <label for="metodeLangsir" class="form-label">Metode Langsir</label>
                                {{-- <input type="text" class="form-control" disabled
                                    value="Data Lama : {{ $progres->metodeLangsir }}"> --}}
                                <select class="form-select" id="metodeLangsir" name="metodeLangsir">
                                    {{-- <option value="">Pilih salah satu opsi</option> --}}
                                    <option value="Tenaga Manusia Dengan Ember/Pikulan/Karung"
                                        {{ old('metodeLangsir', $progres->metodeLangsir) == 'Tenaga Manusia Dengan Ember/Pikulan/Karung' ? 'selected' : '' }}>
                                        Tenaga Manusia Dengan Ember/Pikulan/Karung
                                    </option>
                                    <option value="Tenaga Manusia Dengan Angkong"
                                        {{ old('metodeLangsir') == 'Tenaga Manusia Dengan Angkong' ? 'selected' : '' }}>
                                        Tenaga Manusia Dengan Angkong
                                    </option>
                                    <option value="lainnya" {{ old('metodeLangsir') == 'lainnya' ? 'selected' : '' }}>
                                        Pilihan Lainnya</option>
                                </select>
                            </div>

                            <div id="inputLainnyaMetode"
                                style="display: {{ old('metodeLangsir') == 'lainnya' ? 'block' : 'none' }}">
                                <label for="pilihanLainnyaMetode">Pilihan Lainnya:</label>
                                <input type="text" class="form-control" id="pilihanLainnyaMetode"
                                    name="pilihanLainnyaMetode" value="{{ old('pilihanLainnyaMetode') }}">
                            </div>

                            <div class="mt-3 mb-3">
                                <label for="KondisiLokasiPekerjaan" class="form-label">Kondisi Lokasi Pekerjaan</label>
                                {{-- <input type="text" class="form-control" disabled
                                    value="Data Lama : {{ $progres->KondisiLokasiPekerjaan }}"> --}}
                                <select class="form-select" id="KondisiLokasiPekerjaan" name="KondisiLokasiPekerjaan">
                                    {{-- <option value="">Pilih salah satu opsi</option> --}}
                                    <option value="Datar"
                                        {{ old('KondisiLokasiPekerjaan', $progres->KondisiLokasiPekerjaan) == 'Datar' ? 'selected' : '' }}>
                                        Datar</option>
                                    <option value="Sebagian Datar Sebagian Terjal"
                                        {{ old('KondisiLokasiPekerjaan', $progres->KondisiLokasiPekerjaan) == 'Sebagian Datar Sebagian Terjal' ? 'selected' : '' }}>
                                        Sebagian Datar Sebagian Terjal</option>
                                    <option value="Melewati Saluran"
                                        {{ old('KondisiLokasiPekerjaan', $progres->KondisiLokasiPekerjaan) == 'Melewati Saluran' ? 'selected' : '' }}>
                                        Melewati Saluran</option>
                                    <option value="Melewati Jalan"
                                        {{ old('KondisiLokasiPekerjaan', $progres->KondisiLokasiPekerjaan) == 'Melewati Jalan' ? 'selected' : '' }}>
                                        Melewati
                                        Jalan</option>
                                    <option value="Ada Galian Tebing"
                                        {{ old('KondisiLokasiPekerjaan', $progres->KondisiLokasiPekerjaan) == 'Ada Galian Tebing' ? 'selected' : '' }}>
                                        Ada
                                        Galian Tebing</option>
                                    <option value="Ada Timbunan"
                                        {{ old('KondisiLokasiPekerjaan', $progres->KondisiLokasiPekerjaan) == 'Ada Timbunan' ? 'selected' : '' }}>
                                        Ada
                                        Timbunan</option>
                                    <option value="lainnya"
                                        {{ old('KondisiLokasiPekerjaan', $progres->KondisiLokasiPekerjaan) == 'lainnya' ? 'selected' : '' }}>
                                        Lainnya</option>
                                </select>
                            </div>

                            <div id="inputLainnyaKondisiLokasiPekerjaan"
                                style="display: {{ old('KondisiLokasiPekerjaan') == 'lainnya' ? 'block' : 'none' }}">
                                <label for="pilihanLainnyaKondisiLokasiPekerjaan">Pilihan Lainnya:</label>
                                <input type="text" class="form-control" id="pilihanLainnyaKondisiLokasiPekerjaan"
                                    name="pilihanLainnyaKondisiLokasiPekerjaan"
                                    value="{{ old('pilihanLainnyaKondisiLokasiPekerjaan') }}">
                            </div>

                            <div class="mt-3 mb-3">
                                <label for="KondisiTanahLokasiPekerjaan" class="form-label">Kondisi Tanah Lokasi
                                    Pekerjaan</label>
                                {{-- <input type="text" class="form-control" disabled
                                    value="Data Lama : {{ $progres->KondisiTanahLokasiPekerjaan }}"> --}}
                                <select class="form-select" id="KondisiTanahLokasiPekerjaan"
                                    name="KondisiTanahLokasiPekerjaan">
                                    {{-- <option value="">Pilih salah satu opsi</option> --}}
                                    <option value="Kering"
                                        {{ old('KondisiTanahLokasiPekerjaan', $progres->KondisiTanahLokasiPekerjaan) == 'Kering' ? 'selected' : '' }}>
                                        Kering
                                    </option>
                                    <option value="Berair"
                                        {{ old('KondisiTanahLokasiPekerjaan', $progres->KondisiTanahLokasiPekerjaan) == 'Berair' ? 'selected' : '' }}>
                                        Berair
                                    </option>
                                    <option value="Daya dukung kuat atau bagus"
                                        {{ old('KondisiTanahLokasiPekerjaan', $progres->KondisiTanahLokasiPekerjaan) == 'Daya dukung kuat atau bagus' ? 'selected' : '' }}>
                                        Daya dukung kuat atau bagus</option>
                                    <option value="Daya dukung rendah (mudah ambles)"
                                        {{ old('KondisiTanahLokasiPekerjaan', $progres->KondisiTanahLokasiPekerjaan) == 'Daya dukung rendah (mudah ambles)' ? 'selected' : '' }}>
                                        Daya dukung rendah (mudah ambles)</option>
                                    <option value="lainnya"
                                        {{ old('KondisiTanahLokasiPekerjaan', $progres->KondisiTanahLokasiPekerjaan) == 'lainnya' ? 'selected' : '' }}>
                                        Lainnya
                                    </option>
                                </select>
                            </div>

                            <div id="inputLainnyaKondisiTanahLokasiPekerjaan"
                                style="display: {{ old('KondisiTanahLokasiPekerjaan') == 'lainnya' ? 'block' : 'none' }}">
                                <label for="pilihanLainnyaKondisiTanahLokasiPekerjaan">Pilihan Lainnya:</label>
                                <input type="text" class="form-control" id="pilihanLainnyaKondisiTanahLokasiPekerjaan"
                                    name="pilihanLainnyaKondisiTanahLokasiPekerjaan"
                                    value="{{ old('pilihanLainnyaKondisiTanahLokasiPekerjaan') }}">
                            </div>

                            <div class="mt-3 mb-3">
                                <label for="PotensiMasalahSosial" class="form-label">Potensi Masalah Sosial</label>
                                {{-- <input type="text" class="form-control" disabled
                                    value="Data Lama : {{ $progres->PotensiMasalahSosial }}"> --}}
                                <select class="form-select" id="PotensiMasalahSosial" name="PotensiMasalahSosial">
                                    {{-- <option value="">Pilih salah satu opsi</option> --}}
                                    <option value="Tidak Ada"
                                        {{ old('PotensiMasalahSosial', $progres->PotensiMasalahSosial) == 'Tidak Ada' ? 'selected' : '' }}>
                                        Tidak Ada
                                    </option>
                                    <option value="Saat Musim Panen tenaga kerja tidak ada"
                                        {{ old('PotensiMasalahSosial', $progres->PotensiMasalahSosial) == 'Saat Musim Panen tenaga kerja tidak ada' ? 'selected' : '' }}>
                                        Saat Musim Panen tenaga kerja tidak ada</option>
                                    <option value="Tenaga Kerja Upah Tinggi"
                                        {{ old('PotensiMasalahSosial', $progres->PotensiMasalahSosial) == 'Tenaga Kerja Upah Tinggi' ? 'selected' : '' }}>
                                        Tenaga Kerja Upah Tinggi</option>
                                    <option value="Sering libur krn kearifan lokal"
                                        {{ old('PotensiMasalahSosial', $progres->PotensiMasalahSosial) == 'Sering libur krn kearifan lokal' ? 'selected' : '' }}>
                                        Sering libur krn kearifan lokal</option>
                                    <option value="Antara Desa dan P3A kurang harmonis"
                                        {{ old('PotensiMasalahSosial', $progres->PotensiMasalahSosial) == 'Antara Desa dan P3A kurang harmonis' ? 'selected' : '' }}>
                                        Antara Desa dan P3A kurang harmonis</option>
                                    <option value="Kondisi internal P3A kurang solid"
                                        {{ old('PotensiMasalahSosial', $progres->PotensiMasalahSosial) == 'Kondisi internal P3A kurang solid' ? 'selected' : '' }}>
                                        Kondisi internal P3A kurang solid</option>
                                    <option value="Kepala Desa sangat dominan"
                                        {{ old('PotensiMasalahSosial', $progres->PotensiMasalahSosial) == 'Kepala Desa sangat dominan' ? 'selected' : '' }}>
                                        Kepala Desa sangat dominan</option>
                                    <option value="Ada tokoh masyarakat yang sangat dominan"
                                        {{ old('PotensiMasalahSosial', $progres->PotensiMasalahSosial) == 'Ada tokoh masyarakat yang sangat dominan' ? 'selected' : '' }}>
                                        Ada tokoh masyarakat yang sangat dominan</option>
                                    <option value="lainnya"
                                        {{ old('PotensiMasalahSosial', $progres->PotensiMasalahSosial) == 'lainnya' ? 'selected' : '' }}>
                                        Lainnya</option>
                                </select>
                            </div>

                            <div id="inputLainnyaPotensiMasalahSosial"
                                style="display: {{ old('PotensiMasalahSosial') == 'lainnya' ? 'block' : 'none' }}">
                                <label for="pilihanLainnyaPotensiMasalahSosial">Pilihan Lainnya:</label>
                                <input type="text" class="form-control" id="pilihanLainnyaPotensiMasalahSosial"
                                    name="pilihanLainnyaPotensiMasalahSosial"
                                    value="{{ old('pilihanLainnyaPotensiMasalahSosial') }}">
                            </div>
                            <div class="separator">
                                <br>
                                <p class="d-flex justify-content-center">Dokumen</p>
                                <div class="line"></div>
                            </div>

                            <div class="mt-3 mb-3">
                                <label for="TerlampirAktePendirian">Akte Pendirian</label>
                                <input type="file" class="form-control" id="TerlampirAktePendirian"
                                    name="TerlampirAktePendirian" accept="application/pdf">
                                <h6>PDF Max 1 MB</h6>
                            </div>

                            <div class="mt-3 mb-3">
                                <label for="TerlampirNPWP">NPWP</label>
                                <input type="file" class="form-control @error('jaringan_pdf') is-invalid @enderror"
                                    id="TerlampirNPWP" name="TerlampirNPWP" accept="application/pdf">
                                <div class="form-text">PDF Max 5 MB
                                </div>

                            </div>

                            <div class="mt-3 mb-3">
                                <label for="TerlampirBukuRekening">Buku Rekening</label>
                                <input type="file"
                                    class="form-control @error('TerlampirBukuRekening') is-invalid @enderror"
                                    id="TerlampirBukuRekening" name="TerlampirBukuRekening" accept="application/pdf">
                                <div class="form-text">PDF Max 5 MB
                                </div>
                            </div>
                            <div class="mt-3 mb-3">
                                <label for="TerlampirRab">RAB</label>
                                <input type="file" class="form-control " id="TerlampirRab" name="TerlampirRab"
                                    accept="application/pdf">
                                <div class="form-text">PDF Max 5 MB
                                </div>
                            </div>
                            <div class="mt-3 mb-3">
                                <label for="TerlampirLembarKerja">Gambar Kerja</label>
                                <input type="file" class="form-control " id="TerlampirLembarKerja"
                                    name="TerlampirLembarKerja" accept="application/pdf">
                                <div class="form-text">PDF Max 5 MB
                                </div>
                            </div>
                            <div class="mt-3 mb-3">
                                <label for="TerlampirProgres">Foto Survei</label>
                                <input type="file" class="form-control" id="TerlampirProgres" name="TerlampirProgres"
                                    accept="image/*">
                                <div class="form-text">Hanya gambar (PNG, JPG, JPEG, MAX:5 MB) yang diterima</div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
        // Ambil elemen-elemen yang diperlukan
        const TahunPengerjaan = document.getElementById('TahunPengerjaan');
        const inputLainnyaTahunPengerjaan = document.getElementById('inputLainnyaTahunPengerjaan');

        // Tambahkan event listener untuk memantau perubahan pada select
        TahunPengerjaan.addEventListener('change', function() {
            if (TahunPengerjaan.value === 'lainnya') {
                inputLainnyaTahunPengerjaan.style.display = 'block';
            } else {
                inputLainnyaTahunPengerjaan.style.display = 'none';
            }
        });

        const metodeLangsir = document.getElementById('metodeLangsir');
        const inputLainnyaMetode = document.getElementById('inputLainnyaMetode');
        const pilihanLainnyaMetode = document.getElementById('pilihanLainnyaMetode');

        metodeLangsir.addEventListener('change', function() {
            if (metodeLangsir.value === 'lainnya') {
                inputLainnyaMetode.style.display = 'block';
                pilihanLainnyaMetode.required = true;
            } else {
                inputLainnyaMetode.style.display = 'none';
                pilihanLainnyaMetode.required = false;
            }
        });

        const kondisiLokasiPekerjaan = document.getElementById('KondisiLokasiPekerjaan');
        const inputLainnyaKondisiLokasiPekerjaan = document.getElementById('inputLainnyaKondisiLokasiPekerjaan');
        const pilihanLainnyaKondisiLokasiPekerjaan = document.getElementById('pilihanLainnyaKondisiLokasiPekerjaan');

        kondisiLokasiPekerjaan.addEventListener('change', function() {
            if (kondisiLokasiPekerjaan.value === 'lainnya') {
                inputLainnyaKondisiLokasiPekerjaan.style.display = 'block';
                pilihanLainnyaKondisiLokasiPekerjaan.required = true;
            } else {
                inputLainnyaKondisiLokasiPekerjaan.style.display = 'none';
                pilihanLainnyaKondisiLokasiPekerjaan.required = false;
            }
        });

        const kondisiTanahLokasiPekerjaan = document.getElementById('KondisiTanahLokasiPekerjaan');
        const inputLainnyaKondisiTanahLokasiPekerjaan = document.getElementById('inputLainnyaKondisiTanahLokasiPekerjaan');
        const pilihanLainnyaKondisiTanahLokasiPekerjaan = document.getElementById(
            'pilihanLainnyaKondisiTanahLokasiPekerjaan');

        kondisiTanahLokasiPekerjaan.addEventListener('change', function() {
            if (kondisiTanahLokasiPekerjaan.value === 'lainnya') {
                inputLainnyaKondisiTanahLokasiPekerjaan.style.display = 'block';
                pilihanLainnyaKondisiTanahLokasiPekerjaan.required = true;
            } else {
                inputLainnyaKondisiTanahLokasiPekerjaan.style.display = 'none';
                pilihanLainnyaKondisiTanahLokasiPekerjaan.required = false;
            }
        });

        const potensiMasalahSosial = document.getElementById('PotensiMasalahSosial');
        const inputLainnyaPotensiMasalahSosial = document.getElementById('inputLainnyaPotensiMasalahSosial');
        const pilihanLainnyaPotensiMasalahSosial = document.getElementById('pilihanLainnyaPotensiMasalahSosial');

        potensiMasalahSosial.addEventListener('change', function() {
            if (potensiMasalahSosial.value === 'lainnya') {
                inputLainnyaPotensiMasalahSosial.style.display = 'block';
                pilihanLainnyaPotensiMasalahSosial.required = true;
            } else {
                inputLainnyaPotensiMasalahSosial.style.display = 'none';
                pilihanLainnyaPotensiMasalahSosial.required = false;
            }
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
@endsection
