<?php

namespace App\Http\Controllers\Admin\Product;

use App\DataTables\ProductCategoryDataTable;
use App\Http\Requests\CreateProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Repositories\ProductCategoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Image;

class ProductCategoryController extends AppBaseController
{
    /** @var ProductCategoryRepository $productCategoryRepository*/
    private $productCategoryRepository;

    public function __construct(ProductCategoryRepository $productCategoryRepo)
    {
        $this->productCategoryRepository = $productCategoryRepo;
//        $this->middleware('permission:product-category-list|product-category-create|product-category-edit|product-category-delete', ['only' => ['index','show']]);
//        $this->middleware('permission:product-category-create', ['only' => ['create','store']]);
//        $this->middleware('permission:product-category-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:product-category-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the ProductCategory.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(ProductCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.product_categories.index');
    }

    /**
     * Show the form for creating a new ProductCategory.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->productCategoryRepository->all();
        return view('admin.product_categories.create', compact('categories'));
    }

    /**
     * Store a newly created ProductCategory in storage.
     *
     * @param CreateProductCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateProductCategoryRequest $request)
    {
        $input = $request->all();
       $input = $request->all();
        $image =  $input['image'] ?? null;
        $imgName = null;
        if(!empty($image)){
            // for save original image
            $img = Image::make($image);
            $imgPath = 'uploads/product_category/';
            $imgName =time().$image->getClientOriginalName();
            $img =  $img->save($imgPath.$imgName);
            $input['image']=$imgName;
        }


        $productCategory = $this->productCategoryRepository->create([
            'name' => [
                'en' => $input['name_en'],
                'ar' => $input['name_ar'],
            ],
            'image' => $imgName,
            'parent_id' => $input['parent_id'],
            'status' => $input['status'],
        ]);

      //  $productCategory = $this->productCategoryRepository->create($input);

        $messages = ['success' => "Successfully added", 'redirect' => route('productCategories.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Display the specified ProductCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productCategory = $this->productCategoryRepository->find($id);

        if (empty($productCategory)) {
            $messages = ['success' => "Product Category not found", 'redirect' => route('productCategories.index')];
            return response()->json(['messages' => $messages]);

        }

        return view('admin.product_categories.show', compact('productCategory'));
    }

    /**
     * Show the form for editing the specified ProductCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productCategory = $this->productCategoryRepository->find($id);
        $categories = $this->productCategoryRepository->all();
        if (empty($productCategory)) {
            $messages = ['success' => "Product Category not found", 'redirect' => route('productCategories.index')];
            return response()->json(['messages' => $messages]);
        }

        return view('admin.product_categories.edit', compact('productCategory', 'categories'));
    }

    /**
     * Update the specified ProductCategory in storage.
     *
     * @param int $id
     * @param UpdateProductCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductCategoryRequest $request)
    {
        $productCategory = $this->productCategoryRepository->find($id);

        if (empty($productCategory)) {
            $messages = ['success' => "Product Category not found", 'redirect' => route('productCategories.index')];
            return response()->json(['messages' => $messages]);
        }
        $input = $request->all();
        $productCategory = $this->productCategoryRepository->update($input, $id);

        $messages = ['success' => "Successfully updated", 'redirect' => route('productCategories.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Remove the specified ProductCategory from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $productCategory = $this->productCategoryRepository->find($id);

        if (empty($productCategory)) {
            $messages = ['success' => "Product Category not found", 'redirect' => route('productCategories.index')];
            return response()->json(['messages' => $messages]);
        }

        $this->productCategoryRepository->delete($id);


        $messages = ['success' => "Successfully updated", 'redirect' => route('product_categories.index')];
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

        $this->productCategoryRepository->bulkDelete($request->ids);

        $messages = ['success' => "Successfully deleted", 'redirect' => route('product_categories.index')];
        return response()->json(['messages' => $messages]);
    }

}
