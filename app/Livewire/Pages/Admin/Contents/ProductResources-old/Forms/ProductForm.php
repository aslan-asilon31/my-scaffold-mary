<?php

namespace App\Livewire\Pages\Admin\Contents\ProductResources\Forms;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class ProductForm extends Form
{
  public string|null $product_category_first_id = null;
  public string|null $name = null;
  public string|null $availability = 'in-stock';
  public float|null $selling_price = 0;
  public float|null $discount_persentage = 0;
  public float|null $discount_value = 0;
  public float|null $nett_price = 0;
  public float|null $weight = 0;
  public float|null $rating = 0;
  public float|null $sold_qty = 0;
  public TemporaryUploadedFile|string|null $image_url = null;
  public int|null $is_activated = 1;

  public function rules(string|null $id = null): array
  {
    return [
      'masterForm.product_category_first_id' => 'required|string',
      'masterForm.availability' => 'required|string',
      'masterForm.name' => 'required|string',
      'masterForm.selling_price' => 'required|numeric|min:0',
      'masterForm.discount_persentage' => 'required|numeric|min:0',
      'masterForm.discount_value' => 'required|numeric|min:0',
      'masterForm.nett_price' => 'required|numeric|min:0',
      'masterForm.weight' => 'required|numeric|min:0',
      'masterForm.rating' => 'required|numeric|min:0',
      'masterForm.sold_qty' => 'required|numeric|min:0',
      'masterForm.image_url' => [
        'nullable',
        new \App\Rules\StringOrImageRule,
      ],
      'masterForm.is_activated' => 'required|bool',
    ];
  }

  public function attributes(): array
  {
    return [
      'masterForm.product_category_first_id' => 'Product Category 1',
      'masterForm.availability' => 'Availability',
      'masterForm.name' => 'Name',
      'masterForm.selling_price' => 'Selling Price',
      'masterForm.discount_persentage' => 'Discount Percentage',
      'masterForm.discount_value' => 'Discount Value',
      'masterForm.nett_price' => 'Net Price',
      'masterForm.weight' => 'Weight',
      'masterForm.rating' => 'Rating',
      'masterForm.sold_qty' => 'Sold Qty',
      'masterForm.image_url' => 'Image',
      'masterForm.is_activated' => 'Is Activated',
    ];
  }
}
