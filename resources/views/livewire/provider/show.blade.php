<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $provider->name }}
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
                                Correo:
                            </h2>
                        </div>

                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-lg leading-relaxed">
                            {{ $provider->email }}
                        </p>

                    </div>

                    <div>
                        <div class="flex items-center">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Direccion/es
                            </h2>
                        </div>
                        <ul>
                            @forelse ($provider->addresses as $address)
                            <li>
                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-lg leading-relaxed">
                                    {{ $address->address.','.$address->phone_1.'/'.$address->phone_2 }}
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
                </div>
            </div>
        </div>
    </div>
 </div>
