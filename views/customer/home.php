<?php
include "./config/connect.php";


$kquery = mysqli_query($conn, "SELECT DISTINCT tk.id_kategori, tk.nama_kategori FROM tb_kategori tk JOIN tb_menu tm ON tk.id_kategori = tm.id_kategori");
while ($record = mysqli_fetch_array($kquery)) {
    $result[] = $record;
}

?>


<div x-data='{
  modalKategori: false,
  modal: false,
  selectedId: null,
  selectNama: null,
  selectHarga: null,
  selectImg: null,
  keranjang: false,
  cart: JSON.parse(localStorage.getItem("cart") || "{\"pemesanan\": [], \"info\": {}, \"pelanggan\": {}, \"catatan\": \"\"}")
}' x-init='
  cart = JSON.parse(localStorage.getItem("cart") || "{\"pemesanan\": [], \"info\": {}, \"pelanggan\": {}, \"catatan\": \"\"}");
  $store.keranjang = cart.pemesanan.length > 0;
  keranjang = cart.pemesanan.length > 0;
' class="w-screen min-h-screen sm:w-[640px] relative overflow-y-scroll scrollbar-hide border border-t-0 border-gray-300 bg-white">

    <?php include './partials/customer/header.php' ?>

    <img id="image" src="./public/assets/images/king.png" alt="header" class="object-cover w-full h-auto">

    <div id="labelKategori" class="w-full bg-slate-100 flex items-center justify-between sm:w-[640px] h-14 z-[997]">
        <div class="flex h-full px-2 py-2">
            <button id="" type="button" @click="modalKategori = true" class="inline-flex items-center px-3 py-2 text-xl font-medium text-black gap-x-2">
                <div class="p-1 rounded-full bg-slate-400">
                    <svg class="text-white shrink-0 size-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        <path d="M5 17H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        <path d="M5 7H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </div>
                <span class="hidden sm:flex">KATEGORI</span>
            </button>
            <hr class="w-[2px] h-full bg-gray-400">
        </div>
        <div id="overflow-container" class="flex items-center flex-1 w-full px-5 overflow-x-hidden text-white select-none scroll-container cursor-grab flex-nowrap">
            <div class="flex items-center justify-center gap-2 select-none scroll-content">

                <?php $no = 1;
                foreach ($result as $row) { ?>

                    <a href="#<?php echo $row['id_kategori'] ?>" class="px-2 py-1 text-center text-black bg-transparent border border-gray-600 rounded-full select-none whitespace-nowrap min-w-28"><?php echo $row['nama_kategori']; ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php foreach ($result as $row) {
        $kategori = $row['id_kategori']; ?>

        <div class="w-full px-6 py-8">
            <div class="flex items-center justify-center w-full gap-3">
                <h1 id="<?php echo $row['id_kategori'] ?>" class="text-2xl text-black whitespace-nowrap">
                    <?php echo $row['nama_kategori']; ?>
                </h1>
                <hr class="w-full bg-gray-400 h-[2px]">
            </div>
            <div class="flex flex-wrap justify-center w-full gap-2 mt-4">
                <?php
                $mquery = mysqli_query($conn, "SELECT * FROM tb_menu WHERE id_kategori = $kategori AND status_menu = 'Tersedia'");
                while ($rows = mysqli_fetch_array($mquery)) {
                ?>
                    <div class="h-56 max-w-sm overflow-hidden bg-white border border-gray-400 shadow-lg w-36 rounded-2xl sm:w-44">
                        <div data-id="<?php echo $rows['id_menu']; ?>"
                            data-nama="<?php echo $rows['nama_menu']; ?>"
                            data-harga="<?php echo $rows['harga']; ?>"
                            data-img="./<?php echo $rows['gambar_menu']; ?>"
                            @click="modal = true; selectedId = $el.dataset.id; selectNama = $el.dataset.nama; selectHarga = $el.dataset.harga; selectImg = $el.dataset.img;" class="w-full cursor-pointer menuItem">
                            <img class="object-cover object-center w-full h-32 min-h-32 " src="./<?php echo $rows['gambar_menu']; ?>" alt="Menu Image">
                            <div class="px-4 pt-2">
                                <h2 class="text-sm font-semibold text-gray-800"><?php echo $rows['nama_menu'] ?></h2>
                                <p class="mt-1 text-xs text-gray-600">Rp. <?php echo number_format($rows['harga'], 0, ',', '.') ?>, -</p>
                            </div>
                        </div>
                        <div class="flex-col w-full px-4 bg-white">
                            <div class="flex flex-col items-center justify-center w-full mt-auto">
                                <button @click="keranjang=true" type="button" class="hidden w-full px-4 py-[2px] mt-3 text-xs text-black border border-gray-600 transition bg-transparent rounded-full hover:text-white hover:bg-gray-500" data-id="<?php echo $rows['id_menu']; ?>">Tambah</button>
                                <div x-cloak class="flex gap-4 mt-3 btn-group" data-id="<?php echo $rows['id_menu']; ?>">
                                    <button type="button" class="inline-flex items-center justify-center">
                                        <svg class="shrink-0 size-5" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
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
                                    <p class="inline-flex items-center justify-center w-12">0</p>
                                    <button type="button" class="inline-flex items-center justify-center">
                                        <svg class="shrink-0 size-5" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
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
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php
    } ?>
    <!-- Backdrop modal -->
    <div x-show="modal || modalKategori" x-cloak class="fixed inset-0 z-[998] bg-black/85 sm:w-[640px] sm:inline-flex sm:mx-auto"
        x-transition.opacity>
    </div>


    <!-- Modal detail -->
    <div id="modal-induk" x-show="modal" x-cloak
        class="fixed inset-0 flex items-center justify-center z-[999] overflow-hidden"
        x-transition:enter="transform transition ease-out duration-300"
        x-transition:enter-start="translate-y-full opacity-0"
        x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transform transition ease-in duration-300"
        x-transition:leave-start="translate-y-0 opacity-100"
        x-transition:leave-end="translate-y-full opacity-0">
        <div id="modal-container" class="relative bg-white shadow-lg w-screen min-h-screen sm:w-[640px]">
            <!-- Tombol Close (X) -->
            <button id="btn-close" @click="modal = false; selectedId= null; selectNama= null; selectHarga= null; selectImg= null;" class="absolute text-gray-500 top-2 right-2 hover:text-gray-800 z-[99999]">
                <svg class="w-12 h-12 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="1" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" fill="currentColor" />
                    <path d="M8.96967 8.96967C9.26256 8.67678 9.73744 8.67678 10.0303 8.96967L12 10.9394L13.9697 8.96969C14.2626 8.6768 14.7374 8.6768 15.0303 8.96969C15.3232 9.26258 15.3232 9.73746 15.0303 10.0304L13.0607 12L15.0303 13.9696C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0304 15.0303C9.73746 15.3232 9.26258 15.3232 8.96969 15.0303C8.6768 14.7374 8.6768 14.2626 8.96969 13.9697L10.9394 12L8.96967 10.0303C8.67678 9.73744 8.67678 9.26256 8.96967 8.96967Z" fill="#000000" />
                </svg>
            </button>
            <div class="">
                <!-- header modal -->
                <div id="modal-img" class="flex items-center">
                    <img :src="selectImg" class="object-cover w-full h-80 min-h-80" alt="menu_img">
                </div>

                <div id="konten-modal" class="absolute bottom-0 left-0 w-full pb-5 bg-white rounded-t-3xl">
                    <!-- Konten Modal -->
                    <div id="" class="w-full py-4 divide-y-4 divide-gray-200 ">
                        <div class="mb-2 px-7">
                            <h1 class="mb-2 text-2xl text-black" x-text="selectNama"></h1>
                            <h3 class="text-lg font-semibold text-black" x-text="formatRupiah(selectHarga)"></h3>
                        </div>
                        <div class="mb-2 px-7">
                            <label for="hs-autoheight-textarea" class="block mt-4 mb-2 text-lg font-semibold sm:text-xl">Catatan :</label>
                            <textarea name="catatan" id="hs-autoheight-textarea" class="block w-full px-4 py-2 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" rows="3" placeholder="Opsional..." data-hs-textarea-auto-height='{"defaultHeight": 72}'></textarea>

                        </div>
                    </div>

                    <!-- footer modal -->
                    <div class="flex flex-col justify-end gap-3 px-4 py-3 bg-slate-100 rounded-t-3xl">
                        <div class="flex justify-between">
                            <p class="">Jumlah Pesanan : </p>
                            <div class="flex gap-4">
                                <button id="minQty" type="button" class="inline-flex items-center justify-center">

                                    <svg class="shrink-0 size-5" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">

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
                                <p id="modalQty" class="inline-flex items-center justify-center w-12"></p>
                                <button id="plusQty" type="button" class="inline-flex items-center justify-center">
                                    <svg class="shrink-0 size-5" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
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
                        </div>
                        <div class="w-full ">
                            <button id="btn-tambah" type="button" class="inline-flex items-center justify-center w-full px-3 py-2 font-medium text-white border border-transparent rounded-lg bg-primary-500 gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none">Tambah Pesanan <span id="totalHargaDetail" class=""></span></button>
                            <button @click="modal = false; selectedId= null;" id="btn-batal" type="button" class="items-center justify-center hidden w-full px-3 py-2 font-medium text-white border border-transparent rounded-lg bg-primary-300 gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none">Kembali Ke Menu</button>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal keranjang -->
    <a href="cart" id="modalcart" x-show="$store.keranjang" x-cloak
        class="fixed bottom-8 mt-8 left-1/2 translate-x-[-50%] shadow-lg items-center justify-center z-[997] overflow-hidden cursor-pointer"
        x-transition:enter="transform transition ease-out duration-300"
        x-transition:enter-start="translate-y-full opacity-0"
        x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transform transition ease-in duration-300"
        x-transition:leave-start="translate-y-0 opacity-100"
        x-transition:leave-end="translate-y-full opacity-0">
        <div class="relative bg-white shadow-lg w-[300px] h-16 sm:w-[500px] rounded-lg flex overflow-hidden border-gray-400 border">

            <div class="relative inline-flex items-center justify-center w-20 bg-primary-550">
                <p id="cartQty" class="absolute flex items-center justify-center w-5 h-5 text-xs text-white bg-red-500 rounded-full right-2 top-2">0</p>
                <svg class="mt-2 text-white w-9 h-9" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.29977 5H21L19 12H7.37671M20 16H8L6 3H3M9 20C9 20.5523 8.55228 21 8 21C7.44772 21 7 20.5523 7 20C7 19.4477 7.44772 19 8 19C8.55228 19 9 19.4477 9 20ZM20 20C20 20.5523 19.5523 21 19 21C18.4477 21 18 20.5523 18 20C18 19.4477 18.4477 19 19 19C19.5523 19 20 19.4477 20 20Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <div class="flex items-center justify-between w-full px-2 py-3 bg-white sm:pl-5">
                <div class="flex flex-col gap-1">
                    <p class="text-sm text-black">Total</p>
                    <p class="text-sm font-semibold text-black">Rp. <span id="totalHarga"></span>,-</p>
                </div>
                <div class="">
                    <h3 class="text-sm font-semibold text-black">CHECKOUT ( <span id="checkout">0</span> )</h3>
                    <p class="w-full text-xs text-black">untuk melanjutkan</p>
                </div>

            </div>
            <div class="flex items-center bg-slate-200">
                <svg class="size-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 5L14.15 10C14.4237 10.2563 14.6419 10.5659 14.791 10.9099C14.9402 11.2539 15.0171 11.625 15.0171 12C15.0171 12.375 14.9402 12.7458 14.791 13.0898C14.6419 13.4339 14.4237 13.7437 14.15 14L9 19" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </div>

    </a>

    <!-- modal kategori -->
    <div id="modal-induk" x-show="modalKategori" x-cloak
        class="fixed inset-0 flex items-end justify-center z-[999] overflow-hidden "
        x-transition:enter="transform transition ease-out duration-300"
        x-transition:enter-start="translate-y-full opacity-0"
        x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transform transition ease-in duration-300"
        x-transition:leave-start="translate-y-0 opacity-100"
        x-transition:leave-end="translate-y-full opacity-0">
        <div id="modal-container" class="relative bg-white shadow-lg w-screen min-h-80 sm:w-[500px] rounded-t-3xl py-5 px-5">
            <!-- Tombol Close (X) -->
            <div class="flex items-center justify-between w-full">
                <h1 class="text-2xl font-semibold">Kategori Menu</h1>
                <button id="btn-close" @click="modalKategori = false;" class=" text-gray-500  hover:text-gray-800 z-[99999]">
                    <svg class="w-12 h-12 text-white/50" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.1" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" fill="#000000" />
                        <path d="M8.96967 8.96967C9.26256 8.67678 9.73744 8.67678 10.0303 8.96967L12 10.9394L13.9697 8.96969C14.2626 8.6768 14.7374 8.6768 15.0303 8.96969C15.3232 9.26258 15.3232 9.73746 15.0303 10.0304L13.0607 12L15.0303 13.9696C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0304 15.0303C9.73746 15.3232 9.26258 15.3232 8.96969 15.0303C8.6768 14.7374 8.6768 14.2626 8.96969 13.9697L10.9394 12L8.96967 10.0303C8.67678 9.73744 8.67678 9.26256 8.96967 8.96967Z" fill="#000000" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-col gap-2 mt-7">
                <?php $no = 1;
                foreach ($result as $row) { ?>

                    <a href="#<?php echo $row['id_kategori'] ?>" @click="modalKategori = false;" class="px-2 py-3 text-center text-black bg-transparent border-2 select-none border-primary-400 hover:bg-primary-400 hover:text-white rounded-xl whitespace-nowrap min-w-28"><?php echo $row['nama_kategori']; ?></a>
                <?php } ?>
            </div>
        </div>
    </div>


    <?php require_once './partials/customer/footer.php'; ?>
</div>

<!-- footer -->



<!-- JS -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const header = document.getElementById("header");
        const image = document.getElementById("image");
        const labelKategori = document.getElementById("labelKategori");
        const judul = document.getElementById("judul");
        // const scrollContainer = document.getElementById("overflow-container");

        window.addEventListener("scroll", () => {
            const imgHeight = image.clientHeight;
            if (window.scrollY > imgHeight) {
                header.classList.add("bg-white", "shadow-lg", "text-black");
                header.classList.remove("bg-transparant", "text-black");
                judul.classList.remove('hidden');
            } else {
                header.classList.add("bg-transparant", "text-black");
                judul.classList.add('hidden');
                header.classList.remove("bg-white", "shadow-lg", "text-black");
            }


            let headerHeight = header.offsetHeight;
            let imageBottom = image.getBoundingClientRect().bottom;

            if (imageBottom <= headerHeight) {
                labelKategori.classList.add("fixed", "top-[52px]", "shadow-md", "left-1/2", "transform", "-translate-x-1/2");
            } else {
                labelKategori.classList.remove("fixed", "top-[52px]", "shadow-md", "left-1/2", "transform", "-translate-x-1/2");
            }
        });

        const slider = document.querySelector('.scroll-container');
        const links = document.querySelectorAll('.scroll-content a');

        let isDown = false;
        let startX;
        let scrollLeft;
        let isDragging = false;

        // Event untuk mouse (desktop)
        slider.addEventListener('mousedown', (e) => {
            isDown = true;
            isDragging = false;
            slider.classList.add('active');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });

        window.addEventListener('mouseup', () => {
            isDown = false;
            slider.classList.remove('active');
        });

        window.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            isDragging = true;
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 1;
            slider.scrollLeft = scrollLeft - walk;
        });

        // Event untuk touch (mobile)
        slider.addEventListener('touchstart', (e) => {
            isDown = true;
            isDragging = false;
            startX = e.touches[0].pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });

        slider.addEventListener('touchend', () => {
            isDown = false;
        });

        slider.addEventListener('touchmove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            isDragging = true;
            const x = e.touches[0].pageX - slider.offsetLeft;
            const walk = (x - startX) * 1;
            slider.scrollLeft = scrollLeft - walk;
        });

        // Mencegah klik link saat drag
        links.forEach(link => {
            link.addEventListener('click', (e) => {
                if (isDragging) {
                    e.preventDefault();
                }
            });
        });


    });

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener("click", function(e) {
            e.preventDefault();

            let targetID = this.getAttribute("href").substring(1);
            let target = document.getElementById(targetID);

            if (target) {
                let offset = 120;
                let targetPosition = target.getBoundingClientRect().top + window.scrollY - offset;

                window.scrollTo({
                    top: targetPosition,
                    behavior: "smooth"
                });
            }
        });
    });

    function formatRupiah(angka) {
        let formatted = new Intl.NumberFormat('id-ID').format(angka);
        return `Rp. ${formatted},-`;
    }

    document.addEventListener('alpine:init', () => {
        Alpine.store('keranjang', (JSON.parse(localStorage.getItem('cart')) || {
            pemesanan: [],
            info: {},
            pelanggan: {},
            catatan: ""
        }).length > 0);
    });

    document.addEventListener("DOMContentLoaded", fetchCartData);
    document.addEventListener("DOMContentLoaded", updateCheckoutQty);

    document.addEventListener("DOMContentLoaded", function() {

        let cart = JSON.parse(localStorage.getItem("cart")) || {
            pemesanan: [],
            info: {},
            pelanggan: {},
            catatan: ""
        };
        // const validCart = cart.filter(item => item.id_menu);
        let modalcart = null;

        document.querySelectorAll(".btn-group").forEach(function(group) {
            let menuId = group.getAttribute("data-id");
            let addButton = document.querySelector(`button[data-id="${menuId}"]`);
            let decrementBtn = group.children[0]; // Tombol (-)
            let quantityDisplay = group.children[1]; // Elemen <p>
            let incrementBtn = group.children[2]; // Tombol (+)


            // Cek apakah produk ada di localStorage
            let item = cart.pemesanan.find(item => item.id_menu === menuId);
            if (item) {
                quantityDisplay.textContent = item.qty;
                addButton.classList.add("hidden");
                group.classList.remove("hidden");
                group.classList.add("flex");
            } else {
                quantityDisplay.textContent = 0;
                addButton.classList.remove("hidden");
                group.classList.add("hidden");
            }

            // Saat tombol "Tambah" ditekan
            addButton.addEventListener("click", function() {
                cart.pemesanan.push({
                    id_menu: menuId,
                    qty: 1,
                    note: ""
                });
                localStorage.setItem("cart", JSON.stringify(cart));
                quantityDisplay.textContent = 1;
                addButton.classList.add("hidden");
                group.classList.remove("hidden");
                group.classList.add("flex");

                Alpine.store('keranjang', cart.pemesanan && cart.pemesanan.length > 0);
                fetchCartData();
                updateCheckoutQty();
            });

            // Saat tombol "+" ditekan
            incrementBtn.addEventListener("click", function() {
                let itemIndex = cart.pemesanan.findIndex(item => item.id_menu === menuId);
                if (itemIndex !== -1) {
                    cart.pemesanan[itemIndex].qty += 1;
                    localStorage.setItem("cart", JSON.stringify(cart));
                    quantityDisplay.textContent = cart.pemesanan[itemIndex].qty;
                }
                fetchCartData();
                updateCheckoutQty();
            });

            // Saat tombol "-" ditekan
            decrementBtn.addEventListener("click", function() {
                let itemIndex = cart.pemesanan.findIndex(item => item.id_menu === menuId);
                if (itemIndex !== -1) {
                    cart.pemesanan[itemIndex].qty -= 1;
                    if (cart.pemesanan[itemIndex].qty <= 0) {
                        cart.pemesanan.splice(itemIndex, 1); // Hapus produk dari localStorage jika qty 0
                        localStorage.setItem("cart", JSON.stringify(cart));
                        quantityDisplay.textContent = 0;
                        group.classList.add("hidden");
                        addButton.classList.remove("hidden");

                        // const tidakAdaIdMenu = !cart.pemesanan.some(item => item.hasOwnProperty("id_menu"));

                        // if (tidakAdaIdMenu) {
                        //     cart = cart.filter(item => !item.hasOwnProperty("addnote"));
                        //     localStorage.setItem("cart", JSON.stringify(cart));
                        // }

                        Alpine.store('keranjang', cart.pemesanan && cart.pemesanan.length > 0);
                    } else {
                        localStorage.setItem("cart", JSON.stringify(cart));
                        quantityDisplay.textContent = cart.pemesanan[itemIndex].qty;
                    }
                }



                fetchCartData();
                updateCheckoutQty();
            });

        });


    });



    async function fetchCartData() {

        let totalHarga = document.getElementById("totalHarga");
        let cart = JSON.parse(localStorage.getItem("cart")) || {
            pemesanan: [],
            info: {},
            pelanggan: {},
            catatan: ""
        };

        // const validCart = cart.filter(item => item.id_menu);

        if (cart.pemesanan.length === 0) {
            totalHarga.textContent = "";
            return;
        }

        try {
            let response = await fetch("views/customer/get_menu.php");

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            let menuData = await response.json();

            let totalHarga = 0;

            // const validCart = cart.filter(item => item.id_menu);
            cart.pemesanan.forEach(item => {
                let menu = menuData.find(menu => menu.id_menu === item.id_menu);
                if (menu) {
                    let subTotal = menu.harga * item.qty;
                    totalHarga += subTotal;
                }
            });

            document.getElementById("totalHarga").textContent = totalHarga.toLocaleString("id-ID");
        } catch (error) {
            console.error("Gagal mengambil data menu:", error);
        }
    }

    function updateCheckoutQty() {
        let spanQty = document.getElementById("checkout");
        let cartQty = document.getElementById("cartQty");
        let cart = JSON.parse(localStorage.getItem("cart")) || {
            pemesanan: [],
            info: {},
            pelanggan: {},
            catatan: ""
        };

        // const validCart = cart.filter(item => item.id_menu);


        let totalQty = cart.pemesanan.reduce((sum, item) => sum + item.qty, 0);
        spanQty.textContent = totalQty;
        cartQty.textContent = totalQty;
    }

    // Saat card diklik

    document.querySelectorAll(".menuItem").forEach(item => {
        item.addEventListener("click", function() {

            const cart = JSON.parse(localStorage.getItem("cart")) || {
                pemesanan: [],
                info: {},
                pelanggan: {},
                catatan: ""
            };

            const id_menu_cari = this.getAttribute("data-id");
            const harga = this.getAttribute("data-harga");

            console.log("ID Menu yang dipilih:", id_menu_cari);

            const modalQty = document.getElementById("modalQty");
            modalQty.textContent = 1;
            let vqty = parseInt(modalQty.textContent) || 0;


            const btnHargaTxt = document.getElementById("totalHargaDetail");
            const btnTambah = document.getElementById("btn-tambah");
            const btnBatal = document.getElementById("btn-batal");
            const btnClose = document.getElementById("btn-close");
            const catatan = document.getElementById("hs-autoheight-textarea");

            btnBatal.classList.add("hidden");
            btnBatal.classList.remove("inline-flex");
            btnTambah.classList.add("inline-flex");
            btnTambah.classList.remove("hidden");


            btnHargaTxt.textContent = formatRupiah(harga);

            const minQty = document.getElementById("minQty");
            const plusQty = document.getElementById("plusQty");


            const itemDitemukan = cart.pemesanan.find(item => item.id_menu == id_menu_cari);

            if (itemDitemukan) {
                catatan.value = itemDitemukan.note;
            } else {
                catatan.value = "";
            }



            plusQty.onclick = function() {
                vqty += 1;
                modalQty.textContent = vqty;
                btnHargaTxt.textContent = formatRupiah(harga * vqty);

                btnBatal.classList.add("hidden");
                btnBatal.classList.remove("inline-flex");
                btnTambah.classList.add("inline-flex");
                btnTambah.classList.remove("hidden");

            };


            minQty.onclick = function() {

                if (modalQty.textContent > 1) {
                    vqty -= 1;
                    modalQty.textContent = vqty;
                    btnHargaTxt.textContent = formatRupiah(harga * modalQty.textContent);
                } else {
                    vqty = 0;
                    modalQty.textContent = vqty;
                    btnBatal.classList.remove("hidden");
                    btnBatal.classList.add("inline-flex");
                    btnTambah.classList.remove("inline-flex");
                    btnTambah.classList.add("hidden");
                }

            };


            btnTambah.onclick = function() {

                if (itemDitemukan) {
                    itemDitemukan.qty += vqty;
                    itemDitemukan.note = catatan.value;

                } else {
                    cart.pemesanan.push({
                        id_menu: id_menu_cari,
                        qty: vqty,
                        note: catatan.value
                    });

                }
                localStorage.setItem("cart", JSON.stringify(cart));
                window.location.href = window.location.href;
            };

            btnBatal.addEventListener("click", function() {
                vqty = 0;
                modalQty.textContent = vqty;
            });

            btnClose.onclik = function() {
                vqty = 0;
                modalQty.textContent = vqty;
            };


        });
    });
</script>