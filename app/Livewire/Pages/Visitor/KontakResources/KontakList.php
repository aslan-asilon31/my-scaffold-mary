<?php

namespace App\Livewire\Pages\Visitor\KontakResources;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\User;
use App\Models\EmployeeAccount;

class KontakList extends Component
{

    public $nama;
    public $email;
    public $pesan;
    public $post;
    public $titlepost;

    public function kirimPesan()
    {
        $this->post = 'cek post';
        $this->dispatch('pesanDikirim', titlepost: $this->titlepost);
        $this->reset(['nama', 'email', 'pesan']);
    }

    public $EmployeeAccountId;
    public $EmployeeAccount;

    #[Computed]
    public function EmployeeAccount()
    {
        $this->EmployeeAccount = EmployeeAccount::findOrFail($this->EmployeeAccountId);
        return $this->EmployeeAccount;
    }

    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.pages.visitor.kontak-resources.kontak-list')
        ->layout('components.layouts.app_visitor')
        ->title($this->title);
    }

    public string $title = 'Kontak';  


}
