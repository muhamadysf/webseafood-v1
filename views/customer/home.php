<?php
include "./config/connect.php";


$kquery = mysqli_query($conn, "SELECT DISTINCT tk.id_kategori, tk.nama_kategori FROM tb_kategori tk JOIN tb_menu tm ON tk.id_kategori = tm.id_kategori");
while ($record = mysqli_fetch_array($kquery)) {
    $result[] = $record;
}

?>


<div x-data="{ modal: false, selectedId: null, selectNama: null, selectHarga: null, selectImg: null,  jumlah: 0}" class="w-screen min-h-screen sm:w-[640px] relative overflow-y-scroll scrollbar-hide border border-t-0 border-gray-300 bg-white">

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
                $mquery = mysqli_query($conn, "SELECT * FROM tb_menu WHERE id_kategori = $kategori");
                while ($rows = mysqli_fetch_array($mquery)) {
                ?>
                    <a href="#" class="h-56 max-w-sm overflow-hidden bg-white border border-gray-400 shadow-lg w-36 rounded-2xl sm:w-44"
                        data-id="<?php echo $rows['id_menu']; ?>"
                        data-nama="<?php echo $rows['nama_menu']; ?>"
                        data-harga="<?php echo $rows['harga']; ?>"
                        data-img="./<?php echo $rows['gambar_menu']; ?>"
                        @click="modal = true, selectedId = $el.dataset.id; selectNama = $el.dataset.nama; selectHarga = $el.dataset.harga; selectImg = $el.dataset.img;">
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
                    </a>
                <?php } ?>
            </div>
        </div>
    <?php
    } ?>

    <!-- Modal detail -->
    <div x-show="modal" x-cloak
        class="fixed inset-0 flex items-center justify-center z-[99999] overflow-hidden"
        x-transition:enter="transform transition ease-out duration-300"
        x-transition:enter-start="translate-y-full opacity-0"
        x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transform transition ease-in duration-300"
        x-transition:leave-start="translate-y-0 opacity-100"
        x-transition:leave-end="translate-y-full opacity-0">
        <div class="relative bg-white shadow-lg w-screen min-h-screen sm:w-[640px]">
            <!-- Tombol Close (X) -->
            <button @click="modal = false; selectedId= null; selectNama= null; selectHarga= null; selectImg= null; jumlah=0;" class="absolute text-gray-500 top-2 right-2 hover:text-gray-800">
                <svg class="w-12 h-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2ZM15.36 14.3C15.65 14.59 15.65 15.07 15.36 15.36C15.21 15.51 15.02 15.58 14.83 15.58C14.64 15.58 14.45 15.51 14.3 15.36L12 13.06L9.7 15.36C9.55 15.51 9.36 15.58 9.17 15.58C8.98 15.58 8.79 15.51 8.64 15.36C8.35 15.07 8.35 14.59 8.64 14.3L10.94 12L8.64 9.7C8.35 9.41 8.35 8.93 8.64 8.64C8.93 8.35 9.41 8.35 9.7 8.64L12 10.94L14.3 8.64C14.59 8.35 15.07 8.35 15.36 8.64C15.65 8.93 15.65 9.41 15.36 9.7L13.06 12L15.36 14.3Z" fill="currentColor" />
                </svg>
            </button>
            <div class="">
                <!-- header modal -->
                <div class="flex items-center">
                    <img :src="selectImg" class="object-cover w-full h-56" alt="menu_img">
                </div>

                <form action="#" method="post">
                    <!-- Konten Modal -->
                    <div id="" class="w-full py-4 bg-white divide-y-4 divide-gray-200 ">
                        <div class="mb-2 px-7">
                            <h1 class="mb-2 text-2xl text-black" x-text="selectNama"></h1>
                            <h3 class="text-lg font-semibold text-black" x-text="formatRupiah(selectHarga)"></h3>
                        </div>
                        <div class="mb-2 px-7">
                            <label for="hs-autoheight-textarea" class="block mt-4 mb-2 text-xl font-semibold">Catatan :</label>
                            <textarea name="catatan" id="hs-autoheight-textarea" class="block w-full px-4 py-2 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" rows="3" placeholder="Opsional..." data-hs-textarea-auto-height='{"defaultHeight": 72}'></textarea>

                        </div>
                    </div>

                    <!-- footer modal -->
                    <div class="flex flex-col justify-end gap-3 px-4 py-3">
                        <div class="flex justify-between">
                            <p class="">Jumlah Pesanan : </p>
                            <div class="flex gap-4">
                                <button type="button" @click="jumlah > 0 ? jumlah-- : 0" class="inline-flex items-center justify-center">

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
                                <p class="inline-flex items-center justify-center w-12" x-text="jumlah">0</p>
                                <button type="button" @click="jumlah++" class="inline-flex items-center justify-center">
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
                            <button type="button" class="inline-flex items-center justify-center w-full px-3 py-2 font-medium text-white border border-transparent rounded-lg bg-primary-500 gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none">Tambah Pesanan <span class="" x-text="formatRupiah(jumlah * selectHarga)">0</span></button>
                        </div>



                    </div>
                </form>
            </div>
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
</script>