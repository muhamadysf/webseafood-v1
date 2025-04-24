<?php
include "./config/connect.php";

$petugas = $_SESSION['id'];
$query = mysqli_query($conn, "SELECT tpsn.id_pesanan, tpsn.kode_pesanan, tpsn.id_pembeli, tpsn.total_harga, tpsn.status_pesanan, tpsn.tanggal_pesanan, tb.nama_pembeli FROM tb_pesanan tpsn JOIN tb_pembeli tb ON tpsn.id_pembeli = tb.id_pembeli ORDER BY tpsn.tanggal_pesanan DESC");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}


?>

<!-- ================================================================================================================= -->

<div class="w-full" x-data="{ modal: false}">
    <div class="flex items-end w-full mb-7">
        <div class="flex items-center justify-center w-full gap-3 px-5 py-2 bg-primary-300 rounded-xl">
            <h3 class="text-xl font-semibold text-white">Proses pesanan :</h3>
            <button class="p-2 text-black rounded-lg bg-slate-200 hover:bg-slate-400" type="button" @click="modal = true">
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
                ?>
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap !text-center"><?php echo $no++; ?></td>
                            <td class="px-6 py-4 text-sm text-center text-gray-800 whitespace-nowrap"><?php echo isset($row['kode_pesanan']) ? $row['kode_pesanan'] : '-'; ?></td>
                            <td class="px-6 py-4 text-sm text-center text-gray-800 whitespace-nowrap"><?php echo isset($row['nama_pembeli']) ? $row['nama_pembeli'] : '-'; ?></td>
                            <td class="px-6 py-4 text-sm text-center text-gray-800 whitespace-nowrap">Rp. <?php echo isset($row['total_harga']) ? number_format($row['total_harga'], 0, ',', '.') : '-'; ?></td>
                            <td class="px-6 py-4 text-sm text-center text-gray-800 whitespace-nowrap"><?php echo isset($row['status_pesanan']) ? $row['status_pesanan'] : '-'; ?></td>
                            <td class="px-6 py-4 text-sm !text-center text-gray-800 whitespace-nowrap"><?php echo isset($row['tanggal_pesanan']) ? date('d-m-Y H:i:s', strtotime($row['tanggal_pesanan'])) : '-'; ?></td>
                            <td class=" py-4 text-sm  whitespace-nowrap !text-center">

                            </td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>

    <!-- ========================================= -->

    <!-- Backdrop modal -->
    <div x-show="modal " x-cloak class="fixed inset-0 z-[99998] bg-black/85 sm:inline-flex sm:mx-auto"
        x-transition.opacity>
    </div>

    <!-- Modal untuk scanner barcode -->
    <div x-show="modal" x-cloak class="fixed inset-0 flex items-center justify-center z-[99999]"
        x-transition.scale>
        <div class="relative w-1/3">
            <!-- Tombol Close (X) -->
            <button @click="modal= false; selectedId= null; selectNama= null;  selectImg= null; $refs.fileInput.value = ''; setPabrik();" class="absolute text-gray-500 top-2 right-4 hover:text-gray-800">
                <svg class="w-8 h-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2ZM15.36 14.3C15.65 14.59 15.65 15.07 15.36 15.36C15.21 15.51 15.02 15.58 14.83 15.58C14.64 15.58 14.45 15.51 14.3 15.36L12 13.06L9.7 15.36C9.55 15.51 9.36 15.58 9.17 15.58C8.98 15.58 8.79 15.51 8.64 15.36C8.35 15.07 8.35 14.59 8.64 14.3L10.94 12L8.64 9.7C8.35 9.41 8.35 8.93 8.64 8.64C8.93 8.35 9.41 8.35 9.7 8.64L12 10.94L14.3 8.64C14.59 8.35 15.07 8.35 15.36 8.64C15.65 8.93 15.65 9.41 15.36 9.7L13.06 12L15.36 14.3Z" fill="currentColor" />
                </svg>
            </button>
            <div class="w-full max-w-md p-6 space-y-4 bg-white shadow-2xl rounded-2xl">
                <h2 class="text-2xl font-bold text-center text-gray-800">Scan QR Code</h2>

                <video id="preview" class="w-full border border-gray-300 rounded-lg"></video>

                <div id="result" class="p-4 mt-4 text-sm text-gray-700 border border-gray-300 border-dashed rounded-lg bg-gray-50">
                    Hasil scan akan muncul di sini...
                </div>
                <div class="flex justify-end gap-3 px-4 py-3">
                    <button type="button" @click="modal= false; selectedId= null; selectNama= null; selectImg= null;$refs.fileInput.value = ''; setPabrik();" class="px-4 py-2 text-white bg-gray-500 rounded-lg hover:bg-gray-700">
                        Batal
                    </button>
                    <button id="btnSubmit" name="btnsubmit" type="submit" :class="getClass()" class="inline-flex items-center px-3 py-2 font-medium text-white border border-transparent rounded-lg gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none" x-text="getLabel()"></button>
                </div>
            </div>
        </div>
    </div>
</div>


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
        const resultDiv = document.getElementById("result");
        resultDiv.innerHTML = `<div class="font-semibold text-blue-700">Kode ditemukan:</div> <div>${content}</div><div class="mt-2 text-gray-500">Mengambil data pesanan...</div>`;

        // Kirim kode ke server
        fetch('/webseafood/proses/proses_cari_pesanan.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'kode=' + encodeURIComponent(content)
            })
            .then(response => response.text())
            .then(data => {
                resultDiv.innerHTML = `
            <div class="font-semibold text-green-700">Data Pesanan:</div>
            <div class="mt-2 text-sm">${data}</div>
        `;
            })
            .catch(error => {
                resultDiv.innerHTML = `<div class="text-red-600">Gagal mengambil data: ${error}</div>`;
            });
    });

    // Aktifkan kamera
    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            alert('Tidak ditemukan kamera.');
        }
    }).catch(function(e) {
        console.error(e);
        alert('Gagal mengakses kamera: ' + e);
    });
</script>