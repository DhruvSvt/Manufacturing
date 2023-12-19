@extends('admin.layouts.app', ['title' => 'Supplier-Edit'])
@section('content')
<!-- ===== Form Area Start ===== -->
<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
    <div class="mb-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-center m-6">
        <h2 class="text-title-md2 font-bold text-black dark:text-white text-center">
            Edit Supplier
        </h2>
    </div>
    <form action="{{ route('supplier.update',$supplier->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="p-6.5">
            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Name <span class="text-meta-1">*</span>
                    </label>
                    <input type="text" placeholder="Enter your Name" name="name" value="{{ $supplier->name }}"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    @error('name')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Phone no. <span class="text-meta-1">*</span>
                    </label>
                    <input type="tel" placeholder="Enter your Username" name="phone" value="{{ $supplier->phone }}"
                        max="10"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    @error('phone')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">
                    Company name <span class="text-meta-1">*</span>
                </label>
                <input type="text" placeholder="Enter your email address" name="company_name"
                    value="{{ $supplier->company_name }}"
                    class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                @error('company_name')
                <p class="text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">
                    Address <span class="text-meta-1">*</span>
                </label>
                <input type="text" placeholder="Set password" name="address" value="{{ $supplier->address }}"
                    class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                @error('address')
                <p class="text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Type <span class="text-meta-1">*</span>
                    </label>
                    <select name="type" placeholder="Choose The Type" name="name"
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                        <option value="{{ $supplier->type }}">{{ $supplier->type }}</option>
                        <option value="Debtors">Debtors</option>
                        <option value="Creditors">Creditors</option>
                    </select>
                    @error('type')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <button class="flex w-100 float-right rounded bg-primary p-3 font-medium text-gray m-5">
            Submit
        </button>
    </form>
</div>

<!-- ===== Form Area End ===== -->
@endsection
