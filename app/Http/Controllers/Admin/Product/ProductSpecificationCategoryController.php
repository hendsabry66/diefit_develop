<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Requests\CreateProductSpecificationCategoryRequest;
use App\Http\Requests\UpdateProductSpecificationCategoryRequest;
use App\Repositories\ProductSpecificationCategoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\DataTables\ProductSpecificationCategoryDataTable;
use Flash;
use Response;

class ProductSpecificationCategoryController extends AppBaseController
{
    /** @var ProductSpecificationCategoryRepository $productSpecificationCategoryRepository*/
    private $productSpecificationCategoryRepository;

    public function __construct(ProductSpecificationCategoryRepository $productSpecificationCategoryRepo)
    {
        $this->productSpecificationCategoryRepository = $productSpecificationCategoryRepo;
        $this->middleware('permission:product-specification-category-list|product-specification-category-create|product-specification-category-edit|product-specification-category-delete', ['only' => ['index','show']]);
        $this->middleware('permission:product-specification-category-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-specification-category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:product-specification-category-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the ProductSpecificationCategory.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(ProductSpecificationCategoryDataTable $productSpecificationCategoryDataTable)
    {

        return $productSpecificationCategoryDataTable->render('admin.product_specification_categories.index');
    }


    /**
     * Show the form for creating a new ProductSpecificationCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.product_specification_categories.create');
    }

    /**
     * Store a newly created ProductSpecificationCategory in storage.
     *
     * @param CreateProductSpecificationCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateProductSpecificationCategoryRequest $request)
    {
        $input = $request->all();

        $productSpecificationCategory = $this->productSpecificationCategoryRepository->createProductSpecificationCategory($input);

        $messages = ['success' => "Successfully added", 'redirect' => route('ProductSpecificationCategory.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Display the specified ProductSpecificationCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productSpecificationCategory = $this->productSpecificationCategoryRepository->find($id);

        if (empty($productSpecificationCategory)) {
            $messages = ['success' => "Product Specification Category not found", 'redirect' => route('ProductSpecificationCategory.index')];
            return response()->json(['messages' => $messages]);

        }

        return view('admin.product_specification_categories.show', compact('productSpecificationCategory'));
    }

    /**
     * Show the form for editing the specified ProductSpecificationCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productSpecificationCategory = $this->productSpecificationCategoryRepository->find($id);

        if (empty($productSpecificationCategory)) {
            $messages = ['success' => "Product Specification Category not found", 'redirect' => route('ProductSpecificationCategory.index')];
            return response()->json(['messages' => $messages]);

        }

        return view('admin.product_specification_categories.edit', compact('productSpecificationCategory'));
    }

    /**
     * Update the specified ProductSpecificationCategory in storage.
     *
     * @param int $id
     * @param UpdateProductSpecificationCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductSpecificationCategoryRequest $request)
    {
        $productSpecificationCategory = $this->productSpecificationCategoryRepository->find($id);

        if (empty($productSpecificationCategory)) {
            $messages = ['success' => "Product Specification Category not found", 'redirect' => route('ProductSpecificationCategory.index')];
            return response()->json(['messages' => $messages]);

        }
        $input = $request->all();

        $productSpecificationCategory = $this->productSpecificationCategoryRepository->updateProductSpecificationCategory($input, $id);
        $messages = ['success' => "Successfully updated", 'redirect' => route('ProductSpecificationCategory.index')];
        return response()->json(['messages' => $messages]);

    }

    /**
     * Remove the specified ProductSpecificationCategory from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $productSpecificationCategory = $this->productSpecificationCategoryRepository->find($id);

        if (empty($productSpecificationCategory)) {
            $messages = ['success' => "Product Specification Category not found", 'redirect' => route('ProductSpecificationCategory.index')];
            return response()->json(['messages' => $messages]);

        }

        $this->productSpecificationCategoryRepository->delete($id);

        $messages = ['success' => "Successfully deleted", 'redirect' => route('ProductSpecificationCategory.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Bulk delete
     * @param Request $request
     *
     * @return \Illuminate\Support\Facades\Redirect
     *
     * @throws \Exception
     */
    public function bulkDelete(Request $request) {
        if (! $request->ids) {
            flash('قبل التأكيد على الاختيار المتعدد . من فضلك اختر من القائمة اولا')->error();
            return redirect()->back();
        }

        $this->productSpecificationCategoryRepository->bulkDelete($request->ids);

        $messages = ['success' => "Successfully deleted", 'redirect' => route('ProductSpecificationCategory.index')];
        return response()->json(['messages' => $messages]);
    }
}
