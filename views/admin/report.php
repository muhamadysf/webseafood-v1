<h1 class="text-2xl font-bold text-center">Ini laporan</h1>




<div class="page-container">


    <!-- main content area start -->
    <div class="main-content">


        <!-- page title area -->
        <div class="main-content-inner">
            <h1 class="mb-3">Laporan Penjualan</h1>
            <form method="GET" action="laporan.php" class="mb-3">
                <label for="start_date">Dari Tanggal:</label>
                <input class="mr-3" type="date" id="start_date" name="start_date" required value="<?= htmlspecialchars($start_date) ?>">

                <label for="end_date">Sampai Tanggal:</label>
                <input type="date" id="end_date" name="end_date" required value="<?= htmlspecialchars($end_date) ?>">

                <button id="btnfilter" type="submit" class="px-5 btn btn-info">Filter</button>
            </form>

            <?php if (!empty($data_result)): ?>
                <div id="btnoperasi" class="mb-3 d-flex justify-content-end">
                    <a id="exportBtn" class="btn btn-success" href="export_excel.php?start_date=<?= htmlspecialchars($start_date) ?>&end_date=<?= htmlspecialchars($end_date) ?>" target="_blank">Export ke Excel</a>


                    <button id="printBtn" class="ml-2 btn btn-secondary" onclick="window.print()">Cetak Laporan</button>
                </div>

                <table class="table table-striped">
                    <thead class="text-center thead-dark">
                        <tr>
                            <th>Tanggal Order</th>
                            <th>Kode Pemesanan</th>
                            <th>Nama Produk</th>
                            <th>Total Penjualan</th>
                            <th>Biaya Pembelian Produk</th>
                            <th>Keuntungan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_result as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['tgl_order']) ?></td>
                                <td><?= htmlspecialchars($row['kode_order']) ?></td>
                                <td><?= htmlspecialchars($row['produk_tergabung']) ?></td>
                                <td><?= "Rp. " . number_format(htmlspecialchars($row['total_harga']), 0, ',', '.'); ?></td>
                                <td><?= "Rp. " . number_format(htmlspecialchars($row['total_harga_beli']), 0, ',', '.'); ?></td>
                                <td><?= "Rp. " . number_format(htmlspecialchars($row['total_harga'] - $row['total_harga_beli']), 0, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Silakan pilih rentang tanggal untuk melihat laporan.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- jquery latest version -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>