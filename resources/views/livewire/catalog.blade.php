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
                            <button id="categories" data-dropdown-toggle="categoriesDropdown"
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
                                <ul class="space-y-2 text-sm" aria-labelledby="categories">
                                    @forelse ($all_categories as $key => $category)
                                        <li class="flex items-center">
                                            <input wire:model.live='category' type="checkbox" value="{{ $category->id }}"
                                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />

                                            <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $category->name }}
                                            </label>
                                        </li>
                                    @empty
                                        <li class="flex items-center text-white">
                                            No hay categorias.
                                        </li>
                                    @endforelse

                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- https://lightit.io/blog/laravel-livewire-shopping-cart-demo/ --}}
                    <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                        @forelse ($articles as $index => $article)
                        <div class="relative m-10 flex w-full max-w-xs flex-col overflow-hidden rounded-lg border dark:border-gray-700 border-gray-100 dark:bg-gray-900 bg-white shadow-md shadow-gray-950/50">
                            @if($article->getFirstMedia('article-image'))
                                <div class="flex items-center justify-center w-full h-80 bg-gray-300 rounded sm:w-[400px]} dark:bg-gray-700">
                                    <img src="{{ ($article->getFirstMedia('article-image')->getUrl('thumb')) }}" alt="{{ $article->name.'-img' }}" class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                                </div>
                                @else
                                    <div class="flex items-center justify-center w-full h-80 bg-gray-300 rounded sm:w-[400px]} dark:bg-gray-700">
                                        <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                            <path d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z"/>
                                        </svg>
                                    </div>
                                @endif
                            {{-- <a class="relative mx-3 mt-3 flex h-60 overflow-hidden rounded-xl" href="#">
                              <img class="object-cover" src="{{ ($article->getFirstMedia('article-image')->getUrl('thumb')) }}" alt="{{ $article->name.'-img' }}" alt="product image" />
                            </a> --}}
                            <div class="mt-4 px-5 pb-5">
                              {{-- <a href="{{ route('articles.show',$article->id) }}"> --}}
                                <h5 class="text-xl tracking-tight text-slate-900 dark:text-white">{{ $article->name }}</h5>
                              {{-- </a> --}}
                              <div class="mt-2 mb-2 flex items-center justify-between">
                                <p>
                                  <span class="text-2xl font-bold text-slate-900 dark:text-white">{{ $article->price }} Bs.</span>
                                </p>
                              </div>
                              <div class="mb-5 flex items-center justify-between">
                                    <p class="text-sm font-bold text-slate-900 dark:text-white">
                                        Disponibles: {{ $article->available }}
                                    </p>
                              </div>
                              <div class="flex flex-col items-center">
                                    <button wire:click='addToCart("{{ $article->id }}")' type="button" class="flex items-center justify-center rounded-md bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-500 focus:outline-none disabled:bg-blue-500 disabled:cursor-default focus:ring-4 focus:ring-blue-600" {{ ($article->available==0) ? 'disabled' : '' }}>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Agregar al carrito
                                    </button>
                                </div>
                            </div>
                          </div>

                            {{-- <div class="group relative rounded-md p-3" style="background: rgb(17,24,39)">
                                @if($article->getFirstMedia('article-image'))
                                    <div class="aspect-h-1 aspect-w-1 w-full bg-gray overflow-hidden rounded-md bg-gray-200 lg:aspect-none lg:h-80">
                                        <img src="{{ ($article->getFirstMedia('article-image')->getUrl('thumb')) }}" alt="{{ $article->name.'-img' }}" class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                                    </div>
                                @else
                                    <div class="flex items-center justify-center w-full h-80 bg-gray-300 rounded sm:w-[400px]} dark:bg-gray-700">
                                        <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                            <path d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="mt-4 flex justify-between dark:text-white">
                                    <div>
                                        <h3>
                                            {{ $article->name }}
                                        </h3>
                                        <p class="text-xs font-medium dark:text-white text-gray-900">Disponibles: {{ $article->available }}</p>
                                    </div>
                                    <div class="">
                                        <p class=" font-medium dark:text-white text-gray-900">{{ $article->price }} Bs.</p>
                                        <h2 class="text-xs">En carrito: {{ $article->inCart }}</h2>
                                    </div>
                                    <div class="">
                                        <button wire:click='addToCart("{{ $article->id }}")' type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" {{ ($article->available==0) ? 'disabled' : '' }}>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                                <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="sr-only">Add to cart</span>
                                        </button>
                                    </div>
                                </div>
                            </div> --}}
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
