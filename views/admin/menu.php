<?php
include "./config/connect.php";

$petugas = $_SESSION['id'];
$query = mysqli_query($conn, "SELECT * FROM tb_menu");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}


?>

<!--  -->

<div x-data="{ modal: false, selectedId: null, selectKategori: null, selectNama: null, selectdeskripsi: null, selectHpp: null, selectHarga: null, selectStatus: null, selectImg: null, typeAksi: null,
    getLabel() {
                return this.typeAksi === 'Tambah Data' ? 'Simpan Data' :
                        this.typeAksi === 'Edit Data' ? 'Simpan Perubahan' :
                        this.typeAksi === 'Hapus Data' ? 'Hapus' : 
                        null;
            },
    getClass() {
                return this.typeAksi === 'Tambah Data' ? 'bg-green-500 hover:bg-green-700' :
                    this.typeAksi === 'Edit Data' ? 'bg-green-500' :
                    this.typeAksi === 'Hapus Data' ? 'bg-red-500' :
                    this.typeAksi === 'Detail Data' ? 'hidden' :
                    'bg-gray-500';
            },
    handleFileChange(event) { 
            let file = event.target.files[0];
            let pilihan = file;
            
                if (file) { 
                    this.selectImg = URL.createObjectURL(file); 
                } else { 
                    this.selectImg = null;
                    
                }
            } 
                    }">

    <!-- tabel dan judul -->
    <div class="space-y-4">

        <!-- Judul dan tombol tambah, print, export -->
        <div class="flex items-center">
            <h1 class="flex-1 text-2xl font-semibold text-black">Daftar Menu</h1>
            <div class="flex items-center">

                <button @click="modal = true, typeAksi = 'Tambah Data'" id="btnTambah" type="button" class="inline-flex items-center px-5 py-2 text-sm text-white bg-teal-500 border border-transparent rounded-lg font-base focus:outline-none hover:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none" onclick="kondisiModal('tambah')">
                    <svg class="w-auto h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 12H18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12 18V6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Tambah Data Menu
                </button>
            </div>
        </div>

        <!-- tabel user -->
        <div class="flex flex-col overflow-hidden ">
            <table id="myTable" class="min-w-full shadow-xl bg-white/30 backdrop-blur-xl rounded-t-3xl ">
                <thead class="bg-gray-100">
                    <tr class="">
                        <th scope="col" class="px-6 rounded-tl-3xl py-3 text-sm font-semibold !text-center text-gray-700 uppercase">No.</th>
                        <th scope="col" class="px-6 py-3 text-sm font-semibold !text-center text-gray-700 uppercase">Nama Menu</th>
                        <th scope="col" class="px-6 py-3 text-sm font-semibold !text-center text-gray-700 uppercase">HPP</th>
                        <th scope="col" class="px-6 py-3 text-sm font-semibold !text-center text-gray-700 uppercase">Harga<br>Jual</th>
                        <th scope="col" class="px-6 py-3 text-sm font-semibold !text-center text-gray-700 uppercase">Status</th>
                        <th scope="col" class="px-6 py-3 text-sm font-semibold !text-center text-gray-700 uppercase">Tanggal<br>Ditambahkan</th>
                        <th scope="col" class="rounded-tr-3xl px-6 py-3 text-sm font-semibold !text-center text-gray-700 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php
                    if (empty($result)) {
                        //;
                    } else {
                        $no = 1;
                        foreach ($result as $row) {
                    ?>
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap !text-center"><?php echo $no++; ?></td>
                                <td class="px-6 py-4 text-sm text-center text-gray-800 whitespace-nowrap"><?php echo isset($row['nama_menu']) ? $row['nama_menu'] : '-'; ?></td>
                                <td class="px-6 py-4 text-sm text-center text-gray-800 whitespace-nowrap">Rp. <?php echo isset($row['hpp']) ? number_format($row['hpp'], 0, ',', '.') : '-'; ?></td>
                                <td class="px-6 py-4 text-sm text-center text-gray-800 whitespace-nowrap">Rp. <?php echo isset($row['harga']) ? number_format($row['harga'], 0, ',', '.') : '-'; ?></td>
                                <td class="px-6 py-4 text-sm text-center text-gray-800 whitespace-nowrap"><?php echo isset($row['status_menu']) ? $row['status_menu'] : '-'; ?></td>
                                <td class="px-6 py-4 text-sm !text-center text-gray-800 whitespace-nowrap"><?php echo isset($row['created_at']) ? $row['created_at'] : '-'; ?></td>
                                <td class=" py-4 text-sm  whitespace-nowrap !text-center">
                                    <button type="button" class="inline-flex justify-center items-center w-16 py-[2px] text-sm font-medium text-teal-600 bg-teal-200/55 border mr-8 border-transparent rounded-full gap-x-2 hover:bg-teal-400/85 focus:outline-none disabled:opacity-50 disabled:pointer-events-none"
                                        data-id="<?php echo $row['id_menu']; ?>"
                                        data-kategori="<?php echo $row['id_kategori']; ?>"
                                        data-nama="<?php echo $row['nama_menu']; ?>"
                                        data-deskripsi="<?php echo $row['deskripsi']; ?>"
                                        data-hpp="<?php echo $row['hpp']; ?>"
                                        data-harga="<?php echo $row['harga']; ?>"
                                        data-status="<?php echo $row['status_menu']; ?>"
                                        data-gambar="<?php echo $row['gambar_menu']; ?>"
                                        @click="modal = true, selectedId = $el.dataset.id; selectKategori= $el.dataset.kategori; selectNama= $el.dataset.nama; selectdeskripsi= $el.dataset.deskripsi; selectHpp= $el.dataset.hpp; selectHarga= $el.dataset.harga; selectStatus= $el.dataset.status; selectImg= $el.dataset.gambar; typeAksi = 'Detail Data'"
                                        onclick="kondisiModal('detail')">
                                        Detail
                                    </button>
                                    <button type="button" class="inline-flex justify-center mr-8 items-center w-16 py-[2px] text-sm font-medium text-yellow-500 bg-yellow-200/55 border border-transparent rounded-full gap-x-2 hover:border-yel hover:bg-yellow-300/85 focus:outline-none disabled:opacity-50 disabled:pointer-events-none"
                                        data-id="<?php echo $row['id_menu']; ?>"
                                        data-kategori="<?php echo $row['id_kategori']; ?>"
                                        data-nama="<?php echo $row['nama_menu']; ?>"
                                        data-deskripsi="<?php echo $row['deskripsi']; ?>"
                                        data-hpp="<?php echo $row['hpp']; ?>"
                                        data-harga="<?php echo $row['harga']; ?>"
                                        data-status="<?php echo $row['status_menu']; ?>"
                                        data-gambar="<?php echo $row['gambar_menu']; ?>"
                                        @click="modal = true, selectedId = $el.dataset.id; selectKategori= $el.dataset.kategori; selectNama= $el.dataset.nama; selectdeskripsi= $el.dataset.deskripsi; selectHpp= $el.dataset.hpp; selectHarga= $el.dataset.harga; selectStatus= $el.dataset.status; selectImg= $el.dataset.gambar; typeAksi = 'Edit Data'"
                                        onclick="kondisiModal('edit')">
                                        Edit
                                    </button>
                                    <button type="button" class="inline-flex justify-center items-center w-16 py-[2px] text-sm font-medium text-red-500 bg-red-200/55 border border-transparent rounded-full gap-x-2 hover:bg-red-400/85 focus:outline-none disabled:opacity-50 disabled:pointer-events-none"
                                        data-id="<?php echo $row['id_menu']; ?>"
                                        data-kategori="<?php echo $row['id_kategori']; ?>"
                                        data-nama="<?php echo $row['nama_menu']; ?>"
                                        data-deskripsi="<?php echo $row['deskripsi']; ?>"
                                        data-hpp="<?php echo $row['hpp']; ?>"
                                        data-harga="<?php echo $row['harga']; ?>"
                                        data-status="<?php echo $row['status_menu']; ?>"
                                        data-gambar="<?php echo $row['gambar_menu']; ?>"
                                        @click="modal = true, selectedId = $el.dataset.id; selectKategori= $el.dataset.kategori; selectNama= $el.dataset.nama; selectdeskripsi= $el.dataset.deskripsi; selectHpp= $el.dataset.hpp; selectHarga= $el.dataset.harga; selectStatus= $el.dataset.status; selectImg= $el.dataset.gambar; typeAksi = 'Hapus Data'"
                                        onclick="kondisiModal('hapus')">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>

    </div>

    <!-- Backdrop modal -->
    <div x-show="modal" x-cloak class="fixed inset-0 z-[99998] bg-black/85 "
        x-transition.opacity>
    </div>

    <!-- Modal -->
    <div x-show="modal" x-cloak class="fixed inset-0 flex items-center justify-center z-[99999]"
        x-transition.scale>
        <div class="relative w-2/3 bg-white rounded-lg shadow-lg">
            <!-- Tombol Close (X) -->
            <button @click="modal= false; selectedId= null; selectKategori= null; selectNama= null; selectdeskripsi= null; selectHpp= null; selectHarga= null; selectStatus= null; selectImg= null; $refs.fileInput.value = ''; setPabrik();" class="absolute text-gray-500 top-2 right-2 hover:text-gray-800">
                <svg class="w-8 h-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2ZM15.36 14.3C15.65 14.59 15.65 15.07 15.36 15.36C15.21 15.51 15.02 15.58 14.83 15.58C14.64 15.58 14.45 15.51 14.3 15.36L12 13.06L9.7 15.36C9.55 15.51 9.36 15.58 9.17 15.58C8.98 15.58 8.79 15.51 8.64 15.36C8.35 15.07 8.35 14.59 8.64 14.3L10.94 12L8.64 9.7C8.35 9.41 8.35 8.93 8.64 8.64C8.93 8.35 9.41 8.35 9.7 8.64L12 10.94L14.3 8.64C14.59 8.35 15.07 8.35 15.36 8.64C15.65 8.93 15.65 9.41 15.36 9.7L13.06 12L15.36 14.3Z" fill="currentColor" />
                </svg>
            </button>
            <form id="frmmodal" action="#" method="post" enctype="multipart/form-data">
                <input type="hidden" :value="selectedId" name="id">
                <!-- header modal -->
                <div class="flex items-center px-4 py-3 border-b">
                    <h2 class="text-xl font-semibold" x-text='typeAksi'></h2>
                </div>

                <!-- Konten Modal -->
                <div id="pesanHps" class=" flex-col items-center justify-center hidden w-full gap-4 px-4 py-3">
                    <img :src="'../'+selectImg" alt="Logo makanan" class="w-48 h-48 rounded-xl">
                    <p class="">Data Menu <span class="font-semibold text-red-500" x-text="selectNama"></span> akan dihapus permanen. Anda yakin ingin melanjutkan?</p>
                </div>
                <div id="inputModal" class="flex justify-between px-6 py-3 border-b gap-7">
                    <div class="flex flex-col flex-1 w-3/5 gap-4">
                        <div class="max-w-sm w-36">
                            <label for="hs-select-label" class="block mb-2 text-sm font-medium">Kategori :</label>
                            <select name="kategori" id="hs-select-label" x-model="selectKategori" :disabled="typeAksi == 'Detail Data' ? true : false" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg cursor-pointer pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:text-black disabled:pointer-events-none" required>
                                <option value="" selected="">Silahkan pilih...</option>
                                <?php
                                $qkategori = mysqli_query($conn, "SELECT * FROM tb_kategori");
                                while ($row = mysqli_fetch_array($qkategori)) {
                                ?>
                                    <option value="<?php echo $row['id_kategori']; ?>"><?php echo $row['nama_kategori']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="flex justify-between w-full gap-7">
                            <div class="flex flex-col w-full gap-4">
                                <div class="w-full max-w-sm">
                                    <label for="input-label-nama" class="block mb-2 text-sm font-medium">Nama Menu :</label>
                                    <input name="nama" type="text" id="input-label-nama" x-model="selectNama" :readonly="typeAksi == 'Detail Data' ? true : false" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Nama menu..." required>
                                </div>
                                <div class="w-full">
                                    <label for="hpp" class="block mb-2 text-sm font-medium">Harga Pokok Penjualan :</label>
                                    <input name="hpp" type="text" x-model="selectHpp" :readonly="typeAksi == 'Detail Data' ? true : false" id="hpp" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Harga pokok..." minlength="10" maxlength="14" required>
                                </div>
                            </div>
                            <div class="w-full">
                                <div class="w-full">
                                    <label for="hs-autoheight-textarea" class="block mb-2 text-sm font-medium">Deskripsi Menu :</label>
                                    <textarea name="deskripsi" id="hs-autoheight-textarea" :readonly="typeAksi == 'Detail Data' ? true : false" x-model="selectdeskripsi" class="block w-full px-4 py-2 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" rows="6" placeholder="Deskripsi menu..." data-hs-textarea-auto-height='{"defaultHeight": 138}' required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between w-full gap-7">
                            <div class="w-full">
                                <label for="harga" class="block mb-2 text-sm font-medium">Harga Jual :</label>
                                <input name="harga" type="text" x-model="selectHarga" :readonly="typeAksi == 'Detail Data' ? true : false" id="harga" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Harga jual..." minlength="10" maxlength="14" required>
                            </div>
                            <div class="w-full">
                                <label for="status" class="block mb-2 text-sm font-medium">Status :</label>
                                <select name="status" id="status" x-model="selectStatus" :disabled="typeAksi == 'Detail Data' ? true : false" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:text-black disabled:pointer-events-none" required>
                                    <option value="" selected="">Silahkan pilih...</option>
                                    <option value="Tersedia">Tersedia</option>
                                    <option value="Bahan Kosong">Bahan Kosong</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="w-2/5">
                        <div class="">
                            <div class="flex flex-col flex-wrap items-center gap-3 px-3 sm:gap-5">
                                <div id="preview" :class="selectImg != null ? 'block' : 'hidden'" class="size-80" @click="$refs.fileInput.click()">
                                    <img id="previewIMG" :src="'../'+selectImg" class="object-cover w-full h-full rounded-md">
                                </div>
                                <div id="mockup" :class="selectImg === null ? 'block' : 'hidden'" class="flex flex-col justify-center group" @click="$refs.fileInput.click()">
                                    <span id="mockupId" class="group-has-[div]:hidden flex shrink-0 justify-center items-center size-80 border-2 border-dotted  text-gray-400 cursor-pointer rounded-xl hover:bg-gray-50">
                                        <svg class="shrink-0 size-24" height="24" width="24" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            viewBox="0 0 512 512" xml:space="preserve">
                                            <style type="text/css">
                                                .st0 {
                                                    fill: currentColor;
                                                }
                                            </style>
                                            <g>
                                                <path class="st0" d="M302.206,406.028h-214c-13.125,0-23.773,8.471-23.773,18.928v0.552c0,10.472,10.644,18.944,23.773,18.944h214 c13.128,0,23.778-8.471,23.778-18.944v-0.552C325.983,414.499,315.342,406.028,302.206,406.028z" />
                                                <path class="st0" d="M57.23,380.53c0.701,0.23,1.319,0.536,1.978,0.973c1.15,0.759,2.434,1.971,3.918,3.665 c1.108,1.25,2.319,2.752,3.73,4.362c2.12,2.408,4.718,5.144,8.372,7.368c1.82,1.104,3.906,2.047,6.183,2.691 c2.28,0.644,4.76,0.981,7.348,0.981c3.001,0.008,5.849-0.452,8.429-1.311c2.258-0.752,4.282-1.786,6.046-2.96 c3.089-2.062,5.378-4.454,7.283-6.601c1.422-1.625,2.641-3.128,3.768-4.4c1.678-1.924,3.089-3.251,4.362-4.01 c0.652-0.383,1.258-0.667,1.986-0.874c0.724-0.192,1.568-0.338,2.71-0.338c1.322,0,2.246,0.185,3.051,0.453 c0.698,0.23,1.319,0.536,1.982,0.973c1.15,0.759,2.434,1.971,3.909,3.665c1.112,1.25,2.323,2.752,3.738,4.362 c2.12,2.408,4.715,5.144,8.372,7.368c1.821,1.112,3.899,2.047,6.187,2.691c2.284,0.644,4.757,0.981,7.344,0.981 c3.002,0.008,5.857-0.452,8.426-1.311c2.262-0.752,4.286-1.786,6.049-2.96c3.093-2.062,5.374-4.454,7.276-6.601 c1.438-1.625,2.652-3.128,3.775-4.4c1.676-1.924,3.094-3.251,4.37-4.01c0.64-0.383,1.253-0.667,1.982-0.874 c0.721-0.192,1.572-0.338,2.706-0.338c1.323,0,2.25,0.185,3.048,0.453c0.702,0.23,1.323,0.536,1.985,0.973 c1.15,0.759,2.434,1.971,3.91,3.665c1.119,1.25,2.327,2.752,3.738,4.362c2.12,2.408,4.714,5.144,8.375,7.368 c1.821,1.112,3.894,2.047,6.183,2.691c2.289,0.644,4.757,0.981,7.345,0.981c3.005,0.008,5.853-0.452,8.433-1.311 c2.254-0.752,4.282-1.786,6.045-2.96c3.09-2.062,5.382-4.454,7.28-6.601c1.426-1.625,2.652-3.128,3.764-4.4 c1.678-1.924,3.097-3.251,4.382-4.01c0.632-0.383,1.253-0.667,1.973-0.874c0.721-0.192,1.572-0.338,2.711-0.338 c1.322,0,2.246,0.185,3.051,0.453c0.706,0.23,1.323,0.536,1.982,0.973c1.153,0.759,2.434,1.971,3.921,3.665 c1.112,1.25,2.319,2.759,3.738,4.362c2.108,2.408,4.714,5.144,8.368,7.368c1.82,1.112,3.902,2.047,6.19,2.691 c2.281,0.644,4.757,0.989,7.341,0.989c3.005,0,5.861-0.46,8.429-1.319c2.254-0.752,4.286-1.786,6.048-2.96 c3.094-2.062,5.382-4.454,7.284-6.601c1.418-1.625,2.645-3.128,3.764-4.4c1.678-1.924,3.097-3.251,4.374-4.01 c0.64-0.383,1.254-0.667,1.981-0.866c0.729-0.2,1.572-0.346,2.714-0.346c4.708,0,8.533-3.825,8.533-8.54 c0-4.714-3.825-8.54-8.533-8.54c-3.009,0-5.856,0.46-8.437,1.318c-2.258,0.744-4.289,1.787-6.045,2.952 c-3.089,2.062-5.378,4.446-7.283,6.608c-1.422,1.618-2.649,3.128-3.768,4.393c-1.672,1.924-3.097,3.25-4.37,4.017 c-0.652,0.383-1.258,0.66-1.978,0.866c-0.728,0.207-1.58,0.338-2.714,0.338c-1.319,0-2.25-0.177-3.055-0.437 c-0.697-0.23-1.314-0.552-1.982-0.988c-1.15-0.751-2.438-1.978-3.913-3.665c-1.112-1.25-2.327-2.744-3.73-4.37 c-2.123-2.392-4.715-5.137-8.376-7.352c-1.828-1.112-3.902-2.047-6.191-2.706c-2.288-0.637-4.757-0.974-7.344-0.974 c-3.006,0-5.853,0.452-8.434,1.318c-2.254,0.744-4.286,1.787-6.045,2.952c-3.089,2.062-5.378,4.446-7.279,6.608 c-1.434,1.618-2.653,3.128-3.772,4.393c-1.679,1.924-3.09,3.25-4.374,4.017c-0.644,0.383-1.254,0.66-1.974,0.866 c-0.721,0.207-1.572,0.338-2.71,0.338c-1.323,0-2.254-0.177-3.051-0.437c-0.701-0.23-1.322-0.552-1.986-0.988 c-1.146-0.751-2.43-1.978-3.91-3.665c-1.112-1.25-2.319-2.744-3.73-4.354c-2.124-2.408-4.714-5.152-8.375-7.368 c-1.829-1.112-3.898-2.047-6.191-2.706c-2.28-0.637-4.761-0.981-7.341-0.974c-3.001-0.008-5.857,0.452-8.433,1.318 c-2.254,0.744-4.286,1.779-6.049,2.952c-3.09,2.062-5.378,4.446-7.28,6.608c-1.426,1.618-2.641,3.128-3.764,4.393 c-1.675,1.924-3.098,3.25-4.374,4.017c-0.64,0.383-1.253,0.66-1.974,0.866c-0.736,0.199-1.579,0.338-2.71,0.338 c-1.322,0-2.254-0.177-3.059-0.437c-0.698-0.23-1.319-0.552-1.974-0.988c-1.157-0.751-2.434-1.978-3.921-3.665 c-1.112-1.258-2.315-2.752-3.734-4.354c-2.112-2.408-4.711-5.152-8.368-7.368c-1.82-1.112-3.91-2.047-6.187-2.706 c-2.281-0.637-4.753-0.981-7.34-0.974c-3.009-0.008-5.853,0.452-8.441,1.318c-2.254,0.744-4.27,1.779-6.034,2.952 c-3.093,2.062-5.382,4.446-7.283,6.608c-1.43,1.61-2.645,3.128-3.764,4.393c-1.679,1.924-3.105,3.25-4.37,4.017 c-0.652,0.383-1.265,0.66-1.986,0.866c-0.721,0.199-1.572,0.33-2.706,0.338c-1.323-0.008-2.25-0.177-3.055-0.437 c-0.697-0.23-1.314-0.552-1.982-0.988c-1.142-0.751-2.434-1.97-3.906-3.665c-1.115-1.258-2.323-2.752-3.733-4.362 c-2.12-2.4-4.719-5.136-8.372-7.368c-1.82-1.104-3.902-2.039-6.186-2.698c-2.286-0.637-4.758-0.981-7.349-0.974 c-4.715,0-8.537,3.826-8.537,8.54c0,4.715,3.822,8.54,8.537,8.54C55.501,380.076,56.428,380.261,57.23,380.53z" />
                                                <path class="st0" d="M391.466,125.069l15.156-69.74l54.884-31.87L447.89,0l-65.234,37.872l-18.956,87.197H193.117l1.038,13.562 l7.961,103.442c-2.997-0.146-6.018-0.222-9.058-0.222c-71.24,0-129.888,40.74-137.482,86.163c-0.272,1.641-0.483,2.07-0.64,2.53 c-0.134,0.444-0.211,0.89-0.211,2.56c0,9.729,5.421,14.858,14.823,14.858h247.019c9.388,0,14.819-5.129,14.819-14.858 c0-3.319-0.295-1.824-0.858-5.09c-3.791-22.754-20.416-44.335-45.002-60.22c-7.984-5.159-16.801-9.683-26.292-13.485 c-9.882-3.94-20.485-7.069-31.64-9.199l-7.283-94.864h218.849l-24.1,313.862h-86.469c-3.021-3.702-7.459-5.903-13.673-5.903 h-70.953h-25.265H71.251c-14.14,0-19.081,11.484-19.081,25.621v2.568C52.17,500.531,63.639,512,77.784,512h230.547 c13.156,0,24.019-9.92,25.456-22.708h104.604l27.971-364.223H391.466z M117.361,294.428c-3.757,0-6.816-3.059-6.816-6.83 c0-3.78,3.058-6.846,6.816-6.846c3.783,0,6.842,3.066,6.842,6.846C124.203,291.369,121.145,294.428,117.361,294.428z M144.7,273.928c-3.78,0-6.839-3.059-6.839-6.832c0-3.779,3.059-6.846,6.839-6.846c3.775,0,6.838,3.066,6.838,6.846 C151.538,270.869,148.475,273.928,144.7,273.928z M168.603,294.428c-3.776,0-6.838-3.059-6.838-6.83 c0-3.78,3.062-6.846,6.838-6.846c3.783,0,6.842,3.066,6.842,6.846C175.446,291.369,172.387,294.428,168.603,294.428z M189.103,265.388c-3.775,0-6.842-3.06-6.842-6.832c0-3.763,3.067-6.823,6.842-6.823c3.776,0,6.842,3.06,6.842,6.823 C195.945,262.328,192.879,265.388,189.103,265.388z M271.072,282.461c3.784,0,6.842,3.059,6.842,6.838 c0,3.772-3.059,6.839-6.842,6.839c-3.756,0-6.815-3.067-6.815-6.839C264.257,285.52,267.316,282.461,271.072,282.461z M236.915,260.174c3.783,0,6.842,3.059,6.842,6.823c0,3.795-3.058,6.854-6.842,6.854c-3.772,0-6.816-3.059-6.816-6.854 C230.099,263.234,233.143,260.174,236.915,260.174z M221.555,289.299c0,3.772-3.062,6.839-6.842,6.839 c-3.756,0-6.815-3.067-6.815-6.839c0-3.78,3.058-6.838,6.815-6.838C218.493,282.461,221.555,285.52,221.555,289.299z" />
                                            </g>
                                        </svg>
                                    </span>
                                    <p id="pesanError" class="inline-flex items-center justify-center invisible mt-2 text-sm text-red-500 "></p>
                                </div>

                                <div class="" :hidden="typeAksi === 'Detail Data' ? true : false">
                                    <div class="flex items-center gap-x-2">
                                        <button @click="$refs.fileInput.click()" type="button" class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-teal-500 border border-transparent rounded-lg gap-x-2 hover:bg-teal-500/55 hover:ring-2 hover:ring-teal-700 hover:text-teal-700 disabled:opacity-50 disabled:pointer-events-none">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                <polyline points="17 8 12 3 7 8"></polyline>
                                                <line x1="12" x2="12" y1="3" y2="15"></line>
                                            </svg>
                                            Pilih gambar menu...
                                        </button>
                                        <button type="button" class="inline-flex items-center px-3 py-2 text-xs font-semibold text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 hover:ring-2 hover:ring-gray-600 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" @click="selectImg= null;$refs.fileInput.value = '';">Delete</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <input name="file" id="file" :disabled="typeAksi === 'Detail Data' ? true : false" @change="handleFileChange" type="file" x-ref="fileInput" class="hidden" accept="image/*">
                    </div>
                </div>

                <!-- footer modal -->
                <div class="flex justify-end gap-3 px-4 py-3">
                    <button type="button" @click="modal= false;  selectedId= null; selectKategori= null; selectNama= null; selectdeskripsi= null; selectHpp= null; selectHarga= null; selectStatus= null; selectImg= null; $refs.fileInput.value = '';setPabrik();" class="px-4 py-2 text-white bg-gray-500 rounded-lg hover:bg-gray-700">
                        Batal
                    </button>
                    <button id="btnSubmit" name="btnSubmit" type="submit" :class="getClass()" class="inline-flex items-center px-3 py-2 font-medium text-white border border-transparent rounded-lg gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none" x-text="getLabel()"></button>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- javascript -->
<script src="../public/assets/js/jquery-3.7.1.min.js"></script>
<script src="../public/assets/js/datatables.min.js"></script>
<script>
    let table;
    $(document).ready(function() {
        table = $('#myTable').DataTable({
            dom: "<'flex justify-between items-center mb-4'<'text-gray-700'l><'text-gray-700'f>>" +
                "tr" +
                "<'flex justify-between items-center mt-4'<'text-gray-700'i><'text-gray-700'p>>",
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                paginate: {
                    first: "Awal",
                    last: "Akhir",
                    next: "→",
                    previous: "←"
                },

            },
            buttons: [{
                    extend: 'print',
                    className: 'button-print',
                    title: '[KingSeafood - Data User ]',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    },
                    // init: function(api, node, config) {
                    //     $(node).hide();
                    // }
                },
                {
                    extend: 'excel',
                    className: 'button-excel',
                    title: '[KingSeafood - Data User ]',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    },
                    // init: function(api, node, config) {
                    //     $(node).hide();
                    // }
                },
            ]
        });

        $('#btnExcel').on('click', function() {
            table.button('.button-excel').trigger();
        });
        $('#btnPrint').on('click', function() {
            table.button('.button-print').trigger();
        });

        $("input[type='search']").addClass("border rounded px-2 py-1 focus:ring-2 focus:ring-blue-500 w-64");
        $("select").addClass("border w-16 rounded px-2 py-1 focus:ring-2 focus:ring-blue-500");
    });

    // ===========================================================

    const pesanError = document.getElementById('pesanError');
    const mockup = document.getElementById('mockupId');
    const logo = document.getElementById('file');
    const pesanHps = document.getElementById('pesanHps');
    const inputModal = document.getElementById('inputModal');
    const form = document.getElementById("frmmodal");

    let modalType = '';

    function setPabrik() {
        mockup.classList.remove('border-red-500');
        pesanError.classList.add('invisible');
    }

    function kondisiModal(typeModal) {
        modalType = typeModal;

        if (modalType == "hapus") {
            inputModal.classList.add("hidden");
            pesanHps.classList.remove("hidden");
            pesanHps.classList.add("flex");

            form.action = "../proses/proses_menu_delete.php";

        } else {
            pesanHps.classList.add("hidden");
            pesanHps.classList.remove("flex");
            inputModal.classList.remove("hidden");

            if (modalType == "edit") {
                form.action = "../proses/proses_menu_edit.php";
            } else {
                form.action = "../proses/proses_menu_add.php";
            }
        }

    }

    function formatRupiah(angka) {
        return angka.replace(/\D/g, '')
            .replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    document.addEventListener("DOMContentLoaded", function() {
        let inputHarga = document.getElementById("harga");
        let inputHpp = document.getElementById("hpp");

        inputHarga.addEventListener("input", function(event) {
            let value = event.target.value;
            event.target.value = formatRupiah(value);
        });

        inputHpp.addEventListener("input", function(event) {
            let value = event.target.value;
            event.target.value = formatRupiah(value);
        });

        document.getElementById("frmmodal").addEventListener("submit", function(event) {
            let hargaBersih = inputHarga.value.replace(/\./g, '');
            inputHarga.value = hargaBersih;

            let hppBersih = inputHpp.value.replace(/\./g, '');
            inputHpp.value = hppBersih;
        });
    });

    document.getElementById('btnSubmit').addEventListener('click', function(event) {

        if (modalType == 'tambah') {
            if (logo.files.length === 0) {
                event.preventDefault();
                mockup.classList.add('border-red-500');
                pesanError.classList.remove('invisible');
                pesanError.textContent = 'Gambar menu belum dipilih...';
            }
        }
    });
</script>