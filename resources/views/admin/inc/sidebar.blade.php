<!-- ===== Sidebar Start ===== -->
<aside :class="sidebarToggle ? 'translate-x-0' : '-translate-x-full'"
    class="absolute left-0 top-0 z-9999 flex h-screen w-72.5 flex-col overflow-y-hidden bg-black duration-300 ease-linear dark:bg-boxdark lg:static lg:translate-x-0"
    @click.outside="sidebarToggle = false" style="    background: rgb(28 36 52 / 1);">
    <!-- SIDEBAR HEADER -->
    <div class="flex items-center justify-center gap-2 px-6 py-2 lg:py-6.5">
        <a href="{{ route('admin-index') }}">
            <img src="{{ config('app.url') }}/src/images/logo/logo.png" alt="Logo" class="h-15" />

        </a>
        <h4 class=" text-bodydark1">Panacia Health Care</h4>
        <button class="block lg:hidden" @click.stop="sidebarToggle = !sidebarToggle">
            <svg class="fill-current" width="20" height="18" viewBox="0 0 20 18" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M19 8.175H2.98748L9.36248 1.6875C9.69998 1.35 9.69998 0.825 9.36248 0.4875C9.02498 0.15 8.49998 0.15 8.16248 0.4875L0.399976 8.3625C0.0624756 8.7 0.0624756 9.225 0.399976 9.5625L8.16248 17.4375C8.31248 17.5875 8.53748 17.7 8.76248 17.7C8.98748 17.7 9.17498 17.625 9.36248 17.475C9.69998 17.1375 9.69998 16.6125 9.36248 16.275L3.02498 9.8625H19C19.45 9.8625 19.825 9.4875 19.825 9.0375C19.825 8.155 19.45 8.175 19 8.175Z"
                    fill="" />
            </svg>
        </button>
    </div>
    <!-- SIDEBAR HEADER -->

    <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
        <!-- Sidebar Menu -->
        <nav class="mt-0 py-4 px-4 lg:mt-0 lg:px-6" x-data="{ selected: $persist('Dashboard') }">
            <!-- Menu Group -->
            <div>

                <ul class="mb-6 flex flex-col gap-1.5">
                    <!-- Menu Item Dashboard -->
                    <li>
                        <a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4  text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                            href="{{ route('admin-index') }}">
                            <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.10322 0.956299H2.53135C1.5751 0.956299 0.787598 1.7438 0.787598 2.70005V6.27192C0.787598 7.22817 1.5751 8.01567 2.53135 8.01567H6.10322C7.05947 8.01567 7.84697 7.22817 7.84697 6.27192V2.72817C7.8751 1.7438 7.0876 0.956299 6.10322 0.956299ZM6.60947 6.30005C6.60947 6.5813 6.38447 6.8063 6.10322 6.8063H2.53135C2.2501 6.8063 2.0251 6.5813 2.0251 6.30005V2.72817C2.0251 2.44692 2.2501 2.22192 2.53135 2.22192H6.10322C6.38447 2.22192 6.60947 2.44692 6.60947 2.72817V6.30005Z"
                                    fill="" />
                                <path
                                    d="M15.4689 0.956299H11.8971C10.9408 0.956299 10.1533 1.7438 10.1533 2.70005V6.27192C10.1533 7.22817 10.9408 8.01567 11.8971 8.01567H15.4689C16.4252 8.01567 17.2127 7.22817 17.2127 6.27192V2.72817C17.2127 1.7438 16.4252 0.956299 15.4689 0.956299ZM15.9752 6.30005C15.9752 6.5813 15.7502 6.8063 15.4689 6.8063H11.8971C11.6158 6.8063 11.3908 6.5813 11.3908 6.30005V2.72817C11.3908 2.44692 11.6158 2.22192 11.8971 2.22192H15.4689C15.7502 2.22192 15.9752 2.44692 15.9752 2.72817V6.30005Z"
                                    fill="" />
                                <path
                                    d="M6.10322 9.92822H2.53135C1.5751 9.92822 0.787598 10.7157 0.787598 11.672V15.2438C0.787598 16.2001 1.5751 16.9876 2.53135 16.9876H6.10322C7.05947 16.9876 7.84697 16.2001 7.84697 15.2438V11.7001C7.8751 10.7157 7.0876 9.92822 6.10322 9.92822ZM6.60947 15.272C6.60947 15.5532 6.38447 15.7782 6.10322 15.7782H2.53135C2.2501 15.7782 2.0251 15.5532 2.0251 15.272V11.7001C2.0251 11.4188 2.2501 11.1938 2.53135 11.1938H6.10322C6.38447 11.1938 6.60947 11.4188 6.60947 11.7001V15.272Z"
                                    fill="" />
                                <path
                                    d="M15.4689 9.92822H11.8971C10.9408 9.92822 10.1533 10.7157 10.1533 11.672V15.2438C10.1533 16.2001 10.9408 16.9876 11.8971 16.9876H15.4689C16.4252 16.9876 17.2127 16.2001 17.2127 15.2438V11.7001C17.2127 10.7157 16.4252 9.92822 15.4689 9.92822ZM15.9752 15.272C15.9752 15.5532 15.7502 15.7782 15.4689 15.7782H11.8971C11.6158 15.7782 11.3908 15.5532 11.3908 15.272V11.7001C11.3908 11.4188 11.6158 11.1938 11.8971 11.1938H15.4689C15.7502 11.1938 15.9752 11.4188 15.9752 11.7001V15.272Z"
                                    fill="" />
                            </svg>

                            Dashboard
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                fill="" />
                            </svg>
                        </a>
                    </li>
                    <!-- Menu Item Dashboard -->
                </ul>
            </div>

            <!-- Menu Item Master -->
            @if (Auth::user()->role == 1 || Auth::user()->role == 4)
                <div>
                    <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">Dispatch</h3>
                    <ul class="mb-6 flex flex-col gap-1.5">
                        <!-- Menu Item Purchase -->
                        <li>
                            <a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4  text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                href="#" @click.prevent="selected = (selected === 'Purchase' ? '':'Purchase')"
                                :class="{
                                    'bg-graydark dark:bg-meta-4': (selected === 'Purchase') || (
                                        page === 'raw-material' ||
                                        page === 'gifts' || page === 'products' || page === 'others')
                                }">
                                <i class="fa-solid fa-cart-shopping"></i>
                                Purchase

                                <svg class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                                    :class="{ 'rotate-180': (selected === 'Purchase') }" width="20" height="20"
                                    viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                        fill="" />
                                </svg>
                            </a>

                            <!-- Dropdown Menu Start -->
                            <div class="translate transform overflow-hidden"
                                :class="(selected === 'Purchase') ? 'block' : 'hidden'">
                                <ul class="mt-4 mb-5.5 flex flex-col gap-2.5 pl-6">
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('purchase-material') }}"
                                            :class="page === 'raw-material' && '!text-white'">
                                            Raw Material
                                        </a>
                                    </li>
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('purchase-product') }}"
                                            :class="page === 'products' && '!text-white'">
                                            Finnish Goods
                                        </a>
                                    </li>
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('purchase-item') }}"
                                            :class="page === 'gifts' && '!text-white'">
                                            Gifts
                                        </a>
                                    </li>
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('purchase-other') }}"
                                            :class="page === 'others' && '!text-white'">
                                            Others
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Dropdown Menu End -->
                        </li>
                        <!-- Menu Item Purchase -->
                        <!-- Menu Item Stocks -->
                        <li>
                            <a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4  text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                href="{{ route('stock-details') }}"
                                @click.prevent="selected = (selected === 'Stocks' ? '':'Stocks')"
                                :class="{
                                    'bg-graydark dark:bg-meta-4': (selected === 'Stocks') || (
                                        page === 'raw-material' ||
                                        page === 'gifts' || page === 'products')
                                }">
                                <i class="fa-solid fa-warehouse"></i>
                                Stocks
                                <svg class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                                    :class="{ 'rotate-180': (selected === 'Stocks') }" width="20" height="20"
                                    viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                        fill="" />
                                </svg>
                            </a>

                            <!-- Dropdown Menu Start -->
                            <div class="translate transform overflow-hidden"
                                :class="(selected === 'Stocks') ? 'block' : 'hidden'">
                                <ul class="mt-4 mb-5.5 flex flex-col gap-2.5 pl-6">
                                    <li>
                                        <a class="group relative flex items--center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('material-detail') }}"
                                            :class="page === 'raw-material' && '!text-white'">
                                            Raw Material
                                        </a>
                                    </li>
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('item-detail') }}"
                                            :class="page === 'gifts' && '!text-white'">
                                            Gifts
                                        </a>
                                    </li>
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('product-detail') }}"
                                            :class="page === 'products' && '!text-white'">
                                            Finnish Products
                                        </a>
                                    </li>
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('sample.index') }}"
                                            :class="page === 'settings' && '!text-white'">
                                            Sample
                                        </a>
                                    </li>
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('packing-stock.index') }}"
                                            :class="page === 'settings' && '!text-white'">
                                            Packing
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Dropdown Menu End -->
                        </li>
                        <!-- Menu Item Stocks -->
                        <!-- Menu Return Start -->
                        <li>
                            <a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4  text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                href="#" @click.prevent="selected = (selected === 'Return' ? '':'Return')"
                                :class="{
                                    'bg-graydark dark:bg-meta-4': (selected === 'Return') || (page === 'expiry' ||
                                        page === 'brakage' || page === 'good-return')
                                }">
                                <i class="fa fa-exchange"></i>
                                Return
                                <svg class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                                    :class="{ 'rotate-180': (selected === 'Return') }" width="20"
                                    height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                        fill="" />
                                </svg>
                            </a>

                            <!-- Dropdown Menu Start -->
                            <div class="translate transform overflow-hidden"
                                :class="(selected === 'Return') ? 'block' : 'hidden'">
                                <ul class="mt-4 mb-5.5 flex flex-col gap-2.5 pl-6">
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('good-return') }}"
                                            :class="page === 'good-return' && '!text-white'">
                                            Goods Return
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Dropdown Menu End -->
                        </li>

                    </ul>
                </div>
            @endif
            <!-- Menu Return End  -->
            @if (Auth::user()->role == 1 || Auth::user()->role == 5)
                <div>
                    <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">Production</h3>
                    <ul class="mb-6 flex flex-col gap-1.5">
                        <!-- Menu Item Production -->
                        <li>
                            <a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4  text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                href="#"
                                @click.prevent="selected = (selected === 'Production' ? '':'Production')"
                                :class="{
                                    'bg-graydark dark:bg-meta-4': (selected === 'Production') || (
                                        page === 'raw-material' ||
                                        page === 'gifts' || page === 'products')
                                }">
                                <i class="fa fa-industry" aria-hidden="true"></i>
                                Production
                                <svg class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                                    :class="{ 'rotate-180': (selected === 'Production') }" width="20"
                                    height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                        fill="" />
                                </svg>
                            </a>

                            <!-- Dropdown Menu Start -->
                            <div class="translate transform overflow-hidden"
                                :class="(selected === 'Production') ? 'block' : 'hidden'">
                                <ul class="mt-4 mb-5.5 flex flex-col gap-2.5 pl-6">
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('production-create') }}"
                                            :class="page === 'raw-material' && '!text-white'">
                                            Create Goods
                                        </a>
                                    </li>
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('production-proccess') }}"
                                            :class="page === 'gifts' && '!text-white'">
                                            In Process Goods
                                        </a>
                                    </li>
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('production-complete') }}"
                                            :class="page === 'products' && '!text-white'">
                                            Completed Goods
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Dropdown Menu End -->
                        </li>
                        <!-- Menu Item Production -->
                        <!-- Menu Item Challans -->
                        <!-- Menu Item Challans -->
                        <li>
                            <a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4  text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                href="#" @click.prevent="selected = (selected === 'Challans' ? '':'Challans')"
                                :class="{
                                    'bg-graydark dark:bg-meta-4': (selected === 'Challans') || (
                                        page === 'raw-material' ||
                                        page === 'gifts' || page === 'products' || page === 'sample')
                                }">
                                <i class="fa-solid fa-receipt"></i>
                                Challans
                                <svg class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                                    :class="{ 'rotate-180': (selected === 'Challans') }" width="20"
                                    height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                        fill="" />
                                </svg>
                            </a>

                            <!-- Dropdown Menu Start -->
                            <div class="translate transform overflow-hidden"
                                :class="(selected === 'Challans') ? 'block' : 'hidden'">
                                <ul class="mt-4 mb-5.5 flex flex-col gap-2.5 pl-6">
                                    <li>
                                        <a class="group relative flex items--center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('raw-material-challan') }}"
                                            :class="page === 'raw-material' && '!text-white'">
                                            Raw Material Issue Challan
                                        </a>
                                    </li>
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('complete-good-challan') }}"
                                            :class="page === 'products' && '!text-white'">
                                            Finish Goods Challan
                                        </a>
                                    </li>
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('gift-challan') }}"
                                            :class="page === 'gifts' && '!text-white'">
                                            Gift Issue Challan
                                        </a>
                                    </li>
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('sample-challan') }}"
                                            :class="page === 'sample' && '!text-white'">
                                            Sample Issue Challan
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Dropdown Menu End -->
                        </li>
                        <!-- Menu Item Challans -->
                    </ul>
                </div>
            @endif
            <!-- Menu Return End  -->
            @if (Auth::user()->role == 1 || Auth::user()->role == 3)
                <div>
                    <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">Accounts</h3>
                    <ul class="mb-6 flex flex-col gap-1.5">
                        <!-- Menu Item Sales -->
                        <li>
                            <a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4  text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                href="#" @click.prevent="selected = (selected === 'Sale' ? '':'Sale')"
                                :class="{
                                    'bg-graydark dark:bg-meta-4': (selected === 'Sale') || (
                                        page === 'raw-material' ||
                                        page === 'gifts' || page === 'products' || page === 'others')
                                }">
                                <i class="fa-solid fa-bullhorn"></i>
                                Sales
                                <svg class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                                    :class="{ 'rotate-180': (selected === 'Sale') }" width="20"
                                    height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                        fill="" />
                                </svg>
                            </a>

                            <!-- Dropdown Menu Start -->
                            <div class="translate transform overflow-hidden"
                                :class="(selected === 'Sale') ? 'block' : 'hidden'">
                                <ul class="mt-4 mb-5.5 flex flex-col gap-2.5 pl-6">
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('sale.index') }}"
                                            :class="page === 'sale-invoice' && '!text-white'">
                                            Sale Invoice
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Dropdown Menu End -->
                        </li>

                        <!-- Party Payment -->
                        <li>
                            <a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4  text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                href="#"
                                @click.prevent="selected = (selected === 'PartyPayment' ? '':'PartyPayment')"
                                :class="{
                                    'bg-graydark dark:bg-meta-4': (selected === 'PartyPayment') || (
                                        page === 'payment')
                                }">
                                <i class="fas fa-money-check-alt"></i>
                                Party Payment
                                <svg class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                                    :class="{ 'rotate-180': (selected === 'PartyPayment') }" width="20"
                                    height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                        fill="" />
                                </svg>
                            </a>

                            <!-- Dropdown Menu Start -->
                            <div class="translate transform overflow-hidden"
                                :class="(selected === 'PartyPayment') ? 'block' : 'hidden'">
                                <ul class="mt-4 mb-5.5 flex flex-col gap-2.5 pl-6">
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('payment.index') }}"
                                            :class="page === 'payment' && '!text-white'">
                                            Payment
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Dropdown Menu End -->
                        </li>
                        <!-- Party Payment  -->
                    </ul>
                </div>
            @endif
            <!-- Menu Return End  -->
            @if (Auth::user()->role == 1 || Auth::user()->role == 2)
                <div>
                    <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">Office</h3>
                    <ul class="mb-6 flex flex-col gap-1.5">
                        <!-- Menu Item Master -->
                        <li>
                            <a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4  text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                href="#" @click.prevent="selected = (selected === 'Masters' ? '':'Masters')"
                                :class="{
                                    'bg-graydark dark:bg-meta-4': (selected === 'Masters') || (page === 'settings' ||
                                        page === 'fileManager' || page === 'dataTables' ||
                                        page ===
                                    'pricingTables' ||
                                        page === 'errorPage' || page === 'mailSuccess' ||
                                        page ===
                                    'brand')
                                }">
                                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M14.2875 0.506226H3.7125C2.75625 0.506226 1.96875 1.29373 1.96875 2.24998V15.75C1.96875 16.7062 2.75625 17.5219 3.74063 17.5219H14.3156C15.2719 17.5219 16.0875 16.7344 16.0875 15.75V2.24998C16.0313 1.29373 15.2438 0.506226 14.2875 0.506226ZM14.7656 15.75C14.7656 16.0312 14.5406 16.2562 14.2594 16.2562H3.7125C3.43125 16.2562 3.20625 16.0312 3.20625 15.75V2.24998C3.20625 1.96873 3.43125 1.74373 3.7125 1.74373H14.2875C14.5688 1.74373 14.7938 1.96873 14.7938 2.24998V15.75H14.7656Z"
                                        fill="" />
                                    <path
                                        d="M12.7965 2.6156H9.73086C9.22461 2.6156 8.80273 3.03748 8.80273 3.54373V7.25623C8.80273 7.76248 9.22461 8.18435 9.73086 8.18435H12.7965C13.3027 8.18435 13.7246 7.76248 13.7246 7.25623V3.5156C13.6965 3.03748 13.3027 2.6156 12.7965 2.6156ZM12.4309 6.8906H10.0684V3.88123H12.4309V6.8906Z"
                                        fill="" />
                                    <path
                                        d="M4.97773 4.35938H7.03086C7.36836 4.35938 7.67773 4.07812 7.67773 3.7125C7.67773 3.34687 7.39648 3.09375 7.03086 3.09375H4.94961C4.61211 3.09375 4.30273 3.375 4.30273 3.74063C4.30273 4.10625 4.61211 4.35938 4.97773 4.35938Z"
                                        fill="" />
                                    <path
                                        d="M4.97773 7.9312H7.03086C7.36836 7.9312 7.67773 7.64995 7.67773 7.28433C7.67773 6.9187 7.39648 6.63745 7.03086 6.63745H4.94961C4.61211 6.63745 4.30273 6.9187 4.30273 7.28433C4.30273 7.64995 4.61211 7.9312 4.97773 7.9312Z"
                                        fill="" />
                                    <path
                                        d="M13.0789 10.2374H4.97891C4.64141 10.2374 4.33203 10.5187 4.33203 10.8843C4.33203 11.2499 4.61328 11.5312 4.97891 11.5312H13.0789C13.4164 11.5312 13.7258 11.2499 13.7258 10.8843C13.7258 10.5187 13.4164 10.2374 13.0789 10.2374Z"
                                        fill="" />
                                    <path
                                        d="M13.0789 13.8093H4.97891C4.64141 13.8093 4.33203 14.0906 4.33203 14.4562C4.33203 14.8218 4.61328 15.1031 4.97891 15.1031H13.0789C13.4164 15.1031 13.7258 14.8218 13.7258 14.4562C13.7258 14.0906 13.4164 13.8093 13.0789 13.8093Z"
                                        fill="" />
                                </svg>

                                Masters

                                <svg class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                                    :class="{ 'rotate-180': (selected === 'Masters') }" width="20"
                                    height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                        fill="" />
                                </svg>
                            </a>

                            <!-- Dropdown Menu Start -->
                            <div class="translate transform overflow-hidden"
                                :class="(selected === 'Masters') ? 'block' : 'hidden'">
                                <ul class="mt-4 mb-5.5 flex flex-col gap-2.5 pl-6">
                                    {{-- <li>
                                    <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                        href="{{ route('unit') }}" :class="page === 'settings' && '!text-white'">
                                        Raw Material Unit
                                    </a>
                                </li> --}}
                                    {{-- <li>
                                    <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                        href="{{ route('supplier') }}" :class="page === 'settings' && '!text-white'">
                                        Party Name
                                    </a>
                                </li> --}}
                                    {{-- <li>
                                    <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                        href="{{ route('brand') }}" :class="page === 'settings' && '!text-white'">
                                        Brand
                                    </a>
                                </li> --}}

                                    <!-- Modal toggle -->
                                    {{-- <button data-modal-target="authentication-modal"
                                    data-modal-toggle="authentication-modal"
                                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    type="button">
                                    Toggle modal
                                </button> --}}


                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('raw-material') }}"
                                            :class="page === 'settings' && '!text-white'">
                                            Raw Material
                                        </a>
                                    </li>
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('gift') }}"
                                            :class="page === 'settings' && '!text-white'">
                                            Gifts
                                        </a>
                                    </li>
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('product.index') }}"
                                            :class="page === 'settings' && '!text-white'">
                                            Finnish Products
                                        </a>
                                    </li>
                                    {{-- <li>
                                    <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                        href="{{ route('headquarters') }}"
                                        :class="page === 'settings' && '!text-white'">
                                        Headquarters
                                    </a>
                                </li> --}}
                                </ul>
                            </div>
                            <!-- Dropdown Menu End -->
                        </li>
                        <li>
                            <a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4  text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                href="#"
                                @click.prevent="selected = (selected === 'TourAssign' ? '':'TourAssign')"
                                :class="{
                                    'bg-graydark dark:bg-meta-4': (selected === 'TourAssign') || (page === 'tour')
                                }">
                                <i class="fas fa-map-marked-alt"></i>
                                Tour Assign
                                <svg class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                                    :class="{ 'rotate-180': (selected === 'TourAssign') }" width="20"
                                    height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                        fill="" />
                                </svg>
                            </a>

                            <!-- Dropdown Menu Start -->
                            <div class="translate transform overflow-hidden"
                                :class="(selected === 'TourAssign') ? 'block' : 'hidden'">
                                <ul class="mt-4 mb-5.5 flex flex-col gap-2.5 pl-6">
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('tour.index') }}"
                                            :class="page === 'tour' && '!text-white'">
                                            Tour
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Dropdown Menu End -->
                        </li>
                        <!-- Party Payment  -->

                        <!-- Menu Item Admin -->
                        <li>
                            <a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4  text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                href="#" @click.prevent="selected = (selected === 'Forms' ? '':'Forms')"
                                :class="{
                                    'bg-graydark dark:bg-meta-4': (selected === 'Forms') || (
                                        page ===
                                    'formElements' ||
                                        page === 'formLayout')
                                }">
                                <i class="fa fa-user" aria-hidden="true"></i>

                                User

                                <svg class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                                    :class="{ 'rotate-180': (selected === 'Forms') }" width="20"
                                    height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                        fill="" />
                                </svg>
                            </a>

                            <!-- Dropdown Menu Start -->
                            <div class="translate transform overflow-hidden"
                                :class="(selected === 'Forms') ? 'block' : 'hidden'">
                                <ul class="mt-4 mb-5.5 flex flex-col gap-2.5 pl-6">
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('admin-page') }}"
                                            :class="page === 'formElements' && '!text-white'">View Users</a>
                                    </li>
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4  text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('admin-create') }}"
                                            :class="page === 'formElements' && '!text-white'">Add Users</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Dropdown Menu End -->
                        </li>
                    </ul>
                </div>
                <!-- Tour Assign Start -->
            @endif

      </nav>
    <!-- Sidebar Menu -->
    </div>
</aside>

<!-- ===== SIDEBAR End ===== -->
