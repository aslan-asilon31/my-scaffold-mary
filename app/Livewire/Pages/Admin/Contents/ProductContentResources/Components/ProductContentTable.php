<?php

namespace App\Livewire\Pages\Admin\Contents\ProductContentResources\Components;

use App\Models\ProductContent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class ProductContentTable extends PowerGridComponent
{
  public string $tableName = 'product-content-yfoqs8-table';
  public string $sortField = 'product_contents.updated_at';
  public string $sortDirection = 'desc';
  public string $url = '/product-contents';

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
    return ProductContent::query()
      ->join('products', 'product_contents.product_id', 'products.id')
      ->select([
        'product_contents.id',
        'products.name AS products_name',
        'product_contents.title',
        'product_contents.slug',
        'product_contents.url',
        'product_contents.image_url',
        'product_contents.created_by',
        'product_contents.updated_by',
        'product_contents.created_at',
        'product_contents.updated_at',
        'product_contents.is_activated',
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
            <x-menu-item title="Show" Link="/product-contents/edit/' . e($record->id) . '/readonly" />
            <x-menu-item title="Edit" Link="/product-contents/edit/' . e($record->id) . '"/>
        </x-dropdown>'))
      ->add('id')
      ->add('products_name')
      ->add('title')
      ->add('slug')
      ->add('url', fn($record) => $record->url ? Blade::render(sprintf('<x-button href="%s" target="_blank">%s</x-button>', e(url($record->url)), e($record->url))) : NULL)
      ->add('image_url', function ($record) {
        if ($record->image_url) {
          return Blade::render(sprintf('<x-button href="%s" target="_blank">%s</x-button>', e(url($record->image_url)), e($record->image_url)));
        } else {
          return '';
        }
      })
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

      Column::make('Product Name', 'products_name')
        ->sortable(),

      Column::make('Title', 'title')
        ->sortable(),

      Column::make('Slug', 'slug')
        ->sortable(),

      Column::make('URL', 'url')
        ->sortable(),

      Column::make('Image URL', 'image_url')
        ->sortable(),

      Column::make('Created By', 'created_by')
        ->sortable(),

      Column::make('Updated By', 'updated_by')
        ->sortable(),

      Column::make('Created At', 'created_at')
        ->sortable(),

      Column::make('Updated At', 'updated_at')
        ->sortable(),

      Column::make('Is Activated', 'is_activated')
        ->bodyAttribute('text-center')
        ->sortable(),

    ];
  }

  public function filters(): array
  {
    return [
      Filter::inputText('id', 'product_contents.id')->placeholder('ID'),
      Filter::inputText('products_name', 'products.name')->placeholder('Product Name'),
      Filter::inputText('name', 'product_contents.name')->placeholder('Name'),
      Filter::inputText('title', 'product_contents.title')->placeholder('Title'),
      Filter::inputText('slug', 'product_contents.slug')->placeholder('Slug'),
      // Filter::inputText('product_category_firsts_name', 'product_category_firsts.name')->placeholder('Product Category First Name'),
      Filter::inputText('url', 'product_contents.url')->placeholder('URL'),
      Filter::inputText('image_url', 'product_contents.image_url')->placeholder('Image URL'),
      Filter::inputText('created_by', 'product_contents.created_by')->placeholder('Created By'),
      Filter::inputText('updated_by', 'product_contents.updated_by')->placeholder('Updated By'),
      Filter::datepicker('created_at', 'product_contents.created_at'),
      Filter::datepicker('updated_at', 'product_contents.updated_at'),
      Filter::boolean('is_activated', 'product_contents.is_activated')->label('Yes', 'No'),
    ];
  }

  // #[\Livewire\Attributes\On('edit')]
  // public function edit($id): void
  // {
  //   $this->js('alert(' . $id . ')');
  // }

  // public function actions(ProductContent $row): array
  // {
  //   return [
  //     Button::add('edit')
  //       ->slot('Edit')
  //       ->id()
  //       ->class($this->editButtonClass)
  //       ->dispatch('edit', ['id' => $row->id])
  //   ];
  // }

  /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
