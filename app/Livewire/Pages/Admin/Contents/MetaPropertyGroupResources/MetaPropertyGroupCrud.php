<?php

namespace App\Livewire\Pages\Admin\Contents\MetaPropertyGroupResources;

use App\Livewire\Pages\MetaPropertyGroupResources\Forms\MetaPropertyGroupForm;
use App\Models\MetaPropertyGroup;
use Livewire\Component;

class MetaPropertyGroupCrud extends Component
{
  public function render()
  {
    return view('livewire.pages.meta-property-group-resources.meta-property-group-crud')
      ->title($this->title);
  }

  public string $title = 'Meta Property Group';
  public string $url = '/meta-property-groups';

  use \Livewire\WithFileUploads;
  use \App\Helpers\ImageUpload\Traits\WithImageUpload;
  use \App\Helpers\FormHook\Traits\WithFormHook;

  #[\Livewire\Attributes\Locked]
  public null|string $id = null;
  private string $model = MetaPropertyGroup::class;
  public MetaPropertyGroupForm $masterForm;

  private string $uploadFolderName = 'files/images/meta-property-groups';
  private string $baseImageName = 'meta_property_group_image';

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
