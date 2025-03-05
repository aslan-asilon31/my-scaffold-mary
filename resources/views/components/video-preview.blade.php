@props(['videoUrl' => null])

@if ($videoUrl)
  <div>
    @if ($videoUrl instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
      @php
        $temporartyVideoUrl = '/' . basename($videoUrl->getPath()) . '/' . $videoUrl->getFilename();
      @endphp
      <a href="{{ $temporartyVideoUrl }}" target="_blank" class="text-blue-500">
        Video Preview
      </a>
      <div class="w-full break-all">
        {{ $temporartyVideoUrl }}
      </div>
    @else
      <a href="{{ $videoUrl }}" target="_blank" class="text-blue-500">
        Video Preview
      </a>
      <div class="w-full break-all">
        {{ $videoUrl }}
      </div>
    @endif
  </div>
@endif
