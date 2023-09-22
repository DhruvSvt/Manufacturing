@extends('admin.layouts.app', ['title' => 'Raw Material-Edit'])
@section('content')
    <!-- ===== Form Area Start ===== -->
    <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
        <div class="mb-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-center m-6">
            <h2 class="text-title-md2 font-bold text-black dark:text-white text-center">
                Edit Raw Material
            </h2>
        </div>
        <form action="{{ route('raw-material.update',['id' => $raw_material->id ]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="p-6.5">
                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">
                            Name <span class="text-meta-1">*</span>
                        </label>
                        <input type="text" placeholder="Enter your Name" name="name" value="{{ $raw_material->name }}"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        @error('name')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">
                            Price / Unit <span class="text-meta-1">*</span>
                        </label>
                        <input type="number" placeholder="Enter the Price" name="price"
                            value="{{ $raw_material->price }}"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        @error('price')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Unit <span class="text-meta-1">*</span>
                    </label>
                    <select
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                        name="unit">
                        <option value="{{ $raw_material->unit }}" selected>{{ $unit->short_name  ?? '-' }} </option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->full_name }} ({{ $unit->short_name }})</option>
                        @endforeach
                    </select>
                    @error('unit')
                        <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <button class="flex w-100 float-right rounded bg-primary p-3 font-medium text-gray m-5">
                Update
            </button>
        </form>
    </div>

    <!-- ===== Form Area End ===== -->
@endsection
