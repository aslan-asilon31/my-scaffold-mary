<?php

namespace App\Livewire\Pages\Admin\Contents\ProductBrandMarketplaceResources\Components;

use App\Models\ProductCategoryFirst;
use App\Models\ProductBrand;
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

final class ProductBrandTable extends PowerGridComponent
{

  public string $tableName = 'product-brand-table';
  public string $sortField = 'updated_at';
  public string $sortDirection = 'desc';
  public string $url = '/product-brands';

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
    return ProductBrand::query()
      ->select([
        'product_brands.id',
        'product_brands.name',
        'product_brands.slug',
        'product_brands.image_url',
        'product_brands.desc',
        'product_brands.created_by',
        'product_brands.updated_by',
        'product_brands.created_at',
        'product_brands.updated_at',
        'product_brands.is_activated',
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
                  <x-menu-item title="Show" Link="/product-brands/show/' . e($record->id) . '/readonly" />
                  <x-menu-item title="Edit" Link="/product-brands/edit/' . e($record->id) . '"/>
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


      Column::make('Slug', 'slug')
        ->sortable(),

      Column::make('Image url', 'image_url')
        ->sortable(),

      Column::make('Description', 'desc')
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
      Filter::inputText('id', 'product_brands.id')->placeholder('ID'),
      Filter::inputText('name', 'product_brands.name')->placeholder('Name'),
      Filter::inputText('slug', 'product_brands.slug')->placeholder('Slug'),
      Filter::inputText('image_url', 'product_brands.image_url')->placeholder('Image URL'),
      Filter::inputText('desc', 'product_brands.desc')->placeholder('Description'),
      Filter::inputText('created_by', 'product_brands.created_by')->placeholder('Created By'),
      Filter::inputText('updated_by', 'product_brands.updated_by')->placeholder('Updated By'),
      Filter::datepicker('created_at', 'product_brands.created_at'),
      Filter::datepicker('updated_at', 'product_brands.updated_at'),
      Filter::boolean('is_activated', 'product_brands.is_activated')->label('Yes', 'No'),
    ];
  }
}
