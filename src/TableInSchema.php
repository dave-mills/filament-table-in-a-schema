<?php

namespace DaveMills\FilamentTableInASchema;

use Filament\Schemas\Components\Component;
use Filament\Tables\Table;

class TableInSchema extends Component
{
    protected string $view = 'filament-table-in-a-schema::table-in-schema';

    protected \Closure $table;

    public static function make(): static
    {
        return app(static::class);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->dehydrated(false);
    }

    public function table(\Closure $table): static
    {
        $this->table = $table;

        return $this;
    }

    public function getTable(): \Closure
    {
        return $this->table;
    }
}
