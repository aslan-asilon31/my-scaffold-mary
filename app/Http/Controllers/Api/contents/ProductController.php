<?php

namespace App\Http\Controllers\Api\contents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $records = Product::with('productContent')->orderBy('created_at', 'desc')->paginate(20);
        return response()->json([
          'success' => true,
          'data' => $records,
        ], Response::HTTP_OK);
 
    }

    public function fetchById($id)
    {
        $products = Product::with('productContent')->where('products.id',$id)->get();
        return response()->json($products, 200);
    }
    
    // public function index(Request $request)
    // {
    //     DB::beginTransaction();
    //     try {
    //         $products = Product::with('productContent')->get();

    //         if ($products->isEmpty()) {

    //             DB::rollBack();
    //             return response()->json([
    //                 "message" => "failed",
    //                 "error" => "No products found"
    //             ], 404); 
    //         }

    //         DB::commit();

    //         $pass = [
    //             "data" => $products,
    //             "links" => [
    //                 "first" => "http://site.test/api/v1/post?page=1",
    //                 "last" => "http://site.test/api/v1/post?page=8",
    //                 "prev" => null,
    //                 "next" => "http://site.test/api/v1/post?page=2"
    //             ],
    //             "meta" => [
    //                 "total" => $products->count(),
    //                 "per_page" => 15,
    //                 "title"=>"Product",
    //             ],
    //             "message" => "success!"
    //         ];
    //         return response()->json($pass);
    
    //     } catch (\Exception $e) {

    //         \Log::error('Data failed : ' . $e->getMessage());  

    //         DB::rollBack();
    //         return response()->json([
    //             "message" => "failed",
    //             "error" => $e->getMessage()
    //         ], 500); 
    //     }

    // }


    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            // 'product_category_first_id' => 'required|string',
            // 'product_brand_id' => 'required|string',
            'name' => 'required|string|max:255',
            'selling_price' => 'required|numeric|min:0',
            // 'discount_persentage' => 'nullable|numeric|min:0|max:100',
            // 'discount_value' => 'nullable|numeric|min:0',
            // 'nett_price' => 'required|numeric|min:0',
            // 'availability' => 'required|string',
            
        ]);

        // Buat produk baru
        $product = Product::create($validatedData);

        return response()->json([
            'data' => $product, // Menempatkan produk di dalam atribut 'data'
            'status' => 200 // Menambahkan status
        ], 200);

        // return response()->json($product, 200);
    }


    // public function store(Request $request)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $validated = $request->validate([
    //             'name' => 'required|string|max:255',
    //         ]);

    //         $product = Product::create($validated);

    //         DB::commit();
    //         return response()->json([
    //             "message" => "Product created successfully",
    //             "data" => $product
    //         ], 201); 
            
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json([
    //             "message" => "failed",
    //             "error" => $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function show(string $id)
    {
        try {
            $product = Product::with('productContent')->findOrFail($id);
            return response()->json([
                "message" => "success",
                "data" => $product
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "failed",
                "error" => "Product not found"
            ], 404);
        }
    }

    // public function update(Request $request, string $id)
    // {
    //     DB::beginTransaction();

    //     try {
    //         // Validate request data
    //         $validated = $request->validate([
    //             'name' => 'required|string|max:255',
    //         ]);

    //         $product = Product::findOrFail($id);
    //         $product->update($validated);

    //         DB::commit();
    //         return response()->json([
    //             "message" => "Product updated successfully",
    //             "data" => $product
    //         ]);
            
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json([
    //             "message" => "failed",
    //             "error" => $e->getMessage()
    //         ], 500);
    //     }
    // }

    // public function destroy(string $id)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $product = Product::findOrFail($id);
    //         $product->delete();

    //         DB::commit();
    //         return response()->json([
    //             "message" => "Product deleted successfully"
    //         ]);
            
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json([
    //             "message" => "failed",
    //             "error" => $e->getMessage()
    //         ], 500);
    //     }
    // }


    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'selling_price' => 'required|numeric',
        ]);
    
        // Temukan produk berdasarkan ID
        $product = Product::findOrFail($id);
    
        // Perbarui produk dengan data yang divalidasi
        $product->update($validatedData);
    
        return response()->json([
            'status' => 200,
            'data' => $product,
        ]);
    }
    

    public function destroy($id)
    {
        
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }

}
