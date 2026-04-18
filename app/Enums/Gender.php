<?php

namespace App\Enums;

enum Gender: string
{
    case Male = 'male';
    case Female = 'female';
    case Other = 'other';

    private const LABELS = [
        'male'   => 'Masculino',
        'female' => 'Feminino',
        'other'  => 'Outro',
    ];

    public function label(): string
    {
        return self::LABELS[$this->value];
    }

    public static function fromDatabase(?string $value): self
    {
        return self::tryFrom(strtolower((string) $value)) ?? self::Other;
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($case) => [
                $case->value => $case->label(),
            ])
            ->toArray();
    }
}