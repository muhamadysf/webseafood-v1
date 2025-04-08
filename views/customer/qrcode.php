<?php

// 
?>



<!-- Preloader Container -->
<div id="preloader" class="fixed inset-0 z-[999999] flex flex-col items-center justify-center gap-3 bg-white opacity-100 fade-out">
    <div class="flex items-center justify-center rounded-full w-28 h-28 animate-pulse-scale">
        <img src="./public/assets/images/logo.png" class="w-24 h-auto" alt="logo">
    </div>
    <div class="text-xl font-semibold text-center text-black">Mohon tunggu sebentar...</div>
</div>


<!-- halaman -->
<div id="main-content" class="w-screen  min-h-screen sm:w-[640px] relative overflow-y-scroll scrollbar-hide border border-t-0 border-gray-300 bg-white max-w-[640px]">

    <!-- header  -->
    <div class="shadow-xl h-16 fixed bg-slate-100 w-full z-50 flex sm:w-[640px] items-center justify-center rounded-b-xl">
        <div class="flex justify-center flex-1">
            <h1 class="text-2xl font-semibold">Pesanan Dibuat</h1>
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
                    <svg class=" size-5" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--emojione" preserveAspectRatio="xMidYMid meet">
                        <circle cx="32" cy="32" r="30" fill="#4bd37b"></circle>
                        <path fill="#ffffff" d="M46 14L25 35.6l-7-7.2l-7 7.2L25 50l28-28.8z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- qrcode -->
        <div id="qrcode" class="flex justify-center py-4"></div>

        <div id="error-msg" class="hidden text-red-500">Data pesanan tidak ditemukan.</div>

        <div class="">
            <p class="mb-5 text-sm text-center text-black">Tunjukkan QR ini pada kasir</p>
            <p class="text-center text-black">Silahkan menuju ke kasir untuk melakukan pembayaran.</p>
        </div>

    </div>

    <!-- footer -->
    <div class="fixed bottom-0 w-full sm:w-[640px] bg-slate-100 shadow-2xl rounded-t-xl px-5 pt-3 pb-5">

        <div class="flex flex-col items-center justify-between gap-5">
            <div class="flex justify-between w-full">
                <h3 class="text-sm font-semibold text-black ">Total Pembayaran</h3>
                <p id="total-bayar" class="text-sm font-semibold text-primary-400">XXX</p>
            </div>
            <div class="flex justify-center w-full">
                <a href="home" class="w-full px-4 py-2 font-semibold text-center text-white transition-all rounded-lg bg-primary-400 hover:bg-primary-550">
                    Buat Pesanan Baru
                </a>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // 1. Setelah semua konten terload, hapus cart dalam 3 detik
        setTimeout(() => {
            localStorage.removeItem("cart");
            console.log("Cart dihapus dari localStorage");
        }, 3000);

        // 2. Ganti history sebelumnya menjadi halaman utama
        history.replaceState(null, "", "/webseafood/"); // ganti '/' dengan path halaman utamamu jika perlu
    });

    // 3. Deteksi jika halaman dibuka ulang dari cache saat gesture back
    window.addEventListener("pageshow", function(event) {
        if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
            // Halaman dibuka ulang dari cache, redirect ke home
            window.location.href = "/webseafood/"; // ganti '/' sesuai kebutuhanmu
        }
    });

    // ===============================================================

    window.addEventListener("load", function() {
        setTimeout(() => {

            const toast = document.getElementById('preloader');

            if (toast) {
                toast.classList.remove("opacity-100");
                toast.classList.add("opacity-0");
            } else {
                console.log('Element with ID "toast" not found');
            }

            setTimeout(() => {
                toast.classList.add("hidden");
            }, 500);
        }, 5000);

        // const cart = getCart();

        // if (cart.length === 0 || !cart.some(item => item.id_menu)) {
        //     window.location.href = "home";
        // }
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

        const totalBayar = document.getElementById("total-bayar");

        totalBayar.textContent = formatRupiah(totalHarga);
    }

    // ===============================================================

    const cart = getCart();

    // ===============================================================

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

    // ===============================================================

    // if (cart.length === 0) return alert("Keranjang masih kosong!");

    const encodedCart = JSON.stringify(cart);

    // localStorage.removeItem("cart");


    const qrcodeDiv = document.getElementById("qrcode");
    qrcodeDiv.innerHTML = "";

    new QRCode(qrcodeDiv, {
        text: encodedCart,
        width: 200,
        height: 200,
    });

    // cart = [];

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


        // ========================================================================

    });
</script>