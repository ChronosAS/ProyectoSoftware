<?php

namespace App\Enum;

use App\Enum\Concerns\EnumOptions;

enum UserType: string
{
    use EnumOptions;

    case Normal = 'normal';
    case Descapacitado = 'descapacitado';
    case TerceraEdad = '3era edad';
}
