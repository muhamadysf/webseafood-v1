<aside class="fixed z-[999] inset-y-0 left-0 w-56 text-white transition-transform duration-300 transform shadow-xl bg-primary-600" :class="open ? 'translate-x-0' : '-translate-x-full'">
    <div class="flex flex-col py-4 px-7">
        <div class="flex items-center mb-8 hover:cursor-default">
            <img class="w-10 h-auto" src="./public/assets/images/logo.png" alt="logo">
            <h1 class="ml-2 text-lg font-semibold">King Seafood</h1>
        </div>

        <nav class="flex flex-col gap-y-8">
            <div class="<?php echo ((isset($_GET['x']) && $_GET['x'] == 'home') || !isset($_GET['x'])) ? 'text-primary-550 bg-white' : 'bg-white/90 text-primary-350'; ?> inline-flex items-center gap-2 py-1 pl-2 rounded-lg  group hover:cursor-pointer hover:text-primary-550 hover:bg-white hover:rounded-lg">
                <svg class="w-6 h-auto group-hover:text-primary-550" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.918 10.0005H7.082C6.66587 9.99708 6.26541 10.1591 5.96873 10.4509C5.67204 10.7427 5.50343 11.1404 5.5 11.5565V17.4455C5.5077 18.3117 6.21584 19.0078 7.082 19.0005H9.918C10.3341 19.004 10.7346 18.842 11.0313 18.5502C11.328 18.2584 11.4966 17.8607 11.5 17.4445V11.5565C11.4966 11.1404 11.328 10.7427 11.0313 10.4509C10.7346 10.1591 10.3341 9.99708 9.918 10.0005Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.918 4.0006H7.082C6.23326 3.97706 5.52559 4.64492 5.5 5.4936V6.5076C5.52559 7.35629 6.23326 8.02415 7.082 8.0006H9.918C10.7667 8.02415 11.4744 7.35629 11.5 6.5076V5.4936C11.4744 4.64492 10.7667 3.97706 9.918 4.0006Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.082 13.0007H17.917C18.3333 13.0044 18.734 12.8425 19.0309 12.5507C19.3278 12.2588 19.4966 11.861 19.5 11.4447V5.55666C19.4966 5.14054 19.328 4.74282 19.0313 4.45101C18.7346 4.1592 18.3341 3.9972 17.918 4.00066H15.082C14.6659 3.9972 14.2654 4.1592 13.9687 4.45101C13.672 4.74282 13.5034 5.14054 13.5 5.55666V11.4447C13.5034 11.8608 13.672 12.2585 13.9687 12.5503C14.2654 12.8421 14.6659 13.0041 15.082 13.0007Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.082 19.0006H17.917C18.7661 19.0247 19.4744 18.3567 19.5 17.5076V16.4936C19.4744 15.6449 18.7667 14.9771 17.918 15.0006H15.082C14.2333 14.9771 13.5256 15.6449 13.5 16.4936V17.5066C13.525 18.3557 14.2329 19.0241 15.082 19.0006Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <a href="home" class="text-base font-semibold " aria-current="page">Dashboard</a>
            </div>

            <!-- Transaksi -->
            <div class=" <?php echo ($_SESSION['level_kingseafood'] == 1) || ($_SESSION['level_kingseafood'] == 2) ? 'flex flex-col' : 'hidden'; ?> ">
                <h3 class="mb-4 text-xs text-gray-400">Transaksi</h3>
                <div class="rounded-lg inline-flex items-center gap-2 py-1 pl-3 group hover:cursor-pointer hover:text-primary-550 hover:bg-white hover:rounded-lg
                    <?php echo ((isset($_GET['x']) && $_GET['x'] == 'poskasir')) ? 'text-primary-550 bg-white font-semibold' : ' text-white'; ?>">
                    <svg fill="currentColor" class="w-6 h-auto group-hover:text-primary-550" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M16,6 L20,6 C21.1045695,6 22,6.8954305 22,8 L22,16 C22,17.1045695 21.1045695,18 20,18 L16,18 L16,19.9411765 C16,21.0658573 15.1177541,22 14,22 L4,22 C2.88224586,22 2,21.0658573 2,19.9411765 L2,4.05882353 C2,2.93414267 2.88224586,2 4,2 L14,2 C15.1177541,2 16,2.93414267 16,4.05882353 L16,6 Z M20,11 L16,11 L16,16 L20,16 L20,11 Z M14,19.9411765 L14,4.05882353 C14,4.01396021 13.9868154,4 14,4 L4,4 C4.01318464,4 4,4.01396021 4,4.05882353 L4,19.9411765 C4,19.9860398 4.01318464,20 4,20 L14,20 C13.9868154,20 14,19.9860398 14,19.9411765 Z M5,19 L5,17 L7,17 L7,19 L5,19 Z M8,19 L8,17 L10,17 L10,19 L8,19 Z M11,19 L11,17 L13,17 L13,19 L11,19 Z M5,16 L5,14 L7,14 L7,16 L5,16 Z M8,16 L8,14 L10,14 L10,16 L8,16 Z M11,16 L11,14 L13,14 L13,16 L11,16 Z M13,5 L13,13 L5,13 L5,5 L13,5 Z M7,7 L7,11 L11,11 L11,7 L7,7 Z M20,9 L20,8 L16,8 L16,9 L20,9 Z" />
                    </svg>
                    <a href="poskasir" class="text-sm group-hover:font-semibold">POS Kasir</a>
                </div>
            </div>

            <!-- Menu dan Kategori -->
            <div class="<?php echo ($_SESSION['level_kingseafood'] == 1) ? 'flex flex-col' : 'hidden'; ?>">
                <h3 class="mb-4 text-xs text-gray-400">Menu & Kategori</h3>

                <div class="space-y-3 ">
                    <div class="rounded-lg inline-flex items-center w-full gap-2 py-1 pl-3 group hover:cursor-pointer hover:text-primary-550 hover:bg-white hover:rounded-lg
                    <?php echo ((isset($_GET['x']) && $_GET['x'] == 'menu')) ? 'text-primary-550 bg-white font-semibold' : ' text-white'; ?>">
                        <svg fill="currentColor" class="w-6 h-auto group-hover:text-primary-550" viewBox="0 0 64 64" id="Layer_1_1_" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <path d="M63,7V1H45.78c-1.523,0-2.804,1.141-2.979,2.652L41.243,17H25v6h2.095l1.554,15.537C27.574,34.769,24.108,32,20,32  c-4.289,0-7.88,3.018-8.778,7.04L2.903,21.57L1.097,22.43l9.481,19.911C6.79,43.402,4,46.877,4,51c0,0.68,0.084,1.347,0.232,2H2.382  l-1.5,3l3.5,7H32h3.618h21.287l4-40H63v-6H47.633l1.25-10H63z M29.019,42.237c-0.035-0.008-0.069-0.019-0.104-0.027  c0.025-0.187,0.031-0.377,0.045-0.565L29.019,42.237z M30.306,35h8.049C36.312,36.651,35,39.174,35,42s1.312,5.349,3.356,7h-2.587  c-0.597-2.616-2.334-4.799-4.661-5.999L30.306,35z M51,42c0,3.859-3.14,7-7,7s-7-3.141-7-7s3.14-7,7-7S51,38.141,51,42z M49.644,35  h8.051l-1.4,14h-6.651C51.688,47.349,53,44.826,53,42S51.688,36.651,49.644,35z M21.768,53C21.916,52.347,22,51.68,22,51  c0-0.518-0.054-1.022-0.138-1.516C23.024,48.524,24.107,48,25,48c1.026,0,1.792,0.471,2.76,1.067C29.159,49.929,30.899,51,34,51  c0,0.684-0.098,1.354-0.29,2H21.768z M13.078,42.004c-0.032-0.226-0.047-0.453-0.058-0.682C13.948,40.189,16.125,38,18,38  c1.026,0,1.792,0.471,2.76,1.067C22.159,39.929,23.899,41,27,41c0,0.338-0.031,0.673-0.078,1.005  c-2.705,0.024-5.242,1.279-6.92,3.353C18.366,43.332,15.873,42.028,13.078,42.004z M33.702,48.988  c-2.337-0.065-3.641-0.853-4.893-1.623C27.719,46.693,26.593,46,25,46c-1.183,0-2.44,0.483-3.746,1.422  c-0.034-0.078-0.075-0.152-0.111-0.229C22.43,45.22,24.633,44,27,44C30.16,44,32.835,46.106,33.702,48.988z M20,34  c3.16,0,5.835,2.106,6.702,4.988c-2.337-0.065-3.641-0.853-4.893-1.623C20.719,36.693,19.593,36,18,36  c-1.542,0-3.01,0.812-4.19,1.741C14.984,35.52,17.317,34,20,34z M13,44c3.16,0,5.835,2.106,6.702,4.988  c-2.337-0.065-3.641-0.853-4.893-1.623C13.719,46.693,12.593,46,11,46c-1.542,0-3.01,0.812-4.19,1.741C7.984,45.52,10.317,44,13,44z   M6.016,51.328C6.941,50.196,9.122,48,11,48c1.026,0,1.792,0.471,2.76,1.067C15.159,49.929,16.899,51,20,51  c0,0.684-0.098,1.354-0.29,2H6.29C6.128,52.458,6.042,51.898,6.016,51.328z M32,61H5.618l-1-2H30v-2H3.618l-0.5-1l0.5-1h32.764  l0.5,1l-0.5,1H32v2h3.382l-1,2H32z M36.618,61l2.5-5l-1.5-3h-1.851C35.916,52.347,36,51.68,36,51h20.095l-1,10H36.618z M61,21h-4v2  h1.895l-1,10H30.106l-1.001-10H55v-2H27v-2h34V21z M43.257,17l1.53-13.116C44.846,3.38,45.273,3,45.78,3H61v2H47.117l-1.5,12H43.257  z" />
                        </svg>
                        <a href="menu" class="text-sm group-hover:font-semibold">Kelola Menu</a>
                    </div>

                    <div class="rounded-lg inline-flex items-center w-full gap-2 py-1 pl-3 text-gray-200 group hover:cursor-pointer hover:text-primary-550 hover:bg-white hover:rounded-lg
                    <?php echo ((isset($_GET['x']) && $_GET['x'] == 'category')) ? 'text-primary-550 bg-white font-semibold' : ' text-white'; ?>">
                        <svg fill="currentColor" class="w-6 h-auto group-hover:text-primary-550" viewBox="-7.5 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                            <title>category</title>
                            <path d="M2.594 4.781l-1.719 1.75h15.5l-1.719-1.75h-12.063zM17.219 13.406h-17.219v-6.031h17.219v6.031zM12.063 11.688v-1.719h-6.875v1.719h0.844v-0.875h5.156v0.875h0.875zM17.219 20.313h-17.219v-6.031h17.219v6.031zM12.063 18.594v-1.75h-6.875v1.75h0.844v-0.875h5.156v0.875h0.875zM17.219 27.188h-17.219v-6h17.219v6zM12.063 25.469v-1.719h-6.875v1.719h0.844v-0.875h5.156v0.875h0.875z"></path>
                        </svg>
                        <a href="category" class="text-sm group-hover:font-semibold">Kelola Kategori</a>
                    </div>
                </div>
            </div>

            <!-- User dan Pembeli -->
            <div class="<?php echo ($_SESSION['level_kingseafood'] == 1) ? 'flex flex-col' : 'hidden'; ?>">
                <h3 class="mb-4 text-xs text-gray-400">User & Pembeli</h3>

                <div class="space-y-3">
                    <div class="rounded-lg inline-flex items-center w-full gap-2 py-1 pl-3 group hover:cursor-pointer hover:text-primary-550 hover:bg-white hover:rounded-lg
                    <?php echo ((isset($_GET['x']) && $_GET['x'] == 'user')) ? 'text-primary-550 bg-white font-semibold' : ' text-white'; ?>">
                        <svg fill="currentColor" class="w-6 h-auto group-hover:text-primary-550" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 472.615 472.615" xml:space="preserve">
                            <g>
                                <g>
                                    <circle cx="236.308" cy="142.868" r="70.203" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M325.514,234.831l-16.542-4.923l-72.665,72.763l-72.665-72.763l-16.542,4.923c-42.831,12.898-71.582,51.495-71.582,96.197 v82.511h321.575v-82.511C397.095,286.326,368.345,247.729,325.514,234.831z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M319.311,59.077c-11.9,0-23.306,3.208-33.317,8.938c24.209,16.125,40.208,43.645,40.208,74.849 c0,18.496-5.625,35.697-15.239,50.004c2.762,0.348,5.542,0.609,8.348,0.609c37.12,0,67.249-30.129,67.249-67.249 C386.56,89.205,356.431,59.077,319.311,59.077z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M404.283,213.169l-16.049-4.726l-23.555,23.556c32.136,21.917,52.11,58.372,52.11,99.029V384h55.827v-78.966 C472.615,262.4,445.145,225.477,404.283,213.169z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M186.621,68.015c-10.01-5.73-21.416-8.938-33.316-8.938c-37.12,0-67.249,30.128-67.249,67.151 c0,37.12,30.129,67.249,67.249,67.249c2.805,0,5.586-0.262,8.347-0.609c-9.614-14.306-15.239-31.508-15.239-50.004 C146.413,111.66,162.412,84.14,186.621,68.015z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M84.382,208.443l-15.951,4.726h-0.099C27.471,225.477,0,262.4,0,305.034V384h55.827v-52.972 c0-40.666,19.984-77.128,52.104-99.036L84.382,208.443z" />
                                </g>
                            </g>
                        </svg>
                        <a href="user" class="text-sm group-hover:font-semibold">Kelola User</a>
                    </div>

                    <div class="rounded-lg inline-flex items-center w-full gap-2 py-1 pl-3 group hover:cursor-pointer hover:text-primary-550 hover:bg-white hover:rounded-lg
                    <?php echo ((isset($_GET['x']) && $_GET['x'] == 'customer')) ? 'text-primary-550 bg-white font-semibold' : ' text-white'; ?>">
                        <svg fill="currentColor" class="w-6 h-auto group-hover:text-primary-550" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 299.739 299.739" xml:space="preserve">
                            <g id="XMLID_1331_">
                                <g>
                                    <g>
                                        <path d="M102.777,290.386c2.008,5.459,7.254,9.353,13.409,9.353c7.889,0,14.284-6.395,14.284-14.284v-3.831l-24.532,8.078 C104.907,290.04,103.849,290.26,102.777,290.386z" />
                                        <circle cx="133.551" cy="24.67" r="24.67" />
                                        <path d="M68.905,207.751c-1.399-6.079,0.792-12.136,5.299-15.9l-2.176-6.609l-2.255,6.85l-2.348-0.773 c-3.739-1.231-7.799,0.595-9.359,4.209l-28.599,66.274c-1.769,4.1,0.363,8.838,4.603,10.234l29.275,9.639 c4.241,1.396,8.77-1.149,9.783-5.498l5.855-25.144l-10.068-43.241C68.91,207.778,68.909,207.765,68.905,207.751z" />
                                        <path d="M268.986,239.337l-47.859-54.033c-2.61-2.946-7.038-3.414-10.205-1.077l-1.99,1.468l-4.282-5.804l-0.004,6.958 c5.457,2.169,9.43,7.24,9.998,13.452c0.001,0.014,0.004,0.028,0.005,0.042l3.934,44.223l13.411,22.06 c2.319,3.815,7.418,4.819,11.01,2.169l24.803-18.296C271.4,247.846,271.946,242.678,268.986,239.337z" />
                                        <path d="M206.233,201.09c-0.349-3.921-3.632-6.927-7.569-6.93l-2.472-0.001l0.006-10.281c5.007-1.875,8.294-6.963,7.648-12.513 c-0.423-3.631-9.699-83.247-10.123-86.884c-0.475-15.109-12.952-27.279-28.156-27.279c-3.446,0-45.344,0-64.031,0 c-15.454,0-28.092,12.574-28.169,28.029c0,0.029,0,0.059,0,0.088c0.008,3.446,0.203,84.235,0.211,87.451 c0.012,4.721,2.776,8.781,6.763,10.696l4.178,12.689l-2.348,0.773c-3.738,1.231-5.92,5.111-5.027,8.946l16.369,70.301 c1.017,4.365,5.56,6.888,9.783,5.498l29.275-9.639c4.218-1.388,6.383-6.11,4.603-10.234l-28.599-66.274 c-1.56-3.615-5.621-5.44-9.359-4.209l-2.348,0.773l-3.454-10.49c2.439-2.186,3.979-5.353,3.971-8.887 c-0.008-3.295-0.202-84.016-0.211-87.391c0.009-0.782,2.594-1.412,3.375-1.416c0.782-0.004,1.423,0.62,1.44,1.402l-0.093,85.97 h0.006v9.085l0.709,2.153c6.001,0.379,11.315,4.087,13.721,9.662l14.138,32.762v-53.662h6.168v67.955l8.294,19.219 c3.478,8.059-0.167,17.49-8.294,21.059v5.942c0,7.889,6.395,14.284,14.284,14.284c7.414,0,13.508-5.648,14.214-12.877 c-4.926-3.385-7.394-9.073-6.891-14.659l7.35-77.067c0,0-1.087-11.653-1.288-109.407c-0.003-1.31,1.006-2.399,2.311-2.498 s3.119,0.826,3.311,2.122c0,0,0,0.001,0,0.001c0.144,0.971,4.068,35.582,10.269,88.769c0.298,2.56,1.394,4.828,3.001,6.602 l-0.008,13.429c-0.001,0-2.477-0.001-2.477-0.001c-3.934,0-7.219,3.002-7.572,6.921l-6.481,71.89 c-0.024,0.266-0.034,0.531-0.03,0.796c0.061,4.152,3.448,7.488,7.598,7.49l30.821,0.018c0.002,0,0.003,0,0.005,0 c4.46,0,7.968-3.83,7.572-8.276L206.233,201.09z" />
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <a href="customer" class="text-sm group-hover:font-semibold">Kelola Pembeli</a>
                    </div>
                </div>
            </div>

            <!-- Laporan -->
            <div class="<?php echo ($_SESSION['level_kingseafood'] == 1) ? 'flex flex-col' : 'hidden'; ?>">
                <h3 class="mb-4 text-xs text-gray-400">Laporan</h3>

                <div class="rounded-lg inline-flex items-center gap-2 py-1 pl-3 group hover:cursor-pointer hover:text-primary-550 hover:bg-white hover:rounded-lg
                <?php echo ((isset($_GET['x']) && $_GET['x'] == 'report')) ? 'text-primary-550 bg-white font-semibold' : ' text-white'; ?>">
                    <svg fill="currentColor" class="w-6 h-auto group-hover:text-primary-550" viewBox="0 0 32 32" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Layer1">
                            <path d="M27,3c-0,-0.552 -0.448,-1 -1,-1l-20,0c-0.552,0 -1,0.448 -1,1l-0,26c0,0.552 0.448,1 1,1l20,0c0.552,0 1,-0.448 1,-1l-0,-26Zm-2,1l-0,24c-0,0 -18,0 -18,0c-0,-0 -0,-24 -0,-24l18,0Zm-9,10c-3.311,0 -6,2.689 -6,6c-0,3.311 2.689,6 6,6c3.311,0 6,-2.689 6,-6c-0,-3.311 -2.689,-6 -6,-6Zm-1,2.126c-1.724,0.445 -3,2.012 -3,3.874c-0,2.208 1.792,4 4,4c1.862,0 3.429,-1.276 3.874,-3l-3.874,0c-0.552,0 -1,-0.448 -1,-1l0,-3.874Zm-2,-4.126l6,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1l-6,0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1Zm-2,-4l10,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1l-10,0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1Z" />
                        </g>
                    </svg>
                    <a href="report" class="text-sm group-hover:font-semibold">Laporan</a>
                </div>
            </div>

        </nav>

        <div class="">

        </div>
    </div>
</aside>