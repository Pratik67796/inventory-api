<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Requests\Product\UpdateInventoryRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Log;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
        $this->middleware('auth:sanctum');
    }

    public function add(StoreProductRequest $request)
    {
        try {
            $product = $this->productService->createProduct($request->validated());
            return response()->json([
                'data' => [
                    'message' => __('api_message.product_added'),
                    'data' => $product
                ]
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::info("Error in add product: " . $e->getMessage());
            return response()->json(['data' => ['errors' => 'Something went wrong!']], 500);
        }
    }


    public function list(Request $request)
    {
        try {
            $filters = $request->only(['category_id', 'min_price', 'max_price', 'stock']);
            $limit = $request->input('limit', 10);
            $offset = $request->input('offset', 1);
            $products = $this->productService->filterProducts($filters, $limit, $offset);

            return response()->json([
                'data' => [
                    'message' => __('api_message.product_list'),
                    'products' => $products->items(),
                    'meta' => [
                        'total_records' => $products->total(),
                        'current_page' => $products->currentPage(),
                        'total_pages' => $products->lastPage(),
                        'per_page' => $products->perPage(),
                    ]
                ]
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::info("Error in product list: " . $e->getMessage());
            return response()->json(['data' => ['errors' => 'Something went wrong!']], 500);
        }
    }

    public function show($id)
    {
        try {
            $product = $this->productService->getProduct($id);
            return response()->json([
                'data' => [
                    'message' => __('api_message.product_detail'),
                    'data' => $product
                ]
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::info("Error in get product detail: " . $e->getMessage());
            return response()->json(['data' => ['errors' => 'Product not found']], 404);
        }
    }

    public function update(UpdateProductRequest $request, $id)
    {
        try {
            $product = $this->productService->updateProduct($id, $request->validated());
            return response()->json([
                'data' => [
                    'message' => __('api_message.product_updated'),
                    'data' => $product
                ]
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::info("Error in update product: " . $e->getMessage());
            return response()->json(['data' => ['errors' => 'Something went wrong!']], 500);
        }
    }

    public function delete($id)
    {
        try {
            $this->productService->deleteProduct($id);
            return response()->json(['data' => ['message' => __('api_message.product_deleted')]], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::info("Error in delete product: " . $e->getMessage());
            return response()->json(['data' => ['errors' => 'Something went wrong!']], 500);
        }
    }

    public function updateInventory(UpdateInventoryRequest $request, $id)
    {
        try {
            $product = $this->productService->updateInventory(
                $id,
                $request->quantity,
                $request->type,
                auth()->id(),
                $request->notes
            );

            return response()->json([
                'data' => [
                    'message' => __('api_message.inventory_updated'),
                    'data' => $product
                ]
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::info("Error in update inventory: " . $e->getMessage());
            return response()->json(['data' => ['errors' => 'Something went wrong!']], 400);
        }
    }
}