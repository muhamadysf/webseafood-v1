<?php
include "./config/connect.php";

$query = mysqli_query($conn, "SELECT * FROM tb_kategori");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
date_default_timezone_set("Asia/Bangkok");
$timenow = date("j-F-Y-h:i:s A");

?>

<div x-data="{ modal: false, selectedId: null, selectNama: null, typeAksi: null, selectImg: null,
    getLabel() {
                return this.typeAksi === 'Tambah Data' ? 'Simpan Data' :
                        this.typeAksi === 'Edit Data' ? 'Simpan Perubahan' :
                        this.typeAksi === 'Hapus Data' ? 'Hapus' : 
                        null;
            },
    getClass() {
                return this.typeAksi === 'Tambah Data' ? 'bg-green-500' :
                    this.typeAksi === 'Edit Data' ? 'bg-green-500' :
                    this.typeAksi === 'Hapus Data' ? 'bg-red-500' :
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
            <h1 class="flex-1 text-2xl font-semibold text-black">Daftar Kategori</h1>
            <div class="flex items-center">
                <button @click="modal = true, typeAksi = 'Tambah Data'" id="btnTambah" type="button" class="inline-flex items-center px-5 py-2 text-sm text-white bg-teal-500 border border-transparent rounded-lg font-base focus:outline-none hover:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none" onclick="kondisiModal('tambah')">
                    <svg class="w-auto h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 12H18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12 18V6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Tambah Data Kategori
                </button>
            </div>
        </div>

        <!-- tabel kategori -->
        <div class="flex flex-col overflow-hidden ">
            <table id="myTable" class="min-w-full shadow-xl bg-white/30 backdrop-blur-xl rounded-t-3xl">
                <thead class="bg-gray-100">
                    <tr class="">
                        <th scope="col" class="px-6 rounded-tl-3xl py-3 text-sm font-semibold !text-center text-gray-700 uppercase">No.</th>
                        <th scope="col" class="px-6 py-3 text-sm font-semibold !text-center text-gray-700 uppercase">Nama Kategori</th>
                        <th scope="col" class="px-6 py-3 text-sm font-semibold !text-center text-gray-700 uppercase">Jumlah Produk</th>
                        <th scope="col" class="px-6 py-3 text-sm font-semibold !text-center text-gray-700 uppercase">Tanggal Ditambahkan</th>
                        <th scope="col" class="px-6 py-3 text-sm font-semibold !text-center text-gray-700 uppercase">Logo</th>
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
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap !text-center"><?php echo $no++; ?></td>
                                <td class="px-6 py-4 text-sm font-medium text-center text-gray-800 whitespace-nowrap"><?php echo isset($row['nama_kategori']) ? $row['nama_kategori'] : '-'; ?></td>
                                <td class="px-6 py-4 text-sm font-medium !text-center text-gray-800 whitespace-nowrap">
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
                                <td class="px-6 py-4 text-sm !text-center text-gray-800 whitespace-nowrap"><?php echo isset($row['created_at']) ? $row['created_at'] : '-'; ?> WIB</td>
                                <td class="px-6 py-4 text-sm !text-center text-gray-800 whitespace-nowrap"><img class="inline-flex justify-center object-cover w-20 h-20 rounded-full" src="../<?php echo $row['logo_kategori'] ?>"></td>
                                <td class="px-6 py-4 text-sm  whitespace-nowrap !text-center">
                                    <button type="button" class="inline-flex justify-center mr-8 items-center w-16 py-[2px] text-sm font-medium text-yellow-400 bg-yellow-200/55 border border-transparent rounded-full gap-x-2 hover:border-yel hover:bg-yellow-300/85 focus:outline-none disabled:opacity-50 disabled:pointer-events-none"
                                        data-id="<?php echo $row['id_kategori']; ?>"
                                        data-nama="<?php echo $row['nama_kategori']; ?>"
                                        data-logo="./<?php echo $row['logo_kategori']; ?>"
                                        @click="modal = true, selectedId = $el.dataset.id; selectNama = $el.dataset.nama; selectImg = $el.dataset.logo; typeAksi = 'Edit Data'"
                                        onclick="kondisiModal('edit')">
                                        Edit
                                    </button>
                                    <button type="button" class="inline-flex justify-center items-center w-16 py-[2px] text-sm font-medium text-red-500 bg-red-200/55 border border-transparent rounded-full gap-x-2 hover:bg-red-400/85 focus:outline-none disabled:opacity-50 disabled:pointer-events-none"
                                        data-id="<?php echo $row['id_kategori']; ?>"
                                        data-nama="<?php echo $row['nama_kategori']; ?>"
                                        data-logo="./<?php echo $row['logo_kategori']; ?>"
                                        @click="modal = true, selectedId = $el.dataset.id; selectNama = $el.dataset.nama; selectImg = $el.dataset.logo; typeAksi = 'Hapus Data'"
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
    <div x-show="modal" x-cloak class="fixed inset-0 z-[99998] bg-black/85 " x-transition.opacity>
    </div>

    <!-- Modal -->
    <div x-show="modal" x-cloak class="fixed inset-0 flex items-center justify-center z-[99999]" x-transition.scale>
        <div class="relative w-1/3 bg-white rounded-lg shadow-lg">
            <!-- Tombol Close (X) -->
            <button @click="modal= false; selectedId= null; selectNama= null;  selectImg= null; $refs.fileInput.value = ''; setPabrik();" class="absolute text-gray-500 top-2 right-2 hover:text-gray-800">
                <svg class="w-8 h-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2ZM15.36 14.3C15.65 14.59 15.65 15.07 15.36 15.36C15.21 15.51 15.02 15.58 14.83 15.58C14.64 15.58 14.45 15.51 14.3 15.36L12 13.06L9.7 15.36C9.55 15.51 9.36 15.58 9.17 15.58C8.98 15.58 8.79 15.51 8.64 15.36C8.35 15.07 8.35 14.59 8.64 14.3L10.94 12L8.64 9.7C8.35 9.41 8.35 8.93 8.64 8.64C8.93 8.35 9.41 8.35 9.7 8.64L12 10.94L14.3 8.64C14.59 8.35 15.07 8.35 15.36 8.64C15.65 8.93 15.65 9.41 15.36 9.7L13.06 12L15.36 14.3Z" fill="currentColor" />
                </svg>
            </button>
            <form id="frmmodal" action="#" method="post" enctype="multipart/form-data">
                <input type="hidden" :value="selectedId" name="iduser">
                <!-- header modal -->
                <div class="flex items-center px-4 py-3 border-b">
                    <h2 class="text-xl font-semibold" x-text='typeAksi'></h2>
                </div>

                <!-- Konten Modal -->
                <div id="pesanHps" class="hidden px-4 py-3">
                    <p class="">Data kategori <span class="font-semibold text-red-500" x-text="selectNama"></span> akan dihapus permanen. Anda yakin ingin melanjutkan?</p>
                </div>
                <div id="inputModal" class="flex flex-col items-center gap-4 px-4 py-3 border-b">
                    <div class="w-full max-w-sm">
                        <label for="nama-kategori" class="block mb-2 text-sm font-medium">Nama Kategori</label>
                        <input id="nama-kategori" name="namakategori" x-model="selectNama" type="text" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Ketik kategori baru..." required>
                    </div>
                    <div class="">
                        <div class="flex flex-wrap items-center gap-3 px-3 sm:gap-5">
                            <div id="preview" :class="selectImg != null ? 'block' : 'hidden'" class="size-20" @click="$refs.fileInput.click()">
                                <img id="previewIMG" :src="'../'+selectImg" class="object-cover w-full h-full rounded-full">
                            </div>
                            <div id="mockup" :class="selectImg === null ? 'block' : 'hidden'" class="group" @click="$refs.fileInput.click()">
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
                                    <button type="button" class="inline-flex items-center px-3 py-2 text-xs font-semibold text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 hover:ring-2 hover:ring-gray-600 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" @click="selectImg= null;$refs.fileInput.value = '';">Delete</button>
                                </div>
                            </div>
                        </div>
                        <p id="pesanError" class="invisible text-sm text-red-500 "></p>
                    </div>
                    <input name="file" id="file" @change="handleFileChange" type="file" x-ref="fileInput" class="hidden" accept="image/*">
                </div>

                <!-- footer modal -->
                <div class="flex justify-end gap-3 px-4 py-3">
                    <button type="button" @click="modal= false; selectedId= null; selectNama= null; selectImg= null;$refs.fileInput.value = ''; setPabrik();" class="px-4 py-2 text-white bg-gray-500 rounded-lg hover:bg-gray-700">
                        Batal
                    </button>
                    <button id="btnSubmit" name="btnsubmit" type="submit" :class="getClass()" class="inline-flex items-center px-3 py-2 font-medium text-white border border-transparent rounded-lg gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none" x-text="getLabel()"></button>
                </div>

            </form>
        </div>
    </div>
</div>
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
                    title: '[KingSeafood - Data Kategori ]',
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
                    title: '[KingSeafood - Data Kategori ]',
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

    let nama = document.getElementById('nama-kategori');
    let logo = document.getElementById('file');
    let pesanError = document.getElementById('pesanError');
    let mockup = document.getElementById('mockupId');

    const pesanHps = document.getElementById('pesanHps');
    const inputModal = document.getElementById('inputModal');
    const form = document.getElementById("frmmodal");

    let modalType = '';

    function setPabrik() {
        nama.classList.remove('border-red-500', 'border-2');
        nama.classList.remove('focus:border-red-500', 'focus:ring-red-500');
        mockup.classList.remove('border-red-500');
        mockup.classList.remove('text-red-500');
        nama.classList.add('focus:border-blue-500', 'focus:ring-blue-500');
        pesanError.classList.add('invisible');
        mockup.classList.add('text-gray-400');


    }

    function kondisiModal(typeModal) {
        modalType = typeModal;

        if (modalType == "hapus") {
            inputModal.classList.add("hidden");
            pesanHps.classList.remove("hidden");

            form.action = "../proses/proses_kategori_delete.php";

        } else {
            pesanHps.classList.add("hidden");
            inputModal.classList.remove("hidden");

            if (modalType == "edit") {
                form.action = "../proses/proses_kategori_edit.php";
            } else {
                form.action = "../proses/proses_kategori_add.php";
            }
        }

    }

    document.getElementById('btnSubmit').addEventListener("click", function(event) {

        if (modalType != 'hapus') {
            if (nama.value === '') {
                event.preventDefault();
                nama.classList.add('border-red-500', 'border-2');
                nama.classList.remove('focus:border-blue-500', 'focus:ring-blue-500');
                nama.classList.add('focus:border-red-500', 'focus:ring-red-500');
                nama.focus();
            }

            if (modalType != 'edit') {
                if (logo.files.length === 0) {
                    event.preventDefault();
                    pesanError.classList.remove('invisible');
                    mockup.classList.remove('text-gray-400');
                    mockup.classList.add('text-red-500');
                    mockup.classList.add('border-red-500');
                    pesanError.textContent = 'Logo belum dipilih...';
                } else {
                    pesanError.classList.add('invisible');
                    mockup.classList.add('text-gray-400');
                    mockup.classList.remove('text-red-500');
                    mockup.classList.remove('border-red-500');
                    nama.classList.remove('border-red-2');
                }
            }
        }
    });
</script>