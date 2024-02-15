@extends('admin.layouts.app', ['title' => 'Good-Return'])
@section('content')
<!-- ===== Main Content Start ===== -->
<main>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <!-- Breadcrumb Start -->
        <div class="mb-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-center">
            <h2 class="text-title-md2 font-bold text-black dark:text-white text-center">
                Good Return
            </h2>
        </div>
        <!-- Breadcrumb End -->
        <a href="{{ route('good-return-create') }}">
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
                        @include('admin.inc.search')
                        <div class="datatable-container">
                            <table class="datatable-table overflow-y-scroll table w-full" id="dataTableTwo">
                                <thead>
                                    <tr>
                                        <th class="lg:w-15 md:w-15 sm:w-15 xs:w-15">Party Name</th>
                                        <th class="lg:w-15 md:w-15 sm:w-15 xs:w-15">Builty No.</th>
                                        <th class="lg:w-15 md:w-15 sm:w-15 xs:w-15">Name of Product</th>
                                        <th class="lg:w-15 md:w-15 sm:w-15 xs:w-15">Batch No</th>
                                        <th class="lg:w-15 md:w-15 sm:w-15 xs:w-15">Qty</th>
                                        <th class="lg:w-15 md:w-15 sm:w-15 xs:w-15">Rate</th>
                                        <th class="lg:w-15 md:w-15 sm:w-15 xs:w-15">Type</th>
                                        <th class="lg:w-15 md:w-15 sm:w-15 xs:w-15">Print</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($returns as $return)
                                    <tr>
                                        <td class="lg:w-15 md:w-15 sm:w-15 xs:w-15">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $return->supplier->name }}
                                            </p>
                                        </td>
                                        <td class="lg:w-15 md:w-15 sm:w-15 xs:w-15">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $return->builty }}
                                            </p>
                                        </td>
                                        <td class="lg:w-15 md:w-15 sm:w-15 xs:w-15">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                <?php
                                                $returnProducts = App\Models\ReturnGoodsProduct::where('return_good_id',$return->id)->get()
                                                ?>
                                                @foreach ($returnProducts as $key => $returnProduct)
                                                {{ $key+1 }}) {{ $returnProduct->product->name }} ({{
                                                $returnProduct->product->unit->short_name ?? '-' }})
                                                <br>
                                                @endforeach
                                            </p>
                                        </td>
                                        <td class="lg:w-15 md:w-15 sm:w-15 xs:w-15">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                <?php
                                                $returnProducts = App\Models\ReturnGoodsProduct::where('return_good_id',$return->id)->get()
                                                ?>
                                                @foreach ($returnProducts as $key => $returnProduct)
                                                {{ $key+1 }}) {{ $returnProduct->batch_no }}
                                                <br>
                                                @endforeach
                                            </p>
                                        </td>
                                        <td class="lg:w-15 md:w-15 sm:w-15 xs:w-15">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                <?php
                                                $returnProducts = App\Models\ReturnGoodsProduct::where('return_good_id',$return->id)->get()
                                                ?>
                                                @foreach ($returnProducts as $key => $returnProduct)
                                                {{ $key+1 }}) {{ $returnProduct->qty }}
                                                <br>
                                                @endforeach
                                            </p>
                                        </td>
                                        <td class="lg:w-15 md:w-15 sm:w-15 xs:w-15">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                <?php
                                                $returnProducts = App\Models\ReturnGoodsProduct::where('return_good_id',$return->id)->get()
                                                ?>
                                                @foreach ($returnProducts as $key => $returnProduct)
                                                {{ $key+1 }}) ₹{{ $returnProduct->rate }}/-
                                                <br>
                                                @endforeach
                                            </p>
                                        </td>

                                        <td class="lg:w-15 md:w-15 sm:w-15 xs:w-15">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                <?php
                                                $returnProducts = App\Models\ReturnGoodsProduct::where('return_good_id',$return->id)->get()
                                                ?>
                                                @foreach ($returnProducts as $key => $returnProduct)
                                                {{ $key+1 }}) {{ $returnProduct->reason_of_return }}
                                                <br>
                                                @endforeach
                                            </p>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <a href="{{ route('print-return',$return->id) }}" target="_blank"
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
                                Showing {{ $returns->firstItem()}} to
                                {{ $returns->lastItem() }} of
                                {{ $returns->total() }} entries
                            </div>
                            {{ $returns->appends($_GET)->links('vendor.pagination.custom') }}
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
