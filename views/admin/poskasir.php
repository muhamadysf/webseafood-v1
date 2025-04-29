<?php
include "./config/connect.php";

$petugas = $_SESSION['id'];
$query = mysqli_query($conn, "SELECT tpsn.id_pesanan, tpsn.kode_pesanan, tpsn.id_pembeli, tpsn.total_harga, tpsn.status_pesanan, tpsn.tanggal_pesanan, tb.nama_pembeli FROM tb_pesanan tpsn JOIN tb_pembeli tb ON tpsn.id_pembeli = tb.id_pembeli ORDER BY tpsn.tanggal_pesanan DESC");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}


?>

<!-- ================================================================================================================= -->

<div class="w-full" x-data="{ modal: false, modalInput: false, modalBayar: false, modalEdit: true, modalHapus: false, selectNama: null, selectedId: null}">
    <div class="flex items-end w-full mb-7">
        <div class="flex items-center justify-center w-full gap-3 px-5 py-2 bg-primary-300 rounded-xl">
            <h3 class="text-xl text-white">Proses pesanan :</h3>
            <button class="p-2 text-black rounded-lg bg-slate-200 hover:bg-slate-400" type="button" @click="modal = true">
                <svg fill="#000000" class="size-7" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4,4h6v6H4V4M20,4v6H14V4h6M14,15h2V13H14V11h2v2h2V11h2v2H18v2h2v3H18v2H16V18H13v2H11V16h3V15m2,0v3h2V15H16M4,20V14h6v6H4M6,6V8H8V6H6M16,6V8h2V6H16M6,16v2H8V16H6M4,11H6v2H4V11m5,0h4v4H11V13H9V11m2-5h2v4H11V6M2,2V6H0V2A2,2,0,0,1,2,0H6V2H2M22,0a2,2,0,0,1,2,2V6H22V2H18V0h4M2,18v4H6v2H2a2,2,0,0,1-2-2V18H2m20,4V18h2v4a2,2,0,0,1-2,2H18V22Z" />
                </svg>
            </button>
        </div>
    </div>

    <!-- ========================================= -->

    <!-- tabel daftar pesanan -->
    <div class="flex flex-col overflow-hidden ">
        <table id="myTable" class="min-w-full shadow-xl bg-white/30 backdrop-blur-xl rounded-t-3xl ">
            <thead class="bg-gray-100">
                <tr class="">
                    <th scope="col" class="px-6 rounded-tl-3xl py-3 text-sm font-semibold !text-center text-gray-700 uppercase">No.</th>
                    <th scope="col" class="px-6 py-3 text-sm font-semibold !text-center text-gray-700 uppercase">Kode<br>Pesanan</th>
                    <th scope="col" class="px-6 py-3 text-sm font-semibold !text-center text-gray-700 uppercase">Atas Nama</th>
                    <th scope="col" class="px-6 py-3 text-sm font-semibold !text-center text-gray-700 uppercase">Total<br>Harga</th>
                    <th scope="col" class="px-6 py-3 text-sm font-semibold !text-center text-gray-700 uppercase">Status</th>
                    <th scope="col" class="px-6 py-3 text-sm font-semibold !text-center text-gray-700 uppercase">Tanggal<br>Pemesanan</th>
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
                            <td class="px-6 py-4 text-sm text-center text-gray-800 whitespace-nowrap"><?php echo isset($row['kode_pesanan']) ? $row['kode_pesanan'] : '-'; ?></td>
                            <td class="px-6 py-4 text-sm text-center text-gray-800 whitespace-nowrap"><?php echo isset($row['nama_pembeli']) ? $row['nama_pembeli'] : '-'; ?></td>
                            <td class="px-6 py-4 text-sm text-center text-gray-800 whitespace-nowrap">Rp. <?php echo isset($row['total_harga']) ? number_format($row['total_harga'], 0, ',', '.') : '-'; ?></td>
                            <td class="px-6 py-4 text-sm text-center text-gray-800 whitespace-nowrap"><?php echo isset($row['status_pesanan']) ? $row['status_pesanan'] : '-'; ?></td>
                            <td class="px-6 py-4 text-sm !text-center text-gray-800 whitespace-nowrap"><?php echo isset($row['tanggal_pesanan']) ? date('d-m-Y H:i:s', strtotime($row['tanggal_pesanan'])) : '-'; ?></td>
                            <td class=" py-4 text-sm  whitespace-nowrap !text-center">
                                <button type="button" class="inline-flex justify-center items-center w-16 py-[2px] text-sm font-medium text-red-500 bg-red-200/55 border border-transparent rounded-full gap-x-2 hover:bg-red-400/85 focus:outline-none disabled:opacity-50 disabled:pointer-events-none"
                                    data-id="<?php echo $row['id_pesanan']; ?>"
                                    data-nama="<?php echo $row['nama_pembeli']; ?>"
                                    @click="modalHapus = true, selectedId = $el.dataset.id; selectNama= $el.dataset.nama;">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>

    <!-- ========================================= -->

    <!-- Backdrop modal -->
    <div x-show="modal || modalHapus || modalEdit" x-cloak class="fixed inset-0 z-[99998] bg-black/85 sm:inline-flex sm:mx-auto"
        x-transition.opacity>
    </div>

    <!-- ========================================= -->

    <!-- Modal untuk scanner barcode -->
    <div x-show="modal" x-cloak class="fixed inset-0 flex items-center justify-center z-[99999]"
        x-transition.scale>
        <div class="relative w-1/3">
            <!-- Tombol Close (X) -->
            <button @click="modal= false" class="absolute text-gray-500 top-2 right-4 hover:text-gray-800">
                <svg class="w-8 h-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2ZM15.36 14.3C15.65 14.59 15.65 15.07 15.36 15.36C15.21 15.51 15.02 15.58 14.83 15.58C14.64 15.58 14.45 15.51 14.3 15.36L12 13.06L9.7 15.36C9.55 15.51 9.36 15.58 9.17 15.58C8.98 15.58 8.79 15.51 8.64 15.36C8.35 15.07 8.35 14.59 8.64 14.3L10.94 12L8.64 9.7C8.35 9.41 8.35 8.93 8.64 8.64C8.93 8.35 9.41 8.35 9.7 8.64L12 10.94L14.3 8.64C14.59 8.35 15.07 8.35 15.36 8.64C15.65 8.93 15.65 9.41 15.36 9.7L13.06 12L15.36 14.3Z" fill="currentColor" />
                </svg>
            </button>
            <div class="w-full max-w-md p-6 space-y-4 bg-white shadow-2xl rounded-2xl">
                <h2 class="text-2xl font-bold text-center text-gray-800">Scan QR Code</h2>

                <video id="preview" class="w-full border border-gray-300 rounded-lg"></video>

                <div id="result" class="p-4 mt-4 text-sm text-gray-700 border border-gray-300 border-dashed rounded-lg bg-gray-50">
                    Hasil scan akan muncul di sini...
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" @click="modal= false;" class="px-4 py-2 text-white bg-gray-500 rounded-lg hover:bg-gray-700">
                        Batal
                    </button>
                    <!-- Tombol Scan Ulang -->
                    <button type="button" id="btnScanUlang" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-700">
                        Scan Ulang
                    </button>
                    <button id="btnSubmit" name="btnsubmit" type="submit" :class="getClass()" class="inline-flex items-center px-3 py-2 font-medium text-white border border-transparent rounded-lg gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none" x-text="getLabel()"></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk input data pesanan -->
    <div x-show="modalInput" x-cloak class="fixed inset-0 flex items-center justify-center z-[99999]"
        x-transition.scale>
        <div class="relative w-1/3">
            <!-- Tombol Close (X) -->
            <button @click="modalInput= false" class="absolute text-gray-500 top-2 right-4 hover:text-gray-800">
                <svg class="w-8 h-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2ZM15.36 14.3C15.65 14.59 15.65 15.07 15.36 15.36C15.21 15.51 15.02 15.58 14.83 15.58C14.64 15.58 14.45 15.51 14.3 15.36L12 13.06L9.7 15.36C9.55 15.51 9.36 15.58 9.17 15.58C8.98 15.58 8.79 15.51 8.64 15.36C8.35 15.07 8.35 14.59 8.64 14.3L10.94 12L8.64 9.7C8.35 9.41 8.35 8.93 8.64 8.64C8.93 8.35 9.41 8.35 9.7 8.64L12 10.94L14.3 8.64C14.59 8.35 15.07 8.35 15.36 8.64C15.65 8.93 15.65 9.41 15.36 9.7L13.06 12L15.36 14.3Z" fill="currentColor" />
                </svg>
            </button>
            <div class="w-full max-w-md p-6 space-y-4 bg-white shadow-2xl rounded-2xl">
                <h2 class="text-2xl font-bold text-center text-gray-800">Scan QR Code</h2>

                <!-- <video id="preview" class="w-full border border-gray-300 rounded-lg"></video>

                <div id="result" class="p-4 mt-4 text-sm text-gray-700 border border-gray-300 border-dashed rounded-lg bg-gray-50">
                    Hasil scan akan muncul di sini...
                </div> -->
                <div class="flex justify-end gap-3 px-4 py-3">
                    <button type="button" @click="modalInput= false;" class="px-4 py-2 text-white bg-gray-500 rounded-lg hover:bg-gray-700">
                        Batal
                    </button>
                    <button id="btnSubmit" name="btnsubmit" type="submit" :class="getClass()" class="inline-flex items-center px-3 py-2 font-medium text-white border border-transparent rounded-lg gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none" x-text="getLabel()"></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal bayar pesanan -->
    <div x-show="modalBayar" x-cloak class="fixed inset-0 flex items-center justify-center z-[99999]"
        x-transition.scale>
        <div class="relative w-1/3">
            <!-- Tombol Close (X) -->
            <button @click="modalBayar= false" class="absolute text-gray-500 top-2 right-4 hover:text-gray-800">
                <svg class="w-8 h-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2ZM15.36 14.3C15.65 14.59 15.65 15.07 15.36 15.36C15.21 15.51 15.02 15.58 14.83 15.58C14.64 15.58 14.45 15.51 14.3 15.36L12 13.06L9.7 15.36C9.55 15.51 9.36 15.58 9.17 15.58C8.98 15.58 8.79 15.51 8.64 15.36C8.35 15.07 8.35 14.59 8.64 14.3L10.94 12L8.64 9.7C8.35 9.41 8.35 8.93 8.64 8.64C8.93 8.35 9.41 8.35 9.7 8.64L12 10.94L14.3 8.64C14.59 8.35 15.07 8.35 15.36 8.64C15.65 8.93 15.65 9.41 15.36 9.7L13.06 12L15.36 14.3Z" fill="currentColor" />
                </svg>
            </button>
            <div class="w-full max-w-md p-6 space-y-4 bg-white shadow-2xl rounded-2xl">
                <h2 class="text-2xl font-bold text-center text-gray-800">Scan QR Code</h2>

                <!-- <video id="preview" class="w-full border border-gray-300 rounded-lg"></video>

                <div id="result" class="p-4 mt-4 text-sm text-gray-700 border border-gray-300 border-dashed rounded-lg bg-gray-50">
                    Hasil scan akan muncul di sini...
                </div> -->
                <div class="flex justify-end gap-3 px-4 py-3">
                    <button type="button" @click="modalBayar= false;" class="px-4 py-2 text-white bg-gray-500 rounded-lg hover:bg-gray-700">
                        Batal
                    </button>
                    <button id="btnSubmit" name="btnsubmit" type="submit" :class="getClass()" class="inline-flex items-center px-3 py-2 font-medium text-white border border-transparent rounded-lg gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none" x-text="getLabel()"></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit pesanan -->
    <div x-show="modalEdit" x-cloak class="fixed inset-0 flex items-center justify-center z-[99999]"
        x-transition.scale>
        <div class="relative w-5/6 bg-white shadow-2xl rounded-2xl">
            <!-- Tombol Close (X) -->
            <button @click="modalEdit= false" class="absolute text-gray-500 top-2 right-4 hover:text-gray-800">
                <svg class="w-8 h-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2ZM15.36 14.3C15.65 14.59 15.65 15.07 15.36 15.36C15.21 15.51 15.02 15.58 14.83 15.58C14.64 15.58 14.45 15.51 14.3 15.36L12 13.06L9.7 15.36C9.55 15.51 9.36 15.58 9.17 15.58C8.98 15.58 8.79 15.51 8.64 15.36C8.35 15.07 8.35 14.59 8.64 14.3L10.94 12L8.64 9.7C8.35 9.41 8.35 8.93 8.64 8.64C8.93 8.35 9.41 8.35 9.7 8.64L12 10.94L14.3 8.64C14.59 8.35 15.07 8.35 15.36 8.64C15.65 8.93 15.65 9.41 15.36 9.7L13.06 12L15.36 14.3Z" fill="currentColor" />
                </svg>
            </button>
            <div class="w-full ">
                <h2 class="px-5 py-2 text-2xl font-bold text-center text-gray-800">Edit Pesanan</h2>
                <hr class="border-1">

                <div class="px-5 py-2 space-y-2 bg-gray-300 border border-dashed">
                    <div class="flex gap-3">


                        <div class="w-1/4 bg-white rounded-lg shadow-lg">
                            <h2 class="py-1 font-semibold text-center text-black ">Daftar Menu</h2>
                            <hr class="border-1">
                            <div class="px-4 py-2">

                            </div>
                        </div>

                        <div class="w-3/4 bg-white rounded-lg shadow-lg">
                            <h2 class="py-1 font-semibold text-center text-black">Detail Pesanan</h2>
                            <hr class="border-1">

                            <div class="px-4 py-2">
                                <table id="" class="min-w-full shadow-xl bg-white/30 backdrop-blur-xl rounded-t-3xl ">
                                    <thead class="bg-gray-300">
                                        <tr class="">
                                            <th scope="col" class="px-6 rounded-tl-xl py-1 text-xs font-semibold !text-center text-gray-700 uppercase">No.</th>
                                            <th scope="col" class="px-6 py-1 text-xs font-semibold !text-center text-gray-700 uppercase">Jumlah Porsi</th>
                                            <th scope="col" class="px-6 py-1 text-xs font-semibold !text-center text-gray-700 uppercase">Nama Menu</th>
                                            <th scope="col" class="px-6 py-1 text-xs font-semibold !text-center text-gray-700 uppercase">Catatan</th>
                                            <th scope="col" class="rounded-tr-xl px-6 py-1 text-xs font-semibold !text-center text-gray-700 uppercase">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        <?php
                                        // if (empty($result)) {
                                        //     //;
                                        // } else {
                                        //     $no = 1;
                                        //     foreach ($result as $row) {
                                        // 
                                        ?>
                                        <tr>
                                            <td class="px-6 py-4 text-xs font-medium text-gray-800 whitespace-nowrap !text-center"></td>
                                            <td class="px-6 py-4 text-xs text-center text-gray-800 whitespace-nowrap"></td>
                                            <td class="px-6 py-4 text-xs text-center text-gray-800 whitespace-nowrap"></td>
                                            <td class="px-6 py-4 text-xs text-center text-gray-800 whitespace-nowrap"></td>

                                            <td class=" py-4 text-sm  whitespace-nowrap !text-center">
                                                <button type="button" class="inline-flex items-center justify-center px-2 py-1 text-sm font-medium text-red-500 border-2 border-red-500 rounded-lg bg-red-200/55 gap-x-2 hover:bg-red-400/85 focus:outline-none disabled:opacity-50 disabled:pointer-events-none"
                                                    data-id=""
                                                    data-nama="">
                                                    X
                                                </button>
                                            </td>
                                        </tr>
                                        <?php
                                        // } } 
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end w-full bg-white rounded-lg shadow-lg">
                        <div class="flex gap-3 px-5 py-3">

                            <div class="flex flex-col gap-1 text-end">
                                <p class="">Total :</p>
                                <label for="jumlah-uang" class="py-1">Jumlah Uang :</label>
                                <p class="">Kembalian : </p>
                            </div>

                            <div class="flex flex-col justify-start gap-1">
                                <p class="">Rp. XXX.XXX,-</p>
                                <input id="jumlah-uang" name="jumlah-uang" type="text" maxlength="11" class="py-1 border-2 rounded-md focus:border-green-500 focus:ring-green-500 w-28" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                <p class="">Rp. XXX.XXX,-</p>
                            </div>

                        </div>
                    </div>
                </div>

                <hr class="border-1">
                <div class="flex justify-center gap-3 px-5 py-3">
                    <button type="button" @click="modalEdit= false;" class="px-3 text-white bg-gray-500 rounded-lg hover:bg-gray-700">
                        Kembali
                    </button>
                    <button id="btnSubmit" name="btnsubmit" type="submit" class="inline-flex items-center px-6 py-2 font-medium text-white bg-green-500 border border-transparent rounded-lg gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none">Proses</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal hapus pesanan -->
    <div x-show="modalHapus" x-cloak class="fixed inset-0 flex items-center justify-center z-[99999]"
        x-transition.scale>
        <div class="relative w-1/3">
            <!-- Tombol Close (X) -->
            <button @click="modalHapus= false; selectNama= null; selectedId= null;" class="absolute text-gray-500 top-2 right-4 hover:text-gray-800">
                <svg class="w-8 h-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2ZM15.36 14.3C15.65 14.59 15.65 15.07 15.36 15.36C15.21 15.51 15.02 15.58 14.83 15.58C14.64 15.58 14.45 15.51 14.3 15.36L12 13.06L9.7 15.36C9.55 15.51 9.36 15.58 9.17 15.58C8.98 15.58 8.79 15.51 8.64 15.36C8.35 15.07 8.35 14.59 8.64 14.3L10.94 12L8.64 9.7C8.35 9.41 8.35 8.93 8.64 8.64C8.93 8.35 9.41 8.35 9.7 8.64L12 10.94L14.3 8.64C14.59 8.35 15.07 8.35 15.36 8.64C15.65 8.93 15.65 9.41 15.36 9.7L13.06 12L15.36 14.3Z" fill="currentColor" />
                </svg>
            </button>
            <div class="w-full max-w-md py-3 space-y-4 bg-white shadow-2xl rounded-2xl">
                <h2 class="text-2xl font-bold text-center text-gray-800">Hapus Pesanan</h2>
                <hr class="border-1">
                <input type="text" class="hidden" :value="selectedId">
                <div class="p-4 mt-4 text-sm text-gray-700">
                    <p class="">Pesanan atas nama <span class="font-semibold text-red-500" x-text="selectNama"></span> akan dihapus permanen. <br>Anda yakin ingin melanjutkan?</p>
                </div>
                <hr class="border-1">
                <div class="flex justify-end gap-3 px-4 py-3">
                    <button type="button" @click="modalHapus= false; selectNama= null; selectedId= null;" class="px-4 py-2 text-white bg-gray-500 rounded-lg hover:bg-gray-700">
                        Batal
                    </button>
                    <button id="btnHapus" name="btnHapus" type="submit"
                        class="inline-flex items-center px-3 py-2 font-medium text-white bg-red-500 border border-transparent rounded-lg gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none">
                        <svg id="spinner" class="hidden w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="white" stroke-width="4"></circle>
                            <path class="opacity-75" fill="white"
                                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                        <span id="btnText">Lanjutkan</span>
                    </button>
                </div>
            </div>
        </div>
    </div>



</div>

<!--  -->


<!-- javascript -->
<script src="../public/assets/js/jquery-3.7.1.min.js"></script>
<script src="../public/assets/js/datatables.min.js"></script>
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
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

    // =======================================================================================


    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview')
    });

    scanner.addListener('scan', function(content) {
        const resultDiv = document.getElementById("result");
        resultDiv.innerHTML = `<div class="font-semibold text-blue-700">Kode ditemukan:</div> <div>${content}</div><div class="mt-2 text-gray-500">Mengambil data pesanan...</div>`;

        // Kirim kode ke server
        fetch('/webseafood/proses/proses_cari_pesanan.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'kode=' + encodeURIComponent(content)
            })
            .then(response => response.text())
            .then(data => {
                resultDiv.innerHTML = `
            <div class="font-semibold text-green-700">Data Pesanan:</div>
            <div class="mt-2 text-sm">${data}</div>
        `;
            })
            .catch(error => {
                resultDiv.innerHTML = `<div class="text-red-600">Gagal mengambil data: ${error}</div>`;
            });
    });

    // Aktifkan kamera
    // Instascan.Camera.getCameras().then(function(cameras) {
    //     if (cameras.length > 0) {
    //         scanner.start(cameras[0]);
    //     } else {
    //         alert('Tidak ditemukan kamera.');
    //     }
    // }).catch(function(e) {
    //     console.error(e);
    //     alert('Gagal mengakses kamera: ' + e);
    // });

    // =======================================================================================



    document.getElementById('btnHapus').addEventListener('click', function() {

        let id = document.querySelector('input[type="text"].hidden').value;

        if (!id) {
            alert("ID tidak ditemukan.");
            return;
        }


        fetch('/webseafood/proses/data_pesanan_hapus.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + encodeURIComponent(id)
            })
            .then(response => response.text())
            .then(data => {

                // console.log(data);
                if (data.trim() === 'success') {
                    alert("Pesanan berhasil dihapus.");

                    modalHapus = false;
                    selectNama = null;
                    selectedId = null;

                    location.reload();
                } else {
                    alert("Gagal menghapus pesanan: " + data);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Terjadi kesalahan saat menghapus.");
            });
    });

    // =======================================================================================


    function formatRupiah(angka) {
        return angka.replace(/\D/g, '')
            .replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }


    // =======================================================================================


    document.addEventListener("DOMContentLoaded", function() {

        const inputNominal = document.getElementById("jumlah-uang")

        inputNominal.addEventListener("input", function(event) {
            let value = event.target.value;
            event.target.value = formatRupiah(value);
        });

    });
</script>