<?php

namespace App\Livewire\Pages\Admin\Contents\MetaPropertyResources;

use App\Livewire\Pages\Contents\MetaProperties\Forms\MetaPropertyForm;
use App\Models\MetaProperty;
use Livewire\Component;

class MetaPropertyCrud extends Component
{
  public function render()
  {
    return view('livewire.pages.meta-properties.meta-property-crud')
      ->title($this->title);
  }

  public string $title = 'Meta Property';
  public string $url = '/meta-properties';

  use \App\Helpers\FormHook\Traits\WithFormHook;

  #[\Livewire\Attributes\Locked]
  public null|string $id = null;
  private string $model = MetaProperty::class;
  public MetaPropertyForm $masterForm;

  private string $uploadFolderName = 'files/images/meta-properties';
  private string $baseImageName = 'meta_property_image';

  public function create()
  {
    $this->masterForm->reset();
  }

  public function store()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules($this->id),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $this->model::create($validatedForm);

    session()->flash('success_notification', __('messages.created_notification_message'));
    $this->redirect($this->url, true);
  }

  public function edit()
  {
    $record = $this->model::findOrFail($this->id);
    $this->masterForm->fill($record);
  }

  public function update()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules($this->id),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $record = $this->model::findOrFail($this->id);
    $record->update($validatedForm);

    session()->flash('success_notification', __('messages.updated_notification_message'));
    $this->redirect($this->url, true);
  }

  public function delete()
  {
    $record = $this->model::findOrFail($this->id);

    $record->delete();
    session()->flash('success_notification', __('messages.deleted_notification_message'));
    $this->redirect($this->url, true);
  }
}
