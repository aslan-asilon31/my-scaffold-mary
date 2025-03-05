<x-menu activate-by-route>

    {{-- User --}}
    @if ($user = auth()->user()->employee)
        <x-menu-sub title="Setting" icon="o-cog-6-tooth">
        <x-menu-item title="Profile" icon="o-user-circle" link="#" />
        <x-menu-item wire:click="logout" title="Logout" icon="o-x-circle" />
        {{-- <x-menu-item title="sample" icon="o-arrow-right-circle" link="#" /> --}}
        </x-menu-sub>
        <x-menu-separator />
    @endif
  
  
    <x-menu-item title="Dashboard" icon="o-home" link="/"  :class="request()->is('dashboard') ? 'active' : ''" />
    <x-menu-separator title="Management" icon="o-sparkles" />
    <x-menu-item title="Employee" icon="o-squares-2x2" link="/employees" :class="request()->is('employees') ? 'active' : ''" />
    <x-menu-item title="Employee Account" icon="o-squares-2x2" link="/employee-accounts" :class="request()->is('employee-accounts') ? 'active' : ''" />
    <x-menu-item title="Position" icon="o-squares-2x2" link="/positions" :class="request()->is('positions') ? 'active' : ''" />
    <x-menu-item title="Page" icon="o-squares-2x2" link="/pages" :class="request()->is('pages') ? 'active' : ''" />
    <x-menu-item title="Permission" icon="o-squares-2x2" link="/permissions" :class="request()->is('permissions') ? 'active' : ''" />
  
    <x-menu-separator title="Content" icon="o-sparkles" />
  
    {{-- <x-menu-item title="Marketplace" icon="o-squares-2x2" link="/marketplaces" :class="request()->is('marketplaces') ? 'active' : ''" /> --}}
  
    <x-menu-item title="Meta Property Group" icon="o-squares-2x2" link="/meta-property-groups" :class="request()->is('meta-property-groups') ? 'active' : ''" />
  
    <x-menu-item title="Meta Property " icon="o-squares-2x2" link="/meta-properties" :class="request()->is('meta-properties') ? 'active' : ''" />
  
    <x-menu-item title="Product Category 1" icon="o-squares-2x2" link="/product-category-firsts" :class="request()->is('product-category-firsts') ? 'active' : ''" />
    <x-menu-item title="Product Category 2" icon="o-squares-2x2" link="/product-category-seconds" :class="request()->is('product-category-seconds') ? 'active' : ''" />

    <x-menu-item title="Product Brand " icon="o-squares-2x2" link="/product-brands" :class="request()->is('product-brands') ? 'active' : ''" />
        
    <x-menu-item title="Product " icon="o-squares-2x2" link="/products" :class="request()->is('products') ? 'active' : ''" />
  
    <x-menu-item title="Product Content" icon="o-squares-2x2" link="/product-contents" :class="request()->is('product-contents') ? 'active' : ''" />
  
    <x-menu-item title="Category Recommendation" icon="o-squares-2x2" link="/category-recommendations" :class="request()->is('category-recommendations') ? 'active' : ''" />


    <x-menu-separator title="Sales" icon="o-sparkles" />
    <x-menu-item title="Customer" icon="o-squares-2x2" link="/customers" />
    <x-menu-item title="Sales Order " badge="{{ $salesOrderStatusPending->count() }} pending" badge-classes="!badge-warning" icon="o-squares-2x2" link="/sales-orders" :class="request()->is('products') ? 'active' : ''"    />
  
  </x-menu>
  