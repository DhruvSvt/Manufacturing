@extends('admin.layouts.app', ['title' => 'Create Sale Invoice'])
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
                    Sale Invoice
                </h2>
            </div>
            <form action="{{ route('sale.store') }}" method="POST">
                @csrf
                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                    <div class="w-full xl:w-1/2">

                        <label class="block text-black dark:text-white">
                            Party Name<span class="text-meta-1">*</span>
                        </label>

                        <select
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border   -primary"
                            name="supplier_id">
                            <option value="">Choose Party name</option>
                            @foreach ($party as $party)
                                <option value="{{ $party->id }}">{{ $party->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">
                            Place <span class="text-meta-1">*</span>
                        </label>
                        <input type="text" placeholder="Enter the Place" name="place"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        @error('place')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">

                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">
                            Type<span class="text-meta-1">*</span>
                        </label>

                        <select
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border   -primary"
                            name="type">
                            <option value="">Choose Type</option>
                            <option value="Distributor">Distributor / C & F</option>
                            <option value="Stockiest">Stockiest</option>
                            <option value="Other">Other</option>
                        </select>
                        @error('type')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">
                            Due Date <span class="text-meta-1">*</span>
                        </label>
                        <input type="date" name="due_date" min="1"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        @error('due_date')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>



                </div>
                <div class="mt-4.5">
                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                      <div class="w-full xl:w-1/2">
                        <h5>Product Details</h5>
                    </div>

                    </div>

                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">
                            Product Name <span class="text-meta-1">*</span>
                        </label>
                        <select
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                            name="product_id[]">
                            <option value="" selected>Choose Product name</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}
                                 ({{ $product->tquantity.$product->short_name }})</option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">
                            Quantity <span class="text-meta-1">*</span>
                        </label>
                        <input type="number" placeholder="Enter the Quantity" name="qty[]" min="1"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        @error('qty')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">
                            Rate <span class="text-meta-1">*</span>
                        </label>
                        <input type="number" placeholder="Enter the Rate" name="rate[]" min="1"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        @error('rate')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full xl:w-1/2">
                          <button type="button" id="addcustom_area" class="flex w-100  rounded bg-info p-0 font-small py-1.5 px-4 text-gray">
                        Add More
                    </button>
                    </div>
                    </div>
                    <div id="custom_area_container"></div>
                </div>


                <div class="flex justify-start ">
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
    <!-- ===== Main Content End ===== -->
@endsection
@section('scripts')
<script>
     var k=1;
      $('#addcustom_area').click(function(){


 		$('#custom_area_container').append(`<div class="mb-4.5 flex flex-col gap-6 xl:flex-row customarea`+k+`">
                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">
                            Product Name <span class="text-meta-1">*</span>
                        </label>
                        <select
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                            name="product_id[]">
                            <option value="" selected>Choose Product name</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}
                                 ({{ $product->tquantity.$product->short_name }})</option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">
                            Quantity <span class="text-meta-1">*</span>
                        </label>
                        <input type="number" placeholder="Enter the Quantity" name="qty[]" min="1"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        @error('qty')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">
                            Rate <span class="text-meta-1">*</span>
                        </label>
                        <input type="number" placeholder="Enter the Rate" name="rate[]" min="1"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        @error('rate')
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
