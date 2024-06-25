<div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto lg:px-6">
            <x-validation-errors class="mb-4" />
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl lg:rounded-lg">
                <form wire:submit='save'>
                    <div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">

                        <div>
                            <div class="flex items-center">
                                <x-label for="name" value="{{ __('Name') }}" />
                            </div>

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model='name'  autofocus autocomplete="name" />

                        </div>

                        <div>
                            <div class="flex items-center">
                                <x-label for="email" value="{{ __('Email') }}" />
                            </div>
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" wire:model='email'  autocomplete="providername" />
                        </div>

                    </div>
                    <div class="flex items-center justify-end m-4">
                        <x-button-href class="cursor-pointer" href="{{ route('providers.index') }}">
                            Regresar
                        </x-button-href>
                        <x-button class="ms-4">
                            Crear
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

 </div>
