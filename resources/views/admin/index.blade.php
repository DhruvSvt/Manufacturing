@extends('admin.layouts.app',['title'=>'Dashboard'])
@section('content')
<!-- ===== Main Content Start ===== -->
<main>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
            <!-- Users Card Item Start -->
            <div
                class="rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2">
                   <i class="fas fa-users" style="color: #3c50e0;"></i>
                </div>

                <div class="mt-4 flex items-end justify-between">
                    <div>
                        <h4 class="text-title-md font-bold text-black dark:text-white">
                            {{ $users }}
                        </h4>
                        <span class="text-sm font-medium">Total no. of Users</span>
                    </div>
                </div>
            </div>
            <!-- Users Card Item End -->

            <!-- Product Card Item Start -->
            <div
                class="rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2">
                   <i class="fa-solid fa-warehouse" style="color: #3c50e0;"></i>
                </div>

                <div class="mt-4 flex items-end justify-between">
                    <div>
                        <h4 class="text-title-md font-bold text-black dark:text-white">
                            {{ $products }}
                        </h4>
                        <span class="text-sm font-medium">Total no. of Product</span>
                    </div>
                </div>
            </div>
            <!-- Product Card Item End -->

            <!-- Raw Material Card Item Start -->
            <div
                class="rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2">
                    <i class="fa fa-industry" aria-hidden="true" style="color: #3c50e0;"></i>
                </div>

                <div class="mt-4 flex items-end justify-between">
                    <div>
                        <h4 class="text-title-md font-bold text-black dark:text-white">
                            {{ $raw_materials }}
                        </h4>
                        <span class="text-sm font-medium">Total no. of Raw Material</span>
                    </div>

                </div>
            </div>
            <!-- Raw Material Card Item End -->

            <!-- Gift Card Item Start -->
            <div
                class="rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2">
                    <i class="fa-solid fa-gift" style="color: #3c50e0;"></i>
                </div>

                <div class="mt-4 flex items-end justify-between">
                    <div>
                        <h4 class="text-title-md font-bold text-black dark:text-white">
                            {{ $gifts }}
                        </h4>
                        <span class="text-sm font-medium">Total no. of Gifts</span>
                    </div>
                </div>
            </div>
            <!-- Gift Card Item End -->


        </div>

        <div class="mt-4 grid grid-cols-12 gap-4 md:mt-6 md:gap-6 2xl:mt-7.5 2xl:gap-7.5"></div>
    </div>
</main>
<!-- ===== Main Content End ===== -->
@endsection
