@extends('admin.layouts.app', ['title' => 'Purchase ' . $label])
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

    #authentication-modal {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1000;
        /* Adjust the z-index as needed */
        background-color: white;
        /* Add background color as needed */
        padding: 20px;
        /* Add padding as needed */
        /* Add other styles as needed */
    }
</style>
<!-- ===== Main Content Start ===== -->
<main>
    <div
        class=" max-w-screen-2xl p-4 md:p-6 2xl:p-10 my-10 md:mx-10 bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
        <!-- Breadcrumb Start -->
        <div class="mb-20 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-center">
            <h2 class="lg:text-4xl md:text-3xl text-3xl font-bold text-black dark:text-white text-center">
                Purchase {{ $label }}
            </h2>
        </div>
        <form action="{{ $route }}" method="POST">
            @csrf
            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">

                <div class="w-full xl:w-1/2">
                    <div class="flex justify-between items-center mb-2.5">
                        <label class="mb-2.5  text-black dark:text-white">
                            Brand Name
                        </label>
                        <!-- Add Brand Model Start -->

                        {{-- <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                            class="rounded-md bg-primary float-right py-2 px-3 font-medium text-white text-sm"
                            type="button">
                            Add Brand
                        </button> --}}
                    </div>
                    <select
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                        name="brand">
                        <option value="">Choose Brand name</option>
                        @foreach ($brand as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Supplier Name <span class="text-meta-1">*</span>
                    </label>
                    <select
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                        name="supplier_id">
                        <option value="">Choose suppiler name</option>
                        @foreach ($suppilers as $suppiler)
                        <option value="{{ $suppiler->id }}">{{ $suppiler->name }}</option>
                        @endforeach
                    </select>
                    @error('supplier_id')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>


            @if ($label == 'Raw Material' || $label == 'Product')
            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Bill No <span class="text-meta-1">*</span>
                    </label>
                    <input type="text" placeholder="Enter the Bill No" name="bill_no"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    @error('bill_no')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Bill Date <span class="text-meta-1">*</span>
                    </label>
                    <input type="date" name="bill_date"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    @error('bill_date')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            @endif
            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Actual Quantity(in unit) <span class="text-meta-1">*</span>
                    </label>
                    <input type="number" placeholder="Enter your Quantity" name="quantity" min="0"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    @error('quantity')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Bill Quantity(in unit) <span class="text-meta-1">*</span>
                    </label>
                    <input type="number" placeholder="Enter your Quantity" name="bill_qty" min="0"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    @error('bill_qty')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

            </div>
            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Price <span class="text-meta-1">*</span>
                    </label>
                    <input type="text" placeholder="Enter the Price" name="price" min="0"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    @error('price')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Remark
                    </label>
                    <textarea name="remark" rows="4" cols="50"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"></textarea>
                    @error('remark')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-4">
                <h3 class="text-xl font-semibold">{{ $label }} Details </h3>
            </div>
            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                <div class="w-full xl:w-1/2">
                    <div class="flex justify-between items-center mb-2.5">
                        <label class="block text-black dark:text-white">
                            {{ $label }} Name <span class="text-meta-1">*</span>
                        </label>

                        @if ($label == 'Raw Material')
                        <a href="{{ route('raw-material.create') }}">
                            <button type="button"
                                class="rounded-md bg-primary py-2 px-3 font-medium text-white text-sm">
                                Add
                            </button>
                        </a>
                        @elseif($label == 'Item')
                        <button type="button" class="rounded-md bg-primary py-2 px-3 font-medium text-white text-sm">
                            <a href="{{ route('gift.create') }}">
                                Add
                            </a>
                        </button>
                        @elseif($label == 'Product')
                        <button type="button" class="rounded-md bg-primary py-2 px-3 font-medium text-white text-sm">
                            <a href="{{ route('product.create') }}">
                                Add
                            </a>
                        </button>
                        @endif

                    </div>
                    <select
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                        name="modal_id[]">
                        <option value="">Choose {{ $label }} name</option>
                        @if ($label == 'Product')
                        @foreach ($masters as $m)
                        <option value="{{ $m->id }}">{{ $m->name }}
                            ({{ $m->unit->short_name ?? '' }})</option>
                        @endforeach
                        @else
                        @foreach ($masters as $m)
                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                        @endforeach
                        @endif

                    </select>
                    @error('modal_id')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Batch No
                    </label>
                    <input type="text" placeholder="Enter the Batch No." name="batch_no[]"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    @error('batch_no')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Expiry Date
                    </label>
                    <input type="date" name="expiry_date[]"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    @error('expiry_date')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full xl:w-1/2 mt-6">
                    <button type="button" id="addcustom_area"
                        class="flex w-100  rounded bg-info p-0 font-small py-1.5 px-4 text-gray">
                        Add More
                    </button>
                </div>
            </div>

            <div id="custom_area_container"></div>
            <div class="flex justify-end ">
                <button class="flex w-100  rounded bg-primary p-3 font-medium text-gray">
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
    </div>
</main>
<!-- ===== Main Content End ===== -->
@endsection
@section('scripts')
<script>
    var k=1;
      $('#addcustom_area').click(function(){


 		$('#custom_area_container').append(`<div class="mb-4.5 flex flex-col gap-6 xl:flex-row customarea`+k+`">
                   <div class="w-full xl:w-1/2">
                        <div class="flex justify-between items-center">
                            <label class="block text-black dark:text-white">
                                {{ $label }} Name <span class="text-meta-1">*</span>
                            </label>
                        </div>
                        <select
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                            name="modal_id[]">
                            <option value="">Choose {{ $label }} name</option>
                            @if ($label == 'Product')
                            @foreach ($masters as $m)
                            <option value="{{ $m->id }}">{{ $m->name }}
                                ({{ $m->unit->short_name ?? '' }})</option>
                            @endforeach
                            @else
                            @foreach ($masters as $m)
                            <option value="{{ $m->id }}">{{ $m->name }}</option>
                            @endforeach
                            @endif

                        </select>
                        @error('modal_id')
                        <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">
                            Batch No
                        </label>
                        <input type="text" placeholder="Enter the Batch No." name="batch_no[]"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        @error('batch_no')
                        <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">
                            Expiry Date
                        </label>
                        <input type="date" name="expiry_date[]"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        @error('expiry_date')
                        <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full xl:w-1/2">
                        <button type="button" id="`+k+`" class="btn btn-secondary btn_remove_area rounded bg-danger p-0 font-small py-1.5 px-4 text-white"> X </button>
                    </div>
                    </div>`);
		k++;



  });
    $(document).on('click', '.btn_remove_area', function(){

           var button_id = $(this).attr("id");
           $('.customarea'+button_id+'').remove();
           });


</script>
@endsection
