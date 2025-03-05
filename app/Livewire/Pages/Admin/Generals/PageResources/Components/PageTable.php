<?php

namespace App\Livewire\Pages\Admin\Generals\PageResources\Components;


use App\Models\Page;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use Illuminate\Support\Facades\Blade;


final class PageTable extends PowerGridComponent
{
    public string $tableName = 'page-table';
    public string $sortField = 'updated_at';
    public string $sortDirection = 'desc';
    public string $url = '/pages';

    public function setUp(): array
    {
        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Page::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('action', fn($record) => Blade::render('
                <x-dropdown no-x-anchor class="btn-sm">
                    <x-menu-item title="Show" Link="/pages/show/' . e($record->id) . '/readonly" />
                    <x-menu-item title="Edit" Link="/pages/edit/' . e($record->id) . '"/>
                </x-dropdown>'))
            ->add('id')
            ->add('name')
            ->add('created_at')
            ->add('is_activated', fn($record) => $record->is_activated ? 'Aktif' : 'Non-aktif');
    }

    public function columns(): array
    {
        return [
                    
            Column::make('Action', 'action')
                ->bodyAttribute('text-center'),
            
            Column::make('Id', 'id')
                ->sortable()
                ->searchable(),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),
                
            Column::make('Aktif', 'is_activated')
                ->bodyAttribute('text-center'),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('id', 'pages.id')->placeholder('ID'),
            Filter::inputText('name', 'pages.name')->placeholder('Name'),
            Filter::inputText('created_by', 'pages.created_by')->placeholder('Created By'),
            Filter::inputText('updated_by', 'pages.updated_by')->placeholder('Updated By'),
            Filter::datepicker('created_at', 'pages.created_at'),
            Filter::datepicker('updated_at', 'pages.updated_at'),
            Filter::boolean('is_activated', 'pages.is_activated')->label('Yes', 'No'),
        ];
    }

  
}
