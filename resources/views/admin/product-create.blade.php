@extends('admin.layouts.app', ['title' => 'Add Product'])
@section('content')
<!-- ===== Form Area Start ===== -->
<div
    class=" max-w-screen-2xl p-4 md:p-6 2xl:p-10 my-10 md:mx-10 bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
    <div class="mb-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-center m-6">
        <h2 class="text-title-md2 font-bold text-black dark:text-white text-center">
            Add Product
        </h2>
    </div>
    <form action="{{ route('product.store') }}" method="POST" onsubmit="return setValue()">
        @csrf
        <input type="hidden" name="raw_materials" id="raw_materials_hidden" required>
        <div class="p-6.5">
            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Title <span class="text-meta-1">*</span>
                    </label>
                    <input type="text" placeholder="Product Title" name="name"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                        required />
                </div>

                <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Price <span class="text-meta-1">*</span>
                    </label>
                    <input type="text" min="0" placeholder="₹100" name="price"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                        required />
                </div>
            </div>

            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                <div class="w-full xl:w-1/2 relative">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Product Unit <span class="text-meta-1">*</span>
                    </label>
                    <select
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                        name="unit">
                        <option value="0" selected>-- None --</option>
                        @foreach ($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->full_name }} ({{ $unit->short_name }})
                        </option>
                        @endforeach
                    </select>
                    <span class="absolute p-1 right-0 top-1/2 z-99">
                        <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.8">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z"
                                    fill="">
                                </path>
                            </g>
                        </svg>
                    </span>
                    @error('unit')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="w-full xl:w-1/2 relative">
                    <label class="mb-2.5 block text-black dark:text-white">
                        Type <span class="text-meta-1">*</span>
                    </label>
                    <select
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                        name="type">
                        <option value="0" selected>-- None --</option>
                        <option value="Feed" >Feed</option>
                        <option value="Taxable">Taxable</option>
                    </select>
                    <span class="absolute p-1 right-0 top-1/2 z-99">
                        <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.8">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z"
                                    fill="">
                                </path>
                            </g>
                        </svg>
                    </span>
                    @error('type')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="my-16" id="raw_materials">
                <div class="w-full flex flex-col xl:flex-row">
                    <label class="mb-6 flex items-center text-3xl text-center text-black dark:text-white mx-auto">Add
                        Raw Materials</label>
                    <button type="button" style="background:rgb(60 80 224 / var(--tw-bg-opacity)) !important;"
                        class="add_raw_material flex float-right rounded-full bg-primary p-3 font-medium text-gray m-8">+</button>
                </div>
                <div class="raw_material_div flex flex-col gap-6 xl:flex-row my-4">
                    <div class="w-full xl:w-8/12">
                        <label class="mb-2.5 block text-black dark:text-white">Raw Material Product
                            <span class="text-meta-1">*</span></label>
                        <select
                            class="select_material relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                            name="materials">
                            <option value="" selected>Choose Material</option>
                            @foreach ($raw_materials as $raw_material)
                            <option value="{{ $raw_material->id }}">{{ $raw_material->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full xl:w-3/12">
                        <label class="mb-2.5 block text-black dark:text-white">Quantity <span
                                class="text-meta-1">*</span></label>
                        <input type="number" placeholder="1" min="0" name="qty"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                    <div class="w-full xl:w-1/12">
                        <button type="button" onclick="remove(this)"
                            style="background:rgb(251 84 84 / var(--tw-bg-opacity));"
                            class="remove_raw_material flex float-right rounded-full bg-primary p-3 font-medium text-gray m-8">X</button>
                    </div>

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

@section('scripts')
<script>
    let selected_raw_materials = [];
        let raw_materials = [];

        $('#raw_materials').on('change', '.select_material', function() {
            getRawMaterials(false);
        })

        function getRawMaterials(isSet) {
            selected_raw_materials = [];

            //getting the selected raw materials
            $('.select_material').each(function(i, obj, array) {
                if (obj.value !== '') {
                    selected_raw_materials.push(obj.value);
                }
            });

            //Fetching raw-material
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('product.raw-materials') }}",
                data: {
                    '_token': '{{ csrf_token() }}', // Add the CSRF token
                    'selected_raw_materials': selected_raw_materials,
                },
                success: function(data) {
                    raw_materials = data;
                    if (isSet) {
                        setRawMaterial();
                    }
                }
            });
        }

        $('.add_raw_material').on('click', (e) => {
            selected_raw_materials = [];
            getRawMaterials(true);

        })

        function setRawMaterial() {
            let content = `<div class="raw_material_div flex flex-col gap-6 xl:flex-row my-4">
                            <div class="w-full xl:w-8/12">
                                <label class="mb-2.5 block text-black dark:text-white">
                                    Raw Material Product <span class="text-meta-1">*</span>
                                </label>
                                <select class="select_material relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"name="role">
                                    <option value="" selected disabled>Choose Material</option>`;
            raw_materials.forEach(raw_material => {
                content += `<option value="${raw_material.id }">${ raw_material.name }</option>`;
            });

            content += `
                                </select>
                            </div>
                            <div class="w-full xl:w-3/12">
                                <label class="mb-2.5 block text-black dark:text-white">
                                    Quantity <span class="text-meta-1">*</span>
                                </label>
                                <input type="number" placeholder="1" name="qty"class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                            </div>
                            <div class="w-full xl:w-1/12">
                                <button type="button" onclick="remove(this)" style="background:rgb(251 84 84 / var(--tw-bg-opacity));"
                                    class="remove_raw_material flex float-right rounded-full bg-primary p-3 font-medium text-gray m-8">X</button>
                            </div>
                        </div>
                        `;

            $('#raw_materials').append(content);
        }

        function remove(e) {
            selected_raw_materials = [];
            e.parentNode.parentNode.remove();
            // e.parentNode.parentNode.style.display = 'none';
            // e.parents().eq(1).css({
            //     "display": "none",
            // });
            getRawMaterials(false);
        }

        function setValue() {
            let materials = [];
            let id;
            let qty;

            $('.raw_material_div').each(function(i, obj) {
                id = $(this).find('select').val();
                qty = $(this).find('input').val();

                if (id && qty) {
                    materials.push({
                        "id": id,
                        "qty": qty
                    });
                }
            });

            // if (materials && materials.length <= 0) {
            //     return false;
            // }
            $('#raw_materials_hidden').val(JSON.stringify(materials));

            return true;
        }
</script>
@endsection
