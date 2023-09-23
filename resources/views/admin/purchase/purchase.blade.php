@extends('admin.layouts.app', ['title' => 'Purchase-Page'])
@section('content')
    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <div class="mb-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-center">
                <h2 class="text-title-md2 font-bold text-black dark:text-white text-center">
                    Purchase
                </h2>
            </div>
            {{-- <div class=" flex flex-col sm:flex-row sm:items-center sm:justify-start">
                <a href="{{ route('admin-create') }}">
                    <button class="flex w-100 float-right rounded bg-primary p-3 font-medium text-gray m-3">
                        Add Admin
                    </button>
                </a>
            </div> --}}
            <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
                    <!-- Raw_material Card Item Start -->
                    <a href="{{ route('purchase-material') }}">
                        <div
                            class="rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
                            <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                                <i class="fas fa-industry" style="color: #f000c0"></i>
                            </div>
    
                            <div class="mt-4 flex items-end justify-between">
                                <div>
                                    {{-- <h4 class="text-title-md font-bold text-black dark:text-white">
                                        $3.456K
                                    </h4> --}}
                                    <span class="text-sm font-medium">Raw Material</span>
                                </div>
    
                                {{-- <span class="flex items-center gap-1 text-sm font-medium text-meta-3">
                                    0.43%
                                    <svg class="fill-meta-3" width="10" height="11" viewBox="0 0 10 11" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M4.35716 2.47737L0.908974 5.82987L5.0443e-07 4.94612L5 0.0848689L10 4.94612L9.09103 5.82987L5.64284 2.47737L5.64284 10.0849L4.35716 10.0849L4.35716 2.47737Z"
                                            fill="" />
                                    </svg>
                                </span> --}}
                            </div>
                        </div>
                    </a>
                    <!--Raw_material Card Item End -->

                    <!--Gift Card Item Start -->
                    <div
                        class="rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
                        <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                            <i class="fa-solid fa-gift" style="color: #f000c0;"></i>
                        </div>

                        <div class="mt-4 flex items-end justify-between">
                            <div>
                                {{-- <h4 class="text-title-md font-bold text-black dark:text-white">
                                    $45,2K
                                </h4> --}}
                                <span class="text-sm font-medium">Gift</span>
                            </div>

                            {{-- <span class="flex items-center gap-1 text-sm font-medium text-meta-3">
                                4.35%
                                <svg class="fill-meta-3" width="10" height="11" viewBox="0 0 10 11" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4.35716 2.47737L0.908974 5.82987L5.0443e-07 4.94612L5 0.0848689L10 4.94612L9.09103 5.82987L5.64284 2.47737L5.64284 10.0849L4.35716 10.0849L4.35716 2.47737Z"
                                        fill="" />
                                </svg>
                            </span> --}}
                        </div>
                    </div>
                    <!--Gift Card Item End -->

                    <!--final Product Card Item Start -->
                    <div
                        class="rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
                        <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                            <svg class="fill-primary dark:fill-white" width="22" height="22" viewBox="0 0 22 22"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M21.1063 18.0469L19.3875 3.23126C19.2157 1.71876 17.9438 0.584381 16.3969 0.584381H5.56878C4.05628 0.584381 2.78441 1.71876 2.57816 3.23126L0.859406 18.0469C0.756281 18.9063 1.03128 19.7313 1.61566 20.3844C2.20003 21.0375 2.99066 21.3813 3.85003 21.3813H18.1157C18.975 21.3813 19.8 21.0031 20.35 20.3844C20.9 19.7656 21.2094 18.9063 21.1063 18.0469ZM19.2157 19.3531C18.9407 19.6625 18.5625 19.8344 18.15 19.8344H3.85003C3.43753 19.8344 3.05941 19.6625 2.78441 19.3531C2.50941 19.0438 2.37191 18.6313 2.44066 18.2188L4.12503 3.43751C4.19378 2.71563 4.81253 2.16563 5.56878 2.16563H16.4313C17.1532 2.16563 17.7719 2.71563 17.875 3.43751L19.5938 18.2531C19.6282 18.6656 19.4907 19.0438 19.2157 19.3531Z"
                                    fill="" />
                                <path
                                    d="M14.3345 5.29375C13.922 5.39688 13.647 5.80938 13.7501 6.22188C13.7845 6.42813 13.8189 6.63438 13.8189 6.80625C13.8189 8.35313 12.547 9.625 11.0001 9.625C9.45327 9.625 8.1814 8.35313 8.1814 6.80625C8.1814 6.6 8.21577 6.42813 8.25015 6.22188C8.35327 5.80938 8.07827 5.39688 7.66577 5.29375C7.25327 5.19063 6.84077 5.46563 6.73765 5.87813C6.6689 6.1875 6.63452 6.49688 6.63452 6.80625C6.63452 9.2125 8.5939 11.1719 11.0001 11.1719C13.4064 11.1719 15.3658 9.2125 15.3658 6.80625C15.3658 6.49688 15.3314 6.1875 15.2626 5.87813C15.1595 5.46563 14.747 5.225 14.3345 5.29375Z"
                                    fill="" />
                            </svg>
                        </div>

                        <div class="mt-4 flex items-end justify-between">
                            <div>
                                {{-- <h4 class="text-title-md font-bold text-black dark:text-white">
                                    2.450
                                </h4> --}}
                                <span class="text-sm font-medium">Product</span>
                            </div>

                            {{-- <span class="flex items-center gap-1 text-sm font-medium text-meta-3">
                                2.59%
                                <svg class="fill-meta-3" width="10" height="11" viewBox="0 0 10 11" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4.35716 2.47737L0.908974 5.82987L5.0443e-07 4.94612L5 0.0848689L10 4.94612L9.09103 5.82987L5.64284 2.47737L5.64284 10.0849L4.35716 10.0849L4.35716 2.47737Z"
                                        fill="" />
                                </svg>
                            </span> --}}
                        </div>
                    </div>
                    <!--final Product Card Item End -->

                </div>
            </div>
        </div>
    </main>
    <!-- ===== Main Content End ===== -->
@endsection
