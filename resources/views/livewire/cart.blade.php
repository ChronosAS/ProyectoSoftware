<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
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
                                                    <a wire:click="addOneToCart('{{ $article['article']->id }}')" class="text-white font-bold p-3 rounded text-xs dark:bg-green-600 bg-green-600 hover:bg-green-500 cursor-pointer">Agregar</a>
                                                    <a wire:click="removeFromCart('{{ $article['article']->id }}')" class="text-white font-bold p-3 rounded text-xs dark:bg-red-600 bg-red-600 hover:bg-red-500 cursor-pointer">remover</a>
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
                                                    <a wire:click="addOneToCart('{{ $article['article']->id }}')" class="text-white font-bold p-3 rounded text-xs dark:bg-green-600 bg-green-600 hover:bg-green-500 cursor-pointer">Agregar</a>
                                                    <a wire:click="removeFromCart('{{ $article['article']->id }}')" class="text-white font-bold p-3 rounded text-xs dark:bg-red-600 bg-red-600 hover:bg-red-500 cursor-pointer">remover</a>
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
                            <x-button wire:click="checkout()">
                                Procesar Compra.
                            </x-button>
                            <x-button wire:click="emptyCart()" wire:confirm='Esta seguro que desea vaciar el carrito?'>
                                Vaciar Carrito.
                            </x-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
