<div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto lg:px-6">
            <x-validation-errors class="mb-4" />
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl lg:rounded-lg">
                <form wire:submit='update'>
                    <div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">

                        <div>
                            <div class="flex items-center">
                                <x-label for="name" value="{{ __('Name') }}" />
                            </div>

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model='name'  autofocus autocomplete="name" />

                        </div>

                        <div>
                            <div class="flex items-center">
                                <x-label for="description" value="Descripcion" />
                            </div>

                            <x-input id="description" class="block mt-1 w-full" type="text" description="description" wire:model='description'  autofocus autocomplete="description" />

                        </div>

                        <div>
                            <div class="flex items-center">
                                <x-label for="categories" value="Categorias" />
                            </div>
                            <select multiple name="categories" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="categories" wire:model='categories'>
                                <option value="" selected disabled>Seleccione uno</option>
                                @forelse ( $all_categories as $category)
                                    <option value="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
                                @empty
                                    <option value="" disabled>No hay categorias</option>
                                @endforelse
                            </select>
                        </div>

                        <div>
                            <div class="flex items-center">
                                <x-label for="providers" value="Proveedores" />
                            </div>
                            <select multiple name="providers" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="provider" wire:model='providers'>
                                <option value="" selected disabled>Seleccione uno</option>
                                @forelse ( $all_providers as $provider)
                                    <option value="{{ $provider->id }}">{{ ucfirst($provider->name) }}</option>
                                @empty
                                    <option value="" disabled>No hay proveedores</option>
                                @endforelse
                            </select>
                        </div>
                        <div>
                            <div class="flex items-center">
                                <x-label for="price" value="Precio(Bs)" />
                            </div>
                            <x-input id="price" class="block mt-1 w-full [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" type="number" name="price" wire:model='price'  autocomplete="price" step="0.01"/>
                        </div>
                        <div>
                            <div class="flex items-center">
                                <x-label for="stock" value="Disponibles" />
                            </div>
                            <x-input id="stock" wire:model='stock' min="0" class="block mt-1 w-full " type="number" name="stock" autocomplete="stock" />
                        </div>
                        <div>
                            <div class="flex items-center" >
                                <x-label for="image" value="Imagen" />
                            </div>
                            <input name="image" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-300 focus:outline-none dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400" wire:model='image' id="image" type="file">
                        </div>
                    </div>
                    <div class="flex items-center justify-end m-4">
                        <x-button-href class="cursor-pointer" href="{{ route('articles.index') }}">
                            Regresar
                        </x-button-href>
                        <x-button class="ms-4">
                            Actualizar
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

 </div>
