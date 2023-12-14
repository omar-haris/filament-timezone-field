<?php

namespace OmarHaris\FilamentTimezoneField\Tables\Columns;

use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class Timezone extends TextColumn {

    public function getLabel(): string | Htmlable
    {
        return trans('filament-timezone-field::label.timezone');
    }

    public function getStateFromRecord(): mixed
    {
        $record = $this->getRecord();

        $state = Arr::get($record, $this->getName());

        if ($state !== null) {
            foreach (trans('filament-timezone-field::timezone') as $regions) {
                foreach ($regions as $timezone=>$offset) {
                    if ($timezone === $state) {
                        return $offset;
                    }
                }
            }
            return $state;
        }

        if (! $this->queriesRelationships($record)) {
            return null;
        }

        $relationship = $this->getRelationship($record);

        if (! $relationship) {
            return null;
        }

        $relationshipAttribute = $this->getRelationshipAttribute();

        $state = collect($this->getRelationshipResults($record))
            ->filter(fn (Model $record): bool => array_key_exists($relationshipAttribute, $record->attributesToArray()))
            ->pluck($relationshipAttribute)
            ->when($this->isDistinctList(), fn (Collection $state) => $state->unique())
            ->values();

        if (! $state->count()) {
            return null;
        }

        return $state->all();
    }
}
