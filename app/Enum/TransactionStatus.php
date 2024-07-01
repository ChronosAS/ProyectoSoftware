<?php

namespace App\Enum;

use App\Enum\Concerns\EnumOptions;

enum TransactionStatus: string
{
    use EnumOptions;

    case Pendiente = 'pendiente';
    case Procesada = 'procesada';
    case Carncelada = 'cancelada';
}
