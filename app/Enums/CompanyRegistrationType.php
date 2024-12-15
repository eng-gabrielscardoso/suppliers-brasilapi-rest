<?php

namespace App\Enums;

use App\Support\EnumToArray;

enum CompanyRegistrationType: string
{
    use EnumToArray;

    case CPF = 'cpf';
    case CNPJ = 'cnpj';
}
