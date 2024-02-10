<form action="?" method="GET">
    <div class="datatable-top">
        <div class="datatable-dropdown">
            <label>
                <select class="datatable-selector" name="rows" onchange="this.form.submit()">
                    <option value="25" {{ $_GET['rows']=='25' ? 'selected' : false }}>25
                    </option>
                    <option value="50" {{ $_GET['rows']=='50' ? 'selected' : false }}>50
                    </option>
                    <option value="100" {{ $_GET['rows']=='100' ? 'selected' : false }}>100
                    </option>
                    <option value="250" {{ $_GET['rows']=='250' ? 'selected' : false }}>250
                    </option>
                    <option value="500" {{ $_GET['rows']=='500' ? 'selected' : false }}>500
                    </option>
                    <option value="all" {{ $_GET['rows']=='all' ? 'selected' : false }}>All
                    </option>
                </select> entries per page
            </label>
        </div>
        <div class="datatable-search">
            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <input type="search" id="default-search" name="keyword" value="{{ $_GET['keyword'] ?? '' }}"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search Mockups, Logos...">
                <button type="submit"
                    class="text-white absolute end-2 bottom-auto top-[4px] bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </div>
    </div>
</form>