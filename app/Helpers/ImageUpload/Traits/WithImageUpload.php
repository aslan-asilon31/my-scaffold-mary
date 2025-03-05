<?php

namespace App\Helpers\ImageUpload\Traits;

trait WithImageUpload
{
  protected function saveImage($folderName = 'files/images', $imageName = null, $newImageUrl = null, $oldImageUrl = null, $disk = 'public')
  {

    if ($newImageUrl instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
      $ext = $newImageUrl->getClientOriginalExtension();
      $imageName = $imageName . '.' . $ext;
      $imageUrl = $newImageUrl->storeAs($folderName, $imageName, $disk);
      $imageUrl = '/' . $imageUrl;

      if ($oldImageUrl && \Illuminate\Support\Facades\Storage::disk($disk)->exists($oldImageUrl)) {
        \Illuminate\Support\Facades\Storage::disk($disk)->delete($oldImageUrl);
      }

      return $imageUrl;
    }

    if (!$newImageUrl && $oldImageUrl && \Illuminate\Support\Facades\Storage::disk($disk)->exists($oldImageUrl)) {
      \Illuminate\Support\Facades\Storage::disk($disk)->delete($oldImageUrl);
      return null;
    }

    return $newImageUrl;
  }

  protected function deleteImage($imageUrl = null, $disk = 'public')
  {
    if ($imageUrl && \Illuminate\Support\Facades\Storage::disk($disk)->exists($imageUrl)) {
      \Illuminate\Support\Facades\Storage::disk($disk)->delete($imageUrl);
    }
  }
}
