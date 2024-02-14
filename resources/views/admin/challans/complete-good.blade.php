@extends('admin.layouts.app', ['title' => 'Production-Complete'])
@section('content')
<!-- ===== Main Content Start ===== -->
<main>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <!-- Breadcrumb Start -->
        <div class="mb-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-center">
            <h2 class="text-title-md2 font-bold text-black dark:text-white text-center">
                Final Good Challan
            </h2>
        </div>

        <!-- Breadcrumb End -->
        <div class="flex flex-col gap-5 md:gap-7 2xl:gap-10">

            <!-- ====== Data Table Two Start -->
            <div
                class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark overflow-x-auto">

                <div class="data-table-common data-table-two max-w-full overflow-x-auto">
                    <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                        @include('admin.inc.search')
                        <div class="datatable-container dark:bg-meta-4">
                            <table class="table w-full table-auto datatable-table" id="dataTableTwo">
                                <thead>
                                    <tr>
                                        <th class="sm:w-1/6 xs:w-1/6">Challan No.</th>
                                        <th class="sm:w-1/6 xs:w-1/6">Product Name</th>
                                        <th class="sm:w-1/6 xs:w-1/6">Batch Size</th>
                                        <th class="sm:w-1/6 xs:w-1/6">Batch No</th>
                                        <th class="sm:w-1/6 xs:w-1/6">Create at</th>
                                        <th class="sm:w-1/6 xs:w-1/6">Print</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productions as $key => $production)
                                    <tr>
                                        <td class="sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $production->id }}
                                            </p>
                                        </td>
                                        <td class="sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $production->product->name ?? '-' }} ({{
                                                $production->product->unit->short_name ?? '-' }} )
                                            </p>
                                        </td>
                                        <td class="sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $production->qty }}
                                            </p>
                                        </td>
                                        <td class="sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $production->batch_no }}
                                            </p>
                                        </td>
                                        <td class="sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $production->created_at->format('d-m-Y') }}
                                            </p>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <a href="{{ route('print-production',$production->id) }}" target="_blank"
                                                class="inline-flex items-center justify-center gap-2.5 rounded-full bg-meta-3 py-2 px-7 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-5">
                                                <span>
                                                    <i class="fa-solid fa-print"></i>
                                                </span>
                                                Print
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="datatable-bottom">
                            <div class="datatable-info">
                                Showing {{ $productions->firstItem()}} to
                                {{ $productions->lastItem() }} of
                                {{ $productions->total() }} entries
                            </div>
                            {{ $productions->appends($_GET)->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- ====== Data Table Two End -->
        </div>
    </div>
</main>
@endsection