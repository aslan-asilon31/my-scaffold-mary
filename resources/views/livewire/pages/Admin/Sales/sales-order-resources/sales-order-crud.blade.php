<x-card :title="$title" shadow separator class="border shadow">

@php 
  $masterForm->is_processed === 1 ? 'ya' : 'no';
@endphp

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

    <x-input wire:model="masterForm.customer_id" label="" placeholder="" :readonly="$isReadonly" hidden/>
    <x-input wire:model="masterForm.employee_id" label="" placeholder="" :readonly="$isReadonly" hidden/>
    <x-input wire:model="masterForm.first_name" label="First Name" placeholder="First Name" :readonly="$isReadonly" />
    <x-input wire:model="masterForm.last_name" label="Last Name" placeholder="Last Name" :readonly="$isReadonly" />
    <x-input wire:model="masterForm.date" label="Date" placeholder="Date" :readonly="$isReadonly" />
    <x-input wire:model="masterForm.number" label="Number" placeholder="Number" :readonly="$isReadonly" />
    <x-input wire:model="masterForm.total_amount" label="Total amount" placeholder="total amount" :readonly="$isReadonly" />
    <x-input wire:model="masterForm.status" label="Status" placeholder="Status" :readonly="$isReadonly" />
    
    <x-input wire:model="masterForm.is_processed" label="is processed ?" placeholder="is processed" :readonly="$isReadonly" />
    <x-input wire:model="masterForm.fraud_status" label="Fraud Status" placeholder="Fraud Status" :readonly="$isReadonly" />


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