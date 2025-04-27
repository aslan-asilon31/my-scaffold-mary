<div>

    <x-index-menu :title="$title" :url="$url" :id="$id" shadow  class="" />

    <x-form wire:submit="{{ $id ? 'update' : 'store' }}" >

          <div id="pertanyaan">

            <div class="mb-3">
                <x-input 
                    label="Name" 
                    wire:model="masterForm.name" 
                    id="masterForm.name" 
                    name="masterForm.name" 
                    placeholder="Name" 
                    :readonly="$readonly"

                />
            </div>

            <x-file wire:model="masterForm.image_url" label="Image" accept="image/*" crop-after-change :disabled="$isDisabled">
                <img
                  src="{{ $masterForm->image_url ?? 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930' }}"
                  class="h-48 rounded-lg" />
            </x-file>

            <div class="mb-3">
                <x-input 
                    label="Availability" 
                    wire:model="masterForm.availability" 
                    id="masterForm.availability" 
                    name="masterForm.availability" 
                    placeholder="availability" 
                    :readonly="$readonly"

                />
            </div>

            <div class="mb-3">
                <x-input 
                    label="Selling Price" 
                    wire:model="masterForm.selling_price" 
                    id="masterForm.selling_price" 
                    name="masterForm.selling_price" 
                    placeholder="selling price" 
                    :readonly="$readonly"

                />
            </div>
            <div class="mb-3">
                <x-input 
                    label="Discount Persentage" 
                    wire:model="masterForm.discount_persentage" 
                    id="masterForm.discount_persentage" 
                    name="masterForm.discount_persentage" 
                    placeholder="Discount Persentage" 
                    :readonly="$readonly"

                />
            </div>
            <div class="mb-3">
                <x-input 
                    label="Discount Value" 
                    wire:model="masterForm.discount_value" 
                    id="masterForm.discount_value" 
                    name="masterForm.discount_value" 
                    placeholder="Discount Value" 
                    :readonly="$readonly"

                />
            </div>
            <div class="mb-3">
                <x-input 
                    label="Nett Price" 
                    wire:model="masterForm.nett_price" 
                    id="masterForm.nett_price" 
                    name="masterForm.nett_price" 
                    placeholder="Nett Price" 
                    :readonly="$readonly"

                />
            </div>
            <div class="mb-3">
                <x-input 
                    label="Weight" 
                    wire:model="masterForm.weight" 
                    id="masterForm.weight" 
                    name="masterForm.weight" 
                    placeholder="Weight" 
                    :readonly="$readonly"

                />
            </div>
            <div class="mb-3">
                <x-input 
                    label="Rating" 
                    wire:model="masterForm.rating" 
                    id="masterForm.rating" 
                    name="masterForm.rating" 
                    placeholder="Rating" 
                    :readonly="$readonly"

                />
            </div>

              <div class="text-center mt-3">
                <x-errors class="text-white mb-3" />
                <x-button type="submit" :label="$id ? 'update' : 'store'" class="btn-success btn-sm text-white" />
              </div>

          </div>
      </x-form>

    <x-button label="Cancel" class="text-xs md:text-sm" wire.click="closeModal" />

    @script
        <script>

            let $wire = {
                $watch(name, callback) { ... },
            }

            $wire.$set(name, value, live = true) { 
                
            },

            
            $wire.on('product-created', () => {
                console.log('product-created');
            });
        </script>
    @endscript

</div>