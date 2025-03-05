@props(['fieldId' => null, 'activatedTab' => ''])

<x-tab-link>
  @if ($fieldId)
    <x-tab-link-li href="/product-contents/edit/{{ $fieldId }}" :isActivated="$activatedTab == 'product-contents'">
      Content
    </x-tab-link-li>
    <x-tab-link-li href="/product-contents/edit/{{ $fieldId }}/metas" :isActivated="$activatedTab == 'product-content-metas'">
      Meta
    </x-tab-link-li>
    <x-tab-link-li href="/product-contents/edit/{{ $fieldId }}/displays" :isActivated="$activatedTab == 'product-content-displays'">
      Display
    </x-tab-link-li>
    <x-tab-link-li href="/product-contents/edit/{{ $fieldId }}/videos" :isActivated="$activatedTab == 'product-content-videos'">
      Video
    </x-tab-link-li>
    <x-tab-link-li href="/product-contents/edit/{{ $fieldId }}/specifications" :isActivated="$activatedTab == 'product-content-specifications'">
      Specification
    </x-tab-link-li>
    <x-tab-link-li href="/product-contents/edit/{{ $fieldId }}/features" :isActivated="$activatedTab == 'product-content-features'">
      Feature
    </x-tab-link-li>
    <x-tab-link-li href="/product-contents/edit/{{ $fieldId }}/reviews" :isActivated="$activatedTab == 'product-content-reviews'">
      Review
    </x-tab-link-li>
    <x-tab-link-li href="/product-contents/edit/{{ $fieldId }}/review-images" :isActivated="$activatedTab == 'product-content-review-images'">
      Review Image
    </x-tab-link-li>
    <x-tab-link-li href="/product-contents/edit/{{ $fieldId }}/qnas" :isActivated="$activatedTab == 'product-content-qnas'">
      QnA
    </x-tab-link-li>
  @endif

</x-tab-link>
