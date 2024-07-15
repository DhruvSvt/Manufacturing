@extends('admin.layouts.app', ['title' => 'Production-Process'])
@section('content')
<!-- ===== Main Content Start ===== -->
<main>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <!-- Breadcrumb Start -->
        <div class="mb-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-center">
            <h2 class="text-title-md2 font-bold text-black dark:text-white text-center">
                In Process Production
            </h2>
        </div>

        {{-- <div class=" flex flex-col sm:flex-row sm:items-center sm:justify-start">
            <a href="{{ route('supplier.create') }}">
                <button class="flex w-100 float-right rounded bg-primary p-3 font-medium text-gray m-3">
                    Add Suppliers
                </button>
            </a>
        </div> --}}
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
                                        <th class="sm:w-1/6 xs:w-1/6">S.no</th>
                                        <th class="sm:w-1/6 xs:w-1/6">Product Name</th>
                                        <th class="sm:w-1/6 xs:w-1/6">Batch Size</th>
                                        <th class="sm:w-1/6 xs:w-1/6">Batch No</th>
                                        <th class="sm:w-1/6 xs:w-1/6">Create at</th>
                                        <th class="sm:w-1/6 xs:w-1/6">Complete</th>
                                        {{-- <th class="sm:w-1/6 xs:w-1/6">print</th> --}}
                                    </tr>
                                </thead>
                                <?php
                                $i=1
                                ?>
                                <tbody>
                                    {{-- Your table data goes here --}}
                                    <!-- Example row -->
                                    @foreach ($productions as $key => $production)
                                    @if ($production->status === 0)
                                    <tr>
                                        <td class="sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $i++ }}
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
                                                {{ $production->qty ?? '-' }}
                                            </p>
                                        </td>
                                        <td class="sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $production->batch_no ?? '-'}}
                                            </p>
                                        </td>
                                        <td class="sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $production->created_at->format('d-m-Y') ?? '-' }}
                                            </p>
                                        </td>
                                        <td class="sm:w-1/6 xs:w-1/6">
                                            <div x-data="{modalOpen: false}">
                                                <button @click="modalOpen = true">
                                                    {{-- <i data-v-3d6d2adb="" title="Edit"
                                                        class="fa fa-edit text-blue-500 hover:text-blue-700 cursor-pointer"></i>
                                                    --}}
                                                    <label class="relative inline-flex items-center cursor-pointer">
                                                        <input type="checkbox" name="status" class="ds-switch h-4 w-4"
                                                            value="">
                                                    </label>
                                                </button>

                                                <!-- modal start -->
                                                <div x-show="modalOpen" x-transition=""
                                                    class="fixed top-0 left-0 z-999999 flex h-full min-h-screen w-full items-center justify-center bg-black/90 px-4 py-5"
                                                    style="display: none;">
                                                    <div @click.outside="modalOpen = true"
                                                        class="w-full max-w-142.5 rounded-lg bg-white py-12 px-8 text-center dark:bg-boxdark md:py-15 md:px-17.5">
                                                        <h3
                                                            class="pb-2 text-xl font-bold text-black dark:text-white sm:text-2xl">
                                                            Finish Good
                                                        </h3>
                                                        <form
                                                            action="{{ route('finish-good.update',['id' => $production->id ]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="w-full xl:w-1/2 m-auto mt-5">
                                                                <label class="mb-2.5 block text-black dark:text-white">
                                                                    batch No.
                                                                </label>
                                                                <input type="text" name="batch_no"
                                                                    value="{{ $production->batch_no ?? '-'}}" readonly
                                                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                                                @error('batch_no')
                                                                <p class="text-red-500 mt-2">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                            <div class="w-full xl:w-1/2 m-auto mt-5">
                                                                <label class="mb-2.5 block text-black dark:text-white">
                                                                    Product Name
                                                                </label>
                                                                <select name="product_id" id=""
                                                                    class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                                                                    <option selected>-- None --</option>
                                                                    @foreach ($products as $product )
                                                                    <option value="{{ $product->id }}">
                                                                        {{ $product->name ?? '-'}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('product_id')
                                                                <p class="text-red-500 mt-2">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                            <div class="w-full xl:w-1/2 m-auto mt-5">
                                                                <label class="mb-2.5 block text-black dark:text-white">
                                                                    Product Qunatity
                                                                </label>
                                                                <input type="text" name="product_qty"
                                                                    placeholder="Ex: 75" value=""
                                                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />

                                                                @error('product_qty')
                                                                <p class="text-red-500 mt-2">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                            <div class="w-full xl:w-1/2 m-auto mt-5">
                                                                <label class="mb-2.5 block text-black dark:text-white">
                                                                    Remaining Qty
                                                                </label>
                                                                <input type="text" name="remaining_qty"
                                                                    placeholder="Ex: 25" value=""
                                                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                                                <p class="mt-2">Total Avaliable Batch Qty:- {{
                                                                    $production->qty}}</p>
                                                                <input type="hidden" name="total_qty"
                                                                    value="{{ $production->qty }}">
                                                                @error('remaining_qty')
                                                                <p class="text-red-500 mt-2">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                            <span @click="modalOpen = false" onclick="checkBoxFalse()"
                                                                class="flex w-100 float-right rounded font-medium text-gray m-3 mt-3 bg-gray p-3 text-center font-medium text-black transition  hover:border-meta-1 hover:bg-meta-1 hover:text-white dark:border-strokedark dark:bg-meta-4 dark:text-white dark:hover:border-meta-1 dark:hover:bg-meta-1">
                                                                Cancel
                                                            </span>
                                                            <button id="submitBtn" data-id="{{ $production->id }}"
                                                                class="ds-switch flex w-100 float-right rounded bg-primary p-3 font-medium mt-3 text-gray m-3"
                                                                {{ $production->status == 1 ? 'checked' : '' }}>
                                                                Submit
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- modal end -->
                                            </div>
                                        </td>
                                        {{-- <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <a href="{{ route('print-production',$production->id) }}" target="_blank"
                                                class="inline-flex items-center justify-center gap-2.5 rounded-full bg-meta-3 py-2 px-7 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-5">
                                                <span>
                                                    <i class="fa-solid fa-print"></i>
                                                </span>
                                                Print
                                            </a>
                                        </td> --}}
                                    </tr>
                                    @endif
                                    @endforeach
                                    <!-- Repeat for each row of data -->
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
<!-- ===== Main Content End ===== -->

{{-- <script>
    function checkBoxFalse() {
        $('.ds-switch').prop('checked', false);
    }


    $(document).ready(function() {
        $('#submitBtn').click(function() {
            let status = 1;
            let productionId = $(this).data('id');
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('production.status') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'status': status,
                    'production_id': productionId
                },
                success: function(data) {
                    console.log(data.message);
                    // Add your code here to handle the successful update, if needed
                },
                error: function(xhr, status, error) {
                    // Handle the error if the update fails
                    console.error(error);
                }
            });
        });
    }); --}}
</script>


@endsection
