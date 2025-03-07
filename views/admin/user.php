<?php
include "./config/connect.php";

$petugas = $_SESSION['id'];
$query = mysqli_query($conn, "SELECT * FROM tb_user");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}


?>

<!--  -->

<div x-data="{ modal: false, selectedId: null, selectNama: null, selectEmail: null, selectLevel: null, selectNohp: null, selectAlamat: null, typeAksi: null,
    getLabel() {
                return this.typeAksi === 'Tambah Data' ? 'Simpan Data' :
                        this.typeAksi === 'Edit Data' ? 'Simpan Perubahan' :
                        this.typeAksi === 'Hapus Data' ? 'Hapus' : 
                        null;
            },
    getClass() {
                return this.typeAksi === 'Tambah Data' ? 'bg-green-500' :
                    this.typeAksi === 'Edit Data' ? 'bg-green-500' :
                    this.typeAksi === 'Hapus Data' ? 'bg-red-500' :
                    this.typeAksi === 'Detail Data' ? 'hidden' :
                    'bg-gray-500';
            },
                    }">

    <!-- tabel dan judul -->
    <div class="space-y-4">

        <!-- Judul dan tombol tambah, print, export -->
        <div class="flex items-center">
            <h1 class="flex-1 text-2xl font-semibold text-black">Daftar Karyawan</h1>
            <div class="flex items-center">
                <button id="btnPrint" type="button" class="inline-flex items-center justify-center w-24 gap-2 px-3 py-2 mr-2 text-sm border-2 rounded-lg button-print text-slate-600 hover:text-white border-slate-400 font-base focus:outline-none hover:bg-slate-600 disabled:opacity-50 disabled:pointer-events-none">
                    <svg class="w-auto h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 16.75H16C15.8011 16.75 15.6103 16.671 15.4697 16.5303C15.329 16.3897 15.25 16.1989 15.25 16C15.25 15.8011 15.329 15.6103 15.4697 15.4697C15.6103 15.329 15.8011 15.25 16 15.25H18C18.3315 15.25 18.6495 15.1183 18.8839 14.8839C19.1183 14.6495 19.25 14.3315 19.25 14V10C19.25 9.66848 19.1183 9.35054 18.8839 9.11612C18.6495 8.8817 18.3315 8.75 18 8.75H6C5.66848 8.75 5.35054 8.8817 5.11612 9.11612C4.8817 9.35054 4.75 9.66848 4.75 10V14C4.75 14.3315 4.8817 14.6495 5.11612 14.8839C5.35054 15.1183 5.66848 15.25 6 15.25H8C8.19891 15.25 8.38968 15.329 8.53033 15.4697C8.67098 15.6103 8.75 15.8011 8.75 16C8.75 16.1989 8.67098 16.3897 8.53033 16.5303C8.38968 16.671 8.19891 16.75 8 16.75H6C5.27065 16.75 4.57118 16.4603 4.05546 15.9445C3.53973 15.4288 3.25 14.7293 3.25 14V10C3.25 9.27065 3.53973 8.57118 4.05546 8.05546C4.57118 7.53973 5.27065 7.25 6 7.25H18C18.7293 7.25 19.4288 7.53973 19.9445 8.05546C20.4603 8.57118 20.75 9.27065 20.75 10V14C20.75 14.7293 20.4603 15.4288 19.9445 15.9445C19.4288 16.4603 18.7293 16.75 18 16.75Z" fill="currentColor" />
                        <path d="M16 8.75C15.8019 8.74741 15.6126 8.66756 15.4725 8.52747C15.3324 8.38737 15.2526 8.19811 15.25 8V4.75H8.75V8C8.75 8.19891 8.67098 8.38968 8.53033 8.53033C8.38968 8.67098 8.19891 8.75 8 8.75C7.80109 8.75 7.61032 8.67098 7.46967 8.53033C7.32902 8.38968 7.25 8.19891 7.25 8V4.5C7.25 4.16848 7.3817 3.85054 7.61612 3.61612C7.85054 3.3817 8.16848 3.25 8.5 3.25H15.5C15.8315 3.25 16.1495 3.3817 16.3839 3.61612C16.6183 3.85054 16.75 4.16848 16.75 4.5V8C16.7474 8.19811 16.6676 8.38737 16.5275 8.52747C16.3874 8.66756 16.1981 8.74741 16 8.75Z" fill="currentColor" />
                        <path d="M15.5 20.75H8.5C8.16848 20.75 7.85054 20.6183 7.61612 20.3839C7.3817 20.1495 7.25 19.8315 7.25 19.5V12.5C7.25 12.1685 7.3817 11.8505 7.61612 11.6161C7.85054 11.3817 8.16848 11.25 8.5 11.25H15.5C15.8315 11.25 16.1495 11.3817 16.3839 11.6161C16.6183 11.8505 16.75 12.1685 16.75 12.5V19.5C16.75 19.8315 16.6183 20.1495 16.3839 20.3839C16.1495 20.6183 15.8315 20.75 15.5 20.75ZM8.75 19.25H15.25V12.75H8.75V19.25Z" fill="currentColor" />
                    </svg>
                    Print
                </button>
                <button id="btnExcel" type="button" class="inline-flex items-center justify-center w-24 gap-2 px-3 py-2 mr-8 text-sm text-green-700 border-2 border-green-600 rounded-lg button-excel hover:text-white font-base focus:outline-none hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                    <svg class="shrink-0 size-3.5" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.0324 1.91994H9.45071C9.09999 1.91994 8.76367 2.05926 8.51567 2.30725C8.26767 2.55523 8.12839 2.89158 8.12839 3.24228V8.86395L20.0324 15.8079L25.9844 18.3197L31.9364 15.8079V8.86395L20.0324 1.91994Z" fill="#21A366"></path>
                        <path d="M8.12839 8.86395H20.0324V15.8079H8.12839V8.86395Z" fill="#107C41"></path>
                        <path d="M30.614 1.91994H20.0324V8.86395H31.9364V3.24228C31.9364 2.89158 31.7971 2.55523 31.5491 2.30725C31.3011 2.05926 30.9647 1.91994 30.614 1.91994Z" fill="#33C481"></path>
                        <path d="M20.0324 15.8079H8.12839V28.3736C8.12839 28.7243 8.26767 29.0607 8.51567 29.3087C8.76367 29.5567 9.09999 29.6959 9.45071 29.6959H30.6141C30.9647 29.6959 31.3011 29.5567 31.549 29.3087C31.797 29.0607 31.9364 28.7243 31.9364 28.3736V22.7519L20.0324 15.8079Z" fill="#185C37"></path>
                        <path d="M20.0324 15.8079H31.9364V22.7519H20.0324V15.8079Z" fill="#107C41"></path>
                        <path opacity="0.1" d="M16.7261 6.87994H8.12839V25.7279H16.7261C17.0764 25.7269 17.4121 25.5872 17.6599 25.3395C17.9077 25.0917 18.0473 24.756 18.0484 24.4056V8.20226C18.0473 7.8519 17.9077 7.51616 17.6599 7.2684C17.4121 7.02064 17.0764 6.88099 16.7261 6.87994Z" class="fill-black dark:fill-neutral-200" fill="currentColor"></path>
                        <path opacity="0.2" d="M15.7341 7.87194H8.12839V26.7199H15.7341C16.0844 26.7189 16.4201 26.5792 16.6679 26.3315C16.9157 26.0837 17.0553 25.748 17.0564 25.3976V9.19426C17.0553 8.84386 16.9157 8.50818 16.6679 8.26042C16.4201 8.01266 16.0844 7.87299 15.7341 7.87194Z" class="fill-black dark:fill-neutral-200" fill="currentColor"></path>
                        <path opacity="0.2" d="M15.7341 7.87194H8.12839V24.7359H15.7341C16.0844 24.7349 16.4201 24.5952 16.6679 24.3475C16.9157 24.0997 17.0553 23.764 17.0564 23.4136V9.19426C17.0553 8.84386 16.9157 8.50818 16.6679 8.26042C16.4201 8.01266 16.0844 7.87299 15.7341 7.87194Z" class="fill-black dark:fill-neutral-200" fill="currentColor"></path>
                        <path opacity="0.2" d="M14.7421 7.87194H8.12839V24.7359H14.7421C15.0924 24.7349 15.4281 24.5952 15.6759 24.3475C15.9237 24.0997 16.0633 23.764 16.0644 23.4136V9.19426C16.0633 8.84386 15.9237 8.50818 15.6759 8.26042C15.4281 8.01266 15.0924 7.87299 14.7421 7.87194Z" class="fill-black dark:fill-neutral-200" fill="currentColor"></path>
                        <path d="M1.51472 7.87194H14.7421C15.0927 7.87194 15.4291 8.01122 15.6771 8.25922C15.925 8.50722 16.0644 8.84354 16.0644 9.19426V22.4216C16.0644 22.7723 15.925 23.1087 15.6771 23.3567C15.4291 23.6047 15.0927 23.7439 14.7421 23.7439H1.51472C1.16402 23.7439 0.827672 23.6047 0.579686 23.3567C0.3317 23.1087 0.192383 22.7723 0.192383 22.4216V9.19426C0.192383 8.84354 0.3317 8.50722 0.579686 8.25922C0.827672 8.01122 1.16402 7.87194 1.51472 7.87194Z" fill="#107C41"></path>
                        <path d="M3.69711 20.7679L6.90722 15.794L3.96694 10.8479H6.33286L7.93791 14.0095C8.08536 14.3091 8.18688 14.5326 8.24248 14.68H8.26328C8.36912 14.4407 8.47984 14.2079 8.5956 13.9817L10.3108 10.8479H12.4822L9.46656 15.7663L12.5586 20.7679H10.2473L8.3932 17.2959C8.30592 17.148 8.23184 16.9927 8.172 16.8317H8.14424C8.09016 16.9891 8.01824 17.1399 7.92998 17.2811L6.02236 20.7679H3.69711Z" fill="white"></path>
                    </svg>
                    Ekspor
                </button>
                <button @click="modal = true, typeAksi = 'Tambah Data'" id="btnTambah" type="button" class="inline-flex items-center px-5 py-2 text-sm text-white bg-teal-500 border border-transparent rounded-lg font-base focus:outline-none hover:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none" onclick="kondisiModal('tambah')">
                    <svg class="w-auto h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 12H18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12 18V6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Tambah Data Karyawan
                </button>
            </div>
        </div>

        <!-- tabel user -->
        <div class="flex flex-col overflow-hidden ">
            <table id="myTable" class="min-w-full shadow-xl bg-white/30 backdrop-blur-xl rounded-t-3xl ">
                <thead class="bg-gray-100">
                    <tr class="">
                        <th scope="col" class="px-6 rounded-tl-3xl py-3 text-sm font-semibold !text-center text-gray-700 uppercase">No.</th>
                        <th scope="col" class="px-6 py-3 text-sm font-semibold !text-center text-gray-700 uppercase">Nama Karyawan</th>
                        <th scope="col" class="px-6 py-3 text-sm font-semibold !text-center text-gray-700 uppercase">Level</th>
                        <th scope="col" class="px-6 py-3 text-sm font-semibold !text-center text-gray-700 uppercase">No. Handphone</th>
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
                                <td class="px-6 py-4 text-sm text-center text-gray-800 whitespace-nowrap"><?php echo isset($row['nama']) ? $row['nama'] : '-'; ?></td>
                                <td class="px-6 py-4 text-sm !text-center text-gray-800 whitespace-nowrap">
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
                                <td class="px-6 py-4 text-sm !text-center text-gray-800 whitespace-nowrap"><?php echo $row['nohp'] ?></td>
                                <td class=" py-4 text-sm  whitespace-nowrap !text-center">
                                    <button type="button" class="inline-flex justify-center items-center w-16 py-[2px] text-sm font-medium text-teal-600 bg-teal-200/55 border mr-8 border-transparent rounded-full gap-x-2 hover:bg-teal-400/85 focus:outline-none disabled:opacity-50 disabled:pointer-events-none"
                                        data-id="<?php echo $row['id']; ?>"
                                        data-nama="<?php echo $row['nama']; ?>"
                                        data-username="<?php echo $row['username']; ?>"
                                        data-level="<?php echo $row['level']; ?>"
                                        data-nohp="<?php echo $row['nohp']; ?>"
                                        data-alamat="<?php echo $row['alamat']; ?>"
                                        @click="modal = true, selectedId = $el.dataset.id; selectNama = $el.dataset.nama; selectEmail = $el.dataset.username; selectLevel = $el.dataset.level; selectNohp = $el.dataset.nohp; selectAlamat = $el.dataset.alamat;typeAksi = 'Detail Data'"
                                        onclick="kondisiModal('detail')">
                                        Detail
                                    </button>
                                    <button type="button" class="inline-flex justify-center mr-8 items-center w-16 py-[2px] text-sm font-medium text-yellow-500 bg-yellow-200/55 border border-transparent rounded-full gap-x-2 hover:border-yel hover:bg-yellow-300/85 focus:outline-none disabled:opacity-50 disabled:pointer-events-none"
                                        data-id="<?php echo $row['id']; ?>"
                                        data-nama="<?php echo $row['nama']; ?>"
                                        data-username="<?php echo $row['username']; ?>"
                                        data-level="<?php echo $row['level']; ?>"
                                        data-nohp="<?php echo $row['nohp']; ?>"
                                        data-alamat="<?php echo $row['alamat']; ?>"
                                        @click="modal = true, selectedId = $el.dataset.id; selectNama = $el.dataset.nama; selectEmail = $el.dataset.username; selectLevel = $el.dataset.level; selectNohp = $el.dataset.nohp; selectAlamat = $el.dataset.alamat; typeAksi = 'Edit Data'"
                                        onclick="kondisiModal('edit')">
                                        Edit
                                    </button>
                                    <button type="button" class="inline-flex justify-center items-center w-16 py-[2px] text-sm font-medium text-red-500 bg-red-200/55 border border-transparent rounded-full gap-x-2 hover:bg-red-400/85 focus:outline-none disabled:opacity-50 disabled:pointer-events-none"
                                        data-id="<?php echo $row['id']; ?>"
                                        data-nama="<?php echo $row['nama']; ?>"
                                        data-username="<?php echo $row['username']; ?>"
                                        data-level="<?php echo $row['level']; ?>"
                                        data-nohp="<?php echo $row['nohp']; ?>"
                                        data-alamat="<?php echo $row['alamat']; ?>"
                                        @click="modal = true, selectedId = $el.dataset.id; selectNama = $el.dataset.nama; selectEmail = $el.dataset.username; selectLevel = $el.dataset.level; selectNohp = $el.dataset.nohp; selectAlamat = $el.dataset.alamat; typeAksi = 'Hapus Data'"
                                        onclick="kondisiModal('hapus')">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Backdrop modal -->
    <div x-show="modal" x-cloak class="fixed inset-0 z-[99998] bg-black/85 "
        x-transition.opacity>
    </div>

    <!-- Modal -->
    <div x-show="modal" x-cloak class="fixed inset-0 flex items-center justify-center z-[99999]"
        x-transition.scale>
        <div class="relative w-1/2 bg-white rounded-lg shadow-lg">
            <!-- Tombol Close (X) -->
            <button @click="modal= false; selectedId= null; selectNama= null; selectEmail= null; selectLevel= null; selectNohp= null; selectAlamat= null; " class="absolute text-gray-500 top-2 right-2 hover:text-gray-800">
                <svg class="w-8 h-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2ZM15.36 14.3C15.65 14.59 15.65 15.07 15.36 15.36C15.21 15.51 15.02 15.58 14.83 15.58C14.64 15.58 14.45 15.51 14.3 15.36L12 13.06L9.7 15.36C9.55 15.51 9.36 15.58 9.17 15.58C8.98 15.58 8.79 15.51 8.64 15.36C8.35 15.07 8.35 14.59 8.64 14.3L10.94 12L8.64 9.7C8.35 9.41 8.35 8.93 8.64 8.64C8.93 8.35 9.41 8.35 9.7 8.64L12 10.94L14.3 8.64C14.59 8.35 15.07 8.35 15.36 8.64C15.65 8.93 15.65 9.41 15.36 9.7L13.06 12L15.36 14.3Z" fill="currentColor" />
                </svg>
            </button>
            <form id="frmmodal" action="#" method="post" enctype="multipart/form-data">
                <input type="hidden" :value="selectedId" name="id">
                <!-- header modal -->
                <div class="flex items-center px-4 py-3 border-b">
                    <h2 class="text-xl font-semibold" x-text='typeAksi'></h2>
                </div>

                <!-- Konten Modal -->
                <div id="pesanHps" class="hidden px-4 py-3">
                    <p class="">Data Karyawan <span class="font-semibold text-red-500" x-text="selectNama"></span> akan dihapus permanen. Anda yakin ingin melanjutkan?</p>
                </div>
                <div id="inputModal" class="flex flex-col items-center gap-4 px-6 py-3 border-b">
                    <div class="flex min-w-full gap-8 mt-1 mb-5 text-gray-800">
                        <div class="w-full max-w-sm">
                            <label for="input-label-nama" class="block mb-2 text-sm font-medium">Nama Lengkap</label>
                            <input name="nama" type="text" id="input-label-nama" x-model="selectNama" :readonly="typeAksi == 'Detail Data' ? true : false" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Nama Lengkap Karyawan" required>
                        </div>
                        <div class="w-full max-w-sm">
                            <label for="input-label-mail" class="block mb-2 text-sm font-medium">Email</label>
                            <input name="email" type="email" id="input-label-mail" x-model="selectEmail" :readonly="typeAksi == 'Detail Data' ? true : false" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="karyawan@mail.com" required>
                        </div>
                    </div>
                    <div class="flex w-full gap-8 mt-1 mb-5 text-gray-800">
                        <div class="w-full max-w-sm">
                            <label for="hs-select-label" class="block mb-2 text-sm font-medium">Level User</label>
                            <select name="level" id="hs-select-label" x-model="selectLevel" :disabled="typeAksi == 'Detail Data' ? true : false" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:text-black disabled:pointer-events-none" required>
                                <option value="" selected="">Silahkan pilih...</option>
                                <option value="1">Admin</option>
                                <option value="2">Kasir</option>
                                <option value="3">Pelayan</option>
                                <option value="4">Dapur</option>
                            </select>
                        </div>
                        <div class="w-full max-w-sm">
                            <label for="input-label-no" class="block mb-2 text-sm font-medium">Nomor Handphone</label>
                            <input name="nohp" type="number" x-model="selectNohp" :readonly="typeAksi == 'Detail Data' ? true : false" id="input-label-no" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Nomor karyawan yang bisa dihubungi" minlength="10" maxlength="14" required>
                        </div>
                    </div>
                    <div class="w-full mt-1 mb-5 text-gray-800">
                        <div class="w-full">
                            <label for="hs-autoheight-textarea" class="block mb-2 text-sm font-medium">Alamat Karyawan</label>
                            <textarea name="alamat" id="hs-autoheight-textarea" :readonly="typeAksi == 'Detail Data' ? true : false" x-model="selectAlamat" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" rows="3" placeholder="Alamat lengkap karyawan..." data-hs-textarea-auto-height='{
                                "defaultHeight": 96}' required></textarea>
                        </div>
                    </div>
                </div>

                <!-- footer modal -->
                <div class="flex justify-end gap-3 px-4 py-3">
                    <button type="button" @click="modal= false; selectedId= null; selectNama= null; selectEmail= null; selectLevel= null; selectNohp= null; selectAlamat= null;" class="px-4 py-2 text-white bg-gray-500 rounded-lg hover:bg-gray-700">
                        Batal
                    </button>
                    <button id="btnSubmit" name="input_user_validate" type="submit" :class="getClass()" class="inline-flex items-center px-3 py-2 font-medium text-white border border-transparent rounded-lg gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none" x-text="getLabel()"></button>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- javascript -->
<script src="./public/assets/js/jquery-3.7.1.min.js"></script>
<script src="./public/assets/js/datatables.min.js"></script>
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

    // ===========================================================




    const pesanHps = document.getElementById('pesanHps');
    const inputModal = document.getElementById('inputModal');
    const form = document.getElementById("frmmodal");

    let modalType = '';


    function kondisiModal(typeModal) {
        modalType = typeModal;

        if (modalType == "hapus") {
            inputModal.classList.add("hidden");
            pesanHps.classList.remove("hidden");

            form.action = "./proses/proses_delete_user.php";

        } else {
            pesanHps.classList.add("hidden");
            inputModal.classList.remove("hidden");

            if (modalType == "edit") {
                form.action = "./proses/proses_edit_user.php";
            } else {
                form.action = "./proses/proses_input_user.php";
            }
        }

    }
</script>