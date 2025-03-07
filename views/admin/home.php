<?php
include './config/connect.php';

$querypsn = mysqli_query($conn, "SELECT COUNT(id_pesanan) AS JMLPSN FROM tb_pesanan");
$barispsn = mysqli_fetch_assoc($querypsn);
$jmlpsn = $barispsn['JMLPSN'];

$querypsn2 = mysqli_query($conn, "SELECT COUNT(id_pesanan) AS JMLPSN2 FROM tb_pesanan WHERE status_pesanan = 'Selesai'");
$barispsn2 = mysqli_fetch_assoc($querypsn2);
$jmlpsn2 = $barispsn2['JMLPSN2'];

$queryuser = mysqli_query($conn, "SELECT COUNT(id) AS JMLUSER FROM tb_user WHERE level != 1");
$barisuser = mysqli_fetch_assoc($queryuser);
$jmluser = $barisuser['JMLUSER'];

$qpemasukan = mysqli_query($conn, "SELECT SUM(total_harga) AS TOTAL FROM tb_pesanan WHERE status_pesanan = 'Selesai'");
$barispemasukan = mysqli_fetch_assoc($qpemasukan);
$totalpemasukan = $barispemasukan['TOTAL'];
?>

<div class="m-2">
    <div class="w-full px-12 py-8 mb-4 rounded-md shadow-lg bg-white/35 h-44 backdrop-blur-md">
        <h1 class="mb-2 text-3xl">Selamat datang <?php echo $_SESSION['nama']; ?>,</h1>
        <p class="">Mari kita awali pekerjaan kita dengan <span class="font-semibold underline">Bismillaahirrahmaanirrahiim...</span></p>
    </div>
    <div class="flex flex-wrap items-center justify-between gap-4 mb-8 gap-y-8">
        <div class="flex items-center justify-between h-40 p-8 rounded-lg shadow-lg w-80 bg-white/30 backdrop-blur-md">
            <div class="">
                <h1 class="text-6xl font-semibold"><?php echo $jmlpsn; ?></h1>
                <p class="text-base">Jumlah Pesanan Hari Ini</p>
            </div>
            <div class="">
                <svg fill="currentColor" class="w-auto h-16" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
                    <path d="m1783.68 1468.235-315.445 315.445v-315.445h315.445Zm-541.327-338.823v112.94h-903.53v-112.94h903.53Zm338.936-338.824V903.53H338.824V790.59h1242.465ZM621.176 0c93.403 0 169.412 76.01 169.412 169.412 0 26.09-6.437 50.484-16.94 72.62L999.98 468.255l-79.962 79.962-226.221-226.334c-22.137 10.504-46.532 16.942-72.622 16.942-93.402 0-169.411-76.01-169.411-169.412C451.765 76.009 527.775 0 621.176 0Zm395.295 225.882v112.942h790.588v1016.47h-451.765v451.765H112.941V338.824h225.883V225.882H0V1920h1421.478c45.176 0 87.755-17.619 119.717-49.581l329.224-329.11c31.962-32.076 49.581-74.655 49.581-119.831V225.882h-903.53Z" fill-rule="evenodd" />
                </svg>
            </div>
        </div>
        <div class="flex items-center justify-between h-40 p-8 rounded-lg shadow-lg w-80 bg-white/30 backdrop-blur-md">
            <div class="">
                <h1 class="text-6xl font-semibold"><?php echo $jmlpsn2; ?></h1>
                <p class="text-base">jumlah Pesanan Selesai</p>
            </div>
            <div class="">
                <svg fill="currentColor" class="w-auto h-16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 4h13v1H9V4zm0 17h13v-1H9v1zm0-8h13v-1H9v1zm-5.44 9.17L7 18.74 6.26 18l-2.71 2.7-1.12-1-.74.74 1.86 1.73zm0-16L7 2.74 6.26 2 3.55 4.7l-1.12-1-.74.74 1.86 1.73zm0 8L7 10.74 6.26 10l-2.71 2.7-1.12-1-.74.74 1.86 1.73z" />
                </svg>
            </div>
        </div>
        <div class="flex items-center justify-between h-40 p-8 rounded-lg shadow-lg w-80 bg-white/30 backdrop-blur-md">
            <div class="">
                <h1 class="text-6xl font-semibold"><?php echo $jmluser; ?></h1>
                <p class="text-base">Jumlah Karyawan</p>
            </div>
            <div class="">
                <svg fill="currentColor" class="w-auto h-16" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16 21.916c-4.797 0.020-8.806 3.369-9.837 7.856l-0.013 0.068c-0.011 0.048-0.017 0.103-0.017 0.16 0 0.414 0.336 0.75 0.75 0.75 0.357 0 0.656-0.25 0.731-0.585l0.001-0.005c0.875-3.885 4.297-6.744 8.386-6.744s7.511 2.859 8.375 6.687l0.011 0.057c0.076 0.34 0.374 0.59 0.732 0.59 0 0 0.001 0 0.001 0h-0c0.057-0 0.112-0.007 0.165-0.019l-0.005 0.001c0.34-0.076 0.59-0.375 0.59-0.733 0-0.057-0.006-0.112-0.018-0.165l0.001 0.005c-1.045-4.554-5.055-7.903-9.849-7.924h-0.002zM9.164 10.602c0 0 0 0 0 0 2.582 0 4.676-2.093 4.676-4.676s-2.093-4.676-4.676-4.676c-2.582 0-4.676 2.093-4.676 4.676v0c0.003 2.581 2.095 4.673 4.675 4.676h0zM9.164 2.75c0 0 0 0 0 0 1.754 0 3.176 1.422 3.176 3.176s-1.422 3.176-3.176 3.176c-1.754 0-3.176-1.422-3.176-3.176v0c0.002-1.753 1.423-3.174 3.175-3.176h0zM22.926 10.602c2.582 0 4.676-2.093 4.676-4.676s-2.093-4.676-4.676-4.676c-2.582 0-4.676 2.093-4.676 4.676v0c0.003 2.581 2.095 4.673 4.675 4.676h0zM22.926 2.75c1.754 0 3.176 1.422 3.176 3.176s-1.422 3.176-3.176 3.176c-1.754 0-3.176-1.422-3.176-3.176v0c0.002-1.753 1.423-3.174 3.176-3.176h0zM30.822 19.84c-0.878-3.894-4.308-6.759-8.406-6.759-0.423 0-0.839 0.031-1.246 0.089l0.046-0.006c-0.049 0.012-0.092 0.028-0.133 0.047l0.004-0.002c-0.751-2.129-2.745-3.627-5.089-3.627-2.334 0-4.321 1.485-5.068 3.561l-0.012 0.038c-0.017-0.004-0.030-0.014-0.047-0.017-0.359-0.053-0.773-0.084-1.195-0.084-0.002 0-0.005 0-0.007 0h0c-4.092 0.018-7.511 2.874-8.392 6.701l-0.011 0.058c-0.011 0.048-0.017 0.103-0.017 0.16 0 0.414 0.336 0.75 0.75 0.75 0.357 0 0.656-0.25 0.731-0.585l0.001-0.005c0.737-3.207 3.56-5.565 6.937-5.579h0.002c0.335 0 0.664 0.024 0.985 0.070l-0.037-0.004c-0.008 0.119-0.036 0.232-0.036 0.354 0.006 2.987 2.429 5.406 5.417 5.406s5.411-2.419 5.416-5.406v-0.001c0-0.12-0.028-0.233-0.036-0.352 0.016-0.002 0.031 0.005 0.047 0.001 0.294-0.044 0.634-0.068 0.98-0.068 0.004 0 0.007 0 0.011 0h-0.001c3.379 0.013 6.203 2.371 6.93 5.531l0.009 0.048c0.076 0.34 0.375 0.589 0.732 0.59h0c0.057-0 0.112-0.007 0.165-0.019l-0.005 0.001c0.34-0.076 0.59-0.375 0.59-0.733 0-0.057-0.006-0.112-0.018-0.165l0.001 0.005zM16 18.916c-0 0-0 0-0.001 0-2.163 0-3.917-1.753-3.917-3.917s1.754-3.917 3.917-3.917c2.163 0 3.917 1.754 3.917 3.917 0 0 0 0 0 0.001v-0c-0.003 2.162-1.754 3.913-3.916 3.916h-0z"></path>
                </svg>
            </div>
        </div>
    </div>
    <div class="flex flex-wrap items-center justify-center">
        <div class="flex items-center justify-between h-40 p-8 rounded-lg shadow-lg w-80 bg-white/30 backdrop-blur-md">
            <div class="">
                <h1 class="text-2xl font-semibold">Rp. <?php echo $totalpemasukan; ?></h1>
                <p class="text-base">Pendapatan Hari Ini</p>
            </div>
            <div class="">
                <svg fill="currentColor" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    class="w-auto h-16" viewBox="0 0 50.189 50.189"
                    xml:space="preserve">
                    <g>
                        <path d="M38.799,23.748c-0.93-1.371-1.624-3.553-1.199-5.154l2.02-7.601c0.425-1.602-0.003-3.253-0.956-3.689 c-0.954-0.436-1.727-0.789-1.727-0.789c-0.635-0.289-1.403-0.614-2.325-0.92c-1.312-0.436-2.415-1.756-2.415-3.122 c0-1.365-1.343-2.473-3-2.473H21.25c-1.657,0-3,1.334-3,2.978s-1.265,3.469-2.644,4.388c-3.702,2.467-5.887,6.349-5.887,10.913 c0,2.063,0.439,3.822,1.157,5.322c0.715,1.494,1.293,3.811,0.881,5.417L9.438,38.07c-0.412,1.605-0.062,3.283,0.778,3.748 c0.842,0.465,1.524,0.843,1.524,0.843c0.977,0.54,2.119,1.02,3.356,1.422c1.576,0.513,2.9,1.959,2.9,3.435 c0,1.475,1.343,2.672,3,2.672h7.997c1.657,0,3-1.344,3-3v-0.305c0-1.656,1.271-3.475,2.664-4.371 c3.905-2.511,6.27-6.578,6.27-11.312C40.927,28.082,40.093,25.656,38.799,23.748z M30.306,39.699 c-1.537,0.615-2.889,1.955-2.889,3.391s-1.118,2.6-2.499,2.6c-1.379,0-2.498-1.072-2.498-2.396c0-1.325-1.347-2.441-2.979-2.732 c-1.005-0.18-1.963-0.416-2.835-0.69c-1.581-0.497-2.435-2.445-2.022-4.052l0.024-0.094c0.412-1.604,1.92-2.236,3.482-1.687 c1.675,0.591,3.6,1.002,5.643,1.002c2.927,0,4.896-1.161,4.896-3.13c0-1.918-1.615-3.129-5.399-4.393 c-5.401-1.815-9.086-4.341-9.086-9.237c0-3.624,2.037-6.591,5.66-8.133c1.524-0.649,2.87-1.925,2.87-3.249 c0-1.324,1.107-2.398,2.474-2.398c1.365,0,2.474,0.994,2.474,2.221c0,1.227,1.35,2.231,2.982,2.516 c0.56,0.098,1.082,0.215,1.57,0.347c1.602,0.431,2.478,2.302,2.059,3.876c-0.418,1.575-1.95,2.209-3.537,1.731 c-1.198-0.361-2.689-0.646-4.488-0.646c-3.28,0-4.341,1.464-4.341,2.877c0,1.615,1.767,2.726,6.106,4.29 c6.008,2.12,8.38,4.896,8.38,9.489C36.352,34.882,34.254,38.12,30.306,39.699z" />
                    </g>
                </svg>
            </div>
        </div>
    </div>
</div>