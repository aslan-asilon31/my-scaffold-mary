<?php

namespace App\Livewire\Pages\Admin\Generals\MarketplaceResources\Components;

use App\Models\Marketplace;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGDrid\Footer;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class MarketplaceTable extends PowerGridComponent
{
  public string $tableName = 'marketplace-table';
  public string $sortField = 'created_at';
  public string $sortDirection = 'desc';
  public string $url = '/marketplaces';

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
    return Marketplace::query();
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
            <x-menu-item title="Show" Link="/marketplaces/show/' . e($record->id) . '/readonly" />
            <x-menu-item title="Edit" Link="/marketplaces/edit/' . e($record->id) . '"/>
        </x-dropdown>'))
      ->add('id')
      ->add('name')
      ->add('url', fn($record) => Blade::render(sprintf('<div  class="text-blue-600 hover:text-blue-800 visited:text-purple-600" link="%s" target="_blank">%s</div>', e($record->url), e($record->url))))
      ->add('image_url', function ($record) {
        if ($record->image_url) {
          return Blade::render(sprintf('<div class="text-blue-600 hover:text-blue-800 visited:text-purple-600" link="%s" target="_blank">%s</div>', e(url($record->image_url)), e($record->image_url)));
        } else {
          return '';
        }
      })
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

      Column::make('Url', 'url')
        ->sortable(),

      Column::make('Image url', 'image_url')
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

      Column::make('Is activated', 'is_activated')
        ->bodyAttribute('text-center')
        ->sortable(),

    ];
  }

  public function filters(): array
  {
    return [
      Filter::inputText('id')->placeholder('ID'),
      Filter::inputText('name')->placeholder('Name'),
      Filter::inputText('url')->placeholder('URL'),
      Filter::inputText('image_url')->placeholder('Image URL'),
      Filter::inputText('ordinal')->placeholder('Ordinal'),
      Filter::inputText('created_by')->placeholder('Created By'),
      Filter::inputText('updated_by')->placeholder('Updated By'),
      Filter::datepicker('created_at', 'created_at'),
      Filter::datepicker('updated_at', 'updated_at'),
      Filter::boolean('is_activated')->label('Yes', 'No'),
    ];
  }
}
