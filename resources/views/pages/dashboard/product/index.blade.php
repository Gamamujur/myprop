<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    <x-slot name="script">
        <script>
            var datatable = $('#crudtable').DataTable({
                ajax : {
                    url: '{!! url()->current() !!}'
                },

                columns: [
                    {data: 'id', name: 'id', width: '5%'},
                    {data: 'name', name: 'name'},
                    {data: 'price', name: 'price'},
                    {
                        data:'action',
                        name:'action',
                        orderable:false,
                        searchable:false,
                        width:'25%'
                    }
                ]

            })
        </script>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-10">
                <a href="{{ route('dashboard.product.create') }}" class="bg-green-400 hover:bg-green-700 px-2 py-2 rounded shadow-lg text-white font-bold">
                    + Create Product
                </a>
            </div>

            <div class="overflow-hidden sm-rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="crudtable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>

                    </table>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
