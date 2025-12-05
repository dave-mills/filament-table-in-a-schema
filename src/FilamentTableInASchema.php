<?php

namespace DaveMills\FilamentTableInASchema;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Support\Concerns\EvaluatesClosures;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class FilamentTableInASchema extends Component implements HasActions, HasSchemas, HasTable
{
    use EvaluatesClosures;
    use InteractsWithActions;
    use InteractsWithSchemas;
    use InteractsWithTable;

    public ?Model $record;

    protected \Closure $makeTable;

    public function mount(\Closure $table): void
    {
        $this->makeTable = $table;
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('filament-table-in-a-schema::filament-table-in-a-schema');
    }

    public function table(Table $table)
    {
        return $this->evaluate($this->makeTable, [
            'table' => $table,
        ]);
    }
}
