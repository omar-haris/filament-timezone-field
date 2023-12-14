<?php

namespace OmarHaris\FilamentTimezoneField\Forms\Components;
use Filament\Forms\Components\Select;
use Illuminate\Contracts\Support\Htmlable;

class Timezone extends Select
{
    public function getLabel(): string | Htmlable
    {
        return trans('filament-timezone-field::label.timezone');
    }

    public function getOptions(): array
    {
        return trans('filament-timezone-field::timezone');
    }
}
