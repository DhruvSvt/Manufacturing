@include('admin.layouts.app')

@include('admin.inc.sidebar')


<!-- ===== Content Area Start ===== -->
<div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
    @include('admin.inc.header')

    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-title-md2 font-bold text-black dark:text-white">
                    Top Admin
                </h2>
            </div>
            <!-- Breadcrumb End -->
            <div class="flex flex-col gap-5 md:gap-7 2xl:gap-10">

                <!-- ====== Data Table Two Start -->
                <div
                    class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
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
                                    <div
                                        class="grid grid-cols-6 border-t border-stroke py-4.5 px-4 dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5">
                                        <div class="col-span-2 flex items-center">
                                            <p class="font-medium">Name</p>
                                        </div>
                                        <div class="col-span-2 items-center sm:flex">
                                            <p class="font-medium">Username</p>
                                        </div>
                                        <div class="col-span-2 items-center sm:flex">
                                            <p class="font-medium">Email</p>
                                        </div>
                                        <div class="col-span-1 flex items-center">
                                            <p class="font-medium">Status</p>
                                        </div>
                                        <div class="col-span-1 flex items-center">
                                            <p class="font-medium">Action</p>
                                        </div>
                                    </div>
                                    @foreach ($users as $user)    
                                        <div class="grid grid-cols-6 border-t border-stroke py-4.5 px-4 dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5">
                                            <div class="col-span-2 flex items-center">
                                                <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                                                    <p class="text-sm font-medium text-black dark:text-white">
                                                        {{ $user->name }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-span-2 items-center sm:flex">
                                                <p class="text-sm font-medium text-black dark:text-white">
                                                    {{ $user->username }}
                                                </p>
                                            </div>
                                            <div class="col-span-2 items-center sm:flex">
                                                <p class="text-sm font-medium text-black dark:text-white">
                                                    {{ $user->email }}
                                                </p>
                                            </div>
                                            <div class="col-span-1 flex items-center">
                                                <label class="relative inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" data-id="{{ $user->id }}" name="status" class="js-switch" {{ $user->status == 1 ? 'checked' : '' }} value="">
                                                    <div
                                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="flex items-center space-x-3.5">
                                                <a href="{{ route('admin-edit',$user->id) }}">
                                                    <i data-v-3d6d2adb="" title="Edit" class="fa fa-edit text-blue-500 hover:text-blue-700 cursor-pointer"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
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
</div>
<script>
    let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function(html) {
        let switchery = new Switchery(html, { size: 'small' });
    });

    // Ajax Request
    $(document).ready(function(){
        $('.js-switch').change(function () {
            let status = $(this).prop('checked') === true ? 1 : 0;
            let userId = $(this).data('id');
            $.ajax({
                type: "POST", // Change this to POST
                dataType: "json",
                url: '{{ route('status') }}',
                data: {
                    '_token': '{{ csrf_token() }}', // Add the CSRF token
                    'status': status,
                    'user_id': userId
                },
                success: function (data) {
                    console.log(data.message);
                }
            });
        });
    });
</script>

<!-- ===== Content Area End ===== -->
</div>
@include('admin.inc.footer')
</body>

<!-- Mirrored from demo.tailadmin.com/tables by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Sep 2023 07:17:37 GMT -->

</html>
