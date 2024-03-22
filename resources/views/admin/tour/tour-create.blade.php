@extends('admin.layouts.app', ['title' => 'Tour Assign'])
@section('content')
<!-- ===== Main Content Start ===== -->
<main>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <!-- Breadcrumb Start -->
        <div class="mb-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-center">
            <h2 class="text-title-md2 font-bold text-black dark:text-white text-center">
                Tour Assign
            </h2>
        </div>

        <!-- Add Brand Model Start -->
        <div x-data="{ modalOpen: false }">

            <button @click="modalOpen = true" class="rounded-md bg-primary py-3 px-5 font-medium text-white">
                Assign
            </button>

            <!-- modal start -->
            <div x-show="modalOpen" x-transition=""
                class="fixed top-0 left-0 z-999999 flex h-full min-h-screen w-full items-center justify-center bg-black/90 px-4 py-5 overflow-y-auto"
                style="display: none;">
                <div @click.outside="modalOpen = false"
                    class="w-full max-w-142.5 rounded-lg bg-white py-12 px-8 text-center dark:bg-boxdark md:py-15 md:px-17.5 mt-auto mb-auto">
                    <h3 class="pb-2 text-xl font-bold text-black dark:text-white sm:text-2xl">
                        Tour Assign
                    </h3>
                    <form action="{{ route('tour.store') }}" method="POST">
                        @csrf
                        <div class="w-full m-auto mt-5">
                            <label class="mb-2.5 block text-black dark:text-white">
                                Tour Date<span class="text-meta-1">*</span>
                            </label>
                            <input type="date" name="tour_date"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                            @error('tour_date')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full m-auto mt-5">
                            <label class="mb-2.5 block text-black dark:text-white">
                                Employee Name <span class="text-meta-1">*</span>
                            </label>
                            <select
                                class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                name="employee_id">
                                <option value="0" selected>-- None --</option>
                                @foreach ($emps as $emp)
                                <option value="{{ $emp->id }}">{{ $emp->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('employee_id')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full m-auto mt-5">
                            <label class="mb-2.5 block text-black dark:text-white">
                                Start Location<span class="text-meta-1">*</span>
                            </label>
                            <input type="text" placeholder="Enter the Start Locaion" name="start_location"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                            @error('start_location')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full m-auto mt-5">
                            <label class="mb-2.5 block text-black dark:text-white">
                                End Location<span class="text-meta-1">*</span>
                            </label>
                            <input type="text" placeholder="Enter the End Location" name="end_location"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                            @error('end_location')
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
                                        <th class="lg:w-2/12 md:w-2/12 sm:w-2/12 xs:w-2/12">Tour Date</th>
                                        <th class="lg:w-2/12 md:w-2/12 sm:w-2/12 xs:w-2/12">Employee</th>
                                        <th class="lg:w-2/12 md:w-2/12 sm:w-2/12 xs:w-2/12">Start Location</th>
                                        <th class="lg:w-2/12 md:w-2/12 sm:w-2/12 xs:w-2/12">End Location</th>
                                        <th class="lg:w-4/12 md:w-4/12 sm:w-4/12 xs:w-4/12">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tours as $tour)
                                    <tr>

                                        <td class="lg:w-2/12 md:w-2/12 sm:w-2/12 xs:w-2/12">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $tour->tour_date }}
                                            </p>
                                        </td>
                                        <td class="lg:w-2/12 md:w-2/12 sm:w-2/12 xs:w-2/12">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $tour->employee->name }}
                                            </p>
                                        </td>
                                        <td class="lg:w-2/12 md:w-2/12 sm:w-2/12 xs:w-2/12">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $tour->start_location }}
                                            </p>
                                        </td>
                                        <td class="lg:w-2/12 md:w-2/12 sm:w-2/12 xs:w-2/12">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $tour->end_location }}
                                            </p>
                                        </td>
                                        <td class="lg:w-4/12 md:w-4/12 sm:w-4/12 xs:w-4/12">
                                            <div class="d-flex flex-wrap">
                                                <a href="{{ route('tour.product',$tour->id) }}">
                                                    <button type="button"
                                                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Product</button>
                                                </a>
                                                <button type="button"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Gifts</button>
                                                {{-- <button type="button"
                                                    class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Visiting</button>
                                                --}}
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="datatable-bottom">
                            <div class="datatable-info">
                                Showing {{ $tours->firstItem()}} to
                                {{ $tours->lastItem() }} of
                                {{ $tours->total() }} entries
                            </div>
                            {{ $tours->appends($_GET)->links('vendor.pagination.custom') }}
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
{{-- @if (Session::has('error'))
<script>
    var error = "{{ Session::get('error') }}";
            var needQuantity = "{{ Session::get('needQuantity') }}";

            swal("Error", error + ' You need ' + needQuantity + ' qunatity more to create it.', 'error', {
                buttons: {
                    confirm: "OK",
                },
            });
</script>
@endif --}}
<!-- ===== Main Content End ===== -->
@endsection