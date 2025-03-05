<?php

namespace App\Livewire\Pages\Admin\Contents\MetaPropertyResources\Components;

use App\Models\MetaProperty;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
// use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;

final class MetaPropertyTable extends PowerGridComponent
{
  use WithExport;
  public string $tableName = 'meta-property-table';
  public string $sortField = 'meta_properties.ordinal';
  public string $sortDirection = 'asc';
  public string $url = '/meta-properties';

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
    return MetaProperty::query()
      ->join('meta_property_groups', 'meta_properties.meta_property_group_id', 'meta_property_groups.id')
      ->select([
        'meta_properties.id',
        'meta_properties.meta_property_group_id',
        'meta_properties.name',
        'meta_property_groups.name AS meta_property_groups_name',
        'meta_properties.created_by',
        'meta_properties.updated_by',
        'meta_properties.created_at',
        'meta_properties.updated_at',
        'meta_properties.ordinal',
        'meta_properties.is_activated',
      ]);
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
            <x-menu-item title="Show" Link="/meta-property/show/' . e($record->id) . '/readonly" />
            <x-menu-item title="Edit" Link="/meta-property/edit/' . e($record->id) . '"/>
        </x-dropdown>'))
      ->add('id')
      ->add('meta_property_groups_name')
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
        ->visibleInExport(false)
        ->bodyAttribute('text-center'),

      Column::make('ID', 'id')
        ->sortable(),

      Column::make('Name', 'name')
        ->sortable(),

      Column::make('Meta Property Group', 'meta_property_groups_name')
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
      Filter::inputText('id', 'meta_properties.id')->placeholder('Name'),
      Filter::inputText('name', 'meta_properties.name')->placeholder('Name'),
      Filter::inputText('meta_property_groups_name', 'meta_property_groups.name')->placeholder('Meta Property Group'),
      Filter::inputText('created_by', 'meta_properties.created_by')->placeholder('Created By'),
      Filter::inputText('updated_by', 'meta_properties.updated_by')->placeholder('Updated By'),
      Filter::datepicker('created_at', 'meta_properties.created_at'),
      Filter::datepicker('updated_at', 'meta_properties.updated_at'),
      Filter::inputText('ordinal', 'meta_properties.ordinal')->placeholder('Ordinal'),
      Filter::boolean('is_activated', 'meta_properties.is_activated')->label('Yes', 'No'),
    ];
  }
}
