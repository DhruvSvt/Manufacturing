@extends('admin.layouts.app', ['title' => 'Purchase ' . $label])
@section('content')
    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <div class="mb-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-center">
                <h2 class="text-title-md2 font-bold text-black dark:text-white text-center">
                    Purchase {{ $label }}
                </h2>
            </div>
            <form action="{{ $route }}" method="POST">
                @csrf
                <div class="p-6.5">
                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                        <div class="w-full xl:w-1/2">
                            <label class="mb-2.5 block text-black dark:text-white">
                                {{ $label }} Name <span class="text-meta-1">*</span>
                            </label>
                            <select
                                class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                name="modal_id">
                                <option value="">Choose {{ $label }} name</option>
                                @foreach ($masters as $m)
                                    <option value="{{ $m->id }}">{{ $m->name }}</option>
                                @endforeach
                            </select>
                            @error('modal_id')
                                <p class="text-red-500 mt-2">{{ $message }}</p>
                            @enderror
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

                </div>
                <div class="p-6.5">
                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
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
                    </div>
                </div>

                <div class="p-6.5">
                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
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
                </div>
                <button class="flex w-100 float-right rounded bg-primary p-3 font-medium text-gray m-5">
                    Submit
                </button>
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
