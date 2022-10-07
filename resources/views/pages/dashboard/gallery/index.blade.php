<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Product &raquo; {{ $product->name }} &raquo; Gallery
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
                    {data: 'url', name: 'url'},
                    {data: 'is_featured', name: 'is_featured'},
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
                <a href="{{ route('dashboard.product.gallery.create', $product->id) }}" class="bg-green-400 hover:bg-green-700 px-2 py-2 rounded shadow-lg text-white font-bold">
                    + Upload Photos
                </a>
            </div>

            <div class="overflow-hidden sm-rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="crudtable" class="border-2">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Photos</th>
                                <th>Featured</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            

                        </tbody>

                    </table>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
