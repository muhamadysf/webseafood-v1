<?php
include "./config/connect.php";


$kquery = mysqli_query($conn, "SELECT DISTINCT tk.id_kategori, tk.nama_kategori FROM tb_kategori tk JOIN tb_menu tm ON tk.id_kategori = tm.id_kategori");
while ($record = mysqli_fetch_array($kquery)) {
    $result[] = $record;
}

?>


<div class="w-screen min-h-screen sm:w-[640px] relative overflow-y-scroll scrollbar-hide border border-t-0 border-gray-300 bg-white">

    <?php include './partials/customer/header.php' ?>

    <img id="image" src="./public/assets/images/king.png" alt="header" class="object-cover w-full h-auto">

    <div id="labelKategori" class="w-full bg-slate-100 flex items-center justify-between sm:w-[640px] h-14">
        <div class="flex h-full px-2 py-2">
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
        <div id="overflow-container" class="flex items-center flex-1 w-full px-5 overflow-x-hidden text-white select-none scroll-container cursor-grab flex-nowrap">
            <div class="flex items-center justify-center gap-2 select-none scroll-content">


                <?php $no = 1;
                foreach ($result as $row) { ?>

                    <a href="#<?php echo $row['id_kategori'] ?>" class="px-2 py-1 text-center text-black bg-transparent border border-gray-600 rounded-full select-none whitespace-nowrap min-w-28"><?php echo $row['nama_kategori']; ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php
    foreach ($result as $row) {
        $kategori = $row['id_kategori'];
    ?>
        <div class="w-full px-6 py-8">
            <div class="flex items-center justify-center w-full gap-3">
                <h1 id="<?php echo $row['id_kategori'] ?>" class="text-2xl text-black whitespace-nowrap"><?php echo $row['nama_kategori']; ?></h1>
                <hr class="w-full bg-gray-400 h-[2px]">
            </div>
            <div class="flex flex-wrap justify-center w-full gap-2 mt-4">
                <?php
                $mquery = mysqli_query($conn, "SELECT * FROM tb_menu WHERE id_kategori = $kategori");
                while ($rows = mysqli_fetch_array($mquery)) {
                ?>
                    <div class="h-56 max-w-sm overflow-hidden bg-white border border-gray-400 shadow-lg w-36 rounded-2xl sm:w-44">
                        <div class="flex flex-col justify-between h-full p-2">
                            <img class="object-cover object-center w-full h-32 rounded-2xl" src="./<?php echo $rows['gambar_menu']; ?>" alt="Menu Image">
                            <div class="flex flex-col flex-grow px-2 py-1">
                                <h2 class="text-sm font-semibold text-gray-800"><?php echo $rows['nama_menu'] ?></h2>
                                <p class="mt-1 text-xs text-gray-600">Rp. <?php echo number_format($rows['harga'], 0, ',', '.') ?>, -</p>
                                <div class="mt-auto">
                                    <button class="w-full px-4 py-[2px] mt-3 text-xs text-black border border-gray-600 transition bg-transparent rounded-full">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php
    } ?>
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
</script>