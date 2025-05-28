<?php
include "./config/connect.php";

$petugas = $_SESSION['id'];
$query = mysqli_query($conn, "SELECT tpsn.id_pesanan, tpsn.kode_pesanan, tpsn.id_pembeli, tpsn.total_harga, tpsn.status_pesanan, tpsn.tanggal_pesanan, tb.nama_pembeli FROM tb_pesanan tpsn JOIN tb_pembeli tb ON tpsn.id_pembeli = tb.id_pembeli ORDER BY tpsn.tanggal_pesanan DESC");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}





function formatRupiah($angka)
{
    return "Rp. " . number_format($angka, 0, ',', '.') . ',-';
}

?>

<!-- ================================================================================================================= -->

<div class="w-full" x-data="{ modal: false, modalInput: false, modalPreview: false, modalEdit: false, modalHapus: false, selectNama: null, selectedId: null}">
    <div class="flex items-end w-full mb-7">
        <div class="flex items-center justify-center w-full gap-3 px-5 py-2 bg-primary-300 rounded-xl">
            <h3 class="text-xl text-white">Proses pesanan :</h3>
            <button id="" class="p-2 text-black rounded-lg bg-slate-200 hover:bg-slate-400" type="button" @click="modal = true">
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

                        $status = isset($row['status_pesanan']) ? $row['status_pesanan'] : '-';

                        switch ($status) {
                            case 'Belum Bayar':
                                $colorClass = 'text-red-600 bg-red-100 p-1 rounded-md';
                                break;
                            case 'Proses':
                                $colorClass = 'text-yellow-600 bg-yellow-100 p-1 rounded-md';
                                break;
                            case 'Selesai':
                                $colorClass = 'text-green-600 bg-green-100 p-1 rounded-md';
                                break;
                            default:
                                $colorClass = 'text-gray-600 bg-gray-100 p-1 rounded-md';
                                break;
                        }
                ?>
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap !text-center"><?php echo $no++; ?></td>
                            <td class="px-6 py-4 text-sm text-center text-gray-800 whitespace-nowrap"><?php echo isset($row['kode_pesanan']) ? $row['kode_pesanan'] : '-'; ?></td>
                            <td class="px-6 py-4 text-sm text-center text-gray-800 whitespace-nowrap"><?php echo isset($row['nama_pembeli']) ? $row['nama_pembeli'] : '-'; ?></td>
                            <td class="px-6 py-4 text-sm text-center text-gray-800 whitespace-nowrap">Rp. <?php echo isset($row['total_harga']) ? number_format($row['total_harga'], 0, ',', '.') : '-'; ?></td>
                            <td class="px-6 py-4 text-sm text-center text-gray-800 whitespace-nowrap"><span class="<?php echo $colorClass; ?>"><?php echo isset($row['status_pesanan']) ? $row['status_pesanan'] : '-'; ?></span></td>
                            <td class="px-6 py-4 text-sm !text-center text-gray-800 whitespace-nowrap"><?php echo isset($row['tanggal_pesanan']) ? date('d-m-Y H:i:s', strtotime($row['tanggal_pesanan'])) : '-'; ?></td>
                            <td class=" py-4 text-sm  whitespace-nowrap !text-center">
                                <button type="button" class="inline-flex justify-center btn-detail items-center w-16 py-[2px] text-sm font-medium text-teal-600 bg-teal-200/55 border border-transparent rounded-full gap-x-2 hover:bg-teal-400/85  focus:outline-none disabled:opacity-50 disabled:pointer-events-none"
                                    data-id="<?php echo $row['id_pesanan']; ?>"
                                    data-nama="<?php echo $row['nama_pembeli']; ?>"
                                    @click="modalPreview = true, selectedId = $el.dataset.id; selectNama= $el.dataset.nama;">
                                    Detail
                                </button>
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
    <div x-show="modal || modalHapus || modalEdit || modalPreview" x-cloak class="fixed inset-0 z-[99998] bg-black/85 sm:inline-flex sm:mx-auto"
        x-transition.opacity>
    </div>

    <!-- ========================================= -->

    <!-- Modal untuk scanner barcode -->
    <div x-show="modal" x-cloak class="fixed inset-0 flex items-center justify-center z-[99999]"
        x-transition.scale>
        <div class="relative w-1/3">
            <!-- Tombol Close (X) -->
            <button @click="modal= false; selectNama= null; selectedId= null" id="btnCloseModal" class="absolute text-gray-500 top-2 right-4 hover:text-gray-800">
                <svg class="w-8 h-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2ZM15.36 14.3C15.65 14.59 15.65 15.07 15.36 15.36C15.21 15.51 15.02 15.58 14.83 15.58C14.64 15.58 14.45 15.51 14.3 15.36L12 13.06L9.7 15.36C9.55 15.51 9.36 15.58 9.17 15.58C8.98 15.58 8.79 15.51 8.64 15.36C8.35 15.07 8.35 14.59 8.64 14.3L10.94 12L8.64 9.7C8.35 9.41 8.35 8.93 8.64 8.64C8.93 8.35 9.41 8.35 9.7 8.64L12 10.94L14.3 8.64C14.59 8.35 15.07 8.35 15.36 8.64C15.65 8.93 15.65 9.41 15.36 9.7L13.06 12L15.36 14.3Z" fill="currentColor" />
                </svg>
            </button>
            <div class="w-full p-6 space-y-4 bg-white shadow-2xl rounded-2xl">
                <h2 class="text-2xl font-bold text-center text-gray-800">Scan QR Code</h2>

                <video id="preview" class="w-full border border-gray-300 rounded-lg"></video>

                <div id="result" class="p-4 mt-4 text-sm text-gray-700 border border-gray-300 border-dashed rounded-lg bg-gray-50">
                    Hasil scan akan muncul di sini...
                </div>
                <div class="flex justify-end">
                    <button @click="selectNama= null; selectedId= null" type="button" id="btnScanUlang" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-700">
                        Scan Ulang
                    </button>

                </div>
            </div>
        </div>
    </div>


    <!-- Modal preview pesanan -->
    <div x-show="modalPreview" x-cloak class="fixed inset-0 flex items-center justify-center z-[99999]"
        x-transition.scale>
        <div class="relative w-1/2 bg-white shadow-2xl rounded-2xl">
            <!-- Tombol Close (X) -->
            <button @click="modalPreview= false; selectNama= null; selectedId= null" class="absolute text-gray-500 top-2 right-4 hover:text-gray-800">
                <svg class="w-8 h-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2ZM15.36 14.3C15.65 14.59 15.65 15.07 15.36 15.36C15.21 15.51 15.02 15.58 14.83 15.58C14.64 15.58 14.45 15.51 14.3 15.36L12 13.06L9.7 15.36C9.55 15.51 9.36 15.58 9.17 15.58C8.98 15.58 8.79 15.51 8.64 15.36C8.35 15.07 8.35 14.59 8.64 14.3L10.94 12L8.64 9.7C8.35 9.41 8.35 8.93 8.64 8.64C8.93 8.35 9.41 8.35 9.7 8.64L12 10.94L14.3 8.64C14.59 8.35 15.07 8.35 15.36 8.64C15.65 8.93 15.65 9.41 15.36 9.7L13.06 12L15.36 14.3Z" fill="currentColor" />
                </svg>
            </button>
            <!-- <form method="POST">
                <input id="input-id-preview" type="hidden" name="selected_id" :value="selectedId">
                <button type="submit" class="hidden" id="btnSubmitDataPreview">Submit</button>
            </form> -->
            <div class="w-full ">
                <h2 class="px-5 py-2 text-2xl font-bold text-center text-gray-800">Preview Pesanan</h2>


                <div class="px-5 py-2 space-y-2 bg-gray-300 border border-dashed">

                    <div class="flex gap-4  items-start">
                        <div class="flex flex-col w-full  bg-white rounded-lg shadow-lg">
                            <h2 class="py-1 font-semibold text-center text-black">Info Kontak Pembeli</h2>
                            <hr class="border-1">
                            <div class="">
                                <div class="flex gap-3 px-5 py-3">
                                    <div class="flex flex-col gap-1 text-end">
                                        <p class="text-sm font-medium text-black">Nama :</p>
                                        <p class="text-sm font-medium text-black">Nomor Hp:</p>
                                        <p class="text-sm font-medium text-black">Email:</p>
                                    </div>

                                    <div class="flex flex-col justify-start gap-1">
                                        <p id="nama-preview" class="text-sm font-normal text-black">-</p>
                                        <p id="nohp-preview" class="text-sm font-normal text-black">-</p>
                                        <p id="email-preview" class="text-sm font-normal text-black">-</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col w-full bg-white rounded-lg shadow-lg">
                            <h2 class="py-1 font-semibold text-center text-black">Info Pembayaran</h2>
                            <hr class="border-1">
                            <div class="">
                                <div class="flex gap-3 px-5 py-3">
                                    <div class="flex flex-col gap-1 text-end">
                                        <p class="text-sm font-medium text-black">Metode bayar :</p>
                                        <p class="text-sm font-medium text-black">Total Bayar :</p>

                                    </div>

                                    <div class="flex flex-col justify-start gap-1">
                                        <p id="metode-preview" class="text-sm font-normal text-black">-</p>
                                        <p id="total-preview" class="text-sm font-normal text-black">-</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex  w-full bg-white rounded-lg shadow-lg px-3 py-1 gap-2">
                        <h2 class="py-1 font-semibold text-black">Tipe Pemesanan : </h2>
                        <p id="" class="text-sm font-normal text-black flex items-center justify-center"><span id="tipe-preview"></span>, (<span id="meja-preview"></span>)</p>

                    </div>

                    <div id="detail-pesanan-preview" class="w-full bg-white rounded-lg shadow-lg">
                        <h2 class="py-1 font-semibold text-center text-black">Detail Pesanan</h2>
                        <hr class="border-1">
                        <div class="px-4 py-2 max-h-52 h-52 !overflow-y-scroll">
                            <table id="" class="min-w-full shadow-xl bg-white/30 backdrop-blur-xl rounded-t-3xl ">
                                <thead class="bg-gray-300">
                                    <tr class="">
                                        <th scope="col" class="px-6 rounded-tl-xl py-1 text-xs font-semibold !text-center text-gray-700 uppercase">No.</th>
                                        <th scope="col" class="px-6 py-1 text-xs font-semibold !text-center text-gray-700 uppercase">Menu</th>
                                        <th scope="col" class="px-6 py-1 text-xs font-semibold !text-center text-gray-700 uppercase">Catatan</th>
                                        <th scope="col" class="px-6 py-1 text-xs font-semibold !text-center text-gray-700 uppercase rounded-tr-xl">Jumlah Porsi</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body-preview" class="divide-y divide-gray-200 bg-slate-100">
                                    <!--  -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


                <div class="flex justify-center gap-3 px-5 py-3">
                    <button type="button" @click="modalPreview= false;" class="px-3 py-2 text-white bg-gray-500 rounded-lg hover:bg-gray-700">
                        Kembali
                    </button>

                </div>
            </div>
        </div>
    </div>


    <!-- Modal edit pesanan -->
    <div x-show="modalEdit" x-cloak class="fixed inset-0 flex items-center justify-center z-[99999]"
        x-transition.scale>
        <div class="relative w-5/6 bg-white shadow-2xl rounded-2xl">
            <!-- Tombol Close (X) -->
            <button @click="modalEdit= false; selectNama= null; selectedId= null" class="absolute text-gray-500 top-2 right-4 hover:text-gray-800">
                <svg class="w-8 h-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2ZM15.36 14.3C15.65 14.59 15.65 15.07 15.36 15.36C15.21 15.51 15.02 15.58 14.83 15.58C14.64 15.58 14.45 15.51 14.3 15.36L12 13.06L9.7 15.36C9.55 15.51 9.36 15.58 9.17 15.58C8.98 15.58 8.79 15.51 8.64 15.36C8.35 15.07 8.35 14.59 8.64 14.3L10.94 12L8.64 9.7C8.35 9.41 8.35 8.93 8.64 8.64C8.93 8.35 9.41 8.35 9.7 8.64L12 10.94L14.3 8.64C14.59 8.35 15.07 8.35 15.36 8.64C15.65 8.93 15.65 9.41 15.36 9.7L13.06 12L15.36 14.3Z" fill="currentColor" />
                </svg>
            </button>
            <form method="POST">
                <input id="input-id-edit" type="hidden" name="selected_id" :value="selectedId">
                <button type="submit" class="hidden" id="btnSubmitData">Submit</button>
            </form>
            <div class="w-full ">
                <h2 class="px-5 py-2 text-2xl font-bold text-center text-gray-800">Kelola Pesanan</h2>
                <hr class="border-1">

                <div class="px-5 py-2 space-y-2 bg-gray-300 border border-dashed">
                    <div class="flex gap-3">
                        <div id="daftar-menu" class="w-1/4 bg-white rounded-lg shadow-lg ">
                            <h2 class="py-1 font-semibold text-center text-black ">Daftar Menu</h2>
                            <hr class="border-1">
                            <div class="flex flex-col gap-2 px-4 py-2 space-y-2 overflow-y-auto max-h-80">
                                <?php
                                $mquery = mysqli_query($conn, "SELECT * FROM tb_menu");
                                while ($mrow = mysqli_fetch_assoc($mquery)) {
                                ?>

                                    <div class="flex h-full px-4 py-1 border-2 border-gray-500 rounded-md" data-id="<?php echo $mrow['id_menu'] ?>">
                                        <div class="flex flex-col justify-center flex-1 w-full">
                                            <h3 class="text-sm font-medium "><?php echo $mrow['nama_menu'] ?></h3>

                                            <p class="text-xs "><?php echo formatRupiah($mrow["harga"]) ?></p>
                                        </div>
                                        <div class="flex flex-col items-center justify-end h-full gap-2">
                                            <!-- =========================================================================== -->
                                            <img src="../<?php echo $mrow['gambar_menu'] ?>" alt="gambar_menu" class="object-cover size-10 rounded-xl shrink-0">
                                            <button type="button" class="tambah-btn  px-4 py-[2px]  text-xs text-white border border-transparent transition bg-red-600 rounded-lg hover:text-white hover:bg-red-500 disabled:bg-red-300" data-id="<?php echo $mrow['id_menu'] ?>">
                                                Tambah
                                            </button>

                                            <div x-cloak class="hidden gap-4 mt-3 btn-group" data-id="">
                                                <button type="button" class="inline-flex items-center justify-center btn-kurang">
                                                    <svg class="shrink-0 size-5" viewBox="0 0 32 32" version="1.1">
                                                        <defs>

                                                        </defs>
                                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                                            <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-516.000000, -1087.000000)" fill="#000000">
                                                                <path d="M532,1117 C524.268,1117 518,1110.73 518,1103 C518,1095.27 524.268,1089 532,1089 C539.732,1089 546,1095.27 546,1103 C546,1110.73 539.732,1117 532,1117 L532,1117 Z M532,1087 C523.163,1087 516,1094.16 516,1103 C516,1111.84 523.163,1119 532,1119 C540.837,1119 548,1111.84 548,1103 C548,1094.16 540.837,1087 532,1087 L532,1087 Z M538,1102 L526,1102 C525.447,1102 525,1102.45 525,1103 C525,1103.55 525.447,1104 526,1104 L538,1104 C538.553,1104 539,1103.55 539,1103 C539,1102.45 538.553,1102 538,1102 L538,1102 Z" id="minus-circle" sketch:type="MSShapeGroup">

                                                                </path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </button>
                                                <p class="inline-flex items-center justify-center w-12 qty-item">xx</p>
                                                <button type="button" class="inline-flex items-center justify-center btn-tambah">
                                                    <svg class="shrink-0 size-5" viewBox="0 0 32 32" version="1.1">
                                                        <defs>
                                                        </defs>
                                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                                            <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-464.000000, -1087.000000)" fill="#000000">
                                                                <path d="M480,1117 C472.268,1117 466,1110.73 466,1103 C466,1095.27 472.268,1089 480,1089 C487.732,1089 494,1095.27 494,1103 C494,1110.73 487.732,1117 480,1117 L480,1117 Z M480,1087 C471.163,1087 464,1094.16 464,1103 C464,1111.84 471.163,1119 480,1119 C488.837,1119 496,1111.84 496,1103 C496,1094.16 488.837,1087 480,1087 L480,1087 Z M486,1102 L481,1102 L481,1097 C481,1096.45 480.553,1096 480,1096 C479.447,1096 479,1096.45 479,1097 L479,1102 L474,1102 C473.447,1102 473,1102.45 473,1103 C473,1103.55 473.447,1104 474,1104 L479,1104 L479,1109 C479,1109.55 479.447,1110 480,1110 C480.553,1110 481,1109.55 481,1109 L481,1104 L486,1104 C486.553,1104 487,1103.55 487,1103 C487,1102.45 486.553,1102 486,1102 L486,1102 Z" id="plus-circle" sketch:type="MSShapeGroup">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- ================================================================================= -->


                                        </div>
                                    </div>
                                <?php  } ?>
                            </div>
                        </div>

                        <div id="detail-pesanan" class="w-3/4 bg-white rounded-lg shadow-lg">
                            <h2 class="py-1 font-semibold text-center text-black">Detail Pesanan</h2>
                            <hr class="border-1">
                            <div class="px-4 py-2 max-h-52 h-52 !overflow-y-scroll">
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
                                    <tbody id="table-body" class="divide-y divide-gray-200 bg-slate-100">
                                        <!--  -->
                                    </tbody>
                                </table>
                            </div>

                            <hr class="border-2">
                            <div class="flex w-full py-2">
                                <div class="pl-5 max-w-72">
                                    <div class="flex flex-col items-end w-64 gap-1">
                                        <div class="">
                                            <label for="input-nama" class="text-xs">Nama Pemesan :</label>
                                            <input id="input-nama" name="input-nama" type="text" class="w-40 p-1 text-xs rounded-md" readonly>
                                        </div>
                                        <div class="">
                                            <label for="input-nohp" class="text-xs">No. Handphone :</label>
                                            <input id="input-nohp" name="input-nohp" type="text" class="w-40 p-1 text-xs rounded-md" oninput="this.value = this.value.replace(/[^0-9]/g, '')" readonly>
                                        </div>
                                        <div class="">
                                            <label for="input-email" class="text-xs">Email Pemesan :</label>
                                            <input id="input-email" name="input-email" type="text" class="w-40 p-1 text-xs rounded-md" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-7 max-w-[580px]">
                                    <div class="flex items-center w-full h-10">
                                        <h3 class="text-xs text-black w-16">Tipe :</h3>
                                        <div class="flex items-center ml-1 space-x-2 sm:space-x-4">
                                            <label class="flex items-center space-x-2">
                                                <input id="input-ambil" type="radio" name="option" value="ambil" class="hidden peer" disabled>
                                                <div class="flex items-center justify-center w-5 h-5 border-2 border-gray-700 rounded-full ">

                                                    <svg id="svgAway" class="hidden size-4 text-primary-400" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                        viewBox="0 0 35.979 35.979" xml:space="preserve">
                                                        <g>
                                                            <path style="fill:currentColor;" d="M26.84,6.252l-14.046,14.23L2.464,15.12l-1.98,3.815c-1.094,2.106-0.272,4.701,1.836,5.794 l12.094,6.277C14.46,31.03,35.979,9.232,35.979,9.232L32.92,6.211C31.23,4.545,28.509,4.563,26.84,6.252z" />
                                                        </g>
                                                    </svg>
                                                </div>
                                                <span id="spanAway" class="text-xs text-gray-700 whitespace-nowrap">Take away</span>
                                            </label>

                                            <label class="flex items-center space-x-2">
                                                <input id="input-ditempat" type="radio" name="option" value="ditempat" class="hidden peer" disabled>
                                                <div class="flex items-center justify-center w-5 h-5 border-2 border-gray-700 rounded-full ">
                                                    <svg id="svgTempat" class="hidden size-4 text-primary-400" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                        viewBox="0 0 35.979 35.979" xml:space="preserve">
                                                        <g>
                                                            <path style="fill:currentColor;" d="M26.84,6.252l-14.046,14.23L2.464,15.12l-1.98,3.815c-1.094,2.106-0.272,4.701,1.836,5.794 l12.094,6.277C14.46,31.03,35.979,9.232,35.979,9.232L32.92,6.211C31.23,4.545,28.509,4.563,26.84,6.252z" />
                                                        </g>
                                                    </svg>
                                                </div>
                                                <span id="spanTempat" class="text-xs text-gray-700 whitespace-nowrap">Makan ditempat</span>
                                            </label>

                                            <div id="boxMeja" class="justify-center">
                                                <div class="relative">
                                                    <input oninput="this.value = this.value.replace(/[^0-9]/g, '')" id="inputMeja" type="text" class="peer py-2.5 px-4 ps-11 block w-32 border-2 border-gray-200 bg-white  rounded-md sm:text-xs focus:border-red-500 focus:ring-red-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="No. Meja" maxlength="2" readonly>
                                                    <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                                        <svg class="text-gray-500 shrink-0 size-4" fill="currentColor" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 48 48" xml:space="preserve">
                                                            <g>
                                                                <path d="M48,0.5H0v6h12.523c-0.018,0.119-0.041,0.237-0.041,0.358c0,0.987,0.613,1.642,1.666,2.642h-0.01 c0,0,0.055,0.097,0.148,0.161c0.114,0.082,0.225,0.194,0.348,0.273c1.261,0.892,4.684,3.454,7.18,6.566H20v28h-5v3h20v-3h-5v-28 h-1.616c1.741-2.325,4.058-4.919,6.911-7h-0.002c0.952-0.766,1.497-1.645,1.497-2.581c0-0.142-0.022-0.28-0.048-0.419H48V0.5z" />
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="flex w-full">
                                        <label for="input-catatan" class=" text-xs w-16">Catatan :</label>
                                        <textarea name="input-catatan" id="input-catatan" class="block ml-1 px-4 py-2 text-sm border-gray-200 rounded-lg w-full focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" rows="3" placeholder="" data-hs-textarea-auto-height='{"defaultHeight": 72}'></textarea>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="flex w-full h-32 bg-white rounded-lg shadow-lg">
                        <div class="flex-col px-5 py-3">
                            <h3 class="text-base font-semibold text-center  mb-3">1. Kunci Pesanan :</h3>
                            <div class="flex items-center justify-center gap-1">
                                <button id="btn-kunci" name="btn-kunci" type="submit" class="inline-flex items-center px-2 py-2 text-sm font-medium text-white bg-green-500 border border-transparent rounded-lg gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none disabled:bg-green-500/50 disabled:cursor-none">
                                    <svg class="size-6" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4 6V4C4 1.79086 5.79086 0 8 0C10.2091 0 12 1.79086 12 4V6H14V16H2V6H4ZM6 4C6 2.89543 6.89543 2 8 2C9.10457 2 10 2.89543 10 4V6H6V4ZM7 13V9H9V13H7Z" fill="currentColor" />
                                    </svg>
                                </button>
                                <button id="btn-buka-kunci" name="btn-buka-kunci" type="submit" class="inline-flex items-center px-2 py-2 text-sm font-medium text-white bg-green-500 border border-transparent rounded-lg gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none disabled:bg-green-500/50 disabled:cursor-none" disabled>
                                    <svg class="size-6" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.5 2C10.6716 2 10 2.67157 10 3.5V6H13V16H1V6H8V3.5C8 1.567 9.567 0 11.5 0C13.433 0 15 1.567 15 3.5V4H13V3.5C13 2.67157 12.3284 2 11.5 2ZM9 10H5V12H9V10Z" fill="currentColor" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="w-1 h-full bg-gray-400"></div>


                        <div id="div-metode-bayar" class="flex-col px-5 py-3 w-[520px] hidden">
                            <h3 class="text-base font-semibold text-center  mb-3">2. Metode Pembayaran :</h3>
                            <div class="flex items-center space-x-3">
                                <div class="flex ">
                                    <div id="card-qris" class="px-4 py-2 border border-gray-200 rounded-lg shadow-xl select-none">
                                        <label class="flex items-center space-x-2">
                                            <input id="input-kris" type="radio" name="option-dua" value="kris" class=" peer">
                                            <img src="../public/assets/images/qr.png" alt="kris" class="object-cover size-12 ">
                                            <span class="text-xs text-gray-700 sm:text-base whitespace-nowrap">Qris</span>
                                        </label>

                                    </div>
                                    <div id="div-keterangan" class="flex flex-col pl-3">
                                        <label for="input-keterangan" class="text-xs">Nama Rekening :</label>
                                        <input id="input-keterangan" name="input-keterangan" type="text" class="w-40 p-1 rounded-md focus:border-green-500 focus:ring-green-500 focus:border-2">
                                    </div>
                                </div>
                                <div id="card-cash" class="px-4 py-2 border border-gray-200 rounded-lg shadow-xl select-none">
                                    <label class="flex items-center space-x-2">
                                        <input id="input-cash" type="radio" name="option-dua" value="cash" class=" peer">
                                        <img src="../public/assets/images/cash.png" alt="cash" class="object-cover size-12">
                                        <span class="text-xs text-gray-700 sm:text-base whitespace-nowrap">Cash</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="w-1 h-full bg-gray-400"></div>

                        <!-- ============================= -->
                        <div id="div-total-bayar" class=" justify-end w-72">
                            <div class="flex gap-3 px-5 py-3">
                                <div class="flex flex-col gap-1 text-end">
                                    <p class="">Total :</p>
                                    <label for="jumlah-uang" class="py-1">Jumlah Uang :</label>
                                    <p class="">Kembalian : </p>
                                </div>

                                <div class="flex flex-col justify-start gap-1">
                                    <p id="" class="">Rp. <span id="total-harga">0</span>,-</p>
                                    <input id="jumlah-uang" name="jumlah-uang" type="text" maxlength="11" class="py-1 border-transparent rounded-md focus:border-green-500 focus:ring-green-500 w-28 focus:border-2 disabled:border-transparent">
                                    <p id="" class="">Rp. <span id="kembalian">0</span>,-</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <hr class="border-1">
                <div class="flex justify-center gap-3 px-5 py-3">
                    <button type="button" @click="modalEdit= false;" class="px-3 text-white bg-gray-500 rounded-lg hover:bg-gray-700">
                        Kembali
                    </button>
                    <button id="btn-proses" name="btn-proses" type="submit" class="inline-flex items-center px-6 py-2 font-medium text-white bg-green-500 border border-transparent rounded-lg gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none disabled:bg-green-500/50 disabled:cursor-none" disabled>Proses</button>
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
        fetch('/webseafood/proses/proses_cari_pesanan.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'kode=' + encodeURIComponent(content)
            })
            .then(response => response.text())
            .then(text => {
                // console.log('RESPON SERVER:', text); // tampilkan respon mentahnya
                try {
                    const data = JSON.parse(text); // coba parse JSON
                    const resultDiv = document.getElementById('result');

                    if (data.status === 'success') {
                        resultDiv.innerHTML = `
                    <div class="">
                        <p><strong>Kode Pesanan:</strong> <span class="ml-2 text-sm">${data.kode_pesanan}</span></p>
                        <p><strong>Nama Pembeli:</strong> <span class="ml-2 text-sm">${data.nama_pembeli}</span></p>
                        <p><strong>Total Harga:</strong> <span class="ml-2 text-sm">Rp${data.total_harga}</span></p>
                    </div>

                    <div class="flex items-center justify-center mt-3">
                        <button type="button"  id="btn-proses" class="px-4 py-2 text-yellow-500 border-2 border-yellow-500 rounded-lg hover:bg-yellow-300/85 focus:outline-none bg-yellow-200/55" data-id="${data.id_pesanan}" @click="modalEdit = true; selectedId = $el.dataset.id;">
                            Proses
                        </button>
                    </div>
                `;
                        resultDiv.classList.remove('border-gray-300', 'border-red-500');
                        resultDiv.classList.add('border-green-500');

                        // Stop kamera
                        scanner.stop();
                        document.getElementById('preview').classList.add('hidden');
                    } else {
                        resultDiv.textContent = 'Data tidak ditemukan.';
                        resultDiv.classList.remove('border-gray-300', 'border-green-500');
                        resultDiv.classList.add('border-red-500');
                    }
                } catch (e) {
                    console.error('Gagal parse JSON:', e);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const resultDiv = document.getElementById('result');
                resultDiv.textContent = 'Terjadi kesalahan saat memproses data.';
                resultDiv.classList.remove('border-green-500');
                resultDiv.classList.add('border-red-500');
            });
    });


    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            alert('Tidak ada kamera ditemukan.');
        }
    }).catch(function(e) {
        console.error(e);
        alert('Gagal mengakses kamera.');
    });


    function resetScannerUI() {
        document.getElementById('result').textContent = 'Hasil scan akan muncul di sini...';
        document.getElementById('result').className = 'p-4 mt-4 text-sm text-gray-700 border border-gray-300 border-dashed rounded-lg bg-gray-50';
        document.getElementById('preview').classList.remove('hidden');

        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            }
        });
    }

    document.getElementById('btnScanUlang').addEventListener('click', resetScannerUI);


    document.getElementById('btnCloseModal').addEventListener('click', () => {
        // scanner.stop();
        resetScannerUI();
        // document.getElementById('preview').classList.add('hidden');
        // document.getElementById('modal').classList.add('hidden');
    });

    // =======================================================================================


    let rincianpesanan;

    function loadDetailPesanan(selectedId, totalHarga = null) {
        fetch('/webseafood/proses/data_pesanan_detail.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'selected_id=' + encodeURIComponent(selectedId)
            })
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('table-body');
                tbody.innerHTML = '';

                const txtHarga = document.getElementById('total-harga');



                if (data.status === 'success') {

                    rincianpesanan = data.pesanan;


                    data.items.forEach((item, index) => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                        <td class="px-6 py-1 text-xs text-center">${index + 1}</td>
                        <td class="px-6 py-1 text-xs text-center">${item.qty}</td>
                        <td class="px-6 py-1 text-xs text-center">${item.nama_menu}</td>
                        <td class="px-6 py-1 text-xs text-center">${item.catatan_detail}</td>
                        <td class="py-1 text-sm text-center">
                            <button type="button"  class="px-2 py-1 text-sm font-medium text-red-500 border-2 border-red-500 rounded-lg hapus-btn bg-red-200/55"
                                    data-id="${item.id_detail}">
                            X
                            </button>
                        </td>
                        `;
                        tbody.appendChild(row);

                    });

                    txtHarga.textContent = formatRupiah(totalHarga);
                    // console.log(totalHarga);
                } else {
                    tbody.innerHTML = `<tr><td colspan="5" class="py-2 text-sm text-center text-gray-600">Data tidak ditemukan.</td></tr>`;
                }
            });
    }

    // =======================================================================================

    function loadKunciPesanan(selectedId, totalHarga = null) {
        fetch('/webseafood/proses/data_pesanan_detail.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'selected_id=' + encodeURIComponent(selectedId)
            })
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('table-body');
                tbody.innerHTML = '';

                const txtHarga = document.getElementById('total-harga');



                if (data.status === 'success') {

                    // rincianpesanan = data.pesanan;


                    data.items.forEach((item, index) => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                        <td class="px-6 py-1 text-xs text-center">${index + 1}</td>
                        <td class="px-6 py-1 text-xs text-center">${item.qty}</td>
                        <td class="px-6 py-1 text-xs text-center">${item.nama_menu}</td>
                        <td class="px-6 py-1 text-xs text-center">${item.catatan_detail}</td>
                        <td class="py-1 text-sm text-center">
                            -
                        </td>
                        `;
                        tbody.appendChild(row);

                    });

                    txtHarga.textContent = formatRupiah(totalHarga);
                    // console.log(totalHarga);
                } else {
                    tbody.innerHTML = `<tr><td colspan="5" class="py-2 text-sm text-center text-gray-600">Data tidak ditemukan.</td></tr>`;
                }
            });
    }



    // =======================================================================================


    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('hapus-btn') && !e.target.disabled) {
            const id_detail = e.target.dataset.id;
            const selectedId = document.getElementById('input-id-edit').value;
            hapusData(id_detail, selectedId);
        }
    });

    // =======================================================================================


    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('tambah-btn') && !e.target.disabled) {
            const id_menu = e.target.dataset.id;
            const selectedId = document.getElementById('input-id-edit').value;
            tambahMenu(id_menu, selectedId);
        }
    });


    // =======================================================================================


    function tambahMenu(id_menu, selectedId) {
        fetch('/webseafood/proses/data_pesanan_dtltambah.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id_menu=' + encodeURIComponent(id_menu) + '&selectedId=' + encodeURIComponent(selectedId)
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    totalHargaUtama = data.total_harga;
                    loadDetailPesanan(selectedId, totalHargaUtama);
                } else if (data.status === 'hapus') {
                    // location.reload();
                } else {
                    alert('Gagal menambah data.');
                }
            });
    }


    // =======================================================================================

    let totalHargaUtama = 0;

    function hapusData(id_detail, selectedId) {
        if (!confirm('Yakin ingin menghapus item ini?')) return;

        fetch('/webseafood/proses/data_pesanan_dtlhapus.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id_detail=' + encodeURIComponent(id_detail) + '&selectedId=' + encodeURIComponent(selectedId)
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    totalHargaUtama = data.total_harga;
                    loadDetailPesanan(selectedId, totalHargaUtama);
                } else if (data.status === 'hapus') {
                    location.reload();
                } else {
                    alert('Gagal menghapus data.');
                }
            });
    }


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
        angka = String(angka).replace(/\D/g, '');
        return angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        // return 'Rp ' + angka.replace(...); // bisa juga kalau mau pakai "Rp"
    }


    // =======================================================================================

    let dataPesanan = null;

    document.addEventListener("DOMContentLoaded", function() {

        const inputNominal = document.getElementById("jumlah-uang");

        const inputNama = document.getElementById('input-nama');
        const inputNohp = document.getElementById('input-nohp');
        const inputEmail = document.getElementById('input-email');

        const inputCatatanPesanan = document.getElementById('input-catatan');
        const inputKris = document.getElementById('input-kris');
        const inputCash = document.getElementById('input-cash');

        const inputAmbil = document.getElementById('input-ambil');
        const inputDitempat = document.getElementById('input-ditempat');

        const txtHarga = document.getElementById('total-harga');
        const txtKembalian = document.getElementById('kembalian');

        const divKet = document.getElementById('div-keterangan');
        const inputKeterangan = document.getElementById('input-keterangan');
        const inputUang = document.getElementById('jumlah-uang');

        const btnProses = document.getElementById('btn-proses');

        inputNominal.addEventListener("input", function(event) {
            let value = event.target.value;
            event.target.value = formatRupiah(value);
        });


        document.addEventListener('click', function(e) {

            if (e.target && e.target.id === 'btn-proses') {
                const selectedId = document.getElementById('input-id-edit').value;
                loadDetailPesanan(selectedId);

                fetch('/webseafood/proses/data_pesanan_detail.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'selected_id=' + encodeURIComponent(selectedId)
                    })
                    .then(response => response.json())
                    .then(data => {

                        if (data.status === 'success') {

                            dataPesanan = data.pesanan;

                            const jenis = data.pesanan.jenis_pesanan;
                            const metode = data.pesanan.metode_bayar;


                            if (jenis === 'Dine In') {
                                svgTempat.classList.remove("hidden");
                                svgTempat.classList.add("block");
                                svgAway.classList.add("hidden");
                                svgAway.classList.remove("block");
                                boxMeja.classList.remove("hidden");
                                boxMeja.classList.add("flex");
                                spanTempat.classList.remove("text-gray-700");
                                spanTempat.classList.add("text-primary-400");
                                spanAway.classList.add("text-gray-700");
                                spanAway.classList.remove("text-primary-400");
                                inputMeja.value = data.pesanan.no_meja;
                            } else if (jenis === 'Take Away') {
                                svgTempat.classList.add("hidden");
                                svgTempat.classList.remove("block");
                                svgAway.classList.remove("hidden");
                                svgAway.classList.add("block");
                                boxMeja.classList.remove("flex");
                                boxMeja.classList.add("hidden");
                                spanTempat.classList.add("text-gray-700");
                                spanTempat.classList.remove("text-primary-400");
                                spanAway.classList.remove("text-gray-700");
                                spanAway.classList.add("text-primary-400");

                            }

                            if (metode === 'kris') {
                                inputKris.checked = true;
                                divKet.classList.remove('hidden');
                                document.getElementById('card-qris').classList.remove('border-gray-200', 'border');
                                document.getElementById('card-qris').classList.add('border-green-500', 'border-2');
                                // setTimeout(() => inputKeterangan.focus(), 10);
                                // inputKeterangan.focus();
                            } else if (metode === 'cash') {
                                divKet.classList.add('hidden');
                                inputCash.checked = true;
                                // inputUang.focus();
                                document.getElementById('card-cash').classList.remove('border-gray-200', 'border');
                                document.getElementById('card-cash').classList.add('border-green-500', 'border-2');
                                // setTimeout(() => inputUang.focus(), 10);
                            }


                            inputNama.value = data.pesanan.nama_pembeli;
                            inputEmail.value = data.pesanan.email_pembeli;
                            inputNohp.value = data.pesanan.no_hp;
                            inputCatatanPesanan.value = data.pesanan.catatan_pesanan;

                            totalHargaUtama = data.pesanan.total_harga;
                            txtHarga.textContent = formatRupiah(totalHargaUtama);

                        } else {
                            // 
                        }
                    });

            }
        });


        inputUang.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {

                const inputUangRaw = inputUang.value;
                const bayarBersih = inputUangRaw.replace(/\D/g, '');

                const nominal = parseInt(bayarBersih, 10);
                totalHarga = parseFloat(totalHargaUtama || 0);

                let kembalian = 0;

                if (isNaN(nominal) || nominal < totalHarga) {
                    alert(`Jumlah bayar tidak boleh kurang dari total: Rp ${totalHarga}`);
                    this.focus();
                } else {

                    kembalian = nominal - totalHarga;

                    txtHarga.textContent = formatRupiah(totalHargaUtama);
                    this.setAttribute('disabled', '');
                    this.classList.add('text-gray-200', 'ring-gray-200', 'border-green-300');
                    btnProses.removeAttribute('disabled');
                    btnProses.focus();
                    txtKembalian.textContent = formatRupiah(kembalian);


                    const hapusButtons = document.querySelectorAll('.hapus-btn');

                    console.log(hapusButtons);
                    document.querySelectorAll('.hapus-btn').forEach(btn => {
                        btn.disabled = true;
                        btn.classList.add('pointer-events-none', 'opacity-50');
                    });

                }
            }
        });

    });


    document.addEventListener('DOMContentLoaded', function() {

        const svgTempat = document.getElementById("svgTempat");
        const svgAway = document.getElementById("svgAway");
        const options = document.querySelectorAll("input[name='option']");
        const optionsDua = document.querySelectorAll("input[name='option-dua']");
        const inputMeja = document.getElementById("inputMeja");
        const spanAway = document.getElementById("spanAway");
        const spanTempat = document.getElementById("spanTempat");
        const inputUang = document.getElementById('jumlah-uang');
        const divKet = document.getElementById('div-keterangan');
        const inputKeterangan = document.getElementById('input-keterangan');

        const btnKunci = document.getElementById('btn-kunci');
        const btnBukaKunci = document.getElementById('btn-buka-kunci');
        const daftarMenu = document.getElementById('daftar-menu');
        const daftarDetail = document.getElementById('detail-pesanan');

        const divMetodeBayar = document.getElementById('div-metode-bayar');
        const divTotalHarga = document.getElementById('div-total-bayar');

        options.forEach(option => {
            option.addEventListener('change', () => {
                if (option.value === "ditempat") {
                    svgTempat.classList.remove("hidden");
                    svgTempat.classList.add("block");
                    svgAway.classList.add("hidden");
                    svgAway.classList.remove("block");
                    boxMeja.classList.remove("hidden");
                    boxMeja.classList.add("flex");
                    spanTempat.classList.remove("text-gray-700");
                    spanTempat.classList.add("text-primary-400");
                    spanAway.classList.add("text-gray-700");
                    spanAway.classList.remove("text-primary-400");
                    inputMeja.focus();
                } else {
                    svgTempat.classList.add("hidden");
                    svgTempat.classList.remove("block");
                    svgAway.classList.remove("hidden");
                    svgAway.classList.add("block");
                    boxMeja.classList.remove("flex");
                    boxMeja.classList.add("hidden");
                    spanTempat.classList.add("text-gray-700");
                    spanTempat.classList.remove("text-primary-400");
                    spanAway.classList.remove("text-gray-700");
                    spanAway.classList.add("text-primary-400");
                }
            });
        });


        optionsDua.forEach(optionDua => {
            optionDua.addEventListener('change', () => {
                if (optionDua.value === "cash") {
                    inputUang.removeAttribute('disabled');
                    divKet.classList.add('hidden');
                    setTimeout(() => inputUang.focus(), 10);
                    // inputUang.focus();
                    document.getElementById('card-cash').classList.remove('border-gray-200', 'border');
                    document.getElementById('card-cash').classList.add('border-green-500', 'border-2');

                    document.getElementById('card-qris').classList.add('border-gray-200', 'border');
                    document.getElementById('card-qris').classList.remove('border-green-500', 'border-2');
                } else {
                    // inputKeterangan.focus();
                    inputUang.setAttribute('disabled', 'true');
                    divKet.classList.remove('hidden');
                    setTimeout(() => inputKeterangan.focus(), 10);
                    document.getElementById('card-cash').classList.add('border-gray-200', 'border');
                    document.getElementById('card-cash').classList.remove('border-green-500', 'border-2');

                    document.getElementById('card-qris').classList.remove('border-gray-200', 'border');
                    document.getElementById('card-qris').classList.add('border-green-500', 'border-2');
                }
            });
        });


        btnKunci.addEventListener('click', function() {
            btnBukaKunci.removeAttribute('disabled');
            btnKunci.setAttribute('disabled', '');
            daftarMenu.classList.add('hidden');
            daftarDetail.classList.add('w-full');
            daftarDetail.classList.remove('w-3/4');
            divMetodeBayar.classList.remove('hidden');
            // divTotalHarga.classList.remove('hidden');
            const selectedId = document.getElementById('input-id-edit').value;
            loadKunciPesanan(selectedId, totalHargaUtama);
        });

        btnBukaKunci.addEventListener('click', function() {
            btnKunci.removeAttribute('disabled');
            btnBukaKunci.setAttribute('disabled', '');
            daftarMenu.classList.remove('hidden');
            daftarDetail.classList.remove('w-full');
            daftarDetail.classList.add('w-3/4');
            divMetodeBayar.classList.add('hidden');
            // divTotalHarga.classList.add('hidden');
            const selectedId = document.getElementById('input-id-edit').value;
            loadDetailPesanan(selectedId, totalHargaUtama);
        });

        document.getElementById('card-qris').addEventListener('click', function() {
            document.getElementById('input-keterangan').focus();
        });

        document.getElementById('card-cash').addEventListener('click', function() {
            document.getElementById('jumlah-uang').focus();
        });

        document.querySelectorAll('.btn-detail').forEach(button => {
            button.addEventListener('click', function() {
                const idPesanan = this.dataset.id;
                const nama = this.dataset.nama;

                const namaPemesan = document.getElementById('nama-preview');
                const nohpPreview = document.getElementById('nohp-preview');
                const emailPreview = document.getElementById('email-preview');
                const metodePreview = document.getElementById('metode-preview');
                const totalPreview = document.getElementById('total-preview');
                const tipePreview = document.getElementById('tipe-preview');
                const mejaPreview = document.getElementById('meja-preview');



                console.log("Detail diklik:");
                console.log("ID:", idPesanan);
                console.log("Nama:", nama);

                fetch('/webseafood/proses/data_pesanan_detail.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'selected_id=' + encodeURIComponent(idPesanan)
                    })
                    .then(response => response.json())
                    .then(data => {

                        const tbodyPreview = document.getElementById('table-body-preview');
                        tbodyPreview.innerHTML = '';

                        if (data.status === 'success') {

                            data.items.forEach((item, index) => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                <td class="px-6 py-1 text-xs text-center">${index + 1}</td>
                                <td class="px-6 py-1 text-xs text-center">${item.nama_menu}</td>
                                <td class="px-6 py-1 text-xs text-center">${item.catatan_detail}</td>
                                <td class="px-6 py-1 text-xs text-center">${item.qty}</td>
                                
                                `;
                                tbodyPreview.appendChild(row);
                            });

                            namaPemesan.textContent = data.pesanan.nama_pembeli;
                            nohpPreview.textContent = data.pesanan.no_hp;
                            emailPreview.textContent = data.pesanan.email_pembeli;
                            metodePreview.textContent = data.pesanan.metode_bayar;

                            totalPreview.textContent = "Rp. " + formatRupiah(data.pesanan.total_harga);
                            tipePreview.textContent = data.pesanan.jenis_pesanan;
                            mejaPreview.textContent = "No Meja : " + data.pesanan.no_meja;

                            // console.log(totalHarga);
                        } else {
                            tbodyPreview.innerHTML = `<tr><td colspan="5" class="py-2 text-sm text-center text-gray-600">Data tidak ditemukan.</td></tr>`;
                        }
                    });




            });
        });


    });
</script>