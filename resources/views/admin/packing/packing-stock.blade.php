@extends('admin.layouts.app', ['title' =>'Packing Stocks'])
@section('content')
<!-- ===== Main Content Start ===== -->
<main>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <!-- Breadcrumb Start -->
        <div class="mb-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-center">
            <h2 class="text-title-md2 font-bold text-black dark:text-white text-center">
                Available Packing Stocks
            </h2>
        </div>
        <div class=" flex flex-col sm:flex-row sm:items-center sm:justify-start">
            <a href="{{ route('packing-stock.create') }}">
                <button class="flex w-100 float-right rounded bg-primary p-3 font-medium text-gray m-3">
                    Assign Packing
                </button>
            </a>
        </div>

        <!-- Breadcrumb End -->
        <div class="flex flex-col gap-5 md:gap-7 2xl:gap-10">

            <div class="grid gap-4">
                <!-- ====== Data Table One Start -->
                <div
                    class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark-bg-boxdark dark:bg-meta-4">
                    <div class="data-table-common data-table-two max-w-full overflow-x-auto">
                        <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                            @include('admin.inc.search')
                            <div class="datatable-container">
                                <table class="table w-full table-auto datatable-table" id="dataTableTwo">
                                    <thead>
                                        <tr>
                                            <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Product Name
                                            </th>
                                            <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Size
                                            </th>
                                            <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Qty.
                                            </th>
                                            <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">View</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($packing as $p)
                                        <tr>
                                            <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                                <p class="text-sm font-medium text-black dark:text-white">
                                                    {{ $p->product->name }}
                                                </p>
                                            </td>
                                            <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                                <p class="text-sm font-medium text-black dark:text-white">
                                                    {{ $p->packing->size }}
                                                </p>
                                            </td>
                                            <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                                <p class="text-sm font-medium text-black dark:text-white">
                                                    {{ $p->total_qty }}
                                                </p>
                                            </td>

                                            <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                                <p class="text-sm font-medium text-black dark:text-white">
                                                    <a href="{{ route('packing-detail', $p->product_id ) }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </p>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <div class="datatable-bottom">
                                <div class="datatable-info">
                                    Showing {{ $packing->firstItem()}} to
                                    {{ $packing->lastItem() }} of
                                    {{ $packing->total() }} entries
                                </div>
                                {{ $packing->appends($_GET)->links('vendor.pagination.custom') }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ====== Data Table One End -->
            </div>
        </div>
    </div>
</main>
@if (Session::has('success'))
<script>
    swal("Success", "{{ Session::get('success') }}", 'success', {
                buttons: {
                    confirm: "OK",
                },
            });
</script>
@endif

<!--this alert for diplay the need quantity -->
@if (Session::has('error'))
<script>
    var error = "{{ Session::get('error') }}";
            var needQuantity = "{{ Session::get('needQuantity') }}";

            swal("Error", error + ' You need ' + needQuantity + ' qunatity more to create it.', 'error', {
                buttons: {
                    confirm: "OK",
                },
            });
</script>
@endif
<!-- ===== Main Content End ===== -->
@endsection
