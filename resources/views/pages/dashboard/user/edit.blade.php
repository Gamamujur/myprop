<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User &raquo; {{ $item->name }} &raquo; Edit
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                @if ($errors->any())
                    <div class="mb-5">
                        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                            There's something wrong !
                        </div>
                        <div class="border border-t-8 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                            <p>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </p>
                        </div>
                    </div>
                @endif

                    <form action="{{ route('dashboard.user.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Name</label>
                                <input type="text" value="{{ old('name') ?? $item->name }}" name="name" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 " placeholder="Username">
                            </div>

                            <div class="w-full px-3 mt-5">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Email</label>
                                <input type="email" value="{{ old('email') ?? $item->email }}" name="email" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 " placeholder="Email">
                            </div>

                            <div class="w-full px-3 mt-5">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Roles</label>
                                <select name="roles" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="{{ $item->roles }}">{{ $item->roles }}</option>
                                    <option disabled>--------------------------------</option>
                                    <option value="Admin">Admin</option>
                                    <option value="User">User</option>
                                </select>
                            </div>

                            

                            <div class="w-full px-3 mt-10">
                                <button type="submit" class="bg-green-400 hover:bg-green-700 px-2 py-2 rounded shadow-lg text-white font-bold">Save User</button>
                            </div>
                        </div>
                    
                    </form>

            </div>

        </div>
    </div>
</x-app-layout>
