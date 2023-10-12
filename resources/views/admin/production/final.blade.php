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
    <form action="{{ route('production.store') }}" method="POST">
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
                @foreach ($products->raw_material as $key => $item)
                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">
                            {{ $item->name ?? '-' }}
                        </label>
                        <input type="text" placeholder="" name="batch_no" value="{{ $item->qty ?? '-' }}"
                            class="w-1/4 rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
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

<!-- ===== Form Area End ===== -->
@endsection
