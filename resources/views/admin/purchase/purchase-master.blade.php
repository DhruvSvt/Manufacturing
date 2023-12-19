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
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border   -primary"
                        name="modal_id">
                        <option value="">Choose {{ $label }} name</option>
                        @if ($label == 'Product')
                        @foreach ($masters as $m)
                        <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->unit->short_name ?? '' }})</option>
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
            </div>
            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
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
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Quantity(in unit) <span class="text-meta-1">*</span>
                    </label>
                    <input type="number" placeholder="Enter your Quantity" name="quantity" min="0"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    @error('quantity')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Price <span class="text-meta-1">*</span>
                    </label>
                    <input type="number" placeholder="Enter the Price" name="price" min="0"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    @error('price')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Expiry Date <span class="text-meta-1">*</span>
                    </label>
                    <input type="date" name="expiry_date"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    @error('expiry_date')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Batch No 
                    </label>
                    <input type="text" placeholder="Enter the Batch No." name="batch_no"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    @error('batch_no')
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
            <div class="flex justify-end ">
                <button class="flex w-100  rounded bg-primary p-3 font-medium text-gray">
                    Submit
                </button>
            </div>
        </form>

        <!-- Main modal -->
        {{-- <div id="authentication-modal" tabindex="-1" aria-hidden="true"
            class="fixed top-50 left-50 right-50 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="authentication-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="px-6 py-6 lg:px-8">
                        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Sign in to our platform</h3>
                        <form class="space-y-6" action="#">
                            <div>
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                    email</label>
                                <input type="email" name="email" id="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="name@company.com" required>
                            </div>
                            <div>
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                    password</label>
                                <input type="password" name="password" id="password" placeholder="••••••••"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    required>
                            </div>
                            <div class="flex justify-between">
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="remember" type="checkbox" value=""
                                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                                            required>
                                    </div>
                                    <label for="remember"
                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember
                                        me</label>
                                </div>
                                <a href="#" class="text-sm text-blue-700 hover:underline dark:text-blue-500">Lost
                                    Password?</a>
                            </div>
                            <button type="submit"
                                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login
                                to your account</button>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                                Not registered? <a href="#"
                                    class="text-blue-700 hover:underline dark:text-blue-500">Create
                                    account</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                    const modalToggleButtons = document.querySelectorAll('[data-modal-toggle]');
                    const modal = document.getElementById('authentication-modal');

                    modalToggleButtons.forEach(button => {
                        button.addEventListener('click', () => {
                            modal.classList.toggle('hidden');
                        });
                    });
                });
        </script> --}}
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
