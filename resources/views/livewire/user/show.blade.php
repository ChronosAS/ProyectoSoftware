<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto lg:px-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl lg:rounded-lg">
                {{-- <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                    <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
                        Welcome to your Jetstream application!
                    </h1>

                    <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
                        Laravel Jetstream provides a beautiful, robust starting point for your next Laravel application. Laravel is designed
                        to help you build your application using a development environment that is simple, powerful, and enjoyable. We believe
                        you should love expressing your creativity through programming, so we have spent time carefully crafting the Laravel
                        ecosystem to be a breath of fresh air. We hope you love it.
                    </p>
                </div> --}}

                <div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
                    <div>
                        <div class="flex items-center">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Estado:
                            </h2>
                        </div>
                        {!! ($user->accepted)
                            ? '<span class="flex items-center mt-4 text-lg font-medium text-gray-900 dark:text-white me-3"><span class="flex w-2.5 h-2.5 bg-green-600 rounded-full me-1.5 flex-shrink-0"></span>Activo</span>'
                            : '<span class="flex items-center mt-4 text-lg font-medium text-gray-900 dark:text-white me-3"><span class="flex w-2.5 h-2.5 bg-red-600 rounded-full me-1.5 flex-shrink-0"></span>Inactivo</span>'
                        !!}
                    </div>
                    <div>
                        <div class="flex items-center">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Cedula:
                            </h2>
                        </div>

                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-lg leading-relaxed">
                            {{ $user->document }}
                        </p>
                    </div>

                    <div>
                        <div class="flex items-center">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Tipo:
                            </h2>
                        </div>

                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-lg leading-relaxed">
                            {{ str($user->type->name)->replace('_',' ') }}
                        </p>
                    </div>

                    <div>
                        <div class="flex items-center">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Correo:
                            </h2>
                        </div>

                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-lg leading-relaxed">
                            {{ $user->email }}
                        </p>

                    </div>

                    <div>
                        <div class="flex items-center">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Direccion/es
                            </h2>
                        </div>
                        <ul>
                            @forelse ($user->addresses as $address)
                            <li>
                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-lg leading-relaxed">
                                    {{ $address->address }}
                                </p>
                            </li>
                            @empty
                                <li>
                                    <p class="mt-4 text-gray-500 dark:text-gray-400 text-lg leading-relaxed">
                                        Sin direcciones.
                                    </p>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                    @if ($user->type->name == 'Discapacitado')
                        <div>
                            <div class="flex items-center">
                                <a wire:click="showReport()" class="font-semibold text-gray-500 dark:text-white text-xl leading-relaxed hover:text-blue-500 dark:hover:text-blue-500 hover:underline cursor-pointer">
                                    Ver Informe Medico
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($user->accepted == 0)
                        <div>
                            <x-success-button wire:click="acceptUser()" wire:loading.attr="disabled">
                                Aceptar Usuario
                            </x-success-button>
                        </div>
                    @else
                        <div>
                            <x-danger-button wire:click="acceptUser()" wire:loading.attr="disabled">
                                Cancelar Usuario
                            </x-danger-button>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
 </div>
