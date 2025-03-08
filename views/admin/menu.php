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
                <!-- <button id="btnPrint" type="button" class="inline-flex items-center justify-center w-24 gap-2 px-3 py-2 mr-2 text-sm border-2 rounded-lg button-print text-slate-600 hover:text-white border-slate-400 font-base focus:outline-none hover:bg-slate-600 disabled:opacity-50 disabled:pointer-events-none">
                    <svg class="w-auto h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 16.75H16C15.8011 16.75 15.6103 16.671 15.4697 16.5303C15.329 16.3897 15.25 16.1989 15.25 16C15.25 15.8011 15.329 15.6103 15.4697 15.4697C15.6103 15.329 15.8011 15.25 16 15.25H18C18.3315 15.25 18.6495 15.1183 18.8839 14.8839C19.1183 14.6495 19.25 14.3315 19.25 14V10C19.25 9.66848 19.1183 9.35054 18.8839 9.11612C18.6495 8.8817 18.3315 8.75 18 8.75H6C5.66848 8.75 5.35054 8.8817 5.11612 9.11612C4.8817 9.35054 4.75 9.66848 4.75 10V14C4.75 14.3315 4.8817 14.6495 5.11612 14.8839C5.35054 15.1183 5.66848 15.25 6 15.25H8C8.19891 15.25 8.38968 15.329 8.53033 15.4697C8.67098 15.6103 8.75 15.8011 8.75 16C8.75 16.1989 8.67098 16.3897 8.53033 16.5303C8.38968 16.671 8.19891 16.75 8 16.75H6C5.27065 16.75 4.57118 16.4603 4.05546 15.9445C3.53973 15.4288 3.25 14.7293 3.25 14V10C3.25 9.27065 3.53973 8.57118 4.05546 8.05546C4.57118 7.53973 5.27065 7.25 6 7.25H18C18.7293 7.25 19.4288 7.53973 19.9445 8.05546C20.4603 8.57118 20.75 9.27065 20.75 10V14C20.75 14.7293 20.4603 15.4288 19.9445 15.9445C19.4288 16.4603 18.7293 16.75 18 16.75Z" fill="currentColor" />
                        <path d="M16 8.75C15.8019 8.74741 15.6126 8.66756 15.4725 8.52747C15.3324 8.38737 15.2526 8.19811 15.25 8V4.75H8.75V8C8.75 8.19891 8.67098 8.38968 8.53033 8.53033C8.38968 8.67098 8.19891 8.75 8 8.75C7.80109 8.75 7.61032 8.67098 7.46967 8.53033C7.32902 8.38968 7.25 8.19891 7.25 8V4.5C7.25 4.16848 7.3817 3.85054 7.61612 3.61612C7.85054 3.3817 8.16848 3.25 8.5 3.25H15.5C15.8315 3.25 16.1495 3.3817 16.3839 3.61612C16.6183 3.85054 16.75 4.16848 16.75 4.5V8C16.7474 8.19811 16.6676 8.38737 16.5275 8.52747C16.3874 8.66756 16.1981 8.74741 16 8.75Z" fill="currentColor" />
                        <path d="M15.5 20.75H8.5C8.16848 20.75 7.85054 20.6183 7.61612 20.3839C7.3817 20.1495 7.25 19.8315 7.25 19.5V12.5C7.25 12.1685 7.3817 11.8505 7.61612 11.6161C7.85054 11.3817 8.16848 11.25 8.5 11.25H15.5C15.8315 11.25 16.1495 11.3817 16.3839 11.6161C16.6183 11.8505 16.75 12.1685 16.75 12.5V19.5C16.75 19.8315 16.6183 20.1495 16.3839 20.3839C16.1495 20.6183 15.8315 20.75 15.5 20.75ZM8.75 19.25H15.25V12.75H8.75V19.25Z" fill="currentColor" />
                    </svg>
                    Print
                </button>
                <button id="btnExcel" type="button" class="inline-flex items-center justify-center w-24 gap-2 px-3 py-2 mr-8 text-sm text-green-700 border-2 border-green-600 rounded-lg button-excel hover:text-white font-base focus:outline-none hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                    <svg class="shrink-0 size-3.5" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.0324 1.91994H9.45071C9.09999 1.91994 8.76367 2.05926 8.51567 2.30725C8.26767 2.55523 8.12839 2.89158 8.12839 3.24228V8.86395L20.0324 15.8079L25.9844 18.3197L31.9364 15.8079V8.86395L20.0324 1.91994Z" fill="#21A366"></path>
                        <path d="M8.12839 8.86395H20.0324V15.8079H8.12839V8.86395Z" fill="#107C41"></path>
                        <path d="M30.614 1.91994H20.0324V8.86395H31.9364V3.24228C31.9364 2.89158 31.7971 2.55523 31.5491 2.30725C31.3011 2.05926 30.9647 1.91994 30.614 1.91994Z" fill="#33C481"></path>
                        <path d="M20.0324 15.8079H8.12839V28.3736C8.12839 28.7243 8.26767 29.0607 8.51567 29.3087C8.76367 29.5567 9.09999 29.6959 9.45071 29.6959H30.6141C30.9647 29.6959 31.3011 29.5567 31.549 29.3087C31.797 29.0607 31.9364 28.7243 31.9364 28.3736V22.7519L20.0324 15.8079Z" fill="#185C37"></path>
                        <path d="M20.0324 15.8079H31.9364V22.7519H20.0324V15.8079Z" fill="#107C41"></path>
                        <path opacity="0.1" d="M16.7261 6.87994H8.12839V25.7279H16.7261C17.0764 25.7269 17.4121 25.5872 17.6599 25.3395C17.9077 25.0917 18.0473 24.756 18.0484 24.4056V8.20226C18.0473 7.8519 17.9077 7.51616 17.6599 7.2684C17.4121 7.02064 17.0764 6.88099 16.7261 6.87994Z" class="fill-black dark:fill-neutral-200" fill="currentColor"></path>
                        <path opacity="0.2" d="M15.7341 7.87194H8.12839V26.7199H15.7341C16.0844 26.7189 16.4201 26.5792 16.6679 26.3315C16.9157 26.0837 17.0553 25.748 17.0564 25.3976V9.19426C17.0553 8.84386 16.9157 8.50818 16.6679 8.26042C16.4201 8.01266 16.0844 7.87299 15.7341 7.87194Z" class="fill-black dark:fill-neutral-200" fill="currentColor"></path>
                        <path opacity="0.2" d="M15.7341 7.87194H8.12839V24.7359H15.7341C16.0844 24.7349 16.4201 24.5952 16.6679 24.3475C16.9157 24.0997 17.0553 23.764 17.0564 23.4136V9.19426C17.0553 8.84386 16.9157 8.50818 16.6679 8.26042C16.4201 8.01266 16.0844 7.87299 15.7341 7.87194Z" class="fill-black dark:fill-neutral-200" fill="currentColor"></path>
                        <path opacity="0.2" d="M14.7421 7.87194H8.12839V24.7359H14.7421C15.0924 24.7349 15.4281 24.5952 15.6759 24.3475C15.9237 24.0997 16.0633 23.764 16.0644 23.4136V9.19426C16.0633 8.84386 15.9237 8.50818 15.6759 8.26042C15.4281 8.01266 15.0924 7.87299 14.7421 7.87194Z" class="fill-black dark:fill-neutral-200" fill="currentColor"></path>
                        <path d="M1.51472 7.87194H14.7421C15.0927 7.87194 15.4291 8.01122 15.6771 8.25922C15.925 8.50722 16.0644 8.84354 16.0644 9.19426V22.4216C16.0644 22.7723 15.925 23.1087 15.6771 23.3567C15.4291 23.6047 15.0927 23.7439 14.7421 23.7439H1.51472C1.16402 23.7439 0.827672 23.6047 0.579686 23.3567C0.3317 23.1087 0.192383 22.7723 0.192383 22.4216V9.19426C0.192383 8.84354 0.3317 8.50722 0.579686 8.25922C0.827672 8.01122 1.16402 7.87194 1.51472 7.87194Z" fill="#107C41"></path>
                        <path d="M3.69711 20.7679L6.90722 15.794L3.96694 10.8479H6.33286L7.93791 14.0095C8.08536 14.3091 8.18688 14.5326 8.24248 14.68H8.26328C8.36912 14.4407 8.47984 14.2079 8.5956 13.9817L10.3108 10.8479H12.4822L9.46656 15.7663L12.5586 20.7679H10.2473L8.3932 17.2959C8.30592 17.148 8.23184 16.9927 8.172 16.8317H8.14424C8.09016 16.9891 8.01824 17.1399 7.92998 17.2811L6.02236 20.7679H3.69711Z" fill="white"></path>
                    </svg>
                    Ekspor
                </button> -->
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
                <div id="pesanHps" class="hidden px-4 py-3 flex flex-col items-center justify-center gap-4 w-full">
                    <img :src="selectImg" alt="Logo makanan" class="rounded-xl h-48 w-48">
                    <p class="">Data Menu <span class="font-semibold text-red-500" x-text="selectNama"></span> akan dihapus permanen. Anda yakin ingin melanjutkan?</p>
                </div>
                <div id="inputModal" class="flex px-6 py-3 border-b justify-between gap-7">
                    <div class="flex flex-col flex-1 gap-4 w-3/5">
                        <div class="w-36 max-w-sm">
                            <label for="hs-select-label" class="block mb-2 text-sm font-medium">Kategori :</label>
                            <select name="kategori" id="hs-select-label" x-model="selectKategori" :disabled="typeAksi == 'Detail Data' ? true : false" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg pe-9 focus:border-blue-500 focus:ring-blue-500 cursor-pointer disabled:text-black disabled:pointer-events-none" required>
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
                        <div class="flex w-full justify-between gap-7">
                            <div class="flex flex-col gap-4 w-full">
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
                        <div class="flex gap-7 w-full justify-between">
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
                                    <img id="previewIMG" :src="selectImg" class="object-cover w-full h-full rounded-md">
                                </div>
                                <div id="mockup" :class="selectImg === null ? 'block' : 'hidden'" class="group flex flex-col justify-center" @click="$refs.fileInput.click()">
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
                                    <p id="pesanError" class="inline-flex mt-2 justify-center items-center invisible text-sm text-red-500 "></p>
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
<script src="./public/assets/js/jquery-3.7.1.min.js"></script>
<script src="./public/assets/js/datatables.min.js"></script>
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

            form.action = "./proses/proses_menu_delete.php";

        } else {
            pesanHps.classList.add("hidden");
            inputModal.classList.remove("hidden");

            if (modalType == "edit") {
                form.action = "./proses/proses_menu_edit.php";
            } else {
                form.action = "./proses/proses_menu_add.php";
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