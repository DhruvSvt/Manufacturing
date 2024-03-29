@extends('admin.layouts.app',['title'=>'Headquarters-Page'])
@section('content')

<!-- ===== Main Content Start ===== -->
<main>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <!-- Header Start -->
        <div class="mb-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-center">
            <h2 class="text-title-md2 font-bold text-black dark:text-white text-center">
                Top Headquarters
            </h2>
        </div>

        <!-- Add Brand Model Start -->
        <div x-data="{modalOpen: false}" >

            <button @click="modalOpen = true" class="rounded-md bg-primary py-3 px-5 font-medium text-white">
                Add Headquarters
            </button>

            <!-- modal start -->
            <div x-show="modalOpen" x-transition=""
                class="fixed top-0 left-0 z-999999 flex h-full min-h-screen w-full items-center justify-center bg-black/90 px-4 py-5"
                style="display: none;">
                <div @click.outside="modalOpen = false"
                    class="w-full max-w-142.5 rounded-lg bg-white py-12 px-8 text-center dark:bg-boxdark md:py-15 md:px-17.5">
                    <h3 class="pb-2 text-xl font-bold text-black dark:text-white sm:text-2xl">
                        Add Headquarters Name
                    </h3>
                    <form action="{{ route('headquarter.store') }}" method="POST">
                        @csrf
                        <div class="w-full xl:w-1/2 m-auto mt-5">
                            <label class="mb-2.5 block text-black dark:text-white">
                                State Name<span class="text-meta-1">*</span>
                            </label>
                            <input type="text" placeholder="Enter State Name" name="state"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                            @error('state_name')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full xl:w-1/2 m-auto mt-5">
                            <label class="mb-2.5 block text-black dark:text-white">
                                Headquarters Name <span class="text-meta-1">*</span>
                            </label>
                            <input type="text" placeholder="Enter Headquarters Name" name="headquarter"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                            @error('headquarter_name')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full xl:w-1/2 m-auto mt-5">
                            <label class="mb-2.5 block text-black dark:text-white">
                                Region name <span class="text-meta-1">*</span>
                            </label>
                            <input type="text" placeholder="Enter Region name" name="region"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                            @error('region_name')
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
        <!-- Header End -->
        <div class="flex flex-col gap-5 md:gap-7 2xl:gap-10 mt-5">

            <!-- ====== Data Table Two Start -->
            <div
                class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark-bg-boxdark dark:bg-meta-4">
                <div class="data-table-common data-table-two max-w-full overflow-x-auto">
                    <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                       @include('admin.inc.search')
                        <div class="datatable-container dark:bg-meta-4">
                            <table class="table w-full table-auto datatable-table" id="dataTableTwo">
                                <thead>
                                    <tr>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">State Name</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Headquarter Name</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Region Name</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Status</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($headquarters as $headquarter )
                                    <tr>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                                                <p class="text-sm font-medium text-black dark:text-white">
                                                    {{ $headquarter->state }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                                                <p class="text-sm font-medium text-black dark:text-white">
                                                    {{ $headquarter->headquarter }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                                                <p class="text-sm font-medium text-black dark:text-white">
                                                    {{ $headquarter->region }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" data-id="{{ $headquarter->id }}" name="status"
                                                    class="js-switch" {{ $headquarter->status == 1 ? 'checked' : '' }}
                                                value=""
                                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4
                                                peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer
                                                dark:bg-gray-700 peer-checked:after:translate-x-full
                                                peer-checked:after:border-white after:content-[''] after:absolute
                                                after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300
                                                after:border after:rounded-full after:h-5 after:w-5 after:transition-all
                                                dark:border-gray-600 peer-checked:bg-blue-600">
                                            </label>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <div class="flex items-center space-x-3.5">
                                                <!-- Edit Brand Model Start -->
                                                <div x-data="{modalOpen: false}">
                                                    <button @click="modalOpen = true">
                                                        <i data-v-3d6d2adb="" title="Edit"
                                                            class="fa fa-edit text-blue-500 hover:text-blue-700 cursor-pointer"></i>
                                                    </button>

                                                    <!-- modal start -->
                                                    <div x-show="modalOpen" x-transition=""
                                                        class="fixed top-0 left-0 z-999999 flex h-full min-h-screen w-full items-center justify-center bg-black/90 px-4 py-5"
                                                        style="display: none;">
                                                        <div @click.outside="modalOpen = false"
                                                            class="w-full max-w-142.5 rounded-lg bg-white py-12 px-8 text-center dark:bg-boxdark md:py-15 md:px-17.5">
                                                            <h3
                                                                class="pb-2 text-xl font-bold text-black dark:text-white sm:text-2xl">
                                                                Edit Brand Name
                                                            </h3>
                                                            <form
                                                                action="{{ route('headquarter.update',['id' => $headquarter->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="w-full xl:w-1/2 m-auto mt-5">
                                                                    <label
                                                                        class="mb-2.5 block text-black dark:text-white">
                                                                        State Name<span class="text-meta-1">*</span>
                                                                    </label>
                                                                    <input type="text" value="{{ $headquarter->state }}"
                                                                        name="state"
                                                                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                                                    @error('state_name')
                                                                    <p class="text-red-500 mt-2">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="w-full xl:w-1/2 m-auto mt-5">
                                                                    <label
                                                                        class="mb-2.5 block text-black dark:text-white">
                                                                        Headquarters Name <span
                                                                            class="text-meta-1">*</span>
                                                                    </label>
                                                                    <input type="text"
                                                                        value="{{ $headquarter->headquarter }}"
                                                                        name="headquarter"
                                                                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                                                    @error('headquarter_name')
                                                                    <p class="text-red-500 mt-2">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="w-full xl:w-1/2 m-auto mt-5">
                                                                    <label
                                                                        class="mb-2.5 block text-black dark:text-white">
                                                                        Region name <span class="text-meta-1">*</span>
                                                                    </label>
                                                                    <input type="text" value="{{ $headquarter->region }}"
                                                                        name="region"
                                                                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                                                    @error('region_name')
                                                                    <p class="text-red-500 mt-2">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <span @click="modalOpen = false"
                                                                    class="flex w-100 float-right rounded font-medium text-gray m-3 mt-3 bg-gray p-3 text-center font-medium text-black transition  hover:border-meta-1 hover:bg-meta-1 hover:text-white dark:border-strokedark dark:bg-meta-4 dark:text-white dark:hover:border-meta-1 dark:hover:bg-meta-1">
                                                                    Cancel
                                                                </span>
                                                                <button
                                                                    class="flex w-100 float-right rounded bg-primary p-3 font-medium mt-3 text-gray m-3">
                                                                    Submit
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- modal end -->
                                                </div>
                                                <!-- Edit Brand Model End -->
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="datatable-bottom">
                            <div class="datatable-info">
                                Showing {{ $headquarters->firstItem()}} to
                                {{ $headquarters->lastItem() }} of
                                {{ $headquarters->total() }} entries
                            </div>
                            {{ $headquarters->appends($_GET)->links('vendor.pagination.custom') }}
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
                let headquarterId = $(this).data('id');
                $.ajax({
                    type: "POST", // Change this to POST
                    dataType: "json",
                    url: '{{ route('headquarter.status') }}',
                    data: {
                        '_token': '{{ csrf_token() }}', // Add the CSRF token
                        'status': status,
                        'headquarter_id': headquarterId
                    },
                    success: function(data) {
                        console.log(data.message);
                    }
                });
            });
        });
</script>

@endsection
