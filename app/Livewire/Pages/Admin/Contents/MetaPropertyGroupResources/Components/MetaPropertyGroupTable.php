<?php

namespace App\Livewire\Pages\Admin\Contents\MetaPropertyGroupResources\Components;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class MetaPropertyGroupTable extends PowerGridComponent
{
  public string $tableName = 'meta-property-group-table';
  public string $sortField = 'created_at';
  public string $sortDirection = 'desc';
  public string $url = '/meta-property-groups';

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
    return \App\Models\MetaPropertyGroup::query();
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
            <x-menu-item title="Show" Link="/meta-property-group/show/' . e($record->id) . '/readonly" />
            <x-menu-item title="Edit" Link="/meta-property-group/edit/' . e($record->id) . '"/>
        </x-dropdown>'))
      ->add('id')
      ->add('name')
      ->add('created_by')
      ->add('updated_by')
      ->add('created_at')
      ->add('updated_at')
      ->add('ordinal')
      ->add('is_activated', fn($record) => $record->is_activated ? 'Yes' : 'No');
  }

  public function columns(): array
  {
    return [

      Column::make('Action', 'action')
        ->bodyAttribute('text-center'),

      Column::make('ID', 'id')
        ->sortable(),

      Column::make('Name', 'name')
        ->sortable(),

      Column::make('Created By', 'created_by')
        ->sortable(),

      Column::make('Updated By', 'updated_by')
        ->sortable(),

      Column::make('Created At', 'created_at')
        ->sortable(),

      Column::make('Updated At', 'updated_at')
        ->sortable(),

      Column::make('Ordinal', 'ordinal')
        ->bodyAttribute('text-right')
        ->sortable(),

      Column::make('Is Activated', 'is_activated')
        ->bodyAttribute('text-center')
        ->sortable(),

    ];
  }

  public function filters(): array
  {
    return [
      Filter::inputText('id')->placeholder('ID'),
      Filter::inputText('name')->placeholder('Name'),
      Filter::inputText('slug')->placeholder('Slug'),
      Filter::inputText('image_url')->placeholder('Image URL'),
      Filter::inputText('created_by')->placeholder('Created By'),
      Filter::inputText('updated_by')->placeholder('Updated By'),
      Filter::datepicker('created_at'),
      Filter::datepicker('updated_at'),
      Filter::inputText('ordinal')->placeholder('Ordinal'),
      Filter::boolean('is_activated')->label('Yes', 'No'),
    ];
  }
}
