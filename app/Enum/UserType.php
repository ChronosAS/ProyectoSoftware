<?php

namespace App\Enum;

use App\Enum\Concerns\EnumOptions;

enum UserType: string
{
    use EnumOptions;

    case Normal = 'normal';
    case Discapacitado = 'discapacitado';
    case Tercera_Edad = 'tercera_edad';
}
