<!-- Informasi pembeli -->
<?php
include "./config/connect.php"

?>

<div class="w-screen min-h-screen sm:w-[640px] relative overflow-y-scroll scrollbar-hide border border-t-0 border-gray-300 bg-white max-w-[640px]">

    <!-- header  -->
    <div class="shadow-xl h-16 fixed bg-slate-100 w-full z-50 flex sm:w-[640px] items-center justify-center rounded-b-xl">
        <a href="cart" class="p-2 ml-5 bg-white rounded-full w-9 h-9">
            <svg fill="currentColor" class="shrink-0 size-5" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg">
                <path d="M222.927 580.115l301.354 328.512c24.354 28.708 20.825 71.724-7.883 96.078s-71.724 20.825-96.078-7.883L19.576 559.963a67.846 67.846 0 01-13.784-20.022 68.03 68.03 0 01-5.977-29.488l.001-.063a68.343 68.343 0 017.265-29.134 68.28 68.28 0 011.384-2.6 67.59 67.59 0 0110.102-13.687L429.966 21.113c25.592-27.611 68.721-29.247 96.331-3.656s29.247 68.721 3.656 96.331L224.088 443.784h730.46c37.647 0 68.166 30.519 68.166 68.166s-30.519 68.166-68.166 68.166H222.927z" />
            </svg>
        </a>
        <div class="flex justify-center flex-1">
            <h1 class="text-2xl font-semibold -translate-x-10">Pembayaran</h1>
        </div>
    </div>

    <!-- main content -->
    <div id="main-content" class="pb-24 full-cart">

        <!-- tipe pesanan -->
        <div class="px-5 pt-20 pb-4 bg-white">
            <div class="flex items-center justify-between w-full h-10 px-5 border-2 bg-primary-400/25 rounded-xl border-primary-500 ">
                <h3 class="text-xs font-normal text-black sm:text-base">Tipe Pemesanan :</h3>
                <div class="flex items-center space-x-2 sm:space-x-4">
                    <span id="span-mode-psn" class="text-xs font-semibold text-gray-700 sm:text-base whitespace-nowrap"></span>
                    <div class="flex items-center justify-center w-5 h-5 border-2 border-gray-700 rounded-full ">
                        <svg class="text-black size-4" version="1.1" id="Capa_1" viewBox="0 0 35.979 35.979" xml:space="preserve">
                            <g>
                                <path style="fill:currentColor;" d="M26.84,6.252l-14.046,14.23L2.464,15.12l-1.98,3.815c-1.094,2.106-0.272,4.701,1.836,5.794 l12.094,6.277C14.46,31.03,35.979,9.232,35.979,9.232L32.92,6.211C31.23,4.545,28.509,4.563,26.84,6.252z" />
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <hr class="mb-4 border-2">

        <!-- metode bayar -->
        <div class="w-full px-5">
            <h3 class="text-base font-semibold">Metode Pembayaran</h3>
            <div class="flex items-center justify-center gap-6 my-3">
                <div id="card-qris" class="px-4 py-2 border border-gray-200 rounded-lg shadow-xl select-none">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="radio" name="option" value="kris" class=" peer">
                        <img src="public/assets/images/qr.png" alt="kris" class="object-cover size-12 ">
                        <span class="text-xs text-gray-700 sm:text-base whitespace-nowrap">Qris</span>
                    </label>
                </div>
                <div id="card-cash" class="px-4 py-2 border border-gray-200 rounded-lg shadow-xl select-none">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="radio" name="option" value="cash" class=" peer">
                        <img src="public/assets/images/cash.png" alt="cash" class="object-cover size-12">
                        <span class="text-xs text-gray-700 sm:text-base whitespace-nowrap">Cash</span>
                    </label>
                </div>
            </div>
        </div>
        <hr class="mb-4 border-2">


        <!-- informasi pembayaran -->
        <div class="flex flex-col px-5 mt-5">
            <div class="">
                <h3 class="font-semibold sm:text-base">Informasi Pembeli</h3>
                <p class="text-[10px] sm:text-sm italic">*Data digunakan untuk proses pemesanan agar tidak tertukar.</p>
            </div>
            <div class="self-center w-full max-w-sm mt-2 space-y-1 sm:space-y-3">


                <div class="relative">
                    <input type="text" class="peer py-2.5 sm:py-3 border-2 border-gray-200 px-4 ps-11 block w-full bg-white  rounded-full sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Nama Lengkap / Panggilan">
                    <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                        <svg class="text-gray-500 shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>


                    </div>
                </div>

                <div class="relative">
                    <input type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="peer py-2.5 sm:py-3 px-4 ps-11 block border-2 border-gray-200 w-full bg-white  rounded-full sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Nomor Telepon/WA">
                    <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">

                        <svg class="text-gray-500 shrink-0 size-4" width="24" height="24" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <defs>
                            </defs>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Dribbble-Light-Preview" transform="translate(-300.000000, -7599.000000)" fill="currentColor">
                                    <g id="icons" transform="translate(56.000000, 160.000000)">
                                        <path d="M259.821,7453.12124 C259.58,7453.80344 258.622,7454.36761 257.858,7454.53266 C257.335,7454.64369 256.653,7454.73172 254.355,7453.77943 C251.774,7452.71011 248.19,7448.90097 248.19,7446.36621 C248.19,7445.07582 248.934,7443.57337 250.235,7443.57337 C250.861,7443.57337 250.999,7443.58538 251.205,7444.07952 C251.446,7444.6617 252.034,7446.09613 252.104,7446.24317 C252.393,7446.84635 251.81,7447.19946 251.387,7447.72462 C251.252,7447.88266 251.099,7448.05372 251.27,7448.3478 C251.44,7448.63589 252.028,7449.59418 252.892,7450.36341 C254.008,7451.35771 254.913,7451.6748 255.237,7451.80984 C255.478,7451.90987 255.766,7451.88687 255.942,7451.69881 C256.165,7451.45774 256.442,7451.05762 256.724,7450.6635 C256.923,7450.38141 257.176,7450.3464 257.441,7450.44643 C257.62,7450.50845 259.895,7451.56477 259.991,7451.73382 C260.062,7451.85686 260.062,7452.43903 259.821,7453.12124 M254.002,7439 L253.997,7439 L253.997,7439 C248.484,7439 244,7443.48535 244,7449 C244,7451.18666 244.705,7453.21526 245.904,7454.86076 L244.658,7458.57687 L248.501,7457.3485 C250.082,7458.39482 251.969,7459 254.002,7459 C259.515,7459 264,7454.51465 264,7449 C264,7443.48535 259.515,7439 254.002,7439" id="whatsapp-[#128]">
                                        </path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                </div>

                <div class="relative">
                    <input type="text" class="peer py-2.5 sm:py-3 px-4 ps-11 block border-2 border-gray-200 w-full bg-white  rounded-full sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Email">
                    <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                        <svg class="text-gray-500 shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- footer -->
    <div class="fixed bottom-0 w-full sm:w-[640px] bg-slate-100 shadow-2xl rounded-t-xl px-5 pt-3 pb-5">
        <div id="collapseContent" class="mb-2 overflow-hidden transition-all duration-300 ease-in-out max-h-0">
            <div class="p-4 bg-white rounded-lg shadow">
                <div class="flex flex-col gap-1">
                    <div class="flex justify-between">
                        <p class="text-sm font-semibold text-black">Subtotal</p>
                        <p id="p-subtotal" class="text-sm font-semibold text-black txt-total"></p>
                    </div>
                    <hr class="border-t-2 border-gray-400 border-dotted">
                    <div class="flex justify-between pb-2">
                        <p class="text-sm font-semibold text-black">Pajak Bangunan 1</p>
                        <p id="p-pajak" class="text-sm font-semibold text-black txt-total">Rp. 0,-</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <div class="">
                <button id="toggleCollapse"
                    class="flex items-center gap-2 text-black transition">
                    <span>Total Pembayaran</span>
                    <svg id="arrowIcon" class="w-4 h-4 transition-transform duration-300 ease-in-out transform rotate-0"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <h1 id="h1-total-bayar" class="text-xl font-semibold text-black"></h1>
            </div>
            <a href="qrcode" class="px-4 py-2 text-white rounded-lg bg-primary-500">
                Buat Pesanan
            </a>
        </div>
    </div>


</div>
<script>
    const toggleBtn = document.getElementById('toggleCollapse');
    const collapse = document.getElementById('collapseContent');
    const arrowIcon = document.getElementById('arrowIcon');

    let dataDB = [];

    let isOpen = false;

    toggleBtn.addEventListener('click', () => {
        isOpen = !isOpen;

        if (isOpen) {
            collapse.style.maxHeight = collapse.scrollHeight + "px";
            arrowIcon.classList.add("rotate-180");
        } else {
            collapse.style.maxHeight = "0px";
            arrowIcon.classList.remove("rotate-180");
        }
    });



    // ===============================================================

    function getCart() {
        return JSON.parse(localStorage.getItem("cart")) || [];
    }

    function saveCart(cart) {
        localStorage.setItem("cart", JSON.stringify(cart));
    }

    function formatRupiah(angka) {
        let formatted = new Intl.NumberFormat('id-ID').format(angka);
        return `Rp. ${formatted},-`;
    }

    function calcHarga(menuData) {


        const cart = getCart();
        const validCart = cart.filter(item => item.id_menu);
        let totalHarga = 0;

        validCart.forEach(item => {
            let menu = menuData.find(m => m.id_menu == item.id_menu);

            if (menu) {
                let subTotal = menu.harga * item.qty;
                totalHarga += subTotal;
            } else {
                console.log("Menu tidak ditemukan:", item.id_menu);
                console.log("Menu: ", menu);
            }
        });


        const textSubTotal = document.getElementById("p-subtotal");
        const totalBayar = document.getElementById("h1-total-bayar");

        textSubTotal.textContent = formatRupiah(totalHarga);
        totalBayar.textContent = formatRupiah(totalHarga);
    }


    // ===============================================================

    document.addEventListener("DOMContentLoaded", function() {
        const spanModePsn = document.getElementById("span-mode-psn");

        const cart = getCart();

        const modePsn = cart.find(item => item.hasOwnProperty("tipe"))?.tipe || "";
        const noMeja = cart.find(item => item.hasOwnProperty("nomor_meja"))?.nomor_meja || "";

        if (modePsn === "ambil") {
            spanModePsn.textContent = "Take Away";
        } else {
            spanModePsn.textContent = "Makan ditempat ( Meja : " + noMeja + ")";
        }

        // =============================================================================

        const cardQris = document.getElementById("card-qris");
        const cardCash = document.getElementById("card-cash");

        const options = document.querySelectorAll("input[name='option']");

        options.forEach(option => {
            option.addEventListener('change', function() {
                if (option.value === "kris") {
                    cardQris.classList.add("border-primary-400");
                    cardCash.classList.remove("border-primary-400");
                } else {
                    cardQris.classList.remove("border-primary-400");
                    cardCash.classList.add("border-primary-400");
                }
            });
        });

        // =============================================================================




        if (cart.length > 0) {
            const idMenus = cart.map(item => item.id_menu).join(',');

            fetch(`/webseafood/proses/get_menu_cart.php?ids=${idMenus}`)
                .then(response => response.json())
                .then(menuData => {
                    console.log("Data dari server:", menuData);
                    calcHarga(menuData);
                })
                .catch(error => console.log("Gagal mengambil data menu: ", error));
        }

    });
</script>