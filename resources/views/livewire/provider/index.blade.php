<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
                            <label for="table-search" class="sr-only">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                </div>
                                <input wire:model.live='search' type="text" name="search" id="search" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar...">
                            </div>
                        </div>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            Nombre
                                            <a href="#" wire:click.prevent="sortBy('name')"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                              </svg></a>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            Correo
                                            <a href="#" wire:click.prevent="sortBy('email')"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                              </svg></a>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        @can('provider:create')
                                            <x-button-href href="{{ route('providers.create') }}">
                                                Crear
                                            </x-button-href>
                                        @endcan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($providers as $provider)
                                    @if ($loop->last)
                                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="px-6 py-4">
                                                {{ $provider->name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $provider->email }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="{{ route('providers.show',$provider) }}" wire:navigate class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Ver</a>
                                                @can('provider:edit')
                                                    <a href="{{ route('providers.edit',$provider) }}" wire:navigate class="ml-1     font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                                                @endcan
                                                @can('provider:delete')
                                                    <a href="" wire:confirm='Seguro que desea eliminar este proveedor?.' wire:click.live='delete("{{ $provider->id }}")' wire:loading.attr='disabled' class="ml-1 font-medium text-blue-600 dark:text-blue-500 hover:underline">Eliminar</a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @else
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="px-6 py-4">
                                                {{ $provider->name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $provider->email }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="{{ route('providers.show',$provider) }}" wire:navigate class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Ver</a>
                                                @can('provider:edit')
                                                    <a href="{{ route('providers.edit',$provider) }}" wire:navigate class="ml-1 font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                                                @endcan
                                                @can('provider:delete')
                                                    <a href="" wire:confirm='Seguro que desea eliminar este proveedor?.' wire:click.live='delete("{{ $provider->id }}")' wire:loading.attr='disabled' class="ml-1 font-medium text-blue-600 dark:text-blue-500 hover:underline">Eliminar</a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td class="px-6 py-4 text-center text-xl" colspan="3">
                                            No hay proveedores registrados.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="m-4 text-white dark:text-white">
                            {{ $providers->links('vendor.livewire.tailwind-pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
