@extends('admin.layouts.app', ['title' => 'Sample-Challan'])
@section('content')
<!-- ===== Main Content Start ===== -->
<main>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <!-- Breadcrumb Start -->
        <div class="mb-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-center">
            <h2 class="text-title-md2 font-bold text-black dark:text-white text-center">
                Sample Challans
            </h2>
        </div>

        <!-- Add Brand Model Start -->
        <div x-data="{ modalOpen: false }">

            <button @click="modalOpen = true" class="rounded-md bg-primary py-3 px-5 font-medium text-white">
                Issue Challan
            </button>

            <!-- modal start -->
            <div x-show="modalOpen" x-transition=""
                class="fixed top-0 left-0 z-999999 flex h-full min-h-screen w-full items-center justify-center bg-black/90 px-4 py-5"
                style="display: none;">
                <div @click.outside="modalOpen = false"
                    class="w-full max-w-142.5 rounded-lg bg-white py-12 px-8 text-center dark:bg-boxdark md:py-15 md:px-17.5">
                    <h3 class="pb-2 text-xl font-bold text-black dark:text-white sm:text-2xl">
                        Sample Issue Challan
                    </h3>
                    <form action="{{ route('sample-challan-store') }}" method="POST">
                        @csrf
                        <div class="w-full xl:w-1/2 m-auto mt-5">
                            <label class="mb-2.5 block text-black dark:text-white">
                                Sample Name <span class="text-meta-1">*</span>
                            </label>
                            <select
                                class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                name="sample">
                                <option value="0" selected>-- None --</option>
                                @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('sample')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full xl:w-1/2 m-auto mt-5">
                            <label class="mb-2.5 block text-black dark:text-white">
                                Party Name <span class="text-meta-1">*</span>
                            </label>
                            <select
                                class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                name="party">
                                <option value="0" selected>-- None --</option>
                                @foreach ($party as $party)
                                <option value="{{ $party->id }}">{{ $party->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('party')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full xl:w-1/2 m-auto mt-5">
                            <label class="mb-2.5 block text-black dark:text-white">
                                Headquarter Name <span class="text-meta-1">*</span>
                            </label>
                            <select
                                class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                name="headquarter">
                                <option value="0" selected>-- None --</option>
                                @foreach ($hqs as $hq)
                                <option value="{{ $hq->id }}">{{ $hq->headquarter }}
                                </option>
                                @endforeach
                            </select>
                            @error('headquarter')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full xl:w-1/2 m-auto mt-5">
                            <label class="mb-2.5 block text-black dark:text-white">
                                Qty <span class="text-meta-1">*</span>
                            </label>
                            <input type="number" placeholder="Enter the quantity" name="qty"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                            @error('qty')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <span @click="modalOpen = false"
                            class="flex w-100 float-right rounded font-medium text-gray m-3 mt-3 bg-gray p-3 text-center font-medium text-black transition  hover:border-meta-1 hover:bg-meta-1 hover:text-white dark:border-strokedark dark:bg-meta-4 dark:text-white dark:hover:border-meta-1 dark:hover:bg-meta-1">
                            Cancel
                        </span>
                        <button class="flex w-100 float-right rounded bg-primary p-3 font-medium mt-3 text-gray m-3">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
            <!-- modal end -->

        </div>
        <!-- Add Brand Model End -->
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
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Date</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Sample Name</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Party Name </th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">H.Q. Name </th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($samples as $sample)
                                    <tr>

                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $sample->created_at->format('d-m-Y') }}
                                            </p>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $sample->product->name }}
                                            </p>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $sample->supplier->name }}
                                            </p>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $sample->headquarter->headquarter }}
                                            </p>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $sample->qty }}
                                            </p>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="datatable-bottom">
                            <div class="datatable-info">
                                Showing {{ $samples->firstItem()}} to
                                {{ $samples->lastItem() }} of
                                {{ $samples->total() }} entries
                            </div>
                            {{ $samples->appends($_GET)->links('vendor.pagination.custom') }}
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