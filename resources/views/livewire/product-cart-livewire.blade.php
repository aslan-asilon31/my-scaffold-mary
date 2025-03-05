<div>
    <h1 class="text-2xl font-bold mb-4">{{ $title }}</h1>
    @if(count($products) > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">Product Name</th>
                        <th class="border border-gray-300 px-4 py-2">Quantity</th>
                        <th class="border border-gray-300 px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $product['name'] }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <button wire:click="editCart({{ $product['id'] }})" class="text-blue-500">Edit</button>
                                <button wire:click="deleteCart({{ $product['id'] }})" class="text-red-500">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>No products found.</p>
    @endif

    <!-- Form untuk Edit Produk -->
    <div class="mt-4">
        <h2 class="text-xl font-semibold">Edit Product</h2>
        <form wire:submit.prevent="update">
            <input type="hidden" wire:model="productId">
            <div class="mb-4">
                <label for="name" class="block">Product Name</label>
                <input type="text" id="name" wire:model="name" class="border border-gray-300 px-2 py-1 w-full" required>
            </div>
            <div class="mb-4">
                <label for="price" class="block">Price</label>
                <input type="number" id="price" wire:model="price" class="border border-gray-300 px-2 py-1 w-full" required>
            </div>
            <div class="mb-4">
                <label for="amount" class="block">Quantity</label>
                <input type="number" id="amount" wire:model="amount" class="border border-gray-300 px-2 py-1 w-full" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2">Update Product</button>
        </form>
    </div>

    <br> <br>

            <!-- Produk Terlaris -->
            <x-frontend.produk-terlaris1 :products5="$products5" lazy="on-load"/>


</div>
