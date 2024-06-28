<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                    <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                            </div>
                            <input wire:model.live='search' type="text" name="search" id="search" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar...">
                        </div>
                        <div wire:ignore>
                            <button id="dropdownDefault" data-dropdown-toggle="categoriesDropdown"
                              class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm p-2 text-center inline-flex items-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800"
                              type="button">
                              Filtrar por Categoria
                              <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                              </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div id="categoriesDropdown" class="z-10 hidden w-56 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                                <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">
                                    Categorias
                                </h6>
                                <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                                    @foreach ($all_categories as $key => $category)
                                        <li class="flex items-center">
                                            <input wire:model.live='category' type="checkbox" value="{{ $category->id }}"
                                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />

                                            <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $category->name }}
                                            </label>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- https://lightit.io/blog/laravel-livewire-shopping-cart-demo/ --}}
                    <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                        @forelse ($articles as $index => $article)
                            <div class="group relative rounded-md p-3" style="background: rgb(17,24,39)">
                                @if($article->getFirstMedia('article-image'))
                                    <div class="aspect-h-1 aspect-w-1 w-full bg-gray overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                                        <img src="{{ ($article->getFirstMedia('article-image')->getUrl('thumb')) }}" alt="{{ $article->name.'-img' }}" class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                                    </div>
                                @endif
                                <div class="mt-4 flex justify-between">
                                    <div>
                                        <h3 class="text-sm text-gray-700 dark:text-white">
                                            <a class="cursor-pointer" @click=($wire.addToCart('{{ $article->id }}'))>
                                                <span aria-hidden="true" class="absolute inset-0"></span>
                                                {{ $article->name }}
                                            </a>
                                        </h3>
                                    </div>
                                    <p class="text-xs font-medium dark:text-white text-gray-900">{{ $article->price }} Bs.</p>
                                </div>
                            </div>
                        @empty
                            <h1 class="text-3xl dark:text-white">No hay articulos disponibles.</h1>
                        @endforelse
                    </div>
                </div>
                {{ $articles->links('vendor.livewire.tailwind-pagination') }}
            </div>
        </div>
    </div>
</div>
