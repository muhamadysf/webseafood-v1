<?php
include "proses/connect.php";

$query = mysqli_query($conn, "SELECT * FROM tb_kategori");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
date_default_timezone_set("Asia/Bangkok");
$timenow = date("j-F-Y-h:i:s A");

?>


<div x-data="{selectedId: null, selectNama: null}" class="">

    <!-- judul dan tombol tambah -->
    <div class="flex items-center justify-between mb-4 ">
        <div class="">
            <h1 class="text-3xl font-semibold text-gray-800">Daftar Kategori</h1>
        </div>
        <div class="">
            <button id="btnTambah" type="button" class="inline-flex items-center px-5 py-2 text-sm text-white bg-teal-400 border border-transparent rounded-lg font-base focus:outline-none hover:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none" aria-haspopup="dialog" aria-expanded="false" aria-controls="modalAll" data-hs-overlay="#modalAll" onclick="openModal(undefined, 'tambah')">
                <svg class="w-auto h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 12H18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M12 18V6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Tambah Kategori Baru
            </button>
        </div>
    </div>

    <!-- container tabel -->
    <div class="flex flex-col py-8 bg-white shadow-xl rounded-3xl">
        <div class="-m-1.5 h-full w-full overflow-auto scrollbar-hide">
            <div class="p-1.5 min-w-full overflow-auto scrollbar-hide w-full h-full inline-block align-middle">
                <div class="px-8">


                    <!-- ini table -->
                    <table id="myTable" class="divide-y divide-gray-200 min-w-auto">
                        <thead class="!text-center bg-primary-500 text-white py-4">
                            <tr class="!text-center">
                                <th scope="col" class="!text-center px-6 py-3 text-xs font-medium  uppercase ">No.</th>
                                <th scope="col" class="!text-center px-6 py-3 text-xs font-medium  uppercase">Nama Kategori</th>
                                <th scope="col" class="!text-center px-6 py-3 text-xs font-medium  uppercase">Jumlah Produk</th>
                                <th scope="col" class="!text-center px-6 py-3 text-xs font-medium  uppercase">Tanggal Dibuat</th>
                                <th scope="col" class="!text-center px-6 py-3 text-xs font-medium  uppercase">Logo</th>
                                <th scope="col" class="!text-center px-6 py-3 text-xs font-medium  uppercase ">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center bg-white divide-y divide-gray-200">
                            <?php
                            if (mysqli_num_rows($query) > 0) {

                                $no = 1;
                                foreach ($result as $row) {
                            ?>

                                    <tr class="text-center">
                                        <td class="!text-center px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap"><?php echo $no++; ?></td>
                                        <td class="!text-center px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap"><?php echo isset($row['nama_kategori']) ? $row['nama_kategori'] : '-'; ?></td>
                                        <td class="!text-center px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                            <?php
                                            $queryjumlah = mysqli_query($conn, "SELECT COUNT(id_menu) as jumlah FROM tb_menu WHERE id_kategori = " . $row['id_kategori']);
                                            $cekbaris = mysqli_num_rows($queryjumlah);
                                            $baris = mysqli_fetch_assoc($queryjumlah);
                                            $jumlah = $baris['jumlah'];

                                            if ($cekbaris > 0) {
                                                echo number_format($count);
                                            } else {
                                                echo 'Belum ada menu';
                                            }
                                            ?>
                                        </td>
                                        <td class="!text-center px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap"><?php echo isset($row['created_at']) ? $row['created_at'] : '-'; ?></td>
                                        <td class="!text-center px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap"><?php echo isset($row['logo_kategori']) ? $row['logo_kategori'] : '-'; ?></td>
                                        <td class="px-6 py-4 text-sm font-medium text-center whitespace-nowrap">
                                            <button type="button" class="inline-flex justify-center mr-8 items-center w-16 py-[2px] text-sm font-medium text-yellow-400 bg-yellow-200/55 border border-transparent rounded-full gap-x-2 hover:border-yel hover:bg-yellow-300/85 focus:outline-none disabled:opacity-50 disabled:pointer-events-none" aria-haspopup="dialog" aria-expanded="false" aria-controls="modalAll" data-hs-overlay="#modalAll"
                                                data-id="<?php echo $row['id_kategori']; ?>"
                                                data-nama="<?php echo $row['nama_kategori']; ?>"
                                                data-logo="<?php echo $row['logo_kategori']; ?>"
                                                onclick="openModal(this, 'edit')">
                                                Edit
                                            </button>
                                            <button type="button" class="inline-flex justify-center items-center w-16 py-[2px] text-sm font-medium text-red-500 bg-red-200/55 border border-transparent rounded-full gap-x-2 hover:bg-red-400/85 focus:outline-none disabled:opacity-50 disabled:pointer-events-none" aria-haspopup="dialog" aria-expanded="false" aria-controls="modalAll" data-hs-overlay="#modalAll"
                                                data-id="<?php echo $row['id_kategori']; ?>"
                                                data-nama="<?php echo $row['nama_kategori']; ?>"
                                                @click="selectedId = $el.dataset.id; selectNama = $el.dataset.nama"
                                                onclick="openModal(this, 'hapus')">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>

                            <?php }
                            } else {

                                // Tampilkan pesan jika tidak ada data

                            } ?>
                        </tbody>
                    </table>
                    <!-- batas akhir table -->

                </div>
            </div>
        </div>
    </div>

    <!-- Modal tambah, edit, dan hapus data -->
    <div id="modalAll" class="hs-overlay modalAll hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-scale-animation-modal-label">
        <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
            <div class="flex flex-col w-full bg-white border shadow-sm pointer-events-auto rounded-xl">
















                <form class="flex flex-col w-full bg-white border shadow-sm pointer-events-auto rounded-xl" action="<?php  ?>" method="post">
                    <input type="hidden" x-bind:value="selectedId" name="iduser">
                    <div class="flex items-center justify-between px-4 py-3 border-b">
                        <h3 id="hs-scale-animation-modal-label" class="text-2xl font-semibold text-gray-800"></h3>
                        <button type="button" class="inline-flex items-center justify-center text-gray-800 bg-gray-100 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none" aria-label="Close" data-hs-overlay="#modalAll">
                            <span class="sr-only">Close</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-4 overflow-y-auto ">
                        <p id="bodyModalText" class="mt-1 text-gray-800"></p>
                        <div id="bodyModalInput" class="flex flex-col items-center justify-center gap-y-8">
                            <div class="w-full max-w-sm">
                                <label for="nama-kategori" class="block mb-2 text-sm font-medium">Nama Kategori</label>
                                <input type="text" id="nama-kategori" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Ketik kategori baru...">
                            </div>

                            <div class="">

                                <!-- === bagian preview ======================== -->

                                <div data-hs-file-upload='{
                                        "url": "/upload",
                                        "acceptedFiles": "image/*",
                                        "maxFiles": 1,
                                        "singleton": true
                                        }'>
                                    <template data-hs-file-upload-preview="">
                                        <div class="size-20">
                                            <img class="object-contain w-full rounded-full" data-dz-thumbnail="">
                                        </div>
                                    </template>

                                    <div class="flex flex-wrap items-center gap-3 sm:gap-5">
                                        <div class="group" data-hs-file-upload-previews="" data-hs-file-upload-pseudo-trigger="">
                                            <span class="group-has-[div]:hidden flex shrink-0 justify-center items-center size-20 border-2 border-dotted border-gray-300 text-gray-400 cursor-pointer rounded-full hover:bg-gray-50">
                                                <svg class="shrink-0 size-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <circle cx="12" cy="10" r="3"></circle>
                                                    <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662"></path>
                                                </svg>
                                            </span>
                                        </div>

                                        <div class="grow">
                                            <div class="flex items-center gap-x-2">
                                                <button type="button" class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" data-hs-file-upload-trigger="">
                                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                        <polyline points="17 8 12 3 7 8"></polyline>
                                                        <line x1="12" x2="12" y1="3" y2="15"></line>
                                                    </svg>
                                                    Upload photo
                                                </button>
                                                <button type="button" class="inline-flex items-center px-3 py-2 text-xs font-semibold text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-file-upload-clear="">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- === bagian preview ======================== -->

                            </div>





                        </div>
                    </div>
                    <div class="flex items-center justify-center px-4 py-3 border-t gap-x-2">
                        <button id="btnBatal" @click="selectedId = null" type="button" class="px-3 py-2 text-sm font-medium bg-gray-500 border border-gray-200 rounded-lg shadow-sm text-gray-50 gap-x-2 hover:bg-gray-600 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#modalAll">
                            Batal
                        </button>
                        <button id="btnSubmit" name="btnsubmit" type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white border border-transparent rounded-lg gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none">
                            Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="./assets/js/jquery-3.7.1.min.js"></script>
    <script src="./assets/js/datatables.min.js"></script>
    <script>
        var table;
        $(document).ready(function() {
            table = $('#myTable').DataTable({
                dom: "<'flex justify-between items-center mb-2'lf>t<'flex justify-between items-center mt-2'ip>",
                "language": {
                    "emptyTable": "Tidak ada data yang tersedia untuk ditampilkan"
                },
            });
        });


        function openModal(button = 'default', modalType) {

            const inputs = document.querySelectorAll('.modalAll input');

            const header = document.getElementById("hs-scale-animation-modal-label");

            const body = document.getElementById("bodyModal");
            const btnsubmit = document.getElementById("btnSubmit");
            const btnbatal = document.getElementById("btnBatal");






            if (modalType === 'tambah') {

                header.innerText = "Tambah Kategori Baru";
                btnsubmit.innerText = "Simpan";
                btnsubmit.classList.remove("bg-red-600", "hover:bg-red-700");
                btnsubmit.classList.add("bg-green-500", "hover:bg-green-600");





            } else if (modalType === 'edit') {


                let id = button.getAttribute("data-id");
                let nama = button.getAttribute("data-nama");
                let logo = button.getAttribute("data-logo");

                document.getElementById('btnperubahan').classList.remove("hidden");

                inputs.forEach(input => {
                    input.removeAttribute('readonly');
                });
                textareas.forEach(textarea => {
                    textarea.removeAttribute('readonly');
                });

                selects.forEach(select => {
                    select.removeAttribute('disabled');
                });


                document.getElementById("hs-full-screen-label-edit").innerText = "Edit Data Karyawan";
                document.getElementById("btnBatal").innerText = "Batal";

            } else if (modalType === 'hapus') {
                btnsubmit.innerText = "Hapus";
                btnsubmit.classList.remove("bg-green-500", "hover:bg-green-600");
                btnsubmit.classList.add("bg-red-600", "hover:bg-red-700");


            }

        }
    </script>
</div>