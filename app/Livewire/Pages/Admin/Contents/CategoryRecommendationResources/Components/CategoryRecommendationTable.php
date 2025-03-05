<?php

namespace App\Livewire\Pages\Admin\Contents\CategoryRecommendationResources\Components;

use App\Models\CategoryRecommendation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use Illuminate\View\View; 

final class CategoryRecommendationTable extends PowerGridComponent
{

  public string $tableName = 'category_recommendations';
  public string $sortField = 'created_at';
  public string $sortDirection = 'desc';
  public string $url = '/category-recommendations';

  public function setUp(): array
  {
    return [
        // PowerGrid::header()
        //     ->showSearchInput(),
        PowerGrid::footer()
            ->showPerPage()
            ->showRecordCount(),
    ];
  }

  public function datasource(): Builder
  {
    return \App\Models\CategoryRecommendation::query();
  }

  public function relationSearch(): array
  {
    return [];
  }

  public function noDataLabel(): string|View
  {
      return view('no-data');
  }

  public function fields(): PowerGridFields
  {
    return PowerGrid::fields()
      ->add('action', fn($record) => Blade::render('
        <x-dropdown no-x-anchor class="btn-sm">
            <x-menu-item title="Show" Link="/category-recommendations/show/' . e($record->id) . '/readonly" />
            <x-menu-item title="Edit" Link="/category-recommendations/edit/' . e($record->id) . '"/>
        </x-dropdown>'))
      ->add('id')
      ->add('name')
      ->add('product_category_id')
      ->add('description')
      ->add('created_by')
      ->add('updated_by')
      ->add('created_at')
      ->add('updated_at')
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

      Column::make('product category id', 'product_category_id')
        ->sortable(),

      Column::make('Description', 'description')
        ->sortable(),


      Column::make('Created By', 'created_by')
        ->sortable(),

      Column::make('Updated By', 'updated_by')
        ->sortable(),

      Column::make('Created At', 'created_at')
        ->sortable(),

      Column::make('Updated At', 'updated_at')
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
      Filter::inputText('product category id')->placeholder('product_category_id'),
      Filter::inputText('description')->placeholder('Description'),
      Filter::inputText('created_by')->placeholder('Created By'),
      Filter::inputText('updated_by')->placeholder('Updated By'),
      Filter::datepicker('created_at', 'created_at'),
      Filter::datepicker('updated_at', 'updated_at'),
      Filter::boolean('is_activated')->label('Yes', 'No'),
    ];
  }
}
