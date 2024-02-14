@extends('admin.layouts.app', ['title' => $label . ' Stocks'])
@section('content')
<!-- ===== Main Content Start ===== -->
<main>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <!-- Breadcrumb Start -->
        <div class="mb-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-center">
            <h2 class="text-title-md2 font-bold text-black dark:text-white text-center">
                Available {{ $label }} Stocks
            </h2>
        </div>

        <!-- Breadcrumb End -->
        <div class="flex flex-col gap-5 md:gap-7 2xl:gap-10">

            <div class="sm:grid grid-cols-2 gap-4">
                <!-- ====== Data Table One Start -->
                <div
                    class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark-bg-boxdark dark:bg-meta-4 mb-6">
                    <div class="data-table-common data-table-two max-w-full overflow-x-auto">
                        <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                            @include('admin.inc.search')
                            <div class="datatable-container">
                                <table class="table w-full table-auto datatable-table" id="dataTableTwo">
                                    <thead>
                                        <tr>
                                            <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">{{ $label }} Name
                                            </th>
                                            <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Available
                                                {{ $label }} Qty.
                                            </th>
                                            <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">View</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($label == 'Product')
                                        @foreach ($master as $m)
                                        <tr>
                                            <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                                <p class="text-sm font-medium text-black dark:text-white">
                                                    {{ $m->product->name ?? '' }} ({{ $m->product->unit->short_name ??
                                                    '' }})
                                                </p>
                                            </td>
                                            <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                                <p class="text-sm font-medium text-black dark:text-white">
                                                    {{ $m->total_quantity }}
                                                    {{-- {{ $m->raw_material->parent->short_name }} --}}
                                                </p>
                                            </td>
                                            <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                                <p class="text-sm font-medium text-black dark:text-white">
                                                    <a href="{{ route('product-detail-id', $m->product_id) }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </p>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        @foreach ($master as $m)
                                        <tr>
                                            <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                                <p class="text-sm font-medium text-black dark:text-white">
                                                    {{ $m->product->name }}
                                                </p>
                                            </td>
                                            <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                                <p class="text-sm font-medium text-black dark:text-white">
                                                    {{ $m->total_quantity }}
                                                    {{-- {{ $m->raw_material->parent->short_name }} --}}
                                                </p>
                                            </td>
                                            <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                                <p class="text-sm font-medium text-black dark:text-white">
                                                    <a href="{{ route('product-detail-id', $m->product_id) }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </p>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                            <div class="datatable-bottom">
                                <div class="datatable-info">
                                    Showing {{ $master->firstItem()}} to
                                    {{ $master->lastItem() }} of
                                    {{ $master->total() }} entries
                                </div>
                                {{ $master->appends($_GET)->links('vendor.pagination.custom') }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ====== Data Table One End -->

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
                                            <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">{{ $label }} Name
                                            </th>
                                            <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Wasted Qunatity
                                            </th>
                                            <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Expiry Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($label == 'Product')
                                        @foreach ($check_expiring as $key => $ce)
                                        <tr>
                                            <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                                <p class="text-sm font-medium text-black dark:text-white">
                                                    {{ $ce->product->name }} ({{ $ce->product->unit->short_name ?? ''
                                                    }})
                                                </p>
                                            </td>
                                            <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                                <p class="text-sm font-medium text-black dark:text-white">
                                                    {{ $ce->total_quantity }}
                                                    {{-- {{ $ce->raw_material->parent->short_name }} --}}
                                                </p>
                                            </td>
                                            <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                                <p class="text-sm font-medium text-black dark:text-white">
                                                    {{ $ce->expiry_date }}
                                                    @if(\Carbon\Carbon::parse($ce->expiry_date)->lte(\Carbon\Carbon::now()))
                                                    <span class="text-meta-1">expired</span>
                                                    @elseif(\Carbon\Carbon::parse($ce->expiry_date)->diffInDays(\Carbon\Carbon::now())
                                                    <= 30) <span class="text-meta-1" style="color: orange !important;">
                                                        expiring soon</span>
                                                        @endif
                                                </p>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        @foreach ($check_expiring as $key => $ce)
                                        <tr>
                                            <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                                <p class="text-sm font-medium text-black dark:text-white">
                                                    {{ $ce->product->name }}
                                                </p>
                                            </td>
                                            <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                                <p class="text-sm font-medium text-black dark:text-white">
                                                    {{ $ce->total_quantity }}
                                                    {{-- {{ $ce->raw_material->parent->short_name }} --}}
                                                </p>
                                            </td>
                                            <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                                <p class="text-sm font-medium text-black dark:text-white">
                                                    {{ $ce->expiry_date }}
                                                    @if(\Carbon\Carbon::parse($ce->expiry_date)->lte(\Carbon\Carbon::now()))
                                                    <span class="text-meta-1">expired</span>
                                                    @elseif(\Carbon\Carbon::parse($ce->expiry_date)->diffInDays(\Carbon\Carbon::now())
                                                    <= 30) <span class="text-meta-1" style="color: orange !important;">
                                                        expiring soon</span>
                                                        @endif
                                                </p>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                            <div class="datatable-bottom">
                                <div class="datatable-info">
                                    Showing {{ $check_expiring->firstItem()}} to
                                    {{ $check_expiring->lastItem() }} of
                                    {{ $check_expiring->total() }} entries
                                </div>
                                {{ $check_expiring->appends($_GET)->links('vendor.pagination.custom') }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ====== Data Table Two End -->
            </div>
        </div>
    </div>
</main>
<!-- ===== Main Content End ===== -->
@endsection
