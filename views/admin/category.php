<?php
include "./config/connect.php";

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
                                                echo number_format($jumlah);
                                            } else {
                                                echo 'Belum ada menu';
                                            }
                                            ?>
                                        </td>
                                        <td class="!text-center px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap"><?php echo isset($row['created_at']) ? $row['created_at'] : '-'; ?></td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap"><img class="inline-flex justify-center w-auto h-20" src="<?php echo $row['logo_kategori'] ?>"></td>
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
                                                onclick="openModal(this, 'hapus', './<?php echo $row['logo_kategori']; ?>')">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>

                            <?php }
                            } else {
                                // ====== Tampilkan pesan jika tidak ada data
                            } ?>
                        </tbody>
                    </table>
                    <!-- ======= batas akhir table =========================== -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal tambah, edit, dan hapus data -->
    <div id="modalAll" class="hs-overlay [--overlay-backdrop:static] modalAll hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-scale-animation-modal-label">
        <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
            <div class="flex flex-col w-full bg-white border shadow-sm pointer-events-auto rounded-xl">
                <form id="frmmodal" name="frmmodal" class="flex flex-col w-full bg-white border shadow-sm pointer-events-auto rounded-xl" method="post" enctype="multipart/form-data">
                    <input type="hidden" x-bind:value="selectedId" name="iduser">
                    <div class="flex items-center justify-between px-4 py-3 border-b">
                        <h3 id="hs-scale-animation-modal-label" class="text-2xl font-semibold text-gray-800"></h3>
                        <button @click="selectedId = null" type="button" class="inline-flex items-center justify-center text-gray-800 bg-gray-100 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none" aria-label="Close" data-hs-overlay="#modalAll" onclick="hapusPilihan()">
                            <span class="sr-only">Close</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="w-full p-4 overflow-y-auto">
                        <div id="bodyModalText" class="flex flex-col items-center justify-center w-full">
                            <p class="mt-1 text-gray-800">Data <span class="font-semibold underline" x-text='selectNama'></span> akan dihapus permanen dari sistem. <br> Lanjutkan Proses ?</p>
                            <img id="imgHps" class="object-cover w-24 h-auto mt-2 rounded-full" src="">
                        </div>
                        <div id="bodyModalInput" class="flex flex-col items-center justify-center gap-y-8">
                            <div class="w-full max-w-sm">
                                <label for="nama-kategori" class="block mb-2 text-sm font-medium">Nama Kategori</label>
                                <input name="namakategori" type="text" id="nama-kategori" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Ketik kategori baru...">
                            </div>
                            <div class="">
                                <div class="">
                                    <div class="flex flex-wrap items-center gap-3 sm:gap-5">
                                        <div id="preview" class=" size-20" @click="$refs.fileInput.click()">
                                            <img id="previewIMG" class="object-cover w-full h-full rounded-full">
                                        </div>
                                        <div id="mockup" class="group" @click="$refs.fileInput.click()">
                                            <span id="mockupId" class="group-has-[div]:hidden flex shrink-0 justify-center items-center size-20 border-2 border-dotted  text-gray-400 cursor-pointer rounded-full hover:bg-gray-50">

                                                <svg class="shrink-0 size-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <circle cx="12" cy="10" r="3"></circle>
                                                    <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="grow">
                                            <div class="flex items-center gap-x-2">
                                                <button @click="$refs.fileInput.click()" type="button" class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-teal-500 border border-transparent rounded-lg gap-x-2 hover:bg-teal-500/55 hover:ring-2 hover:ring-teal-700 hover:text-teal-700 disabled:opacity-50 disabled:pointer-events-none">
                                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                        <polyline points="17 8 12 3 7 8"></polyline>
                                                        <line x1="12" x2="12" y1="3" y2="15"></line>
                                                    </svg>
                                                    Pilih logo kategori...
                                                </button>
                                                <button type="button" class="inline-flex items-center px-3 py-2 text-xs font-semibold text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 hover:ring-2 hover:ring-gray-600 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" onclick="hapusPilihan()">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                    <p id="pesanError" class="invisible mt-3 text-sm text-red-500 ">Logo belum dipilih...</p>
                                    <input type="file" x-ref="fileInput" class="hidden" name="file" id="file" accept="image/*">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center px-4 py-3 border-t gap-x-2">
                        <button id="btnBatal" @click="selectedId = null" type="button" class="px-3 py-2 text-sm font-medium bg-gray-500 border border-gray-200 rounded-lg shadow-sm text-gray-50 gap-x-2 hover:bg-gray-600 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#modalAll" onclick="hapusPilihan()">
                            Batal
                        </button>
                        <button id="btnSubmit" name="btnsubmit" type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white border border-transparent rounded-lg gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none">

                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="./public/assets/js/jquery-3.7.1.min.js"></script>
    <script src="./public/assets/js/datatables.min.js"></script>
    <script>
        let table;
        let typeModal = "";

        $(document).ready(function() {
            table = $('#myTable').DataTable({
                dom: "<'flex justify-between items-center mb-2'lf>t<'flex justify-between items-center mt-2'ip>",
                "language": {
                    "emptyTable": "Tidak ada data yang tersedia untuk ditampilkan"
                },
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const fileInput = document.getElementById("file");
            const previewDiv = document.getElementById("preview");
            const previewIMG = document.getElementById("previewIMG");
            const mockupDiv = document.getElementById("mockup");

            // Sembunyikan preview saat pertama kali
            previewDiv.style.display = "none";


            let lastImageSrc = "";

            fileInput.addEventListener("change", function(event) {
                const pesanError = document.getElementById("pesanError");
                const file = event.target.files[0];

                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        lastImageSrc = e.target.result;
                        previewIMG.src = lastImageSrc;
                        previewDiv.style.display = "block"; // Tampilkan preview
                        mockupDiv.style.display = "none"; // Sembunyikan mockup
                        pesanError.classList.add("invisible");
                    };

                    reader.readAsDataURL(file);
                } else {
                    if (lastImageSrc) {
                        // Jika ada gambar sebelumnya, tampilkan kembali
                        previewIMG.src = lastImageSrc;
                        previewDiv.style.display = "block";
                        mockupDiv.style.display = "none";
                    } else {
                        // Jika tidak ada gambar sebelumnya, kembali ke kondisi awal
                        previewDiv.style.display = "none";
                        mockupDiv.style.display = "flex";
                    }
                }

                if (!fileInput.files.length) {
                    previewDiv.style.display = "none";
                    mockupDiv.style.display = "flex";
                }
            });



        });

        function hapusPilihan() {
            const fileInput = document.getElementById("file");
            const inputNama = document.getElementById("nama-kategori");
            const previewDiv = document.getElementById("preview");
            const mockupDiv = document.getElementById("mockup");
            const mockupId = document.getElementById("mockupId");
            fileInput.value = "";
            previewDiv.style.display = "none";
            mockupDiv.style.display = "flex";
            mockupId.classList.add("border-gray-300");
            mockupId.classList.remove("border-red-500");
            pesanError.classList.add("invisible");
            inputNama.classList.remove("border-2", "border-red-500", "focus:border-red-500", "focus:ring-red-500");
        }


        function setPreview() {
            document.getElementById("file").addEventListener("change", function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgElement = document.getElementById("previewIMG");
                        imgElement.src = e.target.result;
                        imgElement.classList.remove("hidden");
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        function openModal(button = 'default', modalType, imgUrl = '') {
            typeModal = modalType;

            const header = document.getElementById("hs-scale-animation-modal-label");
            const body = document.getElementById("bodyModalText");
            const bodyInput = document.getElementById("bodyModalInput");
            const btnsubmit = document.getElementById("btnSubmit");
            const inputFile = document.getElementById("file");

            const form = document.getElementById("frmmodal");

            body.classList.add("hidden");
            bodyInput.classList.remove("hidden");
            console.log(modalType);
            if (modalType === 'tambah') {

                header.innerText = "Tambah Kategori Baru";
                btnsubmit.innerText = "Simpan";
                btnsubmit.classList.remove("bg-red-600", "hover:bg-red-700");
                btnsubmit.classList.add("bg-green-500", "hover:bg-green-600");

                form.action = "./proses/proses_kategori_add.php";

                setPreview();



            } else if (modalType === 'edit') {

                header.innerText = "Edit Data Kategori";
                btnsubmit.innerText = "Simpan Perubahan";
                btnsubmit.classList.remove("bg-red-600", "hover:bg-red-700");
                btnsubmit.classList.add("bg-green-500", "hover:bg-green-600");

                form.action = "./proses/proses_kategori_edit.php";

                setPreview();



            } else if (modalType === 'hapus') {
                header.innerText = "Hapus Data Kategori";

                btnsubmit.innerText = "Hapus";
                btnsubmit.classList.remove("bg-green-500", "hover:bg-green-600");
                body.classList.remove("hidden");
                bodyInput.classList.add("hidden");
                btnsubmit.classList.add("bg-red-600", "hover:bg-red-700");

                const imgHps = document.getElementById("imgHps");

                imgHps.src = imgUrl;

                form.action = "./proses/proses_kategori_delete.php";


            }

        }

        document.getElementById("btnSubmit").addEventListener("click", function(event) {
            const fileInput = document.getElementById("file");
            const mockupDiv = document.getElementById("mockupId");
            const pesanError = document.getElementById("pesanError");
            const inputNama = document.getElementById("nama-kategori");

            inputNama.value = inputNama.value.trim();
            console.log(typeModal);
            if (typeModal === 'tambah') {
                if (inputNama.value === "") {
                    inputNama.classList.remove("border-blue-500", "focus:border-blue-500", "focus:ring-blue-500");
                    inputNama.classList.add("border-2", "border-red-500", "focus:border-red-500", "focus:ring-red-500")

                } else if (!fileInput.files.length) {
                    event.preventDefault();
                    mockupDiv.classList.add("border-red-500");
                    pesanError.classList.remove("invisible");


                } else {
                    inputNama.classList.remove("border-2", "border-red-500", "focus:border-red-500", "focus:ring-red-500");
                    mockupDiv.classList.remove("border-red-500");
                    pesanError.classList.add("invisible");
                }


            }

        });
    </script>
</div>