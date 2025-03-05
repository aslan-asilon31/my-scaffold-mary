<?php

namespace App\Helpers\BootModel\Traits;

trait WithMasterBootModel
{
  protected static function boot(): void
  {
    parent::boot();

    static::creating(function ($record) {
      // if (empty($record->id)) {
      //   $record->id = str()->slug($record->name, '_');
      // }
      if (empty($record->created_by)) {
        $record->created_by = auth()->user()->username;
      }

      if (empty($record->updated_by)) {
        $record->updated_by = auth()->user()->username;
      }
    });

    static::updating(function ($record) {
      if (empty($record->updated_by)) {
        $record->updated_by = auth()->user()->username;
      }
    });
  }
}
