<div class="w-full" x-data="{ modal: false}">
    <div class="flex items-end w-full">
        <div class="flex items-center justify-between px-5 py-2 w-96 bg-primary-500 rounded-xl">
            <h3 class="text-base font-semibold text-white">Klik untuk scan barcode :</h3>
            <button class="py-[2px] text-black rounded-full px-7 bg-slate-200" type="button" @click="modal = true">Scan</button>
        </div>
    </div>

    <!-- ========================================= -->
    <div class="flex w-full mt-3 space-x-3">

        <!-- Info Pembeli -->
        <div class="w-2/5 shadow-xl rounded-xl">

            <!-- Judul table -->
            <div class="flex items-center gap-3 px-5 py-2 bg-primary-500 rounded-t-xl">
                <svg class="text-white size-6" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z" fill="currentColor" />
                    <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z" fill="currentColor" />
                </svg>
                <h1 class="font-semibold text-white">Informasi Pesanan</h1>
            </div>

            <!-- Isi table -->
            <div class="flex w-full px-5 pt-2 pb-5 bg-white rounded-b-xl">
                <div class="w-full">
                    <div class="p-3 bg-gray-300 ">
                        <h3 class="text-sm text-black">Nomor Pesanan </h3>
                    </div>
                    <div class="p-3 bg-gray-200 ">
                        <h3 class="text-sm text-black">Jenis Pesanan</h3>
                    </div>
                    <div class="p-3 bg-gray-300 ">
                        <h3 class="text-sm text-black">Nomor Meja</h3>
                    </div>
                    <div class="p-3 bg-gray-200 ">
                        <h3 class="text-sm text-black">Atas Nama</h3>
                    </div>
                    <div class="p-3 bg-gray-300 ">
                        <h3 class="text-sm text-black">Status Pembayaran</h3>
                    </div>
                    <div class="p-3 bg-gray-200 ">
                        <h3 class="text-sm text-black">Tanggal dan Waktu</h3>
                    </div>
                </div>
                <div class="w-full">
                    <div class="p-3 bg-gray-300 ">
                        <p class="text-sm text-black">: <span class=""> xxxxxxx</span></p>
                    </div>
                    <div class="p-3 bg-gray-200 ">
                        <p class="text-sm text-black">: <span class=""> xxxxxxx</span></p>
                    </div>
                    <div class="p-3 bg-gray-300 ">
                        <p class="text-sm text-black">: <span class=""> xxxxxxx</span></p>
                    </div>
                    <div class="p-3 bg-gray-200 ">
                        <p class="text-sm text-black">: <span class=""> xxxxxxx</span></p>
                    </div>
                    <div class="p-3 bg-gray-300 ">
                        <p class="text-sm text-black">: <span class=""> xxxxxxx</span></p>
                    </div>
                    <div class="p-3 bg-gray-200 ">
                        <p class="text-sm text-black">: <span class=""> xxxxxxx</span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Menu -->
        <div class="w-3/5 shadow-xl rounded-xl">

            <!-- Judul table -->
            <div class="flex items-center gap-3 px-5 py-2 bg-primary-500 rounded-t-xl">
                <svg class="text-white size-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 6.00067L21 6.00139M8 12.0007L21 12.0015M8 18.0007L21 18.0015M3.5 6H3.51M3.5 12H3.51M3.5 18H3.51M4 6C4 6.27614 3.77614 6.5 3.5 6.5C3.22386 6.5 3 6.27614 3 6C3 5.72386 3.22386 5.5 3.5 5.5C3.77614 5.5 4 5.72386 4 6ZM4 12C4 12.2761 3.77614 12.5 3.5 12.5C3.22386 12.5 3 12.2761 3 12C3 11.7239 3.22386 11.5 3.5 11.5C3.77614 11.5 4 11.7239 4 12ZM4 18C4 18.2761 3.77614 18.5 3.5 18.5C3.22386 18.5 3 18.2761 3 18C3 17.7239 3.22386 17.5 3.5 17.5C3.77614 17.5 4 17.7239 4 18Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <h1 class="font-semibold text-white">Detail Pesanan</h1>
            </div>

            <!-- Isi table -->
            <div class="flex w-full px-5 py-2 bg-white rounded-b-xl">
                <div class="flex flex-col overflow-hidden ">
                    <table id="myTable" class="min-w-full shadow-xl bg-white/30 backdrop-blur-xl rounded-t-3xl">
                        <thead class="bg-gray-100">
                            <tr class="">
                                <th scope="col" class="px-6 rounded-tl-3xl py-3 text-sm !text-center text-gray-700 uppercase">No.</th>
                                <th scope="col" class="px-6 py-3 text-sm  !text-center text-gray-700 uppercase">Nama Kategori</th>
                                <th scope="col" class="px-6 py-3 text-sm  !text-center text-gray-700 uppercase">Jumlah Produk</th>
                                <th scope="col" class="px-6 py-3 text-sm  !text-center text-gray-700 uppercase">Tanggal Ditambahkan</th>
                                <th scope="col" class="px-6 py-3 text-sm  !text-center text-gray-700 uppercase">Logo</th>
                                <th scope="col" class="rounded-tr-3xl px-6 py-3 text-sm  !text-center text-gray-700 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap !text-center"></td>
                                <td class="px-6 py-4 text-sm font-medium text-center text-gray-800 whitespace-nowrap"></td>
                                <td class="px-6 py-4 text-sm font-medium !text-center text-gray-800 whitespace-nowrap"></td>
                                <td class="px-6 py-4 text-sm !text-center text-gray-800 whitespace-nowrap"></td>
                                <td class="px-6 py-4 text-sm !text-center text-gray-800 whitespace-nowrap"></td>
                                <td class="px-6 py-4 text-sm  whitespace-nowrap !text-center">

                                    <button type="button" class="inline-flex justify-center items-center w-16 py-[2px] text-sm font-medium text-red-500 bg-red-200/55 border border-transparent rounded-full gap-x-2 hover:bg-red-400/85 focus:outline-none disabled:opacity-50 disabled:pointer-events-none" @click="modal = true">
                                        <svg class="size-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6M18 6V16.2C18 17.8802 18 18.7202 17.673 19.362C17.3854 19.9265 16.9265 20.3854 16.362 20.673C15.7202 21 14.8802 21 13.2 21H10.8C9.11984 21 8.27976 21 7.63803 20.673C7.07354 20.3854 6.6146 19.9265 6.32698 19.362C6 18.7202 6 17.8802 6 16.2V6M14 10V17M10 10V17" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal untuk scanner barcode -->
    <div x-show="modal" x-cloak class="fixed inset-0 flex items-center justify-center z-[99999]"
        x-transition.scale>
        <div class="relative w-1/3 bg-white rounded-lg shadow-lg">
            <!-- Tombol Close (X) -->
            <button @click="modal= false; selectedId= null; selectNama= null;  selectImg= null; $refs.fileInput.value = ''; setPabrik();" class="absolute text-gray-500 top-2 right-2 hover:text-gray-800">
                <svg class="w-8 h-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2ZM15.36 14.3C15.65 14.59 15.65 15.07 15.36 15.36C15.21 15.51 15.02 15.58 14.83 15.58C14.64 15.58 14.45 15.51 14.3 15.36L12 13.06L9.7 15.36C9.55 15.51 9.36 15.58 9.17 15.58C8.98 15.58 8.79 15.51 8.64 15.36C8.35 15.07 8.35 14.59 8.64 14.3L10.94 12L8.64 9.7C8.35 9.41 8.35 8.93 8.64 8.64C8.93 8.35 9.41 8.35 9.7 8.64L12 10.94L14.3 8.64C14.59 8.35 15.07 8.35 15.36 8.64C15.65 8.93 15.65 9.41 15.36 9.7L13.06 12L15.36 14.3Z" fill="currentColor" />
                </svg>
            </button>
            <form id="frmmodal" action="#" method="post" enctype="multipart/form-data">
                <input type="hidden" :value="selectedId" name="iduser">
                <!-- header modal -->
                <div class="flex items-center px-4 py-3 border-b">
                    <h2 class="text-xl " x-text='typeAksi'></h2>
                </div>

                <!-- Konten Modal -->
                <div id="pesanHps" class="hidden px-4 py-3">
                    <p class="">Data kategori <span class="font-semibold text-red-500" x-text="selectNama"></span> akan dihapus permanen. Anda yakin ingin melanjutkan?</p>
                </div>
                <div id="inputModal" class="flex flex-col items-center gap-4 px-4 py-3 border-b">
                    <div class="w-full max-w-sm">
                        <label for="nama-kategori" class="block mb-2 text-sm font-medium">Nama Kategori</label>
                        <input id="nama-kategori" name="namakategori" x-model="selectNama" type="text" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Ketik kategori baru..." required>
                    </div>
                    <div class="">
                        <div class="flex flex-wrap items-center gap-3 px-3 sm:gap-5">
                            <div id="preview" :class="selectImg != null ? 'block' : 'hidden'" class="size-20" @click="$refs.fileInput.click()">
                                <img id="previewIMG" :src="'../'+selectImg" class="object-cover w-full h-full rounded-full">
                            </div>
                            <div id="mockup" :class="selectImg === null ? 'block' : 'hidden'" class="group" @click="$refs.fileInput.click()">
                                <span id="mockupId" class="group-has-[div]:hidden flex shrink-0 justify-center items-center size-20 border-2 border-dotted  text-gray-400 cursor-pointer rounded-full hover:bg-gray-50">
                                    <svg class="shrink-0 size-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <circle cx="12" cy="10" r="3"></circle>
                                        <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="grow">
                                <div class="flex items-center gap-x-2">
                                    <button @click="$refs.fileInput.click()" type="button" class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-teal-500 border border-transparent rounded-lg gap-x-2 hover:bg-teal-500/55 hover:ring-2 hover:ring-teal-700 hover:text-teal-700 disabled:opacity-50 disabled:pointer-events-none">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                            <polyline points="17 8 12 3 7 8"></polyline>
                                            <line x1="12" x2="12" y1="3" y2="15"></line>
                                        </svg>
                                        Pilih logo kategori...
                                    </button>
                                    <button type="button" class="inline-flex items-center px-3 py-2 text-xs font-semibold text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 hover:ring-2 hover:ring-gray-600 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" @click="selectImg= null;$refs.fileInput.value = '';">Delete</button>
                                </div>
                            </div>
                        </div>
                        <p id="pesanError" class="invisible text-sm text-red-500 "></p>
                    </div>
                    <input name="file" id="file" @change="handleFileChange" type="file" x-ref="fileInput" class="hidden" accept="image/*">
                </div>

                <!-- footer modal -->
                <div class="flex justify-end gap-3 px-4 py-3">
                    <button type="button" @click="modal= false; selectedId= null; selectNama= null; selectImg= null;$refs.fileInput.value = ''; setPabrik();" class="px-4 py-2 text-white bg-gray-500 rounded-lg hover:bg-gray-700">
                        Batal
                    </button>
                    <button id="btnSubmit" name="btnsubmit" type="submit" :class="getClass()" class="inline-flex items-center px-3 py-2 font-medium text-white border border-transparent rounded-lg gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none" x-text="getLabel()"></button>
                </div>
            </form>
        </div>
    </div>
</div>