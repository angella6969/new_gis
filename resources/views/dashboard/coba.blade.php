@extends('layout.main')
@section('container')
    {{-- <div class="form-group">
        <label for="provinsi">Provinsi:</label>
        <select class="form-control" id="provinsi" name="provinsi">
            <option value="">Pilih Provinsi</option>
        </select>
    </div>
    <div class="form-group">
        <label for="kabupaten">kabupaten:</label>
        <select class="form-control" id="kabupaten" name="kabupaten">
            <option value="">Pilih kabupaten</option>
        </select>
    </div>


    <script>
        // $(document).ready(function() {
        jQuery.ajax({
            url: '/getProvinsi',
            method: 'GET',
            success: function(data) {
                $.each(data, function(index, provinsi) {
                    $('#provinsi').append('<option value="' + provinsi.id + '">' +
                        provinsi.prov_name + '</option>');
                });
                $('#provinsi').change(function() {
                    var selectedProvinsiId = $(this).val();
                    doSomethingWithProvinsiId(selectedProvinsiId);
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

        function doSomethingWithProvinsiId(selectedProvinsiId) {
            $('#kabupaten').empty();
            $('#kabupaten').append('<option value="">Pilih Kabupaten</option>');
            console.log(selectedProvinsiId);
            // $.ajax({
            //     url: '/getKabupaten/' +
            //         selectedProvinsiId, // Menggunakan selectedProvinsiId yang diterima
            //     method: 'GET',
            //     success: function(data) {
            //         if (data) {
            //             $.each(data, function(index, kabupaten) {
            //                 $('#kabupaten').append('<option value="' +
            //                     kabupaten.id + '">' +
            //                     kabupaten.city_name + '</option>');
            //             });
            //         } else {
            //             console.error('Tidak ada data kabupaten yang ditemukan');
            //         }
            //     },
            //     error: function(xhr, status, error) {
            //         console.error('Terjadi kesalahan dalam mengambil data kabupaten: ' + error);
            //     }
            // });
        }
        // });
    </script> --}}

































<button></button>







 

    <form>
        <label for="provinsi">Pilih Provinsi:</label>
        <select id="provinsi" onchange="updateKabupaten()">
            <option value="">Pilih Provinsi</option>
        </select>

        <label for="kabupaten">Pilih Kabupaten:</label>
        <select id="kabupaten" onchange="updateKecamatan()">
            <option value="">Pilih Kabupaten</option>
        </select>

        <label for="kecamatan">Pilih Kecamatan:</label>
        <select id="kecamatan" onchange="updateDesa()">
            <option value="">Pilih Kecamatan</option>
        </select>

        <label for="desa">Pilih Desa:</label>
        <select id="desa">
            <option value="">Pilih Desa</option>
        </select>
    </form>

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
            const kabupatenSelect = document.getElementById("kabupaten");
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
            const kabupatenSelect = document.getElementById("kabupaten");
            const kecamatanSelect = document.getElementById("kecamatan");
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
            const kecamatanSelect = document.getElementById("kecamatan");
            const desaSelect = document.getElementById("desa");
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
@endsection
