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
                    <input type="file"
                        class="w-full cursor-pointer rounded-lg border-[1.5px] border-stroke bg-transparent font-medium outline-none transition file:mr-5 file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-stroke file:bg-whiter file:py-3 file:px-5 file:hover:bg-primary file:hover:bg-opacity-10 focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:file:border-form-strokedark dark:file:bg-white/30 dark:file:text-white dark:focus:border-primary">
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
            <div class="flex flex-col gap-5 md:gap-7 2xl:gap-10">

                <!-- ====== Data Table Two Start -->
                <div
                    class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                    <div class="data-table-common data-table-two max-w-full overflow-x-auto">
                        <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                            <div class="datatable-top">
                                <div class="datatable-dropdown">
                                    <label>
                                        <select class="datatable-selector">
                                            <option value="5">5</option>
                                            <option value="10" selected="">10</option>
                                            <option value="15">15</option>
                                            <option value="-1">All</option>
                                        </select> entries per page
                                    </label>
                                </div>
                                <div class="datatable-search">
                                    <input class="datatable-input" placeholder="Search..." type="search"
                                        title="Search within table" aria-controls="dataTableTwo">
                                </div>
                            </div>
                            <div class="datatable-container">
                                <table class="table w-full table-auto datatable-table" id="dataTableTwo">
                                    <thead>
                                        <tr>
                                            <th data-sortable="true" style="width: 21.407333994053516%;"><a
                                                    href="#" class="datatable-sorter">
                                                    <div class="flex items-center justify-between gap-1.5">
                                                        <p>Name</p>
                                                        <div class="inline-flex flex-col space-y-[2px]">
                                                            <span class="inline-block">
                                                                <svg class="fill-current" width="10" height="5"
                                                                    viewBox="0 0 10 5" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5 0L0 5H10L5 0Z" fill=""></path>
                                                                </svg>
                                                            </span>
                                                            <span class="inline-block">
                                                                <svg class="fill-current" width="10"
                                                                    height="5" viewBox="0 0 10 5" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5 5L10 0L-4.37114e-07 8.74228e-07L5 5Z"
                                                                        fill=""></path>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </a></th>
                                            <th data-sortable="true" style="width: 27.452923686818632%;"><a
                                                    href="#" class="datatable-sorter">
                                                    <div class="flex items-center justify-between gap-1.5">
                                                        <p>Position</p>
                                                        <div class="inline-flex flex-col space-y-[2px]">
                                                            <span class="inline-block">
                                                                <svg class="fill-current" width="10"
                                                                    height="5" viewBox="0 0 10 5" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5 0L0 5H10L5 0Z" fill=""></path>
                                                                </svg>
                                                            </span>
                                                            <span class="inline-block">
                                                                <svg class="fill-current" width="10"
                                                                    height="5" viewBox="0 0 10 5" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5 5L10 0L-4.37114e-07 8.74228e-07L5 5Z"
                                                                        fill=""></path>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </a></th>
                                            <th data-sortable="true" style="width: 16.05550049554014%;"><a
                                                    href="#" class="datatable-sorter">
                                                    <div class="flex items-center justify-between gap-1.5">
                                                        <p>Office</p>
                                                        <div class="inline-flex flex-col space-y-[2px]">
                                                            <span class="inline-block">
                                                                <svg class="fill-current" width="10"
                                                                    height="5" viewBox="0 0 10 5" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5 0L0 5H10L5 0Z" fill=""></path>
                                                                </svg>
                                                            </span>
                                                            <span class="inline-block">
                                                                <svg class="fill-current" width="10"
                                                                    height="5" viewBox="0 0 10 5" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5 5L10 0L-4.37114e-07 8.74228e-07L5 5Z"
                                                                        fill=""></path>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </a></th>
                                            <th data-sortable="true" style="width: 8.02775024777007%;"><a
                                                    href="#" class="datatable-sorter">
                                                    <div class="flex items-center justify-between gap-1.5">
                                                        <p>Age</p>
                                                        <div class="inline-flex flex-col space-y-[2px]">
                                                            <span class="inline-block">
                                                                <svg class="fill-current" width="10"
                                                                    height="5" viewBox="0 0 10 5" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5 0L0 5H10L5 0Z" fill=""></path>
                                                                </svg>
                                                            </span>
                                                            <span class="inline-block">
                                                                <svg class="fill-current" width="10"
                                                                    height="5" viewBox="0 0 10 5" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5 5L10 0L-4.37114e-07 8.74228e-07L5 5Z"
                                                                        fill=""></path>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </a></th>
                                            <th data-sortable="true" class="red"
                                                style="width: 13.478691774033697%;"><a href="#"
                                                    class="datatable-sorter">
                                                    <div class="flex items-center justify-between gap-1.5">
                                                        <p>Start Date</p>
                                                        <div class="inline-flex flex-col space-y-[2px]">
                                                            <span class="inline-block">
                                                                <svg class="fill-current" width="10"
                                                                    height="5" viewBox="0 0 10 5" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5 0L0 5H10L5 0Z" fill=""></path>
                                                                </svg>
                                                            </span>
                                                            <span class="inline-block">
                                                                <svg class="fill-current" width="10"
                                                                    height="5" viewBox="0 0 10 5" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5 5L10 0L-4.37114e-07 8.74228e-07L5 5Z"
                                                                        fill=""></path>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </a></th>
                                            <th data-sortable="true" style="width: 13.577799801783943%;"><a
                                                    href="#" class="datatable-sorter">
                                                    <div class="flex items-center justify-between gap-1.5">
                                                        <p>Salary</p>
                                                        <div class="inline-flex flex-col space-y-[2px]">
                                                            <span class="inline-block">
                                                                <svg class="fill-current" width="10"
                                                                    height="5" viewBox="0 0 10 5" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5 0L0 5H10L5 0Z" fill=""></path>
                                                                </svg>
                                                            </span>
                                                            <span class="inline-block">
                                                                <svg class="fill-current" width="10"
                                                                    height="5" viewBox="0 0 10 5" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5 5L10 0L-4.37114e-07 8.74228e-07L5 5Z"
                                                                        fill=""></path>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr data-index="0">
                                            <td>Cedric Kelly</td>
                                            <td>Senior Javascript Developer</td>
                                            <td>Edinburgh</td>
                                            <td>22</td>
                                            <td class="green">2012/03/29</td>
                                            <td>$433,060</td>
                                        </tr>
                                        <tr data-index="1">
                                            <td>Brielle Kuphal</td>
                                            <td>Senior Javascript Developer</td>
                                            <td>Edinburgh</td>
                                            <td>25</td>
                                            <td class="green">2012/03/29</td>
                                            <td>$433,060</td>
                                        </tr>
                                        <tr data-index="2">
                                            <td>Barney Murray</td>
                                            <td>Senior Backend Developer</td>
                                            <td>amsterdam</td>
                                            <td>29</td>
                                            <td class="green">2010/05/01</td>
                                            <td>$424,785</td>
                                        </tr>
                                        <tr data-index="3">
                                            <td>Ressie Ruecker</td>
                                            <td>Senior Frontend Developer</td>
                                            <td>Jakarta</td>
                                            <td>27</td>
                                            <td class="green">2013/07/01</td>
                                            <td>$785,210</td>
                                        </tr>
                                        <tr data-index="4">
                                            <td>Teresa Mertz</td>
                                            <td>Senior Designer</td>
                                            <td>New Caledonia</td>
                                            <td>25</td>
                                            <td class="green">2014/05/30</td>
                                            <td>$532,126</td>
                                        </tr>
                                        <tr data-index="5">
                                            <td>Chelsey Hackett</td>
                                            <td>Product Manager</td>
                                            <td>NewYork</td>
                                            <td>26</td>
                                            <td class="green">2011/09/30</td>
                                            <td>$421,541</td>
                                        </tr>
                                        <tr data-index="6">
                                            <td>Tatyana Metz</td>
                                            <td>Senior Product Manager</td>
                                            <td>NewYork</td>
                                            <td>28</td>
                                            <td class="green">2009/09/30</td>
                                            <td>$852,541</td>
                                        </tr>
                                        <tr data-index="7">
                                            <td>Oleta Harvey</td>
                                            <td>Junior Product Manager</td>
                                            <td>California</td>
                                            <td>25</td>
                                            <td class="green">2015/10/30</td>
                                            <td>$654,444</td>
                                        </tr>
                                        <tr data-index="8">
                                            <td>Bette Haag</td>
                                            <td>Junior Product Manager</td>
                                            <td>California</td>
                                            <td>29</td>
                                            <td class="green">2017/12/31</td>
                                            <td>$541,111</td>
                                        </tr>
                                        <tr data-index="9">
                                            <td>Meda Ebert</td>
                                            <td>Junior Web Developer</td>
                                            <td>Amsterdam</td>
                                            <td>27</td>
                                            <td class="green">2015/10/31</td>
                                            <td>$651,456</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="datatable-bottom">
                                <div class="datatable-info">Showing 1 to 10 of 26 entries</div>
                                <nav class="datatable-pagination">
                                    <ul class="datatable-pagination-list">
                                        <li class="datatable-pagination-list-item datatable-hidden datatable-disabled">
                                            <a data-page="1" class="datatable-pagination-list-item-link">‹</a>
                                        </li>
                                        <li class="datatable-pagination-list-item datatable-active"><a data-page="1"
                                                class="datatable-pagination-list-item-link">1</a></li>
                                        <li class="datatable-pagination-list-item"><a data-page="2"
                                                class="datatable-pagination-list-item-link">2</a></li>
                                        <li class="datatable-pagination-list-item"><a data-page="3"
                                                class="datatable-pagination-list-item-link">3</a></li>
                                        <li class="datatable-pagination-list-item"><a data-page="2"
                                                class="datatable-pagination-list-item-link">›</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ====== Data Table Two End -->
            </div>
            <!-- ====== Table Section Start -->
            {{-- <div class="flex flex-col gap-10">
                <div class="datatable-top">
                    <div class="datatable-search">
                        <input class="datatable-input" placeholder="Search..." type="search"
                            title="Search within table" aria-controls="dataTableOne">
                    </div>
                    <div class="datatable-dropdown">
                        <label>
                            <select class="datatable-selector">
                                <option value="5">5</option>
                                <option value="10" selected="">10</option>
                                <option value="15">15</option>
                                <option value="-1">All</option>
                            </select>
                        </label>
                    </div>
                </div>
            </div> --}}

            <!-- ====== Table Two Start -->
            <div class="rounded-sm border bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex flex-col">
                    <div class="datatable-top">
                        <div class="datatable-search">
                            <input class="datatable-input h-10 w-45" placeholder="Search..." type="search"
                                title="Search within table" aria-controls="dataTableOne">
                        </div>
                        <div class="datatable-dropdown">
                            <label>
                                <select class="datatable-selector bg-white">
                                    <option value="5">5</option>
                                    <option value="10" selected="">10</option>
                                    <option value="15">15</option>
                                    <option value="-1">All</option>
                                </select>
                            </label>
                        </div>
                    </div>
                </div>
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
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                            </div>
                        </label>
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
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                            </div>
                        </label>
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
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                            </div>
                        </label>
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
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                            </div>
                        </label>
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
        <section>
            <div class="datatable-bottom">
                <div class="datatable-info">Showing 1 to 10 of 26 entries</div>
                <nav class="datatable-pagination">
                    <ul class="datatable-pagination-list">
                        <li class="datatable-pagination-list-item datatable-hidden datatable-disabled"><a
                                data-page="1" class="datatable-pagination-list-item-link">‹</a></li>
                        <li class="datatable-pagination-list-item datatable-active"><a data-page="1"
                                class="datatable-pagination-list-item-link">1</a></li>
                        <li class="datatable-pagination-list-item"><a data-page="2"
                                class="datatable-pagination-list-item-link">2</a></li>
                        <li class="datatable-pagination-list-item"><a data-page="3"
                                class="datatable-pagination-list-item-link">3</a></li>
                        <li class="datatable-pagination-list-item"><a data-page="2"
                                class="datatable-pagination-list-item-link">›</a></li>
                    </ul>
                </nav>
            </div>
        </section>
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
