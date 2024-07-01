<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                        <form wire:submit='checkout'>
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                Nombre
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Precio
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Cantidad
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Total
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($cart['articles'] as $article)
                                            @if ($loop->last)
                                                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                    <td class="px-6 py-4">
                                                        {{ $article['article']->name }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $article['article']->price }} Bs.
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $article['quantity'] }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $article['total_price'] }} Bs.
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <div class="inline-flex rounded-md shadow-sm" role="group">
                                                            <button
                                                                wire:click="addOneToCart('{{ $article['article']->id }}')"
                                                                type="button"
                                                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-green-600 border border-green-200 rounded-s-lg hover:bg-green-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-green-600 dark:border-green-700 dark:text-white dark:hover:text-white dark:hover:bg-green-700 dark:focus:ring-green-500 dark:focus:text-white"
                                                                {{ ($articles->get($article['article']->id)->available==0) ? 'disabled' : '' }}
                                                                >
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                                                    <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                                                </svg>
                                                            </button>
                                                            <button wire:click="removeAllFromCart('{{ $article['article']->id }}')" type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-yellow-300 border-t border-b border-yellow-200 hover:bg-yellow-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-yellow-400 dark:border-yellow-700 dark:text-white dark:hover:text-white dark:hover:bg-yellow-700 dark:focus:ring-yellow-300 dark:focus:text-white">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                                                    <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                                                                </svg>
                                                            </button>
                                                            <button wire:click="removeOneFromCart('{{ $article['article']->id }}')" type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-red-600 border border-red-200 rounded-e-lg hover:bg-red-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-red-600 dark:border-red-700 dark:text-white dark:hover:text-white dark:hover:bg-red-700 dark:focus:ring-red-500 dark:focus:text-white">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                                                    <path fill-rule="evenodd" d="M4.25 12a.75.75 0 0 1 .75-.75h14a.75.75 0 0 1 0 1.5H5a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @else
                                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                    <td class="px-6 py-4">
                                                        {{ $article['article']->name }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $article['article']->price }} Bs.
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $article['quantity'] }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $article['total_price'] }} Bs.
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <div class="inline-flex rounded-md shadow-sm" role="group">
                                                            <button wire:click="addOneToCart('{{ $article['article']->id }}')" type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-green-600 border border-green-200 rounded-s-lg hover:bg-green-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-green-600 dark:border-green-700 dark:text-white dark:hover:text-white dark:hover:bg-green-700 dark:focus:ring-green-500 dark:focus:text-white" >
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                                                    <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                                                </svg>
                                                            </button>
                                                            <button
                                                                wire:click="removeAllFromCart('{{ $article['article']->id }}')"
                                                                type="button"
                                                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-yellow-300 border-t border-b border-yellow-200 hover:bg-yellow-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-yellow-400 dark:border-yellow-700 dark:text-white dark:hover:text-white dark:hover:bg-yellow-700 dark:focus:ring-yellow-300 dark:focus:text-white"
                                                                >
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                                                    <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                                                                </svg>
                                                            </button>
                                                            <button wire:click="removeOneFromCart('{{ $article['article']->id }}')" type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-red-600 border border-red-200 rounded-e-lg hover:bg-red-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-red-600 dark:border-red-700 dark:text-white dark:hover:text-white dark:hover:bg-red-700 dark:focus:ring-red-500 dark:focus:text-white">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                                                    <path fill-rule="evenodd" d="M4.25 12a.75.75 0 0 1 .75-.75h14a.75.75 0 0 1 0 1.5H5a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @empty
                                            <tr>
                                                <td class="px-6 py-4 text-center text-xl" colspan="5">
                                                    Su carrito esta vacio.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot class="bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <td class="px-6 py-4 text-right text-xl" colspan="4">
                                                Total =
                                            </td>
                                            <td class="px-6 py-4 text-left text-xl" colspan="1">
                                                {{ $total_price }} Bs.
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="text-right w-full p-3">
                                @if (count($cart['articles'])!=0)
                                    <x-button wire:click="emptyCart()" wire:confirm='Esta seguro que desea vaciar el carrito?'>
                                        Vaciar Carrito
                                    </x-button>
                                    <x-button>
                                        Procesar Compra
                                    </x-button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
