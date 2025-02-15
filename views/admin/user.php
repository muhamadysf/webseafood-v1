<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>

<div class="">
    <div class="flex justify-between">
        <div class="">
            <h1 class="">User</h1>
        </div>
        <div class="">
            <button class="">
                Export
            </button>
            <button class=""></button>
        </div>
    </div>

    <?php
    if (empty($result)) {
        echo "Data user tidak ada";
    } else {

    ?>

        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="overflow-hidden border rounded-lg shadow">
                        <table id="myTable" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start">No.</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start">Nama</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start">Email</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-end">Level</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-end">No. Handphone</th>
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
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</div>