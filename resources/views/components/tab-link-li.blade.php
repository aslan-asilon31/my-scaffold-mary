@props(['href' => '', 'isActivated' => false])

<li class="me-2">
  <a href="{{ $href ? $href : '#' }}"
    class="inline-block p-2 border-b-2 border-transparent rounded-t-lg {{ $isActivated ? 'text-blue-600 border-blue-600 active' : 'hover:text-gray-600 hover:border-gray-300' }}"
    wire:navigate>
    {{ $slot }}
  </a>
</li>
