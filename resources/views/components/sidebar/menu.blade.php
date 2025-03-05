<a {{ $attributes }}
  class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
  wire:navigate>
  <x-icon.menu />
  {{ $slot }}
</a>
