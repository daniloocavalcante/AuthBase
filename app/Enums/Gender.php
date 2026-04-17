<?php

namespace App\Enums;

namespace App\Enums;

enum Gender: string
{
    case Male = 'male';
    case Female = 'female';
    case Other = 'other';
    //case NonBinary = 'non_binary';

    public function label(): string
    {
        return match ($this) {
            self::Male => 'Masculino',
            self::Female => 'Feminino',
            self::Other => 'Outro',
            //self::NonBinary => 'Não Binário',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($case) => [
                $case->value => $case->label()
            ])
            ->toArray();
    }
}