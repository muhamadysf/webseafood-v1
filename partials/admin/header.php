<div class="w-full p-2 shadow-xl bg-white/30">
  <div class="flex items-center">
    <button @click="open = !open" class="p-1 rounded hover:text-white ">☰</button>
    <div class="flex justify-between flex-1">
      <div class="ml-3 text-2xl" id="date-info">Senin, 1 Januari 2024</div>

      <h1 class="text-2xl -translate-x-28"><span id="digital-clock" class="">00:00:00</span> WIB</h1>

      <div class="relative inline-flex mr-4 hs-dropdown">
        <button id="hs-dropdown-custom-icon-trigger" type="button" class="flex items-center justify-center text-sm font-semibold text-gray-800 bg-transparent rounded-lg shadow-sm focus:text-white hs-dropdown-toggle size-9 hover:text-gray-50 focus:outline-none disabled:opacity-50 disabled:pointer-events-none" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
          <svg class="h-auto w-14" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="currentColor">

            <g id="SVGRepo_bgCarrier" stroke-width="0" />

            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

            <g id="SVGRepo_iconCarrier">

              <path fill="currentColor" d="M600.704 64a32 32 0 0 1 30.464 22.208l35.2 109.376c14.784 7.232 28.928 15.36 42.432 24.512l112.384-24.192a32 32 0 0 1 34.432 15.36L944.32 364.8a32 32 0 0 1-4.032 37.504l-77.12 85.12a357.12 357.12 0 0 1 0 49.024l77.12 85.248a32 32 0 0 1 4.032 37.504l-88.704 153.6a32 32 0 0 1-34.432 15.296L708.8 803.904c-13.44 9.088-27.648 17.28-42.368 24.512l-35.264 109.376A32 32 0 0 1 600.704 960H423.296a32 32 0 0 1-30.464-22.208L357.696 828.48a351.616 351.616 0 0 1-42.56-24.64l-112.32 24.256a32 32 0 0 1-34.432-15.36L79.68 659.2a32 32 0 0 1 4.032-37.504l77.12-85.248a357.12 357.12 0 0 1 0-48.896l-77.12-85.248A32 32 0 0 1 79.68 364.8l88.704-153.6a32 32 0 0 1 34.432-15.296l112.32 24.256c13.568-9.152 27.776-17.408 42.56-24.64l35.2-109.312A32 32 0 0 1 423.232 64H600.64zm-23.424 64H446.72l-36.352 113.088-24.512 11.968a294.113 294.113 0 0 0-34.816 20.096l-22.656 15.36-116.224-25.088-65.28 113.152 79.68 88.192-1.92 27.136a293.12 293.12 0 0 0 0 40.192l1.92 27.136-79.808 88.192 65.344 113.152 116.224-25.024 22.656 15.296a294.113 294.113 0 0 0 34.816 20.096l24.512 11.968L446.72 896h130.688l36.48-113.152 24.448-11.904a288.282 288.282 0 0 0 34.752-20.096l22.592-15.296 116.288 25.024 65.28-113.152-79.744-88.192 1.92-27.136a293.12 293.12 0 0 0 0-40.256l-1.92-27.136 79.808-88.128-65.344-113.152-116.288 24.96-22.592-15.232a287.616 287.616 0 0 0-34.752-20.096l-24.448-11.904L577.344 128zM512 320a192 192 0 1 1 0 384 192 192 0 0 1 0-384zm0 64a128 128 0 1 0 0 256 128 128 0 0 0 0-256z" />

            </g>

          </svg>
        </button>

        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 z-[9999] hidden min-w-48 bg-white shadow-md rounded-lg mt-2" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-custom-icon-trigger">
          <div class="p-1 space-y-0.5">
            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100" href="#">
              <svg class="w-5 h-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

                <g id="SVGRepo_bgCarrier" stroke-width="0" />

                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                <g id="SVGRepo_iconCarrier">
                  <path d="M12.12 12.78C12.05 12.77 11.96 12.77 11.88 12.78C10.12 12.72 8.71997 11.28 8.71997 9.50998C8.71997 7.69998 10.18 6.22998 12 6.22998C13.81 6.22998 15.28 7.69998 15.28 9.50998C15.27 11.28 13.88 12.72 12.12 12.78Z" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M18.74 19.3801C16.96 21.0101 14.6 22.0001 12 22.0001C9.40001 22.0001 7.04001 21.0101 5.26001 19.3801C5.36001 18.4401 5.96001 17.5201 7.03001 16.8001C9.77001 14.9801 14.25 14.9801 16.97 16.8001C18.04 17.5201 18.64 18.4401 18.74 19.3801Z" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </g>

              </svg>
              Profile
            </a>
            <a class=" flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100" href="#" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-custom-backdrop-modal" data-hs-overlay="#hs-custom-backdrop-modal">
              <svg fill="#999999" class="w-5 h-auto" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">

                <g id="SVGRepo_bgCarrier" stroke-width="0" />

                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                <g id="SVGRepo_iconCarrier">
                  <g id="Change_password">
                    <path d="M464.4326,147.54a9.8985,9.8985,0,0,0-17.56,9.1406,214.2638,214.2638,0,0,1-38.7686,251.42c-83.8564,83.8476-220.3154,83.874-304.207-.0088a9.8957,9.8957,0,0,0-16.8926,7.0049v56.9a9.8965,9.8965,0,0,0,19.793,0v-34.55A234.9509,234.9509,0,0,0,464.4326,147.54Z" />
                    <path d="M103.8965,103.9022c83.8828-83.874,220.3418-83.8652,304.207-.0088a9.8906,9.8906,0,0,0,16.8926-6.9961v-56.9a9.8965,9.8965,0,0,0-19.793,0v34.55C313.0234-1.3556,176.0547,3.7509,89.9043,89.9012A233.9561,233.9561,0,0,0,47.5674,364.454a9.8985,9.8985,0,0,0,17.56-9.1406A214.2485,214.2485,0,0,1,103.8965,103.9022Z" />
                    <path d="M126.4009,254.5555v109.44a27.08,27.08,0,0,0,27,27H358.5991a27.077,27.077,0,0,0,27-27v-109.44a27.0777,27.0777,0,0,0-27-27H153.4009A27.0805,27.0805,0,0,0,126.4009,254.5555ZM328,288.13a21.1465,21.1465,0,1,1-21.1465,21.1464A21.1667,21.1667,0,0,1,328,288.13Zm-72,0a21.1465,21.1465,0,1,1-21.1465,21.1464A21.1667,21.1667,0,0,1,256,288.13Zm-72,0a21.1465,21.1465,0,1,1-21.1465,21.1464A21.1667,21.1667,0,0,1,184,288.13Z" />
                    <path d="M343.6533,207.756V171.7538a87.6533,87.6533,0,0,0-175.3066,0V207.756H188.14V171.7538a67.86,67.86,0,0,1,135.7208,0V207.756Z" />
                  </g>
                </g>

              </svg>
              Ganti Password
            </a>
            <hr class="w-full h-[1px] bg-gray-200">
            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100" href="logout">
              <svg class="w-5 h-auto" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">

                <g id="SVGRepo_bgCarrier" stroke-width="0" />

                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                <g id="SVGRepo_iconCarrier">
                  <path d="M11.75 9.874C11.75 10.2882 12.0858 10.624 12.5 10.624C12.9142 10.624 13.25 10.2882 13.25 9.874H11.75ZM13.25 4C13.25 3.58579 12.9142 3.25 12.5 3.25C12.0858 3.25 11.75 3.58579 11.75 4H13.25ZM9.81082 6.66156C10.1878 6.48991 10.3542 6.04515 10.1826 5.66818C10.0109 5.29121 9.56615 5.12478 9.18918 5.29644L9.81082 6.66156ZM5.5 12.16L4.7499 12.1561L4.75005 12.1687L5.5 12.16ZM12.5 19L12.5086 18.25C12.5029 18.25 12.4971 18.25 12.4914 18.25L12.5 19ZM19.5 12.16L20.2501 12.1687L20.25 12.1561L19.5 12.16ZM15.8108 5.29644C15.4338 5.12478 14.9891 5.29121 14.8174 5.66818C14.6458 6.04515 14.8122 6.48991 15.1892 6.66156L15.8108 5.29644ZM13.25 9.874V4H11.75V9.874H13.25ZM9.18918 5.29644C6.49843 6.52171 4.7655 9.19951 4.75001 12.1561L6.24999 12.1639C6.26242 9.79237 7.65246 7.6444 9.81082 6.66156L9.18918 5.29644ZM4.75005 12.1687C4.79935 16.4046 8.27278 19.7986 12.5086 19.75L12.4914 18.25C9.08384 18.2892 6.28961 15.5588 6.24995 12.1513L4.75005 12.1687ZM12.4914 19.75C16.7272 19.7986 20.2007 16.4046 20.2499 12.1687L18.7501 12.1513C18.7104 15.5588 15.9162 18.2892 12.5086 18.25L12.4914 19.75ZM20.25 12.1561C20.2345 9.19951 18.5016 6.52171 15.8108 5.29644L15.1892 6.66156C17.3475 7.6444 18.7376 9.79237 18.75 12.1639L20.25 12.1561Z" fill="#999999" />
                </g>

              </svg>

              Keluar
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- modal ubah password -->
<div id="hs-custom-backdrop-modal" class="hs-overlay [--overlay-backdrop:static] hs-overlay-backdrop-open:bg-primary-950/90 hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-custom-backdrop-label">
  <div class="m-3 mt-0 transition-all ease-out opacity-0 hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 sm:max-w-lg sm:w-full sm:mx-auto">
    <div class="flex flex-col bg-white border shadow-sm pointer-events-auto rounded-xl">
      <form class="" action="proses/proses_ubah_password.php" novalidate method="post">
        <div class="flex items-center justify-between px-4 py-3 border-b">
          <h3 id="hs-custom-backdrop-label" class="font-semibold text-gray-800">
            Ubah Password
          </h3>
          <button type="button" class="inline-flex items-center justify-center text-gray-800 bg-gray-100 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none" aria-label="Close" data-hs-overlay="#hs-custom-backdrop-modal">
            <span class="sr-only">Close</span>
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M18 6 6 18"></path>
              <path d="m6 6 12 12"></path>
            </svg>
          </button>
        </div>
        <div class="p-4 overflow-y-auto">
          <div class="">
            <div class="flex flex-col w-full gap-3 px-8 mb-5">
              <input type="hidden" class="" id="id" name="id" required value="<?php echo $_SESSION['id'] ?>">
              <div class="">
                <label for="hs-toggle-password-with-checkbox-o" class="block mb-2 text-sm">Old password</label>
                <input name="passwordlama" id="hs-toggle-password-with-checkbox-o" type="password" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Masukkan password lama anda...">
              </div>
              <div class="">
                <label for="hs-toggle-password-with-checkbox-n" class="block mb-2 text-sm">New password</label>
                <input name="passwordbaru" id="hs-toggle-password-with-checkbox-n" type="password" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Masukkan password baru anda...">
              </div>
              <div class="">
                <label for="hs-toggle-password-with-checkbox-c" class="block mb-2 text-sm">Current password</label>
                <input name="repasswordbaru" id="hs-toggle-password-with-checkbox-c" type="password" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Masukkan ulang password baru anda...">
              </div>
              <div class="flex justify-end">
                <input data-hs-toggle-password='{
                                    "target": ["#hs-toggle-password-with-checkbox-o", "#hs-toggle-password-with-checkbox-n", "#hs-toggle-password-with-checkbox-c"]
                                }' id="hs-toggle-password-checkbox" type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500">
                <label for="hs-toggle-password-checkbox" class="text-sm text-gray-500 ms-3">Show password</label>
              </div>

            </div>
          </div>
        </div>
        <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2">
          <button type="button" class="inline-flex items-center px-8 py-4 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-custom-backdrop-modal">
            Batal
          </button>
          <button name="ubah_password_validate" type="submit" class="inline-flex items-center px-3 py-4 text-sm font-medium text-white border border-transparent rounded-lg bg-primary-550 gap-x-2 hover:bg-primary-400 focus:outline-none focus:bg-primary-400 disabled:opacity-50 disabled:pointer-events-none">
            Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>