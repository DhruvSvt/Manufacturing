@extends('admin.layouts.app', ['title' => 'Raw-Material Challan'])
@section('content')
<!-- ===== Main Content Start ===== -->
<main>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <!-- Breadcrumb Start -->
        <div class="mb-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-center">
            <h2 class="text-title-md2 font-bold text-black dark:text-white text-center">
                Raw-Material Challans
            </h2>
        </div>

        <!-- Breadcrumb End -->
        <div class="flex flex-col gap-5 md:gap-7 2xl:gap-10 mt-5">

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
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Sr.No.</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Material Name </th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Unit</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Req.Qty</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Acctual qty.</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Batch no.</th>
                                        {{-- <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">BatchSize</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($issues as $key => $issue)
                                    <tr>

                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $key+1 }}
                                            </p>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $issue->product->name ?? '-' }} ( {{
                                                $issue->product->unit->short_name ?? '-' }} )
                                            </p>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $issue->qty }}
                                            </p>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                @if($issue->product_raw_material && count($issue->product_raw_material)
                                                > 0)
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                @foreach ($issue->product_raw_material as $key => $item)
                                                {{ $key+1 }}.)
                                                {{ $item->raw_material->name ?? '-' }} Qty:- {{ $item->qty ?? '' }}
                                                {{-- Access the parent relationship for each raw material item --}}
                                                {{ $item->raw_material->parent->short_name ?? '-' }}
                                                <br>
                                                @endforeach
                                            </p>
                                            @endif
                                            </p>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                @if($issue->finish_raw_material && count($issue->finish_raw_material) >
                                                0)
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                @foreach ($issue->finish_raw_material as $key => $item)
                                                {{ $key+1 }}.)
                                                {{ $item->raw_material->name ?? '-' }} Qty:- {{ $item->qty ?? '' }}
                                                {{-- Access the parent relationship for each raw material item --}}
                                                {{ $item->raw_material->parent->short_name ?? '-' }}
                                                <br>
                                                @endforeach
                                            </p>
                                            @endif
                                            </p>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $issue->batch_no }}
                                            </p>
                                        </td>
                                        {{-- <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $issue->qty }}
                                            </p>
                                        </td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="datatable-bottom">
                            <div class="datatable-info">
                                Showing {{ $issues->firstItem()}} to
                                {{ $issues->lastItem() }} of
                                {{ $issues->total() }} entries
                            </div>
                            {{ $issues->appends($_GET)->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- ====== Data Table Two End -->
        </div>
    </div>
</main>
@endsection