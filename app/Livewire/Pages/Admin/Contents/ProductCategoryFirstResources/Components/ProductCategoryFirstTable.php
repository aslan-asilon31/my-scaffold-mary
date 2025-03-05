<?php

namespace App\Livewire\Pages\Admin\Contents\ProductCategoryFirstResources\Components;

use App\Models\ProductCategoryFirst;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\Footer;

final class ProductCategoryFirstTable extends PowerGridComponent
{

  public string $tableName = 'product-category-first-table';
  public string $sortField = 'updated_at';
  public string $sortDirection = 'desc';
  public string $url = '/product-category-firsts';

  public function setUp(): array
  {
    // $this->showCheckBox();

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
    return ProductCategoryFirst::query()
      ->join('product_category_seconds', 'product_category_firsts.product_category_second_id', 'product_category_seconds.id')
      ->select([
        'product_category_firsts.id',
        'product_category_firsts.name',
        'product_category_seconds.name AS product_category_seconds_name',
        'product_category_firsts.slug',
        'product_category_firsts.image_url',
        'product_category_firsts.header_image_url',
        'product_category_firsts.created_by',
        'product_category_firsts.updated_by',
        'product_category_firsts.created_at',
        'product_category_firsts.updated_at',
        'product_category_firsts.is_activated',
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
                  <x-menu-item title="Show" Link="/product-category-firsts/show/' . e($record->id) . '/readonly" />
                  <x-menu-item title="Edit" Link="/product-category-firsts/edit/' . e($record->id) . '"/>
              </x-dropdown>'))
      ->add('id')
      ->add('name')
      ->add('product_category_seconds_name')
      ->add('slug')
      ->add('image_url', function ($record) {
        if ($record->image_url) {
          return Blade::render(sprintf('<a href="%s" target="_blank">%s</a>', e(url($record->image_url)), e($record->image_url)));
        } else {
          return '';
        }
      })
      ->add('header_image_url', function ($record) {
        if ($record->header_image_url) {
          return Blade::render(sprintf('<a href="%s" target="_blank">%s</a>', e(url($record->header_image_url)), e($record->header_image_url)));
        } else {
          return '';
        }
      })
      ->add('is_activated', fn($record) => $record->is_activated ? 'Yes' : 'No')
      ->add('created_at');
  }

  public function columns(): array
  {
    return [

      Column::make('Action', 'action')
        ->bodyAttribute('text-center'),

      Column::make('Name', 'name')
        ->sortable(),

      Column::make('Product Category 2 Name', 'product_category_seconds_name')
        ->sortable(),

      Column::make('Slug', 'slug')
        ->sortable(),

      Column::make('Image url', 'image_url')
        ->sortable(),

      Column::make('Header Image url', 'header_image_url')
        ->sortable(),

      Column::make('Is Activated', 'is_activated')
        ->bodyAttribute('text-center')
        ->sortable(),

      Column::make('Created By', 'created_by')
        ->sortable(),

    ];
  }

  public function filters(): array
  {
    return [
      Filter::inputText('id', 'product_category_firsts.id')->placeholder('ID'),
      Filter::inputText('name', 'product_category_firsts.name')->placeholder('Name'),
      Filter::inputText('product_category_seconds_name', 'product_category_seconds.name')->placeholder('Product Category 2 Name'),
      Filter::inputText('slug', 'product_category_firsts.slug')->placeholder('Slug'),
      Filter::inputText('image_url', 'product_category_firsts.image_url')->placeholder('Image URL'),
      Filter::inputText('header_image_url', 'product_category_firsts.header_image_url')->placeholder('Header Image URL'),
      Filter::inputText('created_by', 'product_category_firsts.created_by')->placeholder('Created By'),
      Filter::inputText('updated_by', 'product_category_firsts.updated_by')->placeholder('Updated By'),
      Filter::datepicker('created_at', 'product_category_firsts.created_at'),
      Filter::datepicker('updated_at', 'product_category_firsts.updated_at'),
      Filter::boolean('is_activated', 'product_category_firsts.is_activated')->label('Yes', 'No'),
    ];
  }
}
