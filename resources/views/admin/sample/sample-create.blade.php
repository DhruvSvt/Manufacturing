@extends('admin.layouts.app', ['title' => 'Create Sample'])
@section('content')
<style>
    [type="button"],
    [type="reset"],
    [type="submit"],

    button {
        -webkit-appearance: button;
        /* background-color: #3c50e0; */
        background-image: none;
    }
</style>
<!-- ===== Main Content Start ===== -->
<main>
    <div
        class=" max-w-screen-2xl p-4 md:p-6 2xl:p-10 my-10 md:mx-10 bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
        <!-- Breadcrumb Start -->
        <div class="mb-20 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-center">
            <h2 class="lg:text-4xl md:text-3xl text-3xl font-bold text-black dark:text-white text-center">
                Create Sample
            </h2>
        </div>
        <form action="{{ route('sample.store') }}" method="POST">
            @csrf
            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                <div class="w-full xl:w-1/2">
                    <div class="flex justify-between items-center mb-2.5">
                        <label class="block text-black dark:text-white">
                            Product Name <span class="text-meta-1">*</span>
                        </label>

                        <button type="button" class="rounded-md bg-[#3c50e0] py-2 px-3 font-medium text-white text-sm">
                            <a href="{{ route('product.create') }}" target="_blank" >
                                Add
                            </a>
                        </button>

                    </div>
                    <select
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border   -primary"
                        name="product_id">
                        <option value="">Choose Product name</option>
                        @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    @error('product_id')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full xl:w-1/2">
                    <div class="flex justify-between items-center mb-2.5">
                        <label class="mb-2.5  text-black dark:text-white">
                            Headquarter Name
                        </label>
                    </div>
                    <select
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                        name="headquarter_id">
                        <option value="">Choose Headquarter name</option>
                        @foreach ($headquarters as $headquarter)
                        <option value="{{ $headquarter->id }}">{{ $headquarter->headquarter }}</option>
                        @endforeach
                    </select>
                    @error('headquarter_id')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Quantity(in unit) <span class="text-meta-1">*</span>
                    </label>
                    <input type="number" placeholder="Enter your Quantity" name="qty" min="0"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    @error('qty')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end ">
                <button class="flex w-100  rounded bg-primary p-3 font-medium text-gray">
                    Submit
                </button>
            </div>
        </form>
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
