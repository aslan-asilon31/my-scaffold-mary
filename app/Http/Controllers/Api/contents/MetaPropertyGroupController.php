<?php

namespace App\Http\Controllers\Api\contents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductContent;
use App\Models\ProductContentDisplay;
use App\Models\ProductContentFeature;
use App\Models\ProductContentMarketplace;
use App\Models\ProductContentMeta;
use App\Models\ProductContentQna;
use App\Models\ProductContentReview;
use App\Models\ProductContentReviewImage;
use App\Models\ProductContentReviewSpecification;
use App\Models\ProductContentReviewVideo;
use App\Models\MetaPropertyGroup;
use App\Models\MetaProperty;
use App\Models\ProductBrand;
use App\Models\CategoryRecommendation;
use App\Models\Marketplace;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Page;
use App\Models\Permission;
use App\Models\Customer;
use App\Models\ProductSales;
use App\Models\SalesOrder;
use Illuminate\Support\Facades\DB;

class MetaPropertyGroupController extends Controller
{

    public function index(Request $request)
    {
        DB::beginTransaction();

        try {
            $products = Product::with('productContent')->get();

            if ($products->isEmpty()) {

                DB::rollBack();
                return response()->json([
                    "message" => "failed",
                    "error" => "No products found"
                ], 404); 
            }

            DB::commit();

            $pass = [
                "data" => $products,
                "links" => [
                    "first" => "http://site.test/api/v1/post?page=1",
                    "last" => "http://site.test/api/v1/post?page=8",
                    "prev" => null,
                    "next" => "http://site.test/api/v1/post?page=2"
                ],
                "meta" => [
                    "total" => $products->count(),
                    "per_page" => 15
                ],
                "message" => "success!"
            ];
            return response()->json($pass);
    
        } catch (\Exception $e) {

            \Log::error('Data failed : ' . $e->getMessage());  

            DB::rollBack();
            return response()->json([
                "message" => "failed",
                "error" => $e->getMessage()
            ], 500); 
        }

    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $product = Product::create($validated);

            DB::commit();
            return response()->json([
                "message" => "Product created successfully",
                "data" => $product
            ], 201); 
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                "message" => "failed",
                "error" => $e->getMessage()
            ], 500);
        }
    }

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

    public function update(Request $request, string $id)
    {
        DB::beginTransaction();

        try {
            // Validate request data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $product = Product::findOrFail($id);
            $product->update($validated);

            DB::commit();
            return response()->json([
                "message" => "Product updated successfully",
                "data" => $product
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                "message" => "failed",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();

        try {
            $product = Product::findOrFail($id);
            $product->delete();

            DB::commit();
            return response()->json([
                "message" => "Product deleted successfully"
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                "message" => "failed",
                "error" => $e->getMessage()
            ], 500);
        }
    }

}
