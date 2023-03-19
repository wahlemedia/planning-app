<?php

namespace App\Http\Livewire\Admin;

use Closure;
use Filament\Tables;
use App\Models\Topic;
use Livewire\Component;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Concerns\InteractsWithTable;

class ListTopics extends Component implements Tables\Contracts\HasTable
{

    use InteractsWithTable;



    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('title'),
        ];
    }

    // protected function getTableFilters(): array
    // {
    //     return [];
    // }

    // protected function getTableActions(): array
    // {
    //     return [];
    // }

    // protected function getTableBulkActions(): array
    // {
    //     return [];
    // }

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return fn (Model $record): string => route('admin.topics.edit', ['topic' => $record]);
    }

    protected function getTableQuery(): Builder
    {
        return Topic::query();
    }
    public function render()
    {
        return view('livewire.admin.list-topics')
            ->layout('layouts.app', ['header' => 'Topics']);
    }
}
