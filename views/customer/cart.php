<?php
include "./config/connect.php";



?>


<!--  -->

<div class="w-screen min-h-screen sm:w-[640px] relative overflow-y-scroll scrollbar-hide border border-t-0 border-gray-300 bg-white max-w-[640px]">

    <!-- header  -->
    <div class="shadow-xl h-16 fixed bg-slate-100 w-full flex sm:w-[640px] items-center justify-center">
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
    <div class="mt-20">

        <!-- tipe pesanan -->
        <div class="px-5">

            <div class="flex items-center justify-between w-full h-10 px-5 rounded-full bg-primary-400/40 ">
                <h3 class="text-xs font-semibold text-black sm:text-base">Tipe Pemesanan:</h3>
                <div class="flex items-center space-x-4">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="radio" name="option" value="ditempat" class="hidden peer">
                        <div class="flex items-center justify-center w-5 h-5 border-2 border-gray-700 rounded-full peer-checked:border-black">
                            <svg id="svgTempat" class="hidden size-4" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 0 35.979 35.979" xml:space="preserve">
                                <g>
                                    <path style="fill:#010002;" d="M26.84,6.252l-14.046,14.23L2.464,15.12l-1.98,3.815c-1.094,2.106-0.272,4.701,1.836,5.794 l12.094,6.277C14.46,31.03,35.979,9.232,35.979,9.232L32.92,6.211C31.23,4.545,28.509,4.563,26.84,6.252z" />
                                </g>
                            </svg>
                        </div>
                        <span class="text-xs text-black sm:text-base whitespace-nowrap">Makan ditempat</span>
                    </label>

                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="radio" name="option" value="ambil" class="hidden peer">
                        <div class="flex items-center justify-center w-5 h-5 border-2 border-gray-700 rounded-full peer-checked:border-black">

                            <svg id="svgAway" class="hidden size-4" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 0 35.979 35.979" xml:space="preserve">
                                <g>
                                    <path style="fill:#010002;" d="M26.84,6.252l-14.046,14.23L2.464,15.12l-1.98,3.815c-1.094,2.106-0.272,4.701,1.836,5.794 l12.094,6.277C14.46,31.03,35.979,9.232,35.979,9.232L32.92,6.211C31.23,4.545,28.509,4.563,26.84,6.252z" />
                                </g>
                            </svg>
                        </div>
                        <span class="text-xs text-black sm:text-base whitespace-nowrap">Take away</span>
                    </label>
                </div>
            </div>
            <p class="ml-5 text-xs italic text-black">*Silahkan pilih tipe pesanan anda</p>
            <div id="boxMeja" class="justify-center hidden mt-3">
                <div class="relative">
                    <input id="inputMeja" type="text" class="peer py-2.5 sm:py-3 px-4 ps-11 block w-32 border-2 border-gray-200 bg-white  rounded-full sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="No. Meja">
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
        <hr class="my-4 border-2">

        <!-- detail pesanan -->
        <div class="px-5">
            <div class="flex items-center justify-between">
                <h3 class="text-base font-semibold text-black">Item yang dipesan (<span id="cartQty" class="">0</span>)</h3>
                <a href="home" class="px-3 py-1 text-sm font-semibold bg-white border-2 rounded-lg border-primary-400 text-primary-400 hover:bg-primary-400/55">+ Tambah Item</a>
            </div>
            <hr class="my-2 border">
            <div id="cartContainer" class="flex flex-col gap-2 mt-5">



            </div>
        </div>
    </div>

    <!-- footer -->
    <div class=""></div>

    <!-- modal -->
    <div class=""></div>
</div>

<!-- JS -->
<script>
    const cart = JSON.parse(localStorage.getItem("cart")) || [];

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
            })
            .catch(error => console.error("Gagal mengambil data menu:", error));
    }


    function renderCart(menuData) {
        console.log("Memproses data untuk ditampilkan:", menuData);
        const cartContainer = document.getElementById("cartContainer");

        console.log("Cek data menu:", menuData);
        console.log("Cek item cart:", cart);

        if (!cartContainer) {
            console.error("Elemen cartContainer tidak ditemukan!");
            return;
        }
        cartContainer.innerHTML = "";

        cart.forEach(item => {
            const menu = menuData.find(m => m.id_menu == item.id_menu);
            if (!menu) {
                console.warn(`Menu dengan ID ${item.id_menu} tidak ditemukan di data menu.`);
                return;
            }

            const card = document.createElement("div");
            card.classList.add("border", "py-2", "px-4", "rounded-md", "border-2", "border-gray-500", "space-y-2");

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
                                <p class="text-sm text-gray-400 ${item.note ? "" : "italic"}">Catatan: ${item.note ? item.note : "Belum menambahkan catatan"}</p>
                            </div>
                        <p class="text-sm font-semibold">${formatRupiah(menu.harga.toLocaleString())}</p>
                    </div>
                    <div class="flex flex-col w-20">
                        <button type="button" class="inline-flex items-center justify-center gap-1 px-3 text-sm border border-gray-400 rounded-full">
                            <svg fill="currentColor" class="text-gray-400 size-5" viewBox="0 0 16 16">
                                <path d="M13.8 2.2a2.51 2.51 0 0 0-3.54 0l-6.9 6.91-1.76 3.62a1.26 1.26 0 0 0 1.12 1.8 1.23 1.23 0 0 0 .55-.13l3.62-1.76 6-6 .83-.82.06-.06a2.52 2.52 0 0 0 .02-3.56zm-.89.89a1.25 1.25 0 0 1 0 1.77l-1.77-1.77a1.24 1.24 0 0 1 .86-.37 1.22 1.22 0 0 1 .91.37zM2.73 13.27 4.29 10 6 11.71zm4.16-2.4L5.13 9.11 10.26 4 12 5.74z" />
                            </svg>
                            Ubah
                        </button>
                        <div class="flex gap-4 mt-3 btn-group" id="">
                            <button type="button" class="inline-flex items-center justify-center">
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
                            <p class="inline-flex items-center justify-center w-12">0</p>
                            <button type="button" class="inline-flex items-center justify-center">
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

    document.addEventListener('DOMContentLoaded', function() {
        updateCheckoutQty();
        const svgTempat = document.getElementById("svgTempat");
        const svgAway = document.getElementById("svgAway");
        const options = document.querySelectorAll("input[name='option']");
        const inputMeja = document.getElementById("inputMeja");

        options.forEach(option => {
            option.addEventListener('change', () => {
                if (option.value === "ditempat") {
                    svgTempat.classList.remove("hidden");
                    svgTempat.classList.add("block");
                    svgAway.classList.add("hidden");
                    svgAway.classList.remove("block");
                    boxMeja.classList.remove("hidden");
                    boxMeja.classList.add("flex");
                    inputMeja.focus();
                } else {
                    svgTempat.classList.add("hidden");
                    svgTempat.classList.remove("block");
                    svgAway.classList.remove("hidden");
                    svgAway.classList.add("block");
                    boxMeja.classList.remove("flex");
                    boxMeja.classList.add("hidden");
                }
            });
        });



    });

    function updateCheckoutQty() {

        let cartQty = document.getElementById("cartQty");
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        let totalQty = cart.reduce((sum, item) => sum + item.qty, 0);
        cartQty.textContent = totalQty;
    }

    function formatRupiah(angka) {
        let formatted = new Intl.NumberFormat('id-ID').format(angka);
        return `Rp. ${formatted},-`;
    }

    // function cekInput() {
    //     let input = document.getElementById("myInput");
    //     if (!input.value) {
    //         alert("Input wajib diisi!");
    //     } else {
    //         alert("Input valid!");
    //     }
    // }
</script>