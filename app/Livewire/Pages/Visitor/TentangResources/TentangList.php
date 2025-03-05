<?php

namespace App\Livewire\Pages\Visitor\TentangResources;

use Livewire\Component;
use Livewire\Attributes\On; 

class TentangList extends Component
{

    public $nama;
    public $email;
    public $pesan;
    public $titlepost;

    protected $listeners = ['pesanDikirim' => 'updatePesan'];

    #[On('pesanDikirim')] 
    public function updatePesan($titlepost)
    {
        // Update data berdasarkan informasi yang diterima dari Komponen Kontak
        $this->titlepost = $titlepost;
    }

    public string $title = 'Tentang Kami';
    public function render()
    {
        return view('livewire.pages.visitor.tentang-resources.tentang-list')
        ->layout('components.layouts.app_visitor')
        ->title($this->title);
    }
}
