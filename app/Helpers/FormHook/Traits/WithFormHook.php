<?php

namespace App\Helpers\FormHook\Traits;

trait WithFormHook
{
  public function mount()
  {
    if ($this->id) {
      $this->title .= " (Edit)";
      $this->edit();
    } else {
      $this->title .= " (Create)";
      $this->create();
    }
  }
}
