<?php
include "./config/connect.php";

$petugas = $_SESSION['id'];
$query = mysqli_query($conn, "SELECT * FROM tb_pembeli");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}


?>

<div x-data="{ modal: false, selectedId: null, selectNama: null}">
    <div class="space-y-4">
        <div class="flex items-center">
            <h1 class="flex-1 text-2xl font-semibold text-black">Data Pembeli</h1>
            <div class="flex items-center">
                <!--  -->
            </div>
        </div>

        <div class="flex flex-col overflow-hidden ">
            <table id="myTable" class="min-w-full bg-white shadow-xl rounded-t-3xl">
                <thead class="bg-gray-100">
                    <tr class="">
                        <th scope="col" class="px-6 rounded-tl-3xl py-3 text-sm font-semibold !text-center text-gray-700 uppercase">No.</th>
                        <th scope="col" class="px-6 py-3 text-sm font-semibold !text-center text-gray-700 uppercase">Nama Pembeli</th>
                        <th scope="col" class="px-6 py-3 text-sm font-semibold !text-center text-gray-700 uppercase">Email</th>
                        <th scope="col" class="px-6 rounded-tr-3xl py-3 text-sm font-semibold !text-center text-gray-700 uppercase">No. Handphone</th>

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
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap !text-center"><?php echo $no++; ?></td>
                                <td class="px-6 py-4 text-sm font-medium text-center text-gray-800 whitespace-nowrap"><?php echo $row["nama_pembeli"]; ?></td>
                                <td class="px-6 py-4 text-sm text-center text-gray-800 whitespace-nowrap"><?php echo $row["email_pembeli"]; ?></td>
                                <td class="px-6 py-4 text-sm !text-center text-gray-800 whitespace-nowrap"><?php echo $row["no_hp"]; ?></td>

                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- Backdrop modal -->
    <div x-show="modal" x-cloak class="fixed inset-0 z-[99998] bg-black/85 "
        x-transition.opacity></div>

    <!-- Modal -->
    <div x-show="modal" x-cloak class="fixed inset-0 flex items-center justify-center z-[99999]"
        x-transition.scale>
        <div class="relative p-6 bg-white rounded-lg shadow-lg w-96">
            <!-- Tombol Close (X) -->
            <button @click="modal = false" class="absolute text-gray-500 top-2 right-2 hover:text-gray-800">
                <svg class="w-8 h-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2ZM15.36 14.3C15.65 14.59 15.65 15.07 15.36 15.36C15.21 15.51 15.02 15.58 14.83 15.58C14.64 15.58 14.45 15.51 14.3 15.36L12 13.06L9.7 15.36C9.55 15.51 9.36 15.58 9.17 15.58C8.98 15.58 8.79 15.51 8.64 15.36C8.35 15.07 8.35 14.59 8.64 14.3L10.94 12L8.64 9.7C8.35 9.41 8.35 8.93 8.64 8.64C8.93 8.35 9.41 8.35 9.7 8.64L12 10.94L14.3 8.64C14.59 8.35 15.07 8.35 15.36 8.64C15.65 8.93 15.65 9.41 15.36 9.7L13.06 12L15.36 14.3Z" fill="currentColor" />
                </svg>
            </button>

            <!-- Konten Modal -->
            <h2 class="mb-4 text-xl font-semibold">Modal Static</h2>
            <p class="mb-4 text-gray-600">Modal ini tidak bisa ditutup dengan klik di luar area.</p>

            <!-- Tombol Batal -->
            <div class="flex justify-end">
                <button @click="modal = false" class="px-4 py-2 text-white bg-gray-400 rounded hover:bg-gray-500">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>
<script src="../public/assets/js/jquery-3.7.1.min.js"></script>
<script src="../public/assets/js/datatables.min.js"></script>
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
                    title: '[KingSeafood - Data Pembeli ]',
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
                    title: '[KingSeafood - Data Pembeli ]',
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
</script>