<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                    <h2 class="text-2xl font-bold tracking-tight dark:text-white text-gray-900">Productos</h2>
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
                                            <a href="#">
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
