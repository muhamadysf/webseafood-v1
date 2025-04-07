<?php

// 
?>



<!-- Preloader Container -->
<div id="preloader" class="fixed inset-0 z-50 flex flex-col items-center justify-center gap-3 bg-white opacity-100 fade-out">
    <div class="flex items-center justify-center rounded-full w-28 h-28 animate-pulse-scale">
        <img src="./public/assets/images/logo.png" class="w-24 h-auto" alt="logo">
    </div>
    <div class="text-xl font-semibold text-center text-black">Mohon tunggu sebentar...</div>
</div>


<!-- Halaman Utama -->
<div class="hidden" id="main-content">
    <!-- Konten website kamu di sini -->
</div>



<!-- Optional Script untuk menyembunyikan preloader -->
<script>
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
    });
</script>