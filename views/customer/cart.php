<?php
include "./config/connect.php";

function formatRupiah($angka)
{
    return "Rp. " . number_format($angka, 0, ',', '.') . ',-';
}

?>


<!--  -->

<div x-data="{ modalEdit:false, modalNote: false, modalDetail: false,
    selectId: null,
    selectImg: null,
    selectNama: null,
    selectHarga: null,
}" class="w-screen min-h-screen sm:w-[640px] relative overflow-y-scroll scrollbar-hide border border-t-0 border-gray-300 bg-white max-w-[640px]">

    <!-- header  -->
    <div class="shadow-xl h-16 fixed bg-slate-100 w-full z-50 flex sm:w-[640px] items-center justify-center rounded-b-xl">
        <a href="home" class="p-2 ml-5 bg-white rounded-full w-9 h-9">
            <svg fill="currentColor" class="shrink-0 size-5" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg">
                <path d="M222.927 580.115l301.354 328.512c24.354 28.708 20.825 71.724-7.883 96.078s-71.724 20.825-96.078-7.883L19.576 559.963a67.846 67.846 0 01-13.784-20.022 68.03 68.03 0 01-5.977-29.488l.001-.063a68.343 68.343 0 017.265-29.134 68.28 68.28 0 011.384-2.6 67.59 67.59 0 0110.102-13.687L429.966 21.113c25.592-27.611 68.721-29.247 96.331-3.656s29.247 68.721 3.656 96.331L224.088 443.784h730.46c37.647 0 68.166 30.519 68.166 68.166s-30.519 68.166-68.166 68.166H222.927z" />
            </svg>
        </a>
        <div class="flex justify-center flex-1">
            <h1 class="text-2xl font-semibold -translate-x-10">Pesanan</h1>
        </div>
    </div>

    <!-- main content -->
    <div id="main-content" class="pb-24 full-cart">

        <!-- tipe pesanan -->
        <div class="px-5 pt-20 pb-4 bg-primary-400">

            <div class="flex items-center justify-between w-full h-10 px-5 bg-white border-transparent rounded-full ">
                <h3 class="text-xs font-semibold text-black sm:text-base">Tipe Pemesanan :</h3>
                <div class="flex items-center space-x-2 sm:space-x-4">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="radio" name="option" value="ditempat" class="hidden peer">
                        <div class="flex items-center justify-center w-5 h-5 border-2 border-gray-700 rounded-full ">
                            <svg id="svgTempat" class="hidden size-4 text-primary-400" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 0 35.979 35.979" xml:space="preserve">
                                <g>
                                    <path style="fill:currentColor;" d="M26.84,6.252l-14.046,14.23L2.464,15.12l-1.98,3.815c-1.094,2.106-0.272,4.701,1.836,5.794 l12.094,6.277C14.46,31.03,35.979,9.232,35.979,9.232L32.92,6.211C31.23,4.545,28.509,4.563,26.84,6.252z" />
                                </g>
                            </svg>
                        </div>
                        <span id="spanTempat" class="text-xs text-gray-700 sm:text-base whitespace-nowrap">Makan ditempat</span>
                    </label>

                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="radio" name="option" value="ambil" class="hidden peer">
                        <div class="flex items-center justify-center w-5 h-5 border-2 border-gray-700 rounded-full ">

                            <svg id="svgAway" class="hidden size-4 text-primary-400" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 0 35.979 35.979" xml:space="preserve">
                                <g>
                                    <path style="fill:currentColor;" d="M26.84,6.252l-14.046,14.23L2.464,15.12l-1.98,3.815c-1.094,2.106-0.272,4.701,1.836,5.794 l12.094,6.277C14.46,31.03,35.979,9.232,35.979,9.232L32.92,6.211C31.23,4.545,28.509,4.563,26.84,6.252z" />
                                </g>
                            </svg>
                        </div>
                        <span id="spanAway" class="text-xs text-gray-700 sm:text-base whitespace-nowrap">Take away</span>
                    </label>
                </div>
            </div>
            <p class="mt-3 ml-5 text-xs italic text-center text-white">*Silahkan pilih tipe pesanan anda</p>
            <div id="boxMeja" class="justify-center hidden mt-3">
                <div class="relative">
                    <input oninput="this.value = this.value.replace(/[^0-9]/g, '')" id="inputMeja" type="text" class="peer py-2.5 sm:py-3 px-4 ps-11 block w-32 border-2 border-gray-200 bg-white  rounded-full sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="No. Meja" maxlength="2">
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
        <hr class="mb-4 border-2">

        <!-- menu terkait -->
        <div class="relative px-5">
            <h3 class="text-base font-semibold text-black">Menu Terkait</h3>
            <hr class="mt-2 border">
            <div id="" class="flex h-full gap-2 py-4 overflow-x-auto select-none menu-container-card scroll-smooth snap-x snap-mandatory cursor-grab active:cursor-grabbing">

                <?php
                $mquery = mysqli_query($conn, "SELECT * FROM tb_menu GROUP BY id_kategori LIMIT 4");
                while ($mrow = mysqli_fetch_assoc($mquery)) {
                ?>
                    <button type="button" class="card-detail flex user-select-none flex-none shadow-lg rounded-lg bg-white border h-24 w-60 min-w-[240px] snap-start items-center"
                        data-id="<?php echo $mrow['id_menu'] ?>"
                        data-nama="<?php echo $mrow['nama_menu'] ?>"
                        data-img="<?php echo $mrow['gambar_menu'] ?>"
                        data-harga="<?php echo $mrow['harga'] ?>"
                        @click="modalDetail=true;
                                selectId = $el.dataset.id;
                                selectImg = $el.dataset.img;
                                selectNama = $el.dataset.nama;
                                selectHarga = $el.dataset.harga;">
                        <img src="<?php echo $mrow['gambar_menu'] ?>" alt="gambar_menu" class="object-cover m-2 size-20 rounded-xl shrink-0">
                        <div class="flex flex-col justify-between flex-1 gap-3 px-2">
                            <p class="text-base font-semibold text-left"><?php echo $mrow["nama_menu"] ?></p>
                            <p class="text-sm text-left text-gray-700"><?php echo formatRupiah($mrow["harga"]) ?></p>
                        </div>
                    </button>
                <?php  } ?>
            </div>
        </div>

        <hr class="mb-4 border-2">

        <!-- detail pesanan -->
        <div class="px-5">
            <div class="flex items-center justify-between">
                <h3 class="text-base font-semibold text-black">Item yang dipesan (<span id="cartQty" class="">0</span>)</h3>
                <a href="home" class="px-3 py-1 text-sm font-semibold bg-white border-2 rounded-lg border-primary-400 text-primary-400 hover:bg-primary-400/55">+ Tambah Item</a>
            </div>
            <hr class="my-2 border">
            <div id="cartContainer" class="flex flex-col gap-2 my-5"></div>
            <hr class="my-2 border">
            <button id="add-note" type="button" @click="modalNote = true" class="inline-flex items-center w-full ml-5 border-l-4 border-l-primary-400/40">
                <svg class="text-gray-400 size-8" viewBox="0 0 24 24" fill="none">
                    <g id="File / Note_Edit">
                        <path id="Vector" d="M10.0002 4H7.2002C6.08009 4 5.51962 4 5.0918 4.21799C4.71547 4.40973 4.40973 4.71547 4.21799 5.0918C4 5.51962 4 6.08009 4 7.2002V16.8002C4 17.9203 4 18.4801 4.21799 18.9079C4.40973 19.2842 4.71547 19.5905 5.0918 19.7822C5.5192 20 6.07899 20 7.19691 20H16.8031C17.921 20 18.48 20 18.9074 19.7822C19.2837 19.5905 19.5905 19.2839 19.7822 18.9076C20 18.4802 20 17.921 20 16.8031V14M16 5L10 11V14H13L19 8M16 5L19 2L22 5L19 8M16 5L19 8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </g>
                </svg>
                <span id="note-lain" class="ml-2 text-gray-400"></span>
            </button>
        </div>

        <hr class="my-4 border-2">

        <!-- rincian harga -->
        <div class="px-5">
            <div class="w-full px-5 py-2 border-2 border-gray-400 rounded-md">
                <h2 class="text-lg font-semibold text-center text-black">Rincian Pembayaran</h2>
                <div class="flex flex-col gap-1">
                    <div class="flex justify-between">
                        <p class="text-sm font-semibold text-black">Subtotal <span class="font-medium text-gray-400"> ( <span id="total-menu" class=""></span> menu )</span></p>
                        <p class="text-sm font-semibold text-black txt-total"></p>
                    </div>
                    <hr class="border-t-2 border-gray-400 border-dotted">
                    <div class="">
                        <p class="">
                            <button type="button" class="flex items-center justify-between w-full text-sm font-semibold text-black border border-transparent rounded-lg hs-collapse-toggle gap-x-1 decoration-2 hover:text-gray-800 focus:outline-hidden focus:text-gray-800 disabled:opacity-50 disabled:pointer-events-none" id="hs-show-hide-collapse" aria-expanded="false" aria-controls="hs-show-hide-collapse-heading" data-hs-collapse="#hs-show-hide-collapse-heading">
                                <div class="flex items-center">
                                    <span class="hs-collapse-open:hidden ">Biaya lainnya</span>
                                    <span class="hidden hs-collapse-open:block">Biaya lainnya</span>
                                    <svg class="mt-1 hs-collapse-open:rotate-180 shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6"></path>
                                    </svg>
                                </div>
                                <p class="text-sm font-semibold text-black">Rp. 0,-</p>
                            </button>
                        </p>
                        <div id="hs-show-hide-collapse-heading" class="hs-collapse hidden w-full overflow-hidden transition-[height] duration-300" aria-labelledby="hs-show-hide-collapse">
                            <hr class="mt-1 border-t-2 border-gray-400 border-dotted">
                            <div class="flex items-center justify-between my-2 text-gray-500">
                                <p class="ml-3 text-sm">Pajak Bangunan 1</p>
                                <p class="text-sm">Rp. 0,-</p>
                            </div>
                        </div>
                    </div>
                    <hr class="border-t-2 border-gray-400 border-dotted">
                    <div class="flex justify-between pb-6">
                        <p class="text-sm font-semibold text-black">Total</p>
                        <p class="text-sm font-semibold text-black txt-total">Rp. xxxxxxxx</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- mode keranjang kosong -->
    <div id="empty-cart" class="flex-col items-center justify-center hidden min-h-screen px-12">
        <div class="flex flex-col items-center justify-center flex-1 w-full text-center">
            <img src="public/assets/images/cart-empty.jpg" alt="keranjang kosong" class="rounded-full size-52">
            <h1 class="mt-5 text-base font-semibold text-black sm:text-xl">Anda belum memilih menu pesanan</h1>
            <p class="mt-5 text-xs text-black sm:text-sm">Silahkan pilih menu yang ingin Anda pesan dihalaman utama.</p>
        </div>
        <a href="home" class="inline-flex items-center justify-center w-full py-2 mb-12 text-xl text-white rounded-lg bg-primary-400/55 hover:bg-primary-400">Menu Utama</a>
    </div>

    <!-- footer -->
    <div class="full-cart shadow-xl h-20 bottom-0 fixed bg-slate-100 w-full flex sm:w-[640px] items-center justify-center px-5 py-2 rounded-lg">
        <div class="flex-1">
            <p class="text-sm text-gray-400">Total Pembayaran</p>
            <h3 class="text-xl font-semibold text-black txt-total"></h3>
        </div>
        <div class="">
            <a href="checkout" id="btn-checkout" class="px-3 py-2 text-white rounded-lg bg-primary-550/85">Lanjut Pembayaran</a>
        </div>
    </div>

    <!-- Backdrop modal -->
    <div x-show="modalEdit || modalNote || modalDetail" x-cloak class="fixed inset-0 z-[998] bg-black/85  sm:inline-flex sm:mx-auto"
        x-transition.opacity>
    </div>

    <!-- modal catatan tambahan-->
    <div x-show="modalNote" x-cloak
        class="fixed inset-0 flex items-end justify-center z-[999] overflow-hidden"
        x-transition:enter="transform transition ease-out duration-300"
        x-transition:enter-start="translate-y-full opacity-0"
        x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transform transition ease-in duration-300"
        x-transition:leave-start="translate-y-0 opacity-100"
        x-transition:leave-end="translate-y-full opacity-0">
        <div class="relative bg-white shadow-lg w-screen h-72 sm:w-[600px] pt-2 rounded-t-3xl">

            <!-- Tombol Close (X) -->
            <button id="btn-note-close" @click="modalNote = false;" class="absolute text-gray-500 top-2 right-2 hover:text-gray-800 z-[99999]">
                <svg class="w-12 h-12 text-white/50" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.1" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" fill="#000000" />
                    <path d="M8.96967 8.96967C9.26256 8.67678 9.73744 8.67678 10.0303 8.96967L12 10.9394L13.9697 8.96969C14.2626 8.6768 14.7374 8.6768 15.0303 8.96969C15.3232 9.26258 15.3232 9.73746 15.0303 10.0304L13.0607 12L15.0303 13.9696C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0304 15.0303C9.73746 15.3232 9.26258 15.3232 8.96969 15.0303C8.6768 14.7374 8.6768 14.2626 8.96969 13.9697L10.9394 12L8.96967 10.0303C8.67678 9.73744 8.67678 9.26256 8.96967 8.96967Z" fill="#000000" />
                </svg>
            </button>

            <div class="flex flex-col h-full gap-5 p-5">
                <h1 class="mb-2 text-xl font-semibold text-black">Catatan Lainnya...</h1>
                <textarea name="catatan" id="hs-autoheight-textarea-note" class="flex-1 block w-full px-4 py-2 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" rows="3" placeholder="Catatan tambahan..." data-hs-textarea-auto-height='{"defaultHeight": 72}'></textarea>
                <button id="btn-tambah-note" type="button" class="w-full py-2 text-white rounded-lg bg-primary-550 hover:font-semibold"></button>
            </div>
        </div>
    </div>


    <!-- modal edit pesanan-->
    <div x-show="modalEdit" x-cloak
        class="fixed inset-0 flex items-center justify-center z-[999] overflow-hidden"
        x-transition:enter="transform transition ease-out duration-300"
        x-transition:enter-start="translate-y-full opacity-0"
        x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transform transition ease-in duration-300"
        x-transition:leave-start="translate-y-0 opacity-100"
        x-transition:leave-end="translate-y-full opacity-0">
        <div id="modal-container" class="relative bg-white shadow-lg w-screen min-h-screen sm:w-[640px]">
            <!-- Tombol Close (X) -->
            <button id="btn-close" @click="modalEdit = false;" class="absolute text-white top-2 right-2  z-[99999]">
                <svg class="w-12 h-12 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="1" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" fill="currentColor" />
                    <path d="M8.96967 8.96967C9.26256 8.67678 9.73744 8.67678 10.0303 8.96967L12 10.9394L13.9697 8.96969C14.2626 8.6768 14.7374 8.6768 15.0303 8.96969C15.3232 9.26258 15.3232 9.73746 15.0303 10.0304L13.0607 12L15.0303 13.9696C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0304 15.0303C9.73746 15.3232 9.26258 15.3232 8.96969 15.0303C8.6768 14.7374 8.6768 14.2626 8.96969 13.9697L10.9394 12L8.96967 10.0303C8.67678 9.73744 8.67678 9.26256 8.96967 8.96967Z" fill="#000000" />
                </svg>
            </button>
            <div class="">
                <!-- header modal -->
                <div class="flex items-center">
                    <img id="modal-img" src="" class="object-cover w-full sm:h-[484px] h-80 min-h-80" alt="menu_img">
                </div>

                <div id="konten-modal" class="absolute bottom-0 left-0 w-full bg-white rounded-t-3xl">
                    <!-- Konten Modal -->
                    <div id="" class="w-full py-4 divide-y-4 divide-gray-200 ">
                        <div class="mb-2 px-7">
                            <h1 id="nama-menu" class="mb-1 text-2xl text-black"></h1>
                            <h3 id="harga-menu" class="text-lg font-semibold text-black"></h3>
                        </div>
                        <div class="mb-2 px-7">
                            <label for="hs-autoheight-textarea" class="block mt-4 mb-2 text-lg font-semibold sm:text-xl">Catatan :</label>
                            <textarea name="catatan" id="hs-autoheight-textarea" class="block w-full px-4 py-2 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" rows="3" placeholder="Opsional..." data-hs-textarea-auto-height='{"defaultHeight": 72}'></textarea>

                        </div>
                    </div>

                    <!-- footer modal -->
                    <div class="flex flex-col justify-end h-full gap-3 px-4 pt-3 pb-8 bg-slate-100 rounded-t-3xl">
                        <div class="flex justify-between">
                            <p class="">Jumlah Pesanan : </p>
                            <div class="flex gap-4">
                                <button id="min-qty" type="button" class="inline-flex items-center justify-center">
                                    <svg class="shrink-0 size-5" viewBox="0 0 32 32" version="1.1">
                                        <defs></defs>
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                            <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-516.000000, -1087.000000)" fill="#000000">
                                                <path d="M532,1117 C524.268,1117 518,1110.73 518,1103 C518,1095.27 524.268,1089 532,1089 C539.732,1089 546,1095.27 546,1103 C546,1110.73 539.732,1117 532,1117 L532,1117 Z M532,1087 C523.163,1087 516,1094.16 516,1103 C516,1111.84 523.163,1119 532,1119 C540.837,1119 548,1111.84 548,1103 C548,1094.16 540.837,1087 532,1087 L532,1087 Z M538,1102 L526,1102 C525.447,1102 525,1102.45 525,1103 C525,1103.55 525.447,1104 526,1104 L538,1104 C538.553,1104 539,1103.55 539,1103 C539,1102.45 538.553,1102 538,1102 L538,1102 Z" id="minus-circle" sketch:type="MSShapeGroup">

                                                </path>
                                            </g>
                                        </g>
                                    </svg>
                                </button>
                                <p id="modal-qty" class="inline-flex items-center justify-center w-12"></p>
                                <button id="plus-qty" type="button" class="inline-flex items-center justify-center">
                                    <svg class="shrink-0 size-5" viewBox="0 0 32 32" version="1.1">
                                        <defs></defs>
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
                            <button id="btn-perbarui" type="button" class="inline-flex items-center justify-center w-full px-3 py-2 font-medium text-white border border-transparent rounded-lg bg-primary-500 gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none">Perbarui Pesanan <span id="total-harga-edit" class=""></span></button>
                            <button @click="modalEdit = false;" id="btn-hapus" type="button" class="items-center justify-center hidden w-full px-3 py-2 font-medium text-white border border-transparent rounded-lg bg-primary-300 gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none">Hapus pesanan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal detail -->
    <div x-show="modalDetail" x-cloak
        class="fixed inset-0 flex items-center justify-center z-[999] overflow-hidden"
        x-transition:enter="transform transition ease-out duration-300"
        x-transition:enter-start="translate-y-full opacity-0"
        x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transform transition ease-in duration-300"
        x-transition:leave-start="translate-y-0 opacity-100"
        x-transition:leave-end="translate-y-full opacity-0">
        <div class="relative bg-white shadow-lg w-screen min-h-screen sm:w-[640px]">
            <!-- Tombol Close (X) -->
            <button id="btn-close-detail" @click="modalDetail = false;  selectId= null; selectImg = null; selectNama = null; selectHarga = null;" class="absolute text-gray-500 top-2 right-2 hover:text-gray-800 z-[99999]">
                <svg class="w-12 h-12 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="1" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" fill="currentColor" />
                    <path d="M8.96967 8.96967C9.26256 8.67678 9.73744 8.67678 10.0303 8.96967L12 10.9394L13.9697 8.96969C14.2626 8.6768 14.7374 8.6768 15.0303 8.96969C15.3232 9.26258 15.3232 9.73746 15.0303 10.0304L13.0607 12L15.0303 13.9696C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0304 15.0303C9.73746 15.3232 9.26258 15.3232 8.96969 15.0303C8.6768 14.7374 8.6768 14.2626 8.96969 13.9697L10.9394 12L8.96967 10.0303C8.67678 9.73744 8.67678 9.26256 8.96967 8.96967Z" fill="#000000" />
                </svg>
            </button>
            <div class="">
                <!-- header modal -->
                <div class="flex items-center">
                    <img id="modal-img-detail" :src="selectImg" class="object-cover w-full sm:h-[484px] h-80 min-h-80" alt="menu_img">
                </div>

                <div id="konten-modal-detail" class="absolute bottom-0 left-0 w-full bg-white rounded-t-3xl">
                    <!-- Konten Modal -->
                    <div id="" class="w-full py-4 divide-y-4 divide-gray-200 ">
                        <div class="mb-2 px-7">
                            <h1 id="nama-menu-detail" class="mb-1 text-2xl text-black" x-text="selectNama"></h1>
                            <h3 id="harga-menu-detail" class="text-lg font-semibold text-black" x-text="formatRupiah(selectHarga)"></h3>
                        </div>
                        <div class="mb-2 px-7">
                            <label for="catatan-menu-detail" class="block mt-4 mb-2 text-lg font-semibold sm:text-xl">Catatan :</label>
                            <textarea name="catatan" id="catatan-menu-detail" class="block w-full px-4 py-2 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" rows="3" placeholder="Opsional..." data-hs-textarea-auto-height='{"defaultHeight": 72}'></textarea>

                        </div>
                    </div>

                    <!-- footer modal -->
                    <div class="flex flex-col justify-end h-full gap-3 px-4 pt-3 pb-8 bg-slate-100 rounded-t-3xl">
                        <div class="flex justify-between">
                            <p class="">Jumlah Pesanan : </p>
                            <div class="flex gap-4">
                                <button id="min-qty-detail" type="button" class="inline-flex items-center justify-center">
                                    <svg class="shrink-0 size-5" viewBox="0 0 32 32" version="1.1">
                                        <defs></defs>
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                            <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-516.000000, -1087.000000)" fill="#000000">
                                                <path d="M532,1117 C524.268,1117 518,1110.73 518,1103 C518,1095.27 524.268,1089 532,1089 C539.732,1089 546,1095.27 546,1103 C546,1110.73 539.732,1117 532,1117 L532,1117 Z M532,1087 C523.163,1087 516,1094.16 516,1103 C516,1111.84 523.163,1119 532,1119 C540.837,1119 548,1111.84 548,1103 C548,1094.16 540.837,1087 532,1087 L532,1087 Z M538,1102 L526,1102 C525.447,1102 525,1102.45 525,1103 C525,1103.55 525.447,1104 526,1104 L538,1104 C538.553,1104 539,1103.55 539,1103 C539,1102.45 538.553,1102 538,1102 L538,1102 Z" id="minus-circle" sketch:type="MSShapeGroup">

                                                </path>
                                            </g>
                                        </g>
                                    </svg>
                                </button>
                                <p id="modal-qty-detail" class="inline-flex items-center justify-center w-12"></p>
                                <button id="plus-qty-detail" type="button" class="inline-flex items-center justify-center">
                                    <svg class="shrink-0 size-5" viewBox="0 0 32 32" version="1.1">
                                        <defs></defs>
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
                            <button id="btn-tambah-detail" type="button" class="inline-flex items-center justify-center w-full px-3 py-2 font-medium text-white border border-transparent rounded-lg bg-primary-500 gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none">Tambah Pesanan <span id="total-harga-detail" class="text-white"></span></button>
                            <button @click="modalDetail = false;  selectId= null; selectImg = null; selectNama = null; selectHarga = null;" id="btn-batal" type="button" class="items-center justify-center hidden w-full px-3 py-2 font-medium text-white border border-transparent rounded-lg bg-primary-300 gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none">Kembali Ke Menu</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- JS -->
<script>
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    const emptyCart = document.getElementById("empty-cart");
    const btnClose = document.getElementById("btn-close");
    const btnNoteClose = document.getElementById("btn-note-close");
    const fullCart = document.getElementsByClassName("full-cart");
    const modalAddNote = document.getElementById("add-note");

    const btnCheckout = document.getElementById("btn-checkout");

    let dataDB = [];

    // ====================================================================

    if (cart.length === 0 || !cart.some(item => item.id_menu)) {
        window.location.href = "home";
    }

    if (cart.length > 0) {

        const idMenus = cart.map(item => item.id_menu).join(',');

        fetch(`/webseafood/proses/get_menu_cart.php?ids=${idMenus}`)
            .then(response => response.json())
            .then(menuData => {
                console.log("Data dari server:", menuData);
                renderCart(menuData);
                dataDB = menuData;
                updateCheckoutQty();
            })
            .catch(error => console.error("Gagal mengambil data menu:", error));
    }

    function renderCart(menuData) {

        const cartContainer = document.getElementById("cartContainer");

        if (!cartContainer) {
            console.error("Elemen cartContainer tidak ditemukan!");
            return;
        }
        cartContainer.innerHTML = "";

        const validCart = cart.filter(item => item.id_menu);

        validCart.forEach(item => {
            const menu = menuData.find(m => m.id_menu == item.id_menu);

            if (!menu) {
                console.warn(`Menu dengan ID ${item.id_menu} tidak ditemukan di data menu.`);
                return;
            }

            const card = document.createElement("div");
            card.classList.add("border", "py-2", "px-4", "rounded-md", "border-2", "border-gray-500", "space-y-2", "box-Card");
            card.setAttribute("data-id", item.id_menu);

            card.innerHTML = `
            <div class="flex">
                    <div class="flex flex-col flex-1 gap-2">
                        <h3 class="text-lg font-medium">${menu.nama_menu}</h3>
                        <div class="flex items-center">
                                <svg class="mr-1 text-gray-400 size-5" width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.6601 10.44L20.6801 14.62C19.8401 18.23 18.1801 19.69 15.0601 19.39C14.5601 19.35 14.0201 19.26 13.4401 19.12L11.7601 18.72C7.59006 17.73 6.30006 15.67 7.28006 11.49L8.26006 7.30001C8.46006 6.45001 8.70006 5.71001 9.00006 5.10001C10.1701 2.68001 12.1601 2.03001 15.5001 2.82001L17.1701 3.21001C21.3601 4.19001 22.6401 6.26001 21.6601 10.44Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M15.06 19.39C14.44 19.81 13.66 20.16 12.71 20.47L11.13 20.99C7.15998 22.27 5.06997 21.2 3.77997 17.23L2.49997 13.28C1.21997 9.30998 2.27997 7.20998 6.24997 5.92998L7.82997 5.40998C8.23997 5.27998 8.62997 5.16998 8.99997 5.09998C8.69997 5.70998 8.45997 6.44998 8.25997 7.29998L7.27997 11.49C6.29997 15.67 7.58998 17.73 11.76 18.72L13.44 19.12C14.02 19.26 14.56 19.35 15.06 19.39Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M12.64 8.53003L17.49 9.76003" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M11.66 12.4L14.56 13.14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <p class="text-xs sm:text-sm text-gray-400 ${item.note ? "" : "italic"}">${item.note ? "Catatan: " + item.note : "Belum menambahkan catatan"}</p>
                            </div>
                        <p class="text-sm font-semibold txt-harga">${formatRupiah((menu.harga.toLocaleString())*item.qty)}</p>
                    </div>
                    <div class="flex flex-col justify-between w-20">
                        <button @click="modalEdit = true" type="button" class="inline-flex items-center justify-center gap-1 px-3 text-sm border-2 border-gray-400 rounded-full btn-ubah hover:bg-gray-200">
                            <svg fill="currentColor" class="text-gray-400 size-5" viewBox="0 0 16 16">
                                <path d="M13.8 2.2a2.51 2.51 0 0 0-3.54 0l-6.9 6.91-1.76 3.62a1.26 1.26 0 0 0 1.12 1.8 1.23 1.23 0 0 0 .55-.13l3.62-1.76 6-6 .83-.82.06-.06a2.52 2.52 0 0 0 .02-3.56zm-.89.89a1.25 1.25 0 0 1 0 1.77l-1.77-1.77a1.24 1.24 0 0 1 .86-.37 1.22 1.22 0 0 1 .91.37zM2.73 13.27 4.29 10 6 11.71zm4.16-2.4L5.13 9.11 10.26 4 12 5.74z" />
                            </svg>
                            Ubah
                        </button>
                        <div class="flex gap-4 mt-3 btn-group" data-id=${item.id_menu}>
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
                            <p class="inline-flex items-center justify-center w-12 qty-item">${item.qty}</p>
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
                    </div>
                </div>
            
        `;
            cartContainer.appendChild(card);
        });


    }

    function updateHarga() {
        const menuData = dataDB;
        const cart = JSON.parse(localStorage.getItem("cart")) || [];

        const validCart = cart.filter(item => item.id_menu);
        validCart.forEach(item => {
            const menu = menuData.find(m => m.id_menu == item.id_menu);

            if (!menu) {
                console.warn(`Menu dengan ID ${item.id_menu} tidak ditemukan di data menu.`);
                return;
            }

            let hargaSatuan = menu.harga.toLocaleString();

        });

    }

    function checkRadioOption(event) {
        const radioButtons = document.querySelectorAll('input[name="option"]');
        const radio = document.querySelector('input[name="option"]:checked');
        let isChecked = false;

        radioButtons.forEach(radio => {
            if (radio.checked) {
                isChecked = true;
            }
        });

        if (!isChecked) {
            event.preventDefault();
            alert("Silakan pilih salah satu opsi: Makan ditempat atau Take away.");
            return false;
        } else {
            if (radio.value === "ditempat") {
                const inputMeja = document.getElementById("inputMeja");
                let data = inputMeja.value;
                if (data == "") {
                    event.preventDefault();
                    alert("Silakan isi nomor meja terlebih dahulu.");
                    inputMeja.focus();
                    return false;
                }
            }
        }

        return true;
    }

    function updateCheckoutQty() {

        let cartQty = document.getElementById("cartQty");
        let totalMenu = document.getElementById("total-menu");
        let txtTotal = document.getElementsByClassName("txt-total");

        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        let dataDBS = dataDB;

        let totalHarga = 0;

        const validCart = cart.filter(item => item.id_menu);
        validCart.forEach(item => {
            let menu = dataDBS.find(m => m.id_menu == item.id_menu);
            if (menu) {
                let subTotal = menu.harga * item.qty;
                totalHarga += subTotal;
            }
        });

        let totalQty = validCart.reduce((sum, item) => sum + item.qty, 0);
        let qtyMenu = validCart.length;

        cartQty.textContent = totalQty;
        totalMenu.textContent = qtyMenu;
        txtTotal[0].textContent = formatRupiah(totalHarga);
        txtTotal[1].textContent = formatRupiah(totalHarga);
        txtTotal[2].textContent = formatRupiah(totalHarga);

    }

    function formatRupiah(angka) {
        let formatted = new Intl.NumberFormat('id-ID').format(angka);
        return `Rp. ${formatted},-`;
    }


    // ===========================================================================

    const slider = document.querySelector('.menu-container-card');
    let isDown = false;
    let startX;
    let scrollLeft;

    slider.addEventListener('mousedown', (e) => {
        isDown = true;
        slider.classList.add('dragging');
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;

        // Cegah seleksi teks saat drag
        e.preventDefault();
    });

    slider.addEventListener('mouseleave', () => {
        isDown = false;
        slider.classList.remove('dragging');
    });

    slider.addEventListener('mouseup', () => {
        isDown = false;
        slider.classList.remove('dragging');
    });

    slider.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 1.5; // kecepatan scroll
        slider.scrollLeft = scrollLeft - walk;
    });

    // ===========================================================================


    document.addEventListener("click", function(event) {
        let button = event.target.closest("button");
        if (!button) return;

        if (button.classList.contains("btn-kurang")) {
            let card = button.closest(".box-Card");
            if (!card) return;

            let idMenu = card.getAttribute("data-id");
            let textQty = card.querySelector(".qty-item");
            let textHarga = card.querySelector(".txt-harga");

            let cart = JSON.parse(localStorage.getItem("cart")) || [];


            let itemIndex = cart.findIndex(item => item.id_menu === idMenu);
            let menu = dataDB.find(m => m.id_menu == idMenu);

            if (itemIndex !== -1) {
                cart[itemIndex].qty -= 1;

                if (cart[itemIndex].qty <= 0) {
                    cart.splice(itemIndex, 1);
                    card.remove();
                } else {
                    textQty.textContent = cart[itemIndex].qty;
                    textHarga.textContent = formatRupiah((menu.harga.toLocaleString()) * cart[itemIndex].qty);
                }

                localStorage.setItem("cart", JSON.stringify(cart));

            }

            updateCheckoutQty();

            const tidakAdaIdMenu = !cart.some(item => item.hasOwnProperty("id_menu"));

            if (tidakAdaIdMenu) {
                cart = [];
                localStorage.setItem("cart", JSON.stringify(cart));

                emptyCart.classList.remove("hidden");
                emptyCart.classList.add("flex");

                fullCart[0].classList.add("hidden");
                fullCart[1].classList.add("hidden");
            }
        }

        if (button.classList.contains("btn-tambah")) {
            let card = button.closest(".box-Card");
            if (!card) return;

            let idMenu = card.getAttribute("data-id");
            let textQty = card.querySelector(".qty-item");
            let textHarga = card.querySelector(".txt-harga");

            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            let itemIndex = cart.findIndex(item => item.id_menu === idMenu);
            let menu = dataDB.find(m => m.id_menu == idMenu);

            if (itemIndex !== -1) {
                cart[itemIndex].qty += 1;
                textQty.textContent = cart[itemIndex].qty;
                localStorage.setItem("cart", JSON.stringify(cart));
                textHarga.textContent = formatRupiah((menu.harga.toLocaleString()) * cart[itemIndex].qty);
            }

            updateCheckoutQty();
        }

        if (button.classList.contains("btn-ubah")) {
            let card = button.closest(".box-Card");
            if (!card) return;

            let idMenu = card.getAttribute("data-id");

            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            let itemIndex = cart.findIndex(item => item.id_menu === idMenu);

            let menu = dataDB.find(m => m.id_menu == idMenu);

            let modalImg = document.getElementById("modal-img");
            let modalNote = document.getElementById("hs-autoheight-textarea");
            let modalNama = document.getElementById("nama-menu");
            let modalHarga = document.getElementById("harga-menu");
            let modalQty = document.getElementById("modal-qty");
            let modalTotalEdit = document.getElementById("total-harga-edit");
            let modalMinQty = document.getElementById("min-qty");
            let modalPlusQty = document.getElementById("plus-qty");



            if (itemIndex !== -1) {
                modalImg.src = "/webseafood/" + menu.gambar_menu;
                modalNama.textContent = menu.nama_menu;
                modalNote.value = cart[itemIndex].note;
                modalQty.textContent = cart[itemIndex].qty;
                modalHarga.textContent = formatRupiah(menu.harga);
                modalTotalEdit.textContent = formatRupiah(menu.harga * cart[itemIndex].qty);
            }
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        updateCheckoutQty();
        const svgTempat = document.getElementById("svgTempat");
        const svgAway = document.getElementById("svgAway");
        const options = document.querySelectorAll("input[name='option']");
        const inputMeja = document.getElementById("inputMeja");
        const spanAway = document.getElementById("spanAway");
        const spanTempat = document.getElementById("spanTempat");

        const noteLain = document.getElementById("note-lain");

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

        let cart = JSON.parse(localStorage.getItem("cart")) || [];

        const note = cart.find(item => item.hasOwnProperty("addnote"))?.addnote || "";

        const tidakAdaNote = !cart.some(item => item.hasOwnProperty("addnote"));
        if (tidakAdaNote) {
            noteLain.textContent = "Tambah catatan lainnya...";
        } else {
            noteLain.textContent = note;
        }


    });

    btnClose.addEventListener("click", function() {
        document.getElementById("hs-autoheight-textarea").value = "";
    });

    btnNoteClose.addEventListener("click", function() {
        let modalNoteAdd = document.getElementById("hs-autoheight-textarea-note");

        const noteLain = document.getElementById("note-lain");
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        const note = cart.find(item => item.hasOwnProperty("addnote"))?.addnote || "Tambah catatan lainnya...";

        noteLain.textContent = note;
    });

    modalAddNote.addEventListener("click", function() {
        const btnTbhNote = document.getElementById("btn-tambah-note");
        const btnNoteLain = document.getElementById("note-lain");

        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        const adaAddnote = cart.some(item => item.hasOwnProperty("addnote"));

        const note = cart.find(item => item.hasOwnProperty("addnote"))?.addnote || "";

        if (adaAddnote) {

            btnTbhNote.textContent = "Perbarui Catatan";
        } else {
            btnTbhNote.textContent = "Tambahkan Catatan";
        }

        btnTbhNote.addEventListener("click", function() {

            let noteAddModal = document.getElementById("hs-autoheight-textarea-note");
            let modalNoteAdd = noteAddModal.value;
            let spanNoteLain = document.getElementById("note-lain");


            const indexNote = cart.findIndex(item => item.hasOwnProperty("addnote"));
            if (modalNoteAdd === "") {

                if (indexNote !== -1) {
                    cart.splice(indexNote, 1);
                }
            } else {

                if (indexNote !== -1) {

                    cart[indexNote].addnote = modalNoteAdd;
                } else {

                    cart.push({
                        addnote: modalNoteAdd
                    });
                }
            }



            localStorage.setItem("cart", JSON.stringify(cart));

            document.getElementById("btn-note-close").click();
        });

    });

    btnCheckout.addEventListener("click", function(e) {
        checkRadioOption(e);

        const radioDitempat = document.querySelector('input[name="option"][value="ditempat"]');
        const inputMeja = document.getElementById("inputMeja");
        const radio = document.querySelector('input[name="option"]:checked');

        let cart = JSON.parse(localStorage.getItem("cart")) || [];

        if (radio) {
            const value = radio.value;

            cart = cart.filter(item => !item.hasOwnProperty("tipe"));

            if (value === "ditempat") {
                const nomorMeja = inputMeja.value;
                cart.push({
                    tipe: "ditempat",
                    nomor_meja: nomorMeja
                });

            } else if (value === "ambil") {
                cart.push({
                    tipe: "ambil"
                });
            }

            localStorage.setItem("cart", JSON.stringify(cart));

        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const cardsDetail = document.querySelectorAll('.card-detail');

        cardsDetail.forEach(card => {
            card.addEventListener('click', function() {
                const idMenu = this.getAttribute('data-id');
                const hargaMenu = this.getAttribute('data-harga');

                const imgDetail = document.getElementById('modal-img-detail');
                const namaDetail = document.getElementById('nama-menu-detail');
                const hargaDetail = document.getElementById('harga-menu-detail');
                const cD = document.getElementById('catatan-menu-detail');


                const qtyDetail = document.getElementById('modal-qty-detail');
                const totalHargaDetail = document.getElementById('total-harga-detail');

                const minQtyDetail = document.getElementById('min-qty-detail');
                const plusQtyDetail = document.getElementById('plus-qty-detail');

                const btnTambahDetail = document.getElementById('btn-tambah-detail');

                const btnBatal = document.getElementById('btn-batal');
                const btnCloseDetail = document.getElementById('btn-close-detail');

                let dQty = 1;

                qtyDetail.textContent = dQty;

                totalHargaDetail.textContent = formatRupiah(hargaMenu * dQty);

                plusQtyDetail.addEventListener('click', function() {

                    if (dQty === 0) {
                        btnBatal.classList.add("hidden");
                        btnBatal.classList.remove("flex");

                        btnTambahDetail.classList.add("inline-flex");
                        btnTambahDetail.classList.remove("hidden");
                    }

                    dQty += 1;
                    qtyDetail.textContent = dQty;

                    totalHargaDetail.textContent = formatRupiah(hargaMenu * dQty);

                });

                minQtyDetail.addEventListener('click', function() {

                    if (dQty > 0) {
                        dQty -= 1;
                        qtyDetail.textContent = dQty;
                    }

                    if (dQty === 0) {
                        btnBatal.classList.remove("hidden");
                        btnBatal.classList.add("flex");

                        btnTambahDetail.classList.remove("inline-flex");
                        btnTambahDetail.classList.add("hidden");
                    }
                    totalHargaDetail.textContent = formatRupiah(hargaMenu * dQty);
                });

                btnCloseDetail.addEventListener('click', function() {
                    catatanDetail.value = "";
                });

                btnTambahDetail.addEventListener('click', function() {

                    const cart = JSON.parse(localStorage.getItem("cart")) || [];

                    const itemDitemukan = cart.find(item => item.id_menu === idMenu);
                    const catatanDetail = cD.value;

                    if (itemDitemukan) {

                        itemDitemukan.qty += dQty;

                        if (itemDitemukan.note) {
                            itemDitemukan.note += " | " + catatanDetail;
                        } else {
                            itemDitemukan.note = catatanDetail;
                        }
                    } else {
                        cart.push({
                            id_menu: idMenu,
                            qty: dQty,
                            note: catatanDetail,
                        });
                    }

                    localStorage.setItem("cart", JSON.stringify(cart));
                    window.location.href = window.location.href;
                });

            });
        });
    });
</script>