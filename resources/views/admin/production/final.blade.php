@extends('admin.layouts.app', ['title' => 'Final Check'])
@section('content')
<!-- ===== Form Area Start ===== -->
<div
    class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark my-10 md:mx-10">
    <div class="mb-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-center m-6">
        <h2 class="text-title-md2 font-bold text-black dark:text-white text-center">
            Final Challan
        </h2>
    </div>
    <form action="{{ route('production.final.store') }}" method="POST">
        @csrf
        <div class="p-6.5">
            <div class="w-full flex flex-col gap-4.5 xl:flex-row">
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Choose Product
                    </label>
                    <div class="relative z-20 bg-transparent dark:bg-form-input">
                        <input type="text"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                            name="product" value="{{ App\Models\Product::find($productionData['product_id'])->name }}"
                            disabled>
                        </input>
                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2">
                            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Quantity <span class="text-meta-1">*</span>
                    </label>
                    <input type="number" placeholder="Enter the Quantity" name="qty"
                        value="{{ $productionData['qty'] }}"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                        disabled />
                    @error('quantity')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Batch No. <span class="text-meta-1">*</span>
                    </label>
                    <input type="text" placeholder="Enter Batch No." name="batch_no"
                        value="{{ $productionData['batch_no'] }}"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                        disabled />
                    @error('batch_no')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>


            <div class="w-full flex flex-col gap-4.5 xl:flex-row mt-5">
                @foreach ($productRawMaterial as $prm)
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        {{$prm->raw_material->name ?? '-' }}
                    </label>
                    <input type="text" placeholder="" name="batch_no" value="{{ $prm->qty ?? '-' }}"
                        class="w-1/4 rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" /> {{ $prm->raw_material->parent->short_name ?? ' - '}}
                    @error('batch_no')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                @endforeach
            </div>


        </div>
        <div class="flex justify-end">
            <button class="flex w-100 rounded bg-primary p-3 font-medium text-gray m-5">
                Submit
            </button>
        </div>
    </form>


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
</div>

{{--
<!-- Quantity calculated table -->
<div class="m-2">
    <div
        class="lg:m-10 rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 sm:mb-5 xl:pb-1">
        <h4 class="text-title-md2 font-bold text-black dark:text-white text-center">
            Final Quantity
        </h4>
        <div class="flex flex-col mt-5">
            <div class="grid grid-cols-3 rounded-sm bg-gray-2 dark:bg-meta-4 sm:grid-cols-5">
                <div class="p-2.5 xl:p-5 text-center">
                    <h5 class="text-sm font-medium uppercase xsm:text-base">Required Qty / Unit</h5>
                </div>
                <div class="p-2.5 text-center xl:p-5">
                    <h5 class="text-sm font-medium uppercase xsm:text-base">Actually Qty</h5>
                </div>
            </div>

            @foreach($productRawMaterial as $prm)
            <div class="grid grid-cols-3 border-b border-stroke dark:border-strokedark sm:grid-cols-5">
                <div class="flex items-center p-2.5 xl:p-5 text-center sm:block">
                    <p class="font-medium text-black dark:text-white">
                        {{ $prm->qty ?? '-' }} {{ $prm->raw_material->parent->short_name ?? ' - '}}
                        {{ $prm->raw_material->name ?? '-' }} x {{ $productionData['qty'] }}
                    </p>
                </div>

                <div class="flex items-center p-2.5 xl:p-5 text-center">
                    <p class="font-medium text-black dark:text-white">
                        {{ ($prm->qty ?? '-') * ($productionData['qty']) }}{{ $prm->raw_material->parent->short_name ??
                        ' - '}}{{ $prm->raw_material->name ?? '-' }}
                    </p>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
<!-- Quantity calculated table --> --}}

<div class="flex flex-col gap-5 md:gap-7 2xl:gap-10 mt-5">
    <!-- Quantity calculated table -->
    <div
        class="lg:m-10 rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark-bg-boxdark dark:bg-meta-4">
        <div class="data-table-common data-table-two max-w-full overflow-x-auto">
            <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                <div class="datatable-container dark:bg-meta-4">
                    <h4 class="text-title-md2 font-bold text-black dark:text-white text-center px-5 pt-6 pb-2.5 ">
                        Final Quantity
                    </h4>
                    <table class="table w-full table-auto datatable-table" id="dataTableTwo">
                        <thead>
                            <tr>
                                <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6 uppercase">Required Qty / Unit</th>
                                <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6 uppercase">Actually Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productRawMaterial as $prm)
                            <tr>
                                <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                                        <p class="text-sm font-medium text-black dark:text-white">
                                            {{ $prm->qty ?? '-' }} {{ $prm->raw_material->parent->short_name ?? ' - '}}
                                            {{ $prm->raw_material->name ?? '-' }} x {{ $productionData['qty'] }}
                                        </p>
                                    </div>
                                </td>
                                <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                                        <p class="text-sm font-medium text-black dark:text-white">
                                            {{ ($prm->qty ?? '-') * ($productionData['qty']) }} {{
                                            $prm->raw_material->parent->short_name ??
                                            ' - '}} {{ $prm->raw_material->name ?? '-' }}
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Quantity calculated table -->
</div>
<!-- ===== Form Area End ===== -->
@endsection
