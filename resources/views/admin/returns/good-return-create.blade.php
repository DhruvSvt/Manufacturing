@extends('admin.layouts.app', ['title' => 'Create Return Good'])
@section('content')
<style>
    [type="button"],
    [type="reset"],
    [type="submit"],
    button {
        -webkit-appearance: button;
        background-color: #3c50e0;
        background-image: none;
    }
</style>
<!-- ===== Main Content Start ===== -->
<main>
    <div
        class=" max-w-screen-2xl p-4 md:p-6 2xl:p-10 my-10 md:mx-10 bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
        <!-- Breadcrumb Start -->
        <div class="mb-10 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-center">
            <h2 class="lg:text-4xl md:text-3xl text-3xl font-bold text-black dark:text-white text-center">
                Create Return Good
            </h2>
        </div>
        <form action="{{ route('good-return-store') }}" method="POST" onsubmit="return beforeSubmit()">
            @csrf
            <input type="hidden" name="products" id="products_hidden" required>
            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Party Name <span class="text-meta-1">*</span>
                    </label>
                    <select
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                        name="supplier_id">
                        <option value="">Enter Party Name</option>
                        @foreach ($suppilers as $suppiler)
                        <option value="{{ $suppiler->id }}">{{ $suppiler->name }}</option>
                        @endforeach
                    </select>
                    @error('supplier_id')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Builty No. <span class="text-meta-1">*</span>
                    </label>
                    <input type="text" placeholder="Enter the Builty No." name="builty"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    @error('builty')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Transport Name <span class="text-meta-1">*</span>
                    </label>
                    <input type="text" placeholder="Enter the Transport Name" name="transport"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    @error('transport')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Date of Dispatch <span class="text-meta-1">*</span>
                    </label>
                    <input type="date" name="dispatch"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    @error('dispatch')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Date of Reciept <span class="text-meta-1">*</span>
                    </label>
                    <input type="date" name="date_of_receipt"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    @error('date_of_receipt')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Receipt Challan <span class="text-meta-1">*</span>
                    </label>
                    <input type="text" placeholder="Enter the Receipt challan" name="receipt"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    @error('receipt')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="w-full flex mt-10 mb-8 flex-wrap">
                <label class="mb-6 flex items-center text-3xl text-center text-black dark:text-white mx-auto">Add
                    Products</label>
                <button type="button" style="background:rgb(60 80 224 / var(--tw-bg-opacity)) !important;"
                    class="add_product inline-block w-10 h-10 text-3xl items-center justify-center rounded-full bg-primary font-medium text-gray">+</button>
            </div>
            <div class="products_div">
                <div
                    class="product_div my-6 grid gap-4 grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 relative">
                    <div>
                        <div class="flex justify-between items-center mb-2.5">
                            <label class="block text-black dark:text-white">
                                Product Name <span class="text-meta-1">*</span>
                            </label>
                        </div>
                        <select
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-2 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                            name="product_id">
                            <option value="">Choose Product</option>
                            @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->unit->short_name ?? ''
                                }})
                            </option>
                            @endforeach
                        </select>
                        @error('product_id')
                        <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-2.5 block text-black dark:text-white">
                            Quantity <span class="text-meta-1">*</span>
                        </label>
                        <input type="number" placeholder="1" name="quantity" min="0"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        @error('quantity')
                        <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-2.5 block text-black dark:text-white">
                            Rate <span class="text-meta-1">*</span>
                        </label>
                        <input type="number" placeholder="1000" name="rate" min="0"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        @error('rate')
                        <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-2.5 block text-black dark:text-white">
                            Batch No. <span class="text-meta-1">*</span>
                        </label>
                        <input type="number" placeholder="001" name="batch"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        @error('batch')
                        <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-2.5">
                            <label class="block text-black dark:text-white">
                                Reson of Return <span class="text-meta-1">*</span>
                            </label>
                        </div>
                        <select
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                            name="type">
                            <option value="0">Choose Reason</option>
                            <option value="Expiry">Expiry</option>
                            <option value="Brakage">Brakage</option>
                            <option value="Non Saleable">Non Saleable</option>
                            <option value="Near Expiry">Near Expiry</option>
                        </select>
                        @error('type')
                        <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="absolute -top-2 -right-4">
                        <button type="button" onclick="remove(this)"
                            style="background:rgb(251 84 84 / var(--tw-bg-opacity));"
                            class="bg-primary flex h-6 items-center justify-center p-0 remove_raw_material rounded-full text-gray text-xl w-6">&times;</button>
                    </div>
                </div>
            </div>
            <div class="flex justify-end ">
                <button class="flex w-100  rounded bg-primary p-3 font-medium text-gray">
                    Submit
                </button>
            </div>
        </form>
        @if (Session::has('error'))
        <script>
            swal("Error", "{{ Session::get('error') }}", 'error', {
                        buttons: {
                            confirm: "OK",
                        },
                    });
        </script>
        @endif
    </div>
</main>

<!-- ************************ Disable Privious Date Script ************************ -->

{{-- <script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("expiry_date")[0].setAttribute('min', today);
</script> --}}
@endsection

@section('scripts')
<script>
    const productsArr = JSON.parse(`<?php echo json_encode($products) ?>`);
    let products = []
    let productOptions = productsArr.map(function (product) {
        return `<option value="${product.id}">${product.name} (${product.unit ? product.unit.short_name : ''})</option>`;
    });

    let content =
    `
        <div class="product_div my-6 grid gap-4 grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 relative">
            <div>
                <div class="flex justify-between items-center mb-2.5">
                    <label class="block text-black dark:text-white">
                        Product Name <span class="text-meta-1">*</span>
                    </label>
                </div>
                <select
                    class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-2 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                    name="product_id">
                    <option value="">Choose Product</option>
                    ${productOptions}
                </select>
            </div>
            <div>
                <label class="mb-2.5 block text-black dark:text-white">
                    Quantity <span class="text-meta-1">*</span>
                </label>
                <input type="number" placeholder="1" name="quantity" min="0"
                    class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
            </div>
            <div>
                <label class="mb-2.5 block text-black dark:text-white">
                    Rate <span class="text-meta-1">*</span>
                </label>
                <input type="number" placeholder="1000" name="rate" min="0"
                    class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
            </div>
            <div>
                <label class="mb-2.5 block text-black dark:text-white">
                    Batch No. <span class="text-meta-1">*</span>
                </label>
                <input type="number" placeholder="001" name="batch"
                    class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
            </div>
            <div>
                <div class="flex justify-between items-center mb-2.5">
                    <label class="block text-black dark:text-white">
                        Reson of Return <span class="text-meta-1">*</span>
                    </label>
                </div>
                <select
                    class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                    name="type">
                    <option value="0">Choose Reason</option>
                    <option value="Expiry">Expiry</option>
                    <option value="Brakage">Brakage</option>
                    <option value="Non Saleable">Non Saleable</option>
                    <option value="Near Expiry">Near Expiry</option>
                </select>
            </div>
            <div class="absolute -top-2 -right-4">
                <button type="button" onclick="remove(this)"
                    style="background:rgb(251 84 84 / var(--tw-bg-opacity));"
                    class="bg-primary flex h-6 items-center justify-center p-0 remove_raw_material rounded-full text-gray text-xl w-6">&times;</button>
            </div>
        </div>
    `;

    $('.add_product').on('click', (e) => {
        $('.products_div').append(content);
    })
    function remove(e) {
        e.parentNode.parentNode.remove();
    }
    function beforeSubmit() {
        let formData = [];
        let product_id, qty, rate, batch_no, reason;

        $('.product_div').each(function(i, elem) {
            let obj = {};
            $(this).find('input, select')
            .each(function(i, el) {
                obj[el.name] = el.value;
            });
            formData.push(obj);
        });

        console.log(formData);

        if (formData && formData.length <= 0) {
            return false;
        }
        $('#products_hidden').val(JSON.stringify(formData));

        return true;
    }
</script>
@endsection
