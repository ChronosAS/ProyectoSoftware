<div>
    <div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto lg:px-6">
                <x-validation-errors class="mb-4" />
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl lg:rounded-lg">
                    <form wire:submit='update'>
                        <div x-data="{report: false}" class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
                            <div>
                                <div class="flex items-center">
                                    <x-label for="document" value="{{ __('auth.user_id') }}" />
                                    </h2>
                                </div>

                                <x-input id="document" min="0" class="block mt-1 w-full [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" type="number" name="document" wire:model='document'  autofocus autocomplete="document" />
                            </div>

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
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" wire:model='email'  autocomplete="username" />
                            </div>
                            <div>
                                <div class="flex items-center">
                                    <x-label for="type" value="{{ __('auth.user_type') }}" />
                                </div>
                                <select x-on:change="report= $event.target.value" name="type" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="type" wire:model='type'>
                                    <option value="" selected disabled>Seleccione uno</option>
                                    @foreach ( $user_types as $type)
                                        <option value="{{ $type->value }}">{{ str($type->name)->replace('_',' ') }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div x-show="report == 'discapacitado'">
                                <div class="flex items-center" >
                                    <x-label for="report" value="Informe Medico" />
                                </div>
                                <input name="report" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-300 focus:outline-none dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400" wire:model='report' id="report" type="file">
                            </div>
                        </div>
                        <div class="flex items-center justify-end m-4">
                            <x-button-href class="cursor-pointer" href="{{ route('users.index') }}">
                                Regresar
                            </x-button-href>
                            <x-button class="ms-4">
                                Editar
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

     </div>

</div>
