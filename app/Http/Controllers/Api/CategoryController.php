<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Services\CategoryService;
use Illuminate\Validation\ValidationException;
use Log;


class CategoryController extends Controller
{

    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->middleware('auth:sanctum');
    }

    public function add(StoreCategoryRequest $request)
    {
        try {
            $category = $this->categoryService->createcategory($request->validated());
            return response()->json(['data' => ['message' => __('api_message.category_added'), 'data' => $category]], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::info("Error in add category : " . $e->getMessage());
            return response()->json(['data' => ['errors' => 'Something went wrong!']], 500);
        }
    }

    public function list(Request $request)
    {
        try {
            $limit = $request->input('limit', 10);
            $offset = $request->input('offset', 1);
            $categories = $this->categoryService->getAllCategory($limit, $offset);
            return response()->json([
                'data' => [
                    'message' => __('api_message.category_list'),
                    'categories' => $categories->items(),
                    'meta' => [
                        'total_records' => $categories->total(),
                        'current_page' => $categories->currentPage(),
                        'total_pages' => $categories->lastPage(),
                        'per_page' => $categories->perPage(),
                    ]
                ]
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::info("Error in category list: " . $e->getMessage());
            return response()->json(['data' => ['errors' => 'Something went wrong!']], 500);
        }
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $category = $this->categoryService->updateCategory($id, $validatedData);
            return response()->json(['data' => ['message' => __('api_message.category_updated'), 'data' => $category]], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::info("Error in update category: " . $e->getMessage());
            return response()->json(['data' => ['errors' => 'Something went wrong!']], 500);
        }
    }

    public function delete($id)
    {
        try {
            $this->categoryService->deleteCategory($id);
            return response()->json(['data' => ['message' => __('api_message.category_deleted')]], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::info("Error in delete category: " . $e->getMessage());
            return response()->json(['data' => ['errors' => 'Something went wrong!']], 500);
        }
    }
}
