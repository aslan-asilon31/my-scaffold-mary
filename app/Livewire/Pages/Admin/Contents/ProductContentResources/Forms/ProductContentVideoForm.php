<?php

namespace App\Livewire\Pages\Admin\Contents\ProductContentResources\Forms;

use Illuminate\Validation\Rule;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class ProductContentVideoForm extends Form
{
  public ?string $name = null;
  public TemporaryUploadedFile|string|null $thumbnail_url = null;
  public TemporaryUploadedFile|string|null $video_url = null;
  public int $ordinal = 0;
  public int $is_activated = 1;


  public function rules()
  {
    return [
      'masterForm.name' => ['required', 'string', 'max:255'],
      'masterForm.thumbnail_url' =>  ['required', new \App\Rules\StringOrImageRule],
      'masterForm.video_url' =>  ['required', new \App\Rules\StringOrVideoRule],
      'masterForm.ordinal' => ['required', 'numeric', 'min:0'],
      'masterForm.is_activated' => ['required', 'integer', Rule::in([0, 1])],
    ];
  }

  public function attributes()
  {
    return [
      'masterForm.name' => 'Name',
      'masterForm.thumbnail_url' => 'Image',
      'masterForm.video_url' => 'Video',
      'masterForm.ordinal' => 'Ordinal',
      'masterForm.is_activated' => 'Is Activated',
    ];
  }
}
