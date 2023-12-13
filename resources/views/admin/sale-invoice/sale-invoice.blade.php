@extends('admin.layouts.app', ['title' => 'Sale-Invoice'])
@section('content')
<!-- ===== Main Content Start ===== -->
<main>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <!-- Breadcrumb Start -->
        <div class="mb-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-center">
            <h2 class="text-title-md2 font-bold text-black dark:text-white text-center">
                Sale Invoice
            </h2>
        </div>
        <!-- Breadcrumb End -->
        <a href="{{ route('sale.create') }}">
            <button class="rounded-md bg-primary py-3 px-5 font-medium text-white">
                Create
            </button>
        </a>
        <div class="flex flex-col gap-5 md:gap-7 2xl:gap-10 mt-5">

            <!-- ====== Data Table Two Start -->
            <div
                class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark-bg-boxdark dark:bg-meta-4">
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
                            <table class="datatable-table overflow-y-scroll table w-full" id="dataTableTwo">
                                <thead>
                                    <tr>
                                        <th class="lg:w-15 md:w-15 sm:w-15 xs:w-15">Date</th>
                                        <th class="lg:w-15 md:w-15 sm:w-15 xs:w-15">Party Name</th>
                                        <th class="lg:w-15 md:w-15 sm:w-15 xs:w-15">Place</th>
                                        <th class="lg:w-15 md:w-15 sm:w-15 xs:w-15">Product Name</th>
                                        <th class="lg:w-15 md:w-15 sm:w-15 xs:w-15">Quantity</th>
                                        <th class="lg:w-15 md:w-15 sm:w-15 xs:w-15">Rate</th>
                                        <th class="lg:w-15 md:w-15 sm:w-15 xs:w-15">Total Amount</th>
                                    </tr>


                                </thead>

                                <tbody>
                                    @foreach ($sales as $sale)
                                    <tr>
                                        <td class="lg:w-15 md:w-15 sm:w-15 xs:w-15">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $sale->created_at->format('d-M-Y') }}
                                            </p>
                                        </td>
                                        <td class="lg:w-15 md:w-15 sm:w-15 xs:w-15">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $sale->party->name }}
                                            </p>
                                        </td>
                                        <td class="lg:w-15 md:w-15 sm:w-15 xs:w-15">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $sale->place }}
                                            </p>
                                        </td>
                                        <td class="lg:w-15 md:w-15 sm:w-15 xs:w-15">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $sale->product->name }}
                                            </p>
                                        </td>
                                        <td class="lg:w-15 md:w-15 sm:w-15 xs:w-15">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $sale->qty }}
                                            </p>
                                        </td>
                                        <td class="lg:w-15 md:w-15 sm:w-15 xs:w-15">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $sale->rate }}
                                            </p>
                                        </td>
                                        <td class="lg:w-15 md:w-15 sm:w-15 xs:w-15">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                <b>{{ $sale->total_amt }}</b>
                                            </p>
                                        </td>
                                    </tr>
                                    @endforeach
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
<!-- ===== Main Content End ===== -->
@endsection
