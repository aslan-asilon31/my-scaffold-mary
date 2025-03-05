<x-card :title="$title" shadow separator class="border shadow">

  <div class="grid grid-cols-2 mb-4">
    <div>
      <x-button label="List" link="{{ $url }}" class="btn-ghost btn-outline" />
      @if ($id)
        <x-button label="Create" link="{{ $url . '/create' }}" class="btn-ghost btn-outline" />
      @endif

      @if ($id && $isReadonly)
        <x-button label="Edit" link="{{ $url . '/edit/' . $id }}" class="btn-ghost btn-outline" />
      @endif

    </div>
    <div class="text-right">
      @if ($id && !$isReadonly)
        <x-button label="Delete" wire:click="delete" wire:confirm="Do you want to delete this data?"
          class="btn-ghost btn-outline text-red-500" />
      @endif
    </div>
  </div>

  <x-form wire:submit="{{ $id ? 'update' : 'store' }}" wire:confirm="Are you sure?">

    
    <div class="mb-3">
      <x-input wire:model="masterForm.id" id="masterForm.id" name="masterForm.id" placeholder="Id" hidden />
    </div>
    
    <div class="mb-3">
      <x-input label="Name" wire:model.blur="masterForm.name" id="masterForm.name" name="masterForm.name" placeholder="Name" />
    </div>


    <div class="mb-3">
      <x-choices-offline wire:model="masterForm.is_activated" label="Is Activated" :options="[['id' => 0, 'name' => 'Inactive'], ['id' => 1, 'name' => 'Active']]" single searchable
        :readonly="$isReadonly" />
    </div>

    @if (!$isReadonly)
      <div class="text-center mt-3">
        <x-errors class="text-white mb-3" />
        <x-button type="submit" :label="$id ? 'Update' : 'Store'" class="btn-success btn-sm text-white" />
      </div>
    @endif
  </x-form>


</x-card>