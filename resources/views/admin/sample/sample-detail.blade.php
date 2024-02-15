@extends('admin.layouts.app', ['title' =>'Sample Stocks'])
@section('content')
<!-- ===== Main Content Start ===== -->
<main>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <!-- Breadcrumb Start -->
        <div class="mb-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-center">
            <h2 class="text-title-md2 font-bold text-black dark:text-white text-center">
                Available Sample Stocks
            </h2>
        </div>

        <!-- Breadcrumb End -->
        <div class="flex flex-col gap-5 md:gap-7 2xl:gap-10">

            <!-- ====== Data Table Two Start -->
            <div
                class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark-bg-boxdark dark:bg-meta-4">
                <div class="data-table-common data-table-two max-w-full overflow-x-auto">
                    <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                        @include('admin.inc.search')
                        <div class="datatable-container">
                            <table class="table w-full table-auto datatable-table" id="dataTableTwo">
                                <thead>
                                    <tr>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">S.no</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Sample Name</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Employee Name</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Headquarter Name</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Assign Date</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Available Sample qty.
                                        </th>
                                        {{-- <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Expiry Date</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach ($sample as $key => $item)
                                    <tr>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $i++ }})
                                            </p>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $item->product->name }}
                                            </p>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $item->employee->name }}
                                            </p>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $item->headquarter->headquarter }}
                                            </p>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $item->created_at->format('d-m-Y') }}
                                            </p>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $item->qty }}
                                            </p>
                                        </td>
                                        {{-- <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $item->expiry_date }}
                                                @if
                                                (\Carbon\Carbon::parse($item->expiry_date)->lte(\Carbon\Carbon::now()))
                                                <span class="text-meta-1">expired</span>
                                                @elseif
                                                (\Carbon\Carbon::parse($item->expiry_date)->diffInDays(\Carbon\Carbon::now())
                                                <= 30) <span class="text-meta-1" style="color: orange !important;">
                                                    expiring soon</span>
                                                    @endif
                                            </p>
                                        </td> --}}
                                    </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                        <div class="datatable-bottom">
                            <div class="datatable-info">
                                Showing {{ $sample->firstItem()}} to
                                {{ $sample->lastItem() }} of
                                {{ $sample->total() }} entries
                            </div>
                            {{ $sample->appends($_GET)->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- ====== Data Table Two End -->
        </div>
    </div>
</main>
<!-- ===== Main Content End ===== -->
@endsection
