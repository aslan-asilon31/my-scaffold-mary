<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CustomToggleButton extends Component
{
    public $modelId;
    public $isActivated;

    public function mount($modelId, $isActivated)
    {
        $this->modelId = $modelId;
        $this->isActivated = $isActivated;
    }

    public function toggleActivation()
    {
        // Assuming you have a model named 'YourModel'
        $model = YourModel::find($this->modelId);
        if ($model) {
            $model->is_activated = !$this->isActivated;
            $model->save();
            $this->isActivated = $model->is_activated;
        }
    }

    public function render()
    {
        return view('livewire.custom-toggle-button');
    }
}
