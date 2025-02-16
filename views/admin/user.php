<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>

<div class="">
    <div class="flex items-center justify-between mb-4">
        <div class="">
            <h1 class="text-3xl font-semibold">Users</h1>
        </div>
        <div class="">
            <button id="btnPrint" type="button" class="inline-flex items-center px-3 py-2 text-sm text-white border border-transparent rounded-lg bg-slate-400 font-base focus:outline-none hover:bg-slate-600 disabled:opacity-50 disabled:pointer-events-none">
                <svg class="w-auto h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 16.75H16C15.8011 16.75 15.6103 16.671 15.4697 16.5303C15.329 16.3897 15.25 16.1989 15.25 16C15.25 15.8011 15.329 15.6103 15.4697 15.4697C15.6103 15.329 15.8011 15.25 16 15.25H18C18.3315 15.25 18.6495 15.1183 18.8839 14.8839C19.1183 14.6495 19.25 14.3315 19.25 14V10C19.25 9.66848 19.1183 9.35054 18.8839 9.11612C18.6495 8.8817 18.3315 8.75 18 8.75H6C5.66848 8.75 5.35054 8.8817 5.11612 9.11612C4.8817 9.35054 4.75 9.66848 4.75 10V14C4.75 14.3315 4.8817 14.6495 5.11612 14.8839C5.35054 15.1183 5.66848 15.25 6 15.25H8C8.19891 15.25 8.38968 15.329 8.53033 15.4697C8.67098 15.6103 8.75 15.8011 8.75 16C8.75 16.1989 8.67098 16.3897 8.53033 16.5303C8.38968 16.671 8.19891 16.75 8 16.75H6C5.27065 16.75 4.57118 16.4603 4.05546 15.9445C3.53973 15.4288 3.25 14.7293 3.25 14V10C3.25 9.27065 3.53973 8.57118 4.05546 8.05546C4.57118 7.53973 5.27065 7.25 6 7.25H18C18.7293 7.25 19.4288 7.53973 19.9445 8.05546C20.4603 8.57118 20.75 9.27065 20.75 10V14C20.75 14.7293 20.4603 15.4288 19.9445 15.9445C19.4288 16.4603 18.7293 16.75 18 16.75Z" fill="currentColor" />
                    <path d="M16 8.75C15.8019 8.74741 15.6126 8.66756 15.4725 8.52747C15.3324 8.38737 15.2526 8.19811 15.25 8V4.75H8.75V8C8.75 8.19891 8.67098 8.38968 8.53033 8.53033C8.38968 8.67098 8.19891 8.75 8 8.75C7.80109 8.75 7.61032 8.67098 7.46967 8.53033C7.32902 8.38968 7.25 8.19891 7.25 8V4.5C7.25 4.16848 7.3817 3.85054 7.61612 3.61612C7.85054 3.3817 8.16848 3.25 8.5 3.25H15.5C15.8315 3.25 16.1495 3.3817 16.3839 3.61612C16.6183 3.85054 16.75 4.16848 16.75 4.5V8C16.7474 8.19811 16.6676 8.38737 16.5275 8.52747C16.3874 8.66756 16.1981 8.74741 16 8.75Z" fill="currentColor" />
                    <path d="M15.5 20.75H8.5C8.16848 20.75 7.85054 20.6183 7.61612 20.3839C7.3817 20.1495 7.25 19.8315 7.25 19.5V12.5C7.25 12.1685 7.3817 11.8505 7.61612 11.6161C7.85054 11.3817 8.16848 11.25 8.5 11.25H15.5C15.8315 11.25 16.1495 11.3817 16.3839 11.6161C16.6183 11.8505 16.75 12.1685 16.75 12.5V19.5C16.75 19.8315 16.6183 20.1495 16.3839 20.3839C16.1495 20.6183 15.8315 20.75 15.5 20.75ZM8.75 19.25H15.25V12.75H8.75V19.25Z" fill="currentColor" />
                </svg>
                Print
            </button>
            <button id="btnExcel" type="button" class="inline-flex items-center px-3 py-2 mr-8 text-sm text-white bg-green-600 border border-transparent rounded-lg font-base focus:outline-none hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                <svg class="w-auto h-5" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 512 512" xml:space="preserve">
                    <style type="text/css">
                        .st0 {
                            fill: currentColor;
                        }
                    </style>
                    <g>
                        <path class="st0" d="M378.413,0H208.297h-13.183L185.8,9.314L57.02,138.102l-9.314,9.314v13.176v265.514 c0,47.36,38.527,85.895,85.895,85.895h244.812c47.353,0,85.881-38.535,85.881-85.895V85.896C464.294,38.528,425.766,0,378.413,0z M432.497,426.105c0,29.877-24.214,54.091-54.084,54.091H133.601c-29.884,0-54.098-24.214-54.098-54.091V160.591h83.717 c24.885,0,45.077-20.178,45.077-45.07V31.804h170.116c29.87,0,54.084,24.214,54.084,54.092V426.105z" />
                        <path class="st0" d="M171.193,302.61l13.853-18.07c1.494-2.032,2.318-4.211,2.318-6.243c0-4.482-3.533-8.288-8.421-8.288 c-2.863,0-5.712,1.355-7.89,4.211l-10.725,14.125h-0.139l-10.725-14.125c-2.178-2.856-5.027-4.211-7.876-4.211 c-4.888,0-8.42,3.806-8.42,8.288c0,2.032,0.81,4.211,2.304,6.243l13.853,18.07l-15.487,20.235c-1.494,2.038-2.304,4.21-2.304,6.249 c0,4.483,3.533,8.288,8.42,8.288c2.848,0,5.711-1.361,7.876-4.21l12.358-16.304h0.139l12.358,16.304 c2.179,2.849,5.027,4.21,7.876,4.21c4.888,0,8.42-3.805,8.42-8.288c0-2.039-0.81-4.21-2.304-6.249L171.193,302.61z" />
                        <path class="st0" d="M226.898,320.806c-2.989-0.538-4.344-2.172-4.344-5.97v-61.394c0-6.25-4.078-10.055-9.509-10.055 c-5.572,0-9.51,3.805-9.51,10.055v63.021c0,13.448,5.166,20.919,20.235,20.919h0.824c6.926,0,9.914-3.673,9.914-8.288 C234.508,324.883,232.33,321.762,226.898,320.806z" />
                        <path class="st0" d="M277.98,295.544l-7.206-0.817c-7.471-0.81-9.091-2.444-9.091-5.432c0-3.121,2.444-5.16,8.281-5.16 c4.748,0,9.23,0.95,13.308,2.856c2.583,1.222,4.078,1.627,5.432,1.627c4.482,0,7.471-3.261,7.471-7.471 c0-3.261-1.899-5.565-5.572-7.471c-5.558-2.849-12.624-4.343-19.97-4.343c-17.246,0-27.161,8.281-27.161,21.184 c0,11.409,7.192,18.475,21.464,20.102l7.191,0.817c7.75,0.816,9.51,2.444,9.51,5.572c0,3.666-3.254,6.11-10.18,6.11 c-6.382,0-11.409-2.039-16.171-4.756c-2.165-1.222-3.799-1.766-5.572-1.766c-4.344,0-7.876,3.4-7.876,7.61 c0,3.121,1.355,5.565,4.622,7.604c5.432,3.394,13.727,6.249,24.047,6.249c18.6,0,29.339-9.098,29.339-22.546 C299.848,304.509,293.467,297.31,277.98,295.544z" />
                        <path class="st0" d="M351.056,302.61l13.853-18.07c1.494-2.032,2.318-4.211,2.318-6.243c0-4.482-3.533-8.288-8.42-8.288 c-2.862,0-5.712,1.355-7.89,4.211l-10.725,14.125h-0.14l-10.725-14.125c-2.178-2.856-5.027-4.211-7.876-4.211 c-4.888,0-8.421,3.806-8.421,8.288c0,2.032,0.81,4.211,2.304,6.243l13.852,18.07l-15.486,20.235 c-1.494,2.038-2.304,4.21-2.304,6.249c0,4.483,3.534,8.288,8.42,8.288c2.849,0,5.712-1.361,7.876-4.21l12.358-16.304h0.14 l12.358,16.304c2.179,2.849,5.027,4.21,7.876,4.21c4.888,0,8.421-3.805,8.421-8.288c0-2.039-0.81-4.21-2.304-6.249L351.056,302.61z" />
                    </g>
                </svg>
                Ekspor
            </button>

            <button id="btnTambah" type="button" class="inline-flex items-center px-5 py-2 text-sm text-white border border-transparent rounded-lg font-base bg-primary-400 focus:outline-none hover:bg-primary-550 disabled:opacity-50 disabled:pointer-events-none">
                <svg class="w-auto h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 12H18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M12 18V6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Tambah Data User
            </button>
        </div>

    </div>

    <?php
    if (empty($result)) {
        echo "Data user tidak ada";
    } else {
    ?>

        <div class="flex flex-col py-8 bg-white border shadow-xl rounded-3xl">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="px-4 overflow-hidden">
                        <table id="myTable" class="min-w-full border divide-y divide-gray-200">
                            <thead class="bg-gray-50 rounded-xl">
                                <tr class="rounded-xl">
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-center text-gray-500 uppercase">No.</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-center text-gray-500 uppercase">Nama</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-center text-gray-500 uppercase">Email</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-center text-gray-500 uppercase">Level</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-center text-gray-500 uppercase">No. Handphone</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php
                                $no = 1;
                                foreach ($result as $row) {
                                ?>

                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap"><?php echo $no++; ?></td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap"><?php echo $row['nama'] ?></td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap"><?php echo $row['username'] ?></td>
                                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">

                                            <?php
                                            if ($row['level'] == 1) {
                                                echo "Admin";
                                            } else if ($row['level'] == 2) {
                                                echo "Kasir";
                                            } else if ($row['level'] == 3) {
                                                echo "Pelayan";
                                            } else if ($row['level'] == 4) {
                                                echo "Dapur";
                                            }
                                            ?>

                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap"><?php echo $row['nohp'] ?></td>
                                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-end">
                                            <button type="button" class="inline-flex items-center text-sm font-semibold text-blue-600 border border-transparent rounded-lg gap-x-2 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none">Lihat</button>
                                            <button type="button" class="inline-flex items-center text-sm font-semibold text-blue-600 border border-transparent rounded-lg gap-x-2 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none">Edit</button>
                                            <button type="button" class="inline-flex items-center text-sm font-semibold text-blue-600 border border-transparent rounded-lg gap-x-2 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none">Hapus</button>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

    <script src="./assets/js/jquery-3.7.1.min.js"></script>
    <script src="./assets/js/datatables.min.js"></script>
    <script>
        var table;
        $(document).ready(function() {
            table = $('#myTable').DataTable({
                dom: "<'flex justify-between items-center mb-2'lf>t<'flex justify-between items-center mt-2'ip>",
                buttons: [{
                        extend: 'print',
                        className: 'button-print',
                        title: '[KingSeafood - Data User ]',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        },
                        init: function(api, node, config) {
                            $(node).hide();
                        }
                    },
                    {
                        extend: 'excel',
                        className: 'button-excel',
                        title: '[KingSeafood - Data User ]',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        },
                        init: function(api, node, config) {
                            $(node).hide();
                        }
                    },
                ]
            });
        });

        $('#btnExcel').on('click', function() {
            table.button('.button-excel').trigger();
        });
        $('#btnPrint').on('click', function() {
            table.button('.button-print').trigger();
        });
    </script>
</div>