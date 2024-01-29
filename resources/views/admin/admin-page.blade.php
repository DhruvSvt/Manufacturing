@extends('admin.layouts.app',['title'=>'Admin-Page'])
@section('content')

<!-- ===== Main Content Start ===== -->
<main>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <!-- Breadcrumb Start -->
        <div class="mb-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-center">
            <h2 class="text-title-md2 font-bold text-black dark:text-white text-center">
                Top Admin
            </h2>
        </div>

        <div class=" flex flex-col sm:flex-row sm:items-center sm:justify-start">
            <a href="{{ route('admin-create') }}">
                <button class="flex w-100 float-right rounded bg-primary p-3 font-medium text-gray m-3">
                    Add Admin
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
                            <div class="datatable-search">
                                <input class="datatable-input" placeholder="Search..." type="text"
                                    title="Search within table" aria-controls="dataTableTwo" id="search">
                            </div>
                        </div>
                        <div class="datatable-container dark:bg-meta-4">
                            <table class="table w-full table-auto datatable-table" id="dataTableTwo">
                                <thead>
                                    <tr>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Name</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Username</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Email</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Role</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Status</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                                                <p class="text-sm font-medium text-black dark:text-white">
                                                    {{ $user->name }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $user->username }}
                                            </p>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $user->email }}
                                            </p>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $user->roles ? $user->roles->name : '-' }}
                                            </p>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" data-id="{{ $user->id }}" name="status"
                                                    class="js-switch" {{ $user->status == 1 ? 'checked' : '' }}
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
                                                <a href="{{ route('admin-edit', $user->id) }}">
                                                    <i data-v-3d6d2adb="" title="Edit"
                                                        class="fa fa-edit text-blue-500 hover:text-blue-700 cursor-pointer"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="p-4">
                            {{ $users->links() }}
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
                    success: function(data) {
                        console.log(data.message);
                    }
                });
            });
        });

    // Search
    // Declare a variable to track the AJAX call status
    var isAjaxInProgress = false;

    // Search
    $('#search').on('keydown', function () {
        // Check if an AJAX call is already in progress
        if (!isAjaxInProgress) {
            search();
        }
    });

    function search() {
        // Set the flag to indicate that an AJAX call is in progress
        isAjaxInProgress = true;

        var keyword = $('#search').val();

        $.post('{{ route("user.search") }}', {
            _token: $('meta[name="csrf-token"]').attr('content'),
            keyword: keyword
        }, function (data) {
            table_post_row(data);
            console.log(data);

            // Reset the flag when the AJAX call is completed
            isAjaxInProgress = false;
        }).fail(function () {
            // Handle AJAX failure, and reset the flag in case of an error
            isAjaxInProgress = false;
        });
    }

    // table row with ajax
    function table_post_row(res){
    let htmlView = '';
    if(res.users.length <= 0){
        htmlView+= `
        <tr>
            <td colspan="4">No data.</td>
        </tr>`;
    }
    for(let i = 0; i < res.users.length; i++){
        htmlView += `
            <tr>
                <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                        <p class="text-sm font-medium text-black dark:text-white">
                            ${res.users[i].name}
                        </p>
                    </div>
                </td>
                <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                        <p class="text-sm font-medium text-black dark:text-white">
                            ${res.users[i].username}
                        </p>
                    </div>
                </td>
                <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                        <p class="text-sm font-medium text-black dark:text-white">
                            ${res.users[i].email}
                        </p>
                    </div>
                </td>
                <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                        <p class="text-sm font-medium text-black dark:text-white">
                            ${res.users[i].roles ? res.users[i].roles.name : '-'}
                        </p>
                    </div>
                </td>
                <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                        <p class="text-sm font-medium text-black dark:text-white">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" data-id="${ res.users[i].id }" name="status" class="js-switch peer"
                                    ${ res.users.status == 1 ? 'checked' : '' }
                                    value=""
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4
                                    peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer
                                    dark:bg-gray-700 peer-checked:after:translate-x-full
                                    peer-checked:after:border-white after:content-[''] after:absolute
                                    after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300
                                    after:border after:rounded-full after:h-5 after:w-5 after:transition-all
                                    dark:border-gray-600 peer-checked:bg-blue-600">
                            </label>
                        </p>
                    </div>
                </td>

                <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                        <p class="text-sm font-medium text-black dark:text-white">
                            <div class="flex items-center space-x-3.5">
                            <a href="/admin/edit/${res.users[i].id}">
                                <i title="Edit" class="fa fa-edit text-blue-500 hover:text-blue-700 cursor-pointer"></i>
                            </a>
                        </div>
                        </p>
                    </div>
                </td>
            </tr>`;
    }
        $('tbody').html(htmlView);
    }
</script>

@endsection
