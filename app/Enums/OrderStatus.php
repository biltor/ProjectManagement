<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum OrderStatus: string implements HasColor, HasIcon, HasLabel
{
    case New = 'Nouveau';

    case Processing = 'En Cours';

    case Shipped = 'Livrer';

    case Factured = 'Comptabiliser';

    case Cancelled = 'Annuler';

    public function getLabel(): string
    {
        return match ($this) {
            self::New => 'Nouveau',
            self::Processing => 'En Cours',
            self::Shipped => 'Livrer',
            self::Factured => 'Comptabiliser',
            self::Cancelled => 'Annuler',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::New => 'info',
            self::Processing => 'warning',
            self::Shipped, self::Factured => 'success',
            self::Cancelled => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::New => 'heroicon-m-sparkles',
            self::Processing => 'heroicon-m-arrow-path',
            self::Shipped => 'heroicon-m-truck',
            self::Factured => 'heroicon-m-check-badge',
            self::Cancelled => 'heroicon-m-x-circle',
        };
    }
}