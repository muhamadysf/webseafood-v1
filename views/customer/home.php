<?php
include "./config/connect.php";


$query = mysqli_query($conn, "SELECT * FROM tb_kategori");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}


?>


<div class="w-screen h-[2000px] sm:w-[640px] relative overflow-y-scroll scrollbar-hide border border-t-0 border-gray-300 bg-white">

    <?php include './partials/customer/header.php' ?>

    <img id="image" src="./public/assets/images/king.png" alt="header" class="object-cover w-full h-auto">

    <div id="labelKategori" class="w-full bg-slate-100 flex items-center justify-between sm:w-[640px] h-14">
        <div class="px-2 h-full flex py-2">
            <button id="" type="button" class="inline-flex items-center px-3 py-2 text-xl font-medium text-black gap-x-2">
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
        <div id="overflow-container" class="scroll-container flex items-center flex-1 w-full px-5 overflow-x-hidden select-none text-white cursor-grab flex-nowrap">
            <div class="flex items-center gap-2 scroll-content select-none justify-center">


                <?php $no = 1;
                foreach ($result as $row) { ?>

                    <a href="#" class="px-2 py-2 bg-gray-700 rounded-md whitespace-nowrap min-w-28 select-none text-center"><?php echo $row['nama_kategori']; ?></a>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="w-full px-6 py-8">
        <div class="flex w-full items-center justify-center gap-3">
            <h1 class="text-black whitespace-nowrap text-2xl capitalize">Aneka Seafood</h1>
            <hr class="w-full bg-gray-400 h-[2px]">
        </div>
        <div class="flex flex-wrap w-full mt-4 gap-3 sm:justify-start justify-center sm:px-4 ">
            <?php
            // Eksekusi query
            $mquery = mysqli_query($conn, "SELECT * FROM tb_menu");

            // Looping data
            while ($row = mysqli_fetch_array($mquery)) {

            ?>
                <div class="border border-gray-200 rounded-xl shadow-xl bg-white w-36 h-44 sm:w-44 sm:h-56 p-2">
                    <div class=" w-full h-full flex flex-col flex-1">
                        <div class="w-full h-3/5">
                            <img src="./<?php echo $row['gambar_menu']; ?>" alt="menu" class="w-full h-full object-cover rounded-lg">
                        </div>
                        <p class="flex-1"><?php echo $row['nama_menu'] ?></p>
                        <div class="flex justify-between">
                            <h3 class="text-xs font-semibold">Rp. <?php echo number_format($row['harga'], 0, ',', '.') ?>, -</h3>
                            <button class="py-1 px-3 rounded-full border border-gray-200 text-xs">Tambah</button>
                        </div>
                    </div>
                </div>

            <?php } ?>



            <div class="border border-gray-200 rounded-xl shadow-xl bg-white w-36 h-44 sm:w-44 sm:h-56"></div>
            <div class="border border-gray-200 rounded-xl shadow-xl bg-white w-36 h-44 sm:w-44 sm:h-56"></div>
            <div class="border border-gray-200 rounded-xl shadow-xl bg-white w-36 h-44 sm:w-44 sm:h-56"></div>
            <div class="border border-gray-200 rounded-xl shadow-xl bg-white w-36 h-44 sm:w-44 sm:h-56"></div>
            <div class="border border-gray-200 rounded-xl shadow-xl bg-white w-36 h-44 sm:w-44 sm:h-56"></div>

        </div>
    </div>

</div>

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

        // let isDragging = false;
        // let startX;
        // let scrollLeft;
        // let lastMove;
        // let velocity = 0;
        // let raf;
        // let offsetX = 0;

        // scrollContainer.addEventListener("mousedown", (e) => {
        //     isDragging = true;
        //     startX = e.pageX;
        //     scrollLeft = scrollContainer.scrollLeft;
        //     lastMove = scrollLeft;
        //     offsetX = 0;
        //     cancelAnimationFrame(raf);
        // });

        // window.addEventListener("mousemove", (e) => {
        //     if (!isDragging) return;
        //     e.preventDefault();

        //     let moveX = e.pageX - startX;
        //     offsetX = moveX;
        //     scrollContainer.style.transform = `translateX(${moveX}px)`;

        //     velocity = moveX - lastMove;
        //     lastMove = moveX;
        // });

        // window.addEventListener("mouseup", () => {
        //     if (!isDragging) return;
        //     isDragging = false;

        //     // Efek Kembali ke Posisi Navbar
        //     scrollContainer.style.transition = "transform 0.3s ease-out";
        //     scrollContainer.style.transform = "translateX(0)";

        //     // Reset setelah animasi selesai
        //     setTimeout(() => {
        //         scrollContainer.style.transition = "none";
        //     }, 300);
        // });
    });
</script>