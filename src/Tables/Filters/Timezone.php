<?php

namespace OmarHaris\FilamentTimezoneField\Tables\Filters;

use Filament\Tables\Filters\SelectFilter;
use Illuminate\Contracts\Support\Htmlable;

class Timezone extends SelectFilter
{
    public function getLabel(): string
    {
        return trans('filament-timezone-field::label.timezone');
    }

    public function getOptions(): array
    {
        return trans('filament-timezone-field::timezone');
    }
}
