<?php

namespace OmarHaris\FilamentTimezoneField\Tables\Filters;

use Filament\Tables\Filters\SelectFilter;
use Illuminate\Contracts\Support\Htmlable;

class Timezone extends SelectFilter
{
    protected function setUp(): void
    {
        parent::setUp();
        
        // Filament v4 compatibility
        $this->label(trans('filament-timezone-field::label.timezone'));
        $this->options($this->getTimezoneOptions());
    }

    /**
     * Filament v3 compatibility - getLabel method
     */
    public function getLabel(): string
    {
        return trans('filament-timezone-field::label.timezone');
    }

    /**
     * Filament v3 compatibility - getOptions method
     */
    public function getOptions(): array
    {
        return $this->getTimezoneOptions();
    }

    /**
     * Get timezone options (flattened from nested structure)
     */
    protected function getTimezoneOptions(): array
    {
        $timezones = trans('filament-timezone-field::timezone');
        
        // Convert nested structure to flat array
        $flattened = [];
        foreach ($timezones as $region => $regionTimezones) {
            if (is_array($regionTimezones)) {
                foreach ($regionTimezones as $timezone => $label) {
                    $flattened[$timezone] = $label;
                }
            }
        }
        
        return $flattened;
    }
}
