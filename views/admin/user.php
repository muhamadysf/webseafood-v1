<?php
include "proses/connect.php";

$petugas = $_SESSION['id'];
$query = mysqli_query($conn, "SELECT * FROM tb_user");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}


?>

<div class="" x-data="{ selectedId: null, selectNama: null }">
    <div class="flex items-center justify-between mb-4 ">
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

            <button id="btnTambah" type="button" class="inline-flex items-center px-5 py-2 text-sm text-white bg-teal-500 border border-transparent rounded-lg font-base focus:outline-none hover:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-full-screen-modal" data-hs-overlay="#hs-full-screen-modal">
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



        <div class="flex flex-col py-8 bg-white shadow-xl rounded-3xl">
            <div class="-m-1.5 h-full w-full overflow-auto scrollbar-hide">
                <div class="p-1.5 min-w-full overflow-auto scrollbar-hide w-full h-full inline-block align-middle">
                    <div class="px-8">
                        <!-- ini table -->
                        <table id="myTable" class="divide-y divide-gray-200 min-w-auto">
                            <thead class="!text-center bg-primary-500 text-white py-4">
                                <tr class="!text-center">
                                    <th scope="col" class="!text-center px-6 py-3 text-xs font-medium  uppercase ">No.</th>
                                    <th scope="col" class="!text-center px-6 py-3 text-xs font-medium  uppercase">Nama</th>
                                    <th scope="col" class="!text-center px-6 py-3 text-xs font-medium  uppercase">Level</th>
                                    <th scope="col" class="!text-center px-6 py-3 text-xs font-medium  uppercase">No. Handphone</th>
                                    <th scope="col" class="!text-center px-6 py-3 text-xs font-medium  uppercase ">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center bg-white divide-y divide-gray-200">
                                <?php
                                $no = 1;
                                foreach ($result as $row) {
                                ?>

                                    <tr class="text-center">
                                        <td class="!text-center px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap"><?php echo $no++; ?></td>
                                        <td class="!text-center px-6 py-4 text-sm text-gray-800 whitespace-nowrap"><?php echo $row['nama'] ?></td>
                                        <td class="!text-center px-6 py-4 text-sm text-gray-800 whitespace-nowrap">

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
                                        <td class="!text-center px-6 py-4 text-sm text-gray-800 whitespace-nowrap"><?php echo $row['nohp'] ?></td>
                                        <td class="px-6 py-4 text-sm font-medium text-center whitespace-nowrap">
                                            <button type="button" class="inline-flex justify-center items-center w-16 py-[2px] text-sm font-medium text-teal-600 bg-teal-200/55 border mr-8 border-transparent rounded-full gap-x-2 hover:bg-teal-400/85 focus:outline-none disabled:opacity-50 disabled:pointer-events-none" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-full-screen-modal-detail" data-hs-overlay="#hs-full-screen-modal-edit"
                                                data-id="<?php echo $row['id']; ?>"
                                                data-nama="<?php echo $row['nama']; ?>"
                                                data-username="<?php echo $row['username']; ?>"
                                                data-level="<?php echo $row['level']; ?>"
                                                data-nohp="<?php echo $row['nohp']; ?>"
                                                data-alamat="<?php echo $row['alamat']; ?>"
                                                onclick="openEditModal(this,'detail')">
                                                Detail
                                            </button>
                                            <button type="button" class="inline-flex justify-center mr-8 items-center w-16 py-[2px] text-sm font-medium text-yellow-400 bg-yellow-200/55 border border-transparent rounded-full gap-x-2 hover:border-yel hover:bg-yellow-300/85 focus:outline-none disabled:opacity-50 disabled:pointer-events-none" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-full-screen-modal-edit" data-hs-overlay="#hs-full-screen-modal-edit"
                                                data-id="<?php echo $row['id']; ?>"
                                                data-nama="<?php echo $row['nama']; ?>"
                                                data-username="<?php echo $row['username']; ?>"
                                                data-level="<?php echo $row['level']; ?>"
                                                data-nohp="<?php echo $row['nohp']; ?>"
                                                data-alamat="<?php echo $row['alamat']; ?>"
                                                onclick="openEditModal(this, 'edit')">
                                                Edit
                                            </button>
                                            <button type="button" class="inline-flex justify-center items-center w-16 py-[2px] text-sm font-medium text-red-500 bg-red-200/55 border border-transparent rounded-full gap-x-2 hover:bg-red-400/85 focus:outline-none disabled:opacity-50 disabled:pointer-events-none" aria-haspopup="dialog" aria-expanded="false" aria-controls="hapusdata" data-hs-overlay="#hapusdata"
                                                data-id="<?php echo $row['id']; ?>"
                                                data-nama="<?php echo $row['nama']; ?>"
                                                @click="selectedId = $el.dataset.id; selectNama = $el.dataset.nama"
                                                onclick="openHapusModal(this)">
                                                Hapus
                                            </button>

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

    <!-- Modal tambah user -->
    <div id="hs-full-screen-modal" class="hs-overlay [--overlay-backdrop:static]  hidden rounded-2xl right-0 fixed bottom-12 top-12 left-56 z-[80] scrollbar-hide overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-full-screen-label ">
        <div class="h-full max-w-full max-h-full mt-10 transition-all ease-out scale-90 opacity-0 hs-overlay-open:mt-0 hs-overlay-open:opacity-100 hs-overlay-open:duration-1000 hs-overlay-open:scale-100">
            <div class="flex flex-col h-full max-w-full max-h-full bg-white pointer-events-auto">
                <form name="frmadd" action="./proses/proses_input_user.php" method="post" class="flex flex-col h-full max-w-full max-h-full bg-white pointer-events-auto">

                    <div class="flex items-center justify-between px-4 py-3 border-b">
                        <h3 id="hs-full-screen-label" class="px-8 text-2xl font-semibold text-gray-800">
                            Tambah Karyawan Baru
                        </h3>
                        <button type="button" class="inline-flex items-center justify-center text-gray-800 bg-gray-100 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none" aria-label="Close" data-hs-overlay="#hs-full-screen-modal">
                            <span class="sr-only">Close</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="w-full py-4 overflow-auto px-14 scrollbar-hide">

                        <div class="flex min-w-full gap-8 mt-1 mb-5 text-gray-800">
                            <div class="w-full max-w-sm">
                                <label for="input-label-nama" class="block mb-2 text-sm font-medium">Nama Lengkap</label>
                                <input name="nama" type="text" id="input-label-nama" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Nama Lengkap Karyawan" required>
                            </div>
                            <div class="w-full max-w-sm">
                                <label for="input-label-mail" class="block mb-2 text-sm font-medium">Email</label>
                                <input name="email" type="email" id="input-label-mail" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="karyawan@mail.com">
                            </div>
                        </div>
                        <div class="flex gap-8 mt-1 mb-5 text-gray-800">
                            <div class="w-full max-w-sm">
                                <label for="hs-select-label" class="block mb-2 text-sm font-medium">Level User</label>
                                <select name="level" id="hs-select-label" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" required>
                                    <option value="" selected="">Silahkan pilih...</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Kasir</option>
                                    <option value="3">Pelayan</option>
                                    <option value="4">Dapur</option>
                                </select>
                            </div>
                            <div class="w-full max-w-sm">
                                <label for="input-label-no" class="block mb-2 text-sm font-medium">Nomor Handphone</label>
                                <input name="nohp" type="number" id="input-label-no" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Nomor karyawan yang bisa dihubungi" minlength="10" maxlength="14" required>
                            </div>
                        </div>
                        <div class="w-full mt-1 mb-5 text-gray-800">
                            <div class="w-full max-w-sm">
                                <label for="hs-autoheight-textarea" class="block mb-2 text-sm font-medium">Alamat Karyawan</label>
                                <textarea name="alamat" id="hs-autoheight-textarea" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" rows="3" placeholder="Alamat lengkap karyawan..." data-hs-textarea-auto-height="" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-center px-4 py-3 mt-auto border-t gap-x-8">
                        <button type="button" class="px-3 py-2 text-sm font-medium bg-gray-500 border border-gray-200 rounded-lg shadow-sm text-gray-50 gap-x-2 hover:bg-gray-600 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-full-screen-modal">
                            Batal
                        </button>
                        <button name="input_user_validate" type="submit" class="px-3 py-2 text-sm font-medium text-white bg-green-500 border border-transparent rounded-lg gap-x-2 hover:bg-green-600 focus:outline-none disabled:opacity-50 disabled:pointer-events-none">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal detail dan edit data -->
    <div id="hs-full-screen-modal-edit" class="hs-overlay modal [--overlay-backdrop:static]  hidden rounded-2xl right-0 fixed bottom-12 top-12 left-56 z-[80] scrollbar-hide overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-full-screen-label-edit ">
        <div class="h-full max-w-full max-h-full mt-10 transition-all ease-out scale-90 opacity-0 hs-overlay-open:mt-0 hs-overlay-open:opacity-100 hs-overlay-open:duration-1000 hs-overlay-open:scale-100">
            <div class="flex flex-col h-full max-w-full max-h-full bg-white pointer-events-auto">
                <form name="frmedit" action="./proses/proses_edit_user.php" method="post" class="flex flex-col h-full max-w-full max-h-full bg-white pointer-events-auto">

                    <div class="flex items-center justify-between px-4 py-3 border-b">
                        <h3 id="hs-full-screen-label-edit" class="px-8 text-2xl font-semibold text-gray-800">
                            Edit Data Karyawan
                        </h3>
                        <button type="button" class="inline-flex items-center justify-center text-gray-800 bg-gray-100 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none" aria-label="Close" data-hs-overlay="#hs-full-screen-modal-edit">
                            <span class="sr-only">Close</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="w-full py-4 overflow-auto px-14 scrollbar-hide">
                        <div class="flex min-w-full gap-8 mt-1 mb-5 text-gray-800">
                            <div class="w-full max-w-sm">
                                <input id="iduser" name="iduser" type="hidden">
                                <label for="input-label-nama-edit" class="block mb-2 text-sm font-medium">Nama Lengkap</label>
                                <input name="nama" type="text" id="input-label-nama-edit" value="" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Nama Lengkap Karyawan" required>
                            </div>
                            <div class="w-full max-w-sm">
                                <label for="input-label-mail-edit" class="block mb-2 text-sm font-medium">Email</label>
                                <input name="email" type="email" id="input-label-mail-edit" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="karyawan@mail.com">
                            </div>
                        </div>
                        <div class="flex gap-8 mt-1 mb-5 text-gray-800">
                            <div class="w-full max-w-sm">
                                <label for="hs-select-label-edit" class="block mb-2 text-sm font-medium">Level User</label>
                                <select name="level" id="hs-select-label-edit" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" required>
                                    <option value="" selected="">Silahkan pilih...</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Kasir</option>
                                    <option value="3">Pelayan</option>
                                    <option value="4">Dapur</option>
                                </select>
                            </div>
                            <div class="w-full max-w-sm">
                                <label for="input-label-no-edit" class="block mb-2 text-sm font-medium">Nomor Handphone</label>
                                <input name="nohp" type="number" id="input-label-no-edit" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Nomor karyawan yang bisa dihubungi" minlength="10" maxlength="14" required>
                            </div>
                        </div>
                        <div class="w-full mt-1 mb-5 text-gray-800">
                            <div class="w-full max-w-sm">
                                <label for="hs-autoheight-textarea-edit" class="block mb-2 text-sm font-medium">Alamat Karyawan</label>
                                <textarea name="alamat" id="hs-autoheight-textarea-edit" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" rows="3" placeholder="Alamat lengkap karyawan..." data-hs-textarea-auto-height="" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-center px-4 py-3 mt-auto border-t gap-x-8">
                        <button id="btnBatal" type="button" class="px-3 py-2 text-sm font-medium bg-gray-500 border border-gray-200 rounded-lg shadow-sm text-gray-50 gap-x-2 hover:bg-gray-600 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-full-screen-modal-edit">
                            Batal
                        </button>
                        <button id="btnperubahan" name="input_user_validate" type="submit" class="px-3 py-2 text-sm font-medium text-white bg-green-500 border border-transparent rounded-lg gap-x-2 hover:bg-green-600 focus:outline-none disabled:opacity-50 disabled:pointer-events-none">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal hapus data -->
    <div id="hapusdata" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-scale-animation-modal-label">
        <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
            <div class="flex flex-col w-full bg-white border shadow-sm pointer-events-auto rounded-xl">
                <form class="flex flex-col w-full bg-white border shadow-sm pointer-events-auto rounded-xl" action="./proses/proses_delete_user.php" method="post">
                    <input type="hidden" x-bind:value="selectedId" name="iduser">
                    <input type="hidden" value="<?php echo $petugas ?>" id="petugas" name="petugas">
                    <div class="flex items-center justify-between px-4 py-3 border-b">
                        <h3 id="hs-scale-animation-modal-label" class="font-bold text-gray-800">
                            Hapus Data
                        </h3>
                        <button type="button" class="inline-flex items-center justify-center text-gray-800 bg-gray-100 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none" aria-label="Close" data-hs-overlay="#hapusdata">
                            <span class="sr-only">Close</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-4 overflow-y-auto">
                        <p id="bodyHapusModal" class="mt-1 text-gray-800"></p>
                    </div>
                    <div class="flex items-center justify-center px-4 py-3 border-t gap-x-2">
                        <button id="btnBtl" @click="selectedId = null" type="button" class="px-3 py-2 text-sm font-medium bg-gray-500 border border-gray-200 rounded-lg shadow-sm text-gray-50 gap-x-2 hover:bg-gray-600 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hapusdata">
                            Batal
                        </button>
                        <button id="btnHapus" name="delete_data" type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg gap-x-2 hover:bg-red-700 focus:outline-none focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none" <?php echo ($row['username'] == $_SESSION['username_kingseafood']) ? 'disabled' : ''; ?>>
                            Hapus
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- JS pembantu -->
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

        function openEditModal(button, modalType) {
            let id = button.getAttribute("data-id");
            let nama = button.getAttribute("data-nama");
            let username = button.getAttribute("data-username");
            let level = button.getAttribute("data-level");
            let alamat = button.getAttribute("data-alamat");
            let nohp = button.getAttribute("data-nohp");

            const inputs = document.querySelectorAll('.modal input');
            const textareas = document.querySelectorAll('.modal textarea');
            const selects = document.querySelectorAll('.modal select');

            document.getElementById("iduser").value = id;
            document.getElementById("input-label-nama-edit").value = nama;
            document.getElementById("input-label-mail-edit").value = username;
            document.getElementById("hs-select-label-edit").value = level;
            document.getElementById("hs-autoheight-textarea-edit").value = alamat;
            document.getElementById("input-label-no-edit").value = nohp;


            if (modalType === 'edit') {
                document.getElementById('btnperubahan').classList.remove("hidden");

                inputs.forEach(input => {
                    input.removeAttribute('readonly');
                });
                textareas.forEach(textarea => {
                    textarea.removeAttribute('readonly');
                });

                selects.forEach(select => {
                    select.removeAttribute('disabled');
                });


                document.getElementById("hs-full-screen-label-edit").innerText = "Edit Data Karyawan";
                document.getElementById("btnBatal").innerText = "Batal";


            } else if (modalType === 'detail') {
                document.getElementById('btnperubahan').classList.add("hidden");


                inputs.forEach(input => {
                    input.setAttribute('readonly', 'true');

                });
                textareas.forEach(textarea => {
                    textarea.setAttribute('readonly', 'true');
                });

                selects.forEach(select => {
                    select.setAttribute('disabled', 'true');
                });

                document.getElementById("hs-full-screen-label-edit").innerText = "Detail Data Karyawan";
                document.getElementById("btnBatal").innerText = "Kembali";
            }

        }

        function openHapusModal(button) {
            let id = button.getAttribute("data-id");
            let nama = button.getAttribute("data-nama");
            let idpetugas = document.getElementById("petugas").value;

            if (id !== idpetugas) {
                document.getElementById('btnHapus').classList.remove("hidden");
                document.getElementById("btnBtl").innerText = "Batal";
                document.getElementById("bodyHapusModal").innerHTML = "Data <span class='text-lg text-red-600 underline'>" + nama + "</span> akan dihapus permanen dari penyimpanan. Lanjutkan proses?";
            } else {
                document.getElementById("bodyHapusModal").innerText = "Maaf, Anda tidak dapat menghapus data Anda sendiri.";
                document.getElementById('btnHapus').classList.add("hidden");
                document.getElementById("btnBtl").innerText = "Kembali";
            }

        }
    </script>
</div>