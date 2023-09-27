@extends('admin.layouts.app', ['title' => 'Product'])
@section('content')
    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <div class="mb-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-center">
                <h2 class="text-title-md2 font-bold text-black dark:text-white text-center">
                    Products
                </h2>
            </div>

            <div class=" flex flex-col sm:flex-row sm:items-center sm:justify-start">
                <a href="{{ route('product.create') }}">
                    <button class="flex w-100 float-right rounded bg-primary p-3 font-medium text-gray m-3">
                        Add product
                    </button>
                </a>
            </div>
            <!-- Breadcrumb End -->
            <div class="flex flex-col gap-5 md:gap-7 2xl:gap-10">

                <!-- ====== Data Table Two Start -->
                <div
                    class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark-bg-boxdark dark:bg-meta-4">
                    <div class="data-table-common data-table-two max-w-full overflow-x-auto">
                        <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                            <div class="datatable-top ">
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
                            <div class="datatable-container dark:bg-meta-4">
                                <table class="table w-full table-auto datatable-table" id="dataTableTwo">
                                    <thead>
                                        <tr>
                                            <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Title</th>
                                            <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Price</th>
                                            <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Raw Materials</th>
                                            <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Status</th>
                                            <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                                                        <p class="text-sm font-medium text-black dark:text-white">
                                                            {{ $product->name }}
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                                    <p class="text-sm font-medium text-black dark:text-white">
                                                        ₹ {{ $product->price }} /-
                                                    </p>
                                                </td>
                                                <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                                    @if($product->raw_material && count($product->raw_material) > 0)
                                                        <p class="text-sm font-medium text-black dark:text-white">
                                                            @foreach ($product->raw_material as $key => $item)
                                                                {{ $key+1 }}.)
                                                                {{ $item->name ?? '-' }} Qty:- {{ $item->qty ?? '-' }} {{ $product->raw_material->parent->short_name }}
                                                                <br>
                                                            @endforeach
                                                        </p>
                                                    @endif
                                                    @if($product->raw_material && count($product->raw_material) > 0)
                                                        <p class="text-sm font-medium text-black dark:text-white">
                                                            @foreach ($product->raw_material as $key => $item)
                                                                {{ $key+1 }}.)
                                                                {{ $item->name ?? '-' }} Qty:- {{ $item->qty ?? '-' }}

                                                                {{-- Access the parent relationship for each raw material item --}}
                                                                {{ $item->parent->short_name ?? '-' }}

                                                                <br>
                                                            @endforeach
                                                        </p>
                                                    @endif
                                                </td>
                                                <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                                    <label class="relative inline-flex items-center cursor-pointer">
                                                        <input type="checkbox" data-id="{{ $product->id }}" name="status"
                                                            class="js-switch" {{ $product->status == 1 ? 'checked' : '' }}
                                                            value=""
                                                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                                    </label>
                                                </td>
                                                <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                                    <div class="flex items-center space-x-3.5">
                                                        <a href="{{ route('product.edit',$product->id) }}">
                                                        <i data-v-3d6d2adb="" title="Edit"
                                                            class="fa fa-edit text-blue-500 hover:text-blue-700 cursor-pointer"></i>
                                                        {{-- </a> --}}
                                                    </div>
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
    <!-- ===== Main Content End ===== -->
    <script>
        let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function(html) {
            let switchery = new Switchery(html, {
                size: 'small'
            });
        });

        // Ajax Request
        $(document).ready(function() {
            $('.js-switch').change(function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let productId = $(this).data('id');
                $.ajax({
                    type: "POST", // Change this to POST
                    dataType: "json",
                    url: '{{ route('product.status') }}',
                    data: {
                        '_token': '{{ csrf_token() }}', // Add the CSRF token
                        'status': status,
                        'product_id': productId
                    },
                    success: function(data) {
                        console.log(data.message);
                    }
                });
            });
        });
    </script>
@endsection
