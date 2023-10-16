@extends('admin.layouts.app',['title'=>'Gift-Challan'])
@section('content')

<!-- ===== Main Content Start ===== -->
<main>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <!-- Breadcrumb Start -->
        <div class="mb-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-center">
            <h2 class="text-title-md2 font-bold text-black dark:text-white text-center">
                Gift Challans
            </h2>
        </div>

        <!-- Add Brand Model Start -->
        <div x-data="{modalOpen: false}">

            <button @click="modalOpen = true" class="rounded-md bg-primary py-3 px-9 font-medium text-white">
                Issue Challan
            </button>

            <!-- modal start -->
            <div x-show="modalOpen" x-transition=""
                class="fixed top-0 left-0 z-999999 flex h-full min-h-screen w-full items-center justify-center bg-black/90 px-4 py-5"
                style="display: none;">
                <div @click.outside="modalOpen = false"
                    class="w-full max-w-142.5 rounded-lg bg-white py-12 px-8 text-center dark:bg-boxdark md:py-15 md:px-17.5">
                    <h3 class="pb-2 text-xl font-bold text-black dark:text-white sm:text-2xl">
                        Gift Issue Challan
                    </h3>
                    <form action="{{ route('gift-store') }}" method="POST">
                        @csrf
                        <div class="w-full xl:w-1/2 m-auto mt-5">
                            <label class="mb-2.5 block text-black dark:text-white">
                                Gift Name <span class="text-meta-1">*</span>
                            </label>
                            <select
                                class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                name="party">
                                <option value="0" selected>-- None --</option>
                                @foreach ($gifts as $gift)
                                <option value="{{ $gift->id }}">{{ $gift->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('party')
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
                                @foreach ($hq_name as $hq)
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
                        <div class="w-full xl:w-1/2 m-auto mt-5">
                            <label class="mb-2.5 block text-black dark:text-white">
                                Amount <span class="text-meta-1">*</span>
                            </label>
                            <input type="number" placeholder="Enter the Amount" name="amount"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                            @error('amount')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <button @click="modalOpen = false"
                            class="flex w-100 float-right rounded font-medium text-gray m-3 mt-3 bg-gray p-3 text-center font-medium text-black transition  hover:border-meta-1 hover:bg-meta-1 hover:text-white dark:border-strokedark dark:bg-meta-4 dark:text-white dark:hover:border-meta-1 dark:hover:bg-meta-1">
                            Cancel
                        </button>
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
                            <table class="table w-full table-auto datatable-table" id="dataTableTwo">
                                <thead>
                                    <tr>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Date</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Party Name </th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">H.Q. Name </th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Qty</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($gifts as $gift) --}}
                                    <tr>

                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{-- {{ $gift->name }} --}}
                                            </p>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{-- {{ $gift->price }} --}}
                                            </p>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{-- {{ $gift->parent ? $gift->parent->short_name : '-' }} --}}
                                            </p>
                                        </td>
                                    </tr>
                                    {{-- @endforeach --}}
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
@if (Session::has('error'))
<script>
    swal("Error", "{{ Session::get('error') }}", 'error', {
                buttons: {
                    confirm: "OK",
                },
            });
</script>
@endif
<!-- ===== Main Content End ===== -->
{{-- <script>
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
                let giftId = $(this).data('id');
                $.ajax({
                    type: "POST", // Change this to POST
                    dataType: "json",
                    url: '{{ route('gift.status') }}',
                    data: {
                        '_token': '{{ csrf_token() }}', // Add the CSRF token
                        'status': status,
                        'gift_id': giftId
                    },
                    success: function(data) {
                        console.log(data.message);
                    }
                });
            });
        });
</script> --}}

@endsection