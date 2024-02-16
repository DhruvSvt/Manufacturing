@extends('admin.layouts.app', ['title' => 'Supplier-Page'])
@section('content')
<!-- ===== Main Content Start ===== -->
<main>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <!-- Breadcrumb Start -->
        <div class="mb-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-center">
            <h2 class="text-title-md2 font-bold text-black dark:text-white text-center">
                Top Suppliers
            </h2>
        </div>

        <div class=" flex flex-col sm:flex-row sm:items-center sm:justify-start">
            <a href="{{ route('supplier.create') }}">
                <button class="flex w-100 float-right rounded bg-primary p-3 font-medium text-gray m-3">
                    Add Suppliers
                </button>
            </a>
        </div>
        <!-- Breadcrumb End -->
        <div class="flex flex-col gap-5 md:gap-7 2xl:gap-10">

            <!-- ====== Data Table Two Start -->
            <div
                class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark overflow-x-auto">

                <div class="data-table-common data-table-two max-w-full overflow-x-auto">
                    <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                        @include('admin.inc.search')
                    </div>
                    <div class="datatable-container dark:bg-meta-4">
                        <table class="table w-full table-auto datatable-table" id="dataTableTwo">
                            <thead>
                                <tr>
                                    <th class="sm:w-1/6 xs:w-1/6">Name</th>
                                    <th class="sm:w-1/6 xs:w-1/6">Phone</th>
                                    <th class="sm:w-1/6 xs:w-1/6">Company Name</th>
                                    <th class="sm:w-1/6 xs:w-1/6">Address</th>
                                    <th class="sm:w-1/6 xs:w-1/6">GST No.</th>
                                    <th class="sm:w-1/6 xs:w-1/6">DL No.</th>
                                    <th class="sm:w-1/6 xs:w-1/6">Type</th>
                                    <th class="sm:w-1/6 xs:w-1/6">Status</th>
                                    <th class="sm:w-1/6 xs:w-1/6">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Your table data goes here --}}
                                <!-- Example row -->
                                @foreach ($suppliers as $sup)
                                <tr>
                                    <td class="sm:w-1/6 xs:w-1/6">
                                        <p class="text-sm font-medium text-black dark:text-white">{{ $sup->name }}
                                        </p>
                                    </td>
                                    <td class="sm:w-1/6 xs:w-1/6">
                                        <p class="text-sm font-medium text-black dark:text-white">{{ $sup->phone }}
                                        </p>
                                    </td>
                                    <td class="sm:w-1/6 xs:w-1/6">
                                        <p class="text-sm font-medium text-black dark:text-white">{{
                                            $sup->company_name }}</p>
                                    </td>
                                    <td class="sm:w-1/6 xs:w-1/6">
                                        <p class="text-sm font-medium text-black dark:text-white">{{ $sup->address
                                            }}</p>
                                    </td>
                                    <td class="sm:w-1/6 xs:w-1/6">
                                        <p class="text-sm font-medium text-black dark:text-white">{{ $sup->gst
                                            }}</p>
                                    </td>
                                    <td class="sm:w-1/6 xs:w-1/6">
                                        <p class="text-sm font-medium text-black dark:text-white">{{ $sup->dl
                                            }}</p>
                                    </td>
                                    <td class="sm:w-1/6 xs:w-1/6">
                                        <p class="text-sm font-medium text-black dark:text-white">{{ $sup->type }}</p>
                                    </td>
                                    <td class="sm:w-1/6 xs:w-1/6">
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" data-id="{{ $sup->id }}" name="status"
                                                class="js-switch" {{ $sup->status == 1 ? 'checked' : '' }}>
                                        </label>
                                    </td>
                                    <td class="sm:w-1/6 xs:w-1/6">
                                        <div class="flex items-center space-x-3.5">
                                            <a href="{{ route('supplier.edit', $sup->id) }}">
                                                <i data-v-3d6d2adb="" title="Edit"
                                                    class="fa fa-edit text-blue-500 hover:text-blue-700 cursor-pointer"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                <!-- Repeat for each row of data -->
                            </tbody>
                        </table>
                    </div>
                    <div class="datatable-bottom">
                        <div class="datatable-info">
                            Showing {{ $suppliers->firstItem()}} to
                            {{ $suppliers->lastItem() }} of
                            {{ $suppliers->total() }} entries
                        </div>
                        {{ $suppliers->appends($_GET)->links('vendor.pagination.custom') }}
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
                    let supplierId = $(this).data('id');
                    $.ajax({
                        type: "POST", // Change this to POST
                        dataType: "json",
                        url: '{{ route('supplier.status') }}',
                        data: {
                            '_token': '{{ csrf_token() }}', // Add the CSRF token
                            'status': status,
                            'supplier_id': supplierId
                        },
                        success: function(data) {
                            console.log(data.message);
                        }
                    });
                });
            });
</script>
@endsection
