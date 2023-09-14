@include('admin.layouts.app')

@include('admin.inc.sidebar')


<!-- ===== Content Area Start ===== -->
<div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
    @include('admin.inc.header')
    <!-- ===== Form Area Start ===== -->
    <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
        <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Contact Form
            </h2>
        </div>
        <form action="#">
            <div class="p-6.5">
                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">
                            First name
                        </label>
                        <input type="text" placeholder="Enter your first name"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>

                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">
                            Last name
                        </label>
                        <input type="text" placeholder="Enter your last name"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Email <span class="text-meta-1">*</span>
                    </label>
                    <input type="email" placeholder="Enter your email address"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Subject
                    </label>
                    <input type="text" placeholder="Select subject"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Country
                    </label>
                    <div class="relative z-20 bg-transparent dark:bg-form-input">
                        <select
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                            <option value="">Choose your country</option>
                            <option value="">USA</option>
                            <option value="">UK</option>
                            <option value="">Canada</option>
                        </select>
                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2">
                            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g opacity="0.8">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z"
                                        fill=""></path>
                                </g>
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Message
                    </label>
                    <textarea rows="6" placeholder="Type your message"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"></textarea>
                </div>
                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        Select date
                    </label>
                    <div class="relative">
                        <input type="date"
                            class="custom-input-date custom-input-date-2 w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                    </div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        Attach file
                      </label>
                      <input type="file" class="w-full cursor-pointer rounded-lg border-[1.5px] border-stroke bg-transparent font-medium outline-none transition file:mr-5 file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-stroke file:bg-whiter file:py-3 file:px-5 file:hover:bg-primary file:hover:bg-opacity-10 focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:file:border-form-strokedark dark:file:bg-white/30 dark:file:text-white dark:focus:border-primary">
                    <div></div>
                </div>
            </div>
            <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray">
                Send Message
            </button>
        </form>
    </div>
    <!-- ===== Form Area End ===== -->

    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-title-md2 font-bold text-black dark:text-white">
                    Top Products
                </h2>
            </div>
            <!-- Breadcrumb End -->

            <!-- ====== Table Section Start -->
            <div class="flex flex-col gap-10">

                <!-- ====== Table Two Start -->
                <div
                    class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                    <div
                        class="grid grid-cols-6 border-t border-stroke py-4.5 px-4 dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5">
                        <div class="col-span-3 flex items-center">
                            <p class="font-medium">Product Name</p>
                        </div>
                        <div class="col-span-2 hidden items-center sm:flex">
                            <p class="font-medium">Category</p>
                        </div>
                        <div class="col-span-1 flex items-center">
                            <p class="font-medium">Status</p>
                        </div>
                        <div class="col-span-1 flex items-center">
                            <p class="font-medium">Action</p>
                        </div>
                    </div>

                    <div
                        class="grid grid-cols-6 border-t border-stroke py-4.5 px-4 dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5">
                        <div class="col-span-3 flex items-center">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                                <div class="h-12.5 w-15 rounded-md">
                                    <img src="src/images/product/product-01.png" alt="Product" />
                                </div>
                                <p class="text-sm font-medium text-black dark:text-white">
                                    Apple Watch Series 7
                                </p>
                            </div>
                        </div>
                        <div class="col-span-2 hidden items-center sm:flex">
                            <p class="text-sm font-medium text-black dark:text-white">Electronics</p>
                        </div>
                        <div class="col-span-1 flex items-center">
                            <div class="flex items-center p-3">
                                <input checked id="checked-checkbox" type="checkbox" value=""
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            </div>
                        </div>
                        <div class="flex items-center space-x-3.5">
                            <i class="fa fa-eye" aria-hidden="true"></i>

                            <i class="fa fa-trash" aria-hidden="true"></i>

                            <i data-v-3d6d2adb="" title="Edit"
                                class="fa fa-edit text-blue-500 hover:text-blue-700 cursor-pointer"></i>
                        </div>
                    </div>
                    <div
                        class="grid grid-cols-6 border-t border-stroke py-4.5 px-4 dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5">
                        <div class="col-span-3 flex items-center">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                                <div class="h-12.5 w-15 rounded-md">
                                    <img src="src/images/product/product-02.png" alt="Product" />
                                </div>
                                <p class="text-sm font-medium text-black dark:text-white">
                                    Macbook Pro M1
                                </p>
                            </div>
                        </div>
                        <div class="col-span-2 hidden items-center sm:flex">
                            <p class="text-sm font-medium text-black dark:text-white">Electronics</p>
                        </div>
                        <div class="col-span-1 flex items-center">
                            <div class="flex items-center p-3">
                                <input checked id="checked-checkbox" type="checkbox" value=""
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            </div>
                        </div>
                        <div class="flex items-center space-x-3.5">
                            <i class="fa fa-eye" aria-hidden="true"></i>

                            <i class="fa fa-trash" aria-hidden="true"></i>

                            <i data-v-3d6d2adb="" title="Edit"
                                class="fa fa-edit text-blue-500 hover:text-blue-700 cursor-pointer"></i>
                        </div>
                    </div>
                    <div
                        class="grid grid-cols-6 border-t border-stroke py-4.5 px-4 dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5">
                        <div class="col-span-3 flex items-center">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                                <div class="h-12.5 w-15 rounded-md">
                                    <img src="src/images/product/product-03.png" alt="Product" />
                                </div>
                                <p class="text-sm font-medium text-black dark:text-white">
                                    Dell Inspiron 15
                                </p>
                            </div>
                        </div>
                        <div class="col-span-2 hidden items-center sm:flex">
                            <p class="text-sm font-medium text-black dark:text-white">Electronics</p>
                        </div>
                        <div class="col-span-1 flex items-center">
                            <div class="flex items-center p-3">
                                <input checked id="checked-checkbox" type="checkbox" value=""
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            </div>
                        </div>
                        <div class="flex items-center space-x-3.5">
                            <i class="fa fa-eye" aria-hidden="true"></i>

                            <i class="fa fa-trash" aria-hidden="true"></i>

                            <i data-v-3d6d2adb="" title="Edit"
                                class="fa fa-edit text-blue-500 hover:text-blue-700 cursor-pointer"></i>
                        </div>
                    </div>
                    <div
                        class="grid grid-cols-6 border-t border-stroke py-4.5 px-4 dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5">
                        <div class="col-span-3 flex items-center">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                                <div class="h-12.5 w-15 rounded-md">
                                    <img src="src/images/product/product-04.png" alt="Product" />
                                </div>
                                <p class="text-sm font-medium text-black dark:text-white">
                                    HP Probook 450
                                </p>
                            </div>
                        </div>
                        <div class="col-span-2 hidden items-center sm:flex">
                            <p class="text-sm font-medium text-black dark:text-white">Electronics</p>
                        </div>
                        <div class="col-span-1 flex items-center">
                            <div class="flex items-center p-3">
                                <input checked id="checked-checkbox" type="checkbox" value=""
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            </div>
                        </div>
                        <div class="flex items-center space-x-3.5">
                            <i class="fa fa-eye" aria-hidden="true"></i>

                            <i class="fa fa-trash" aria-hidden="true"></i>

                            <i data-v-3d6d2adb="" title="Edit"
                                class="fa fa-edit text-blue-500 hover:text-blue-700 cursor-pointer"></i>
                        </div>
                    </div>
                </div>

                <!-- ====== Table Two End -->
            </div>
            <!-- ====== Table Section End -->
        </div>
    </main>
    <!-- ===== Main Content End ===== -->
</div>
<!-- ===== Content Area End ===== -->
</div>
<!-- ===== Page Wrapper End ===== -->
<script defer src="bundle.js"></script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v8b253dfea2ab4077af8c6f58422dfbfd1689876627854"
    integrity="sha512-bjgnUKX4azu3dLTVtie9u6TKqgx29RBwfj3QXYt5EKfWM/9hPSAI/4qcV5NACjwAo8UtTeWefx6Zq5PHcMm7Tg=="
    data-cf-beacon='{"rayId":"805e9b23afe91e14","version":"2023.8.0","r":1,"b":1,"token":"67f7a278e3374824ae6dd92295d38f77","si":100}'
    crossorigin="anonymous"></script>
</body>

<!-- Mirrored from demo.tailadmin.com/tables by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Sep 2023 07:17:37 GMT -->

</html>
