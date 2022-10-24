<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Requests\CreateProductSpecificationRequest;
use App\Http\Requests\UpdateProductSpecificationRequest;
use App\Repositories\ProductSpecificationRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductSpecificationCategoryRepository;
use App\Http\Controllers\AppBaseController;
use App\DataTables\ProductSpecificationDataTable;
use Illuminate\Http\Request;
use Flash;
use Response;

class ProductSpecificationController extends AppBaseController
{
    /** @var ProductSpecificationRepository $productSpecificationRepository*/
    private $productSpecificationRepository , $productRepository , $productSpecificationCategoryRepository;

    public function __construct(ProductSpecificationRepository $productSpecificationRepo , ProductRepository $productRepo , ProductSpecificationCategoryRepository $productSpecificationCategoryRepo)
    {
        $this->productSpecificationRepository = $productSpecificationRepo;
        $this->productRepository = $productRepo;
        $this->productSpecificationCategoryRepository = $productSpecificationCategoryRepo;
    }


    /**
     * Display a listing of the ProductSpecification.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(ProductSpecificationDataTable $dataTable , Request $request)
    {
        return $dataTable->render('admin.product_specifications.index');
    }


    /**
     * Show the form for creating a new ProductSpecification.
     *
     * @return Response
     */
    public function create()
    {
        $products = $this->productRepository->all();
        $productSpecificationCategories = $this->productSpecificationCategoryRepository->all();
        return view('admin.product_specifications.create', compact('products' , 'productSpecificationCategories'));
    }

    /**
     * Store a newly created ProductSpecification in storage.
     *
     * @param CreateProductSpecificationRequest $request
     *
     * @return Response
     */
    public function store(CreateProductSpecificationRequest $request)
    {
        $input = $request->all();

        $productSpecification = $this->productSpecificationRepository->createProductSpecification($input);

        $messages = ['success' => "Successfully addes", 'redirect' => route('ProductSpecification.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Display the specified ProductSpecification.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productSpecification = $this->productSpecificationRepository->find($id);

        if (empty($productSpecification)) {
            $messages = ['success' => "Product Specification not found", 'redirect' => route('ProductSpecification.index')];
            return response()->json(['messages' => $messages]);
           }

        return view('admin.product_specifications.show', compact('productSpecification'));
    }

    /**
     * Show the form for editing the specified ProductSpecification.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productSpecification = $this->productSpecificationRepository->find($id);
        $products = $this->productRepository->all();
        $productSpecificationCategories = $this->productSpecificationCategoryRepository->all();

        if (empty($productSpecification)) {
            $messages = ['success' => "Product Specification not found", 'redirect' => route('ProductSpecification.index')];
            return response()->json(['messages' => $messages]);
        }

        return view('admin.product_specifications.edit', compact('productSpecification' , 'products' , 'productSpecificationCategories'));
    }

    /**
     * Update the specified ProductSpecification in storage.
     *
     * @param int $id
     * @param UpdateProductSpecificationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductSpecificationRequest $request)
    {
        $productSpecification = $this->productSpecificationRepository->find($id);

        if (empty($productSpecification)) {
            $messages = ['success' => "Product Specification not found", 'redirect' => route('ProductSpecification.index')];
            return response()->json(['messages' => $messages]);
        }

        $input = $request->all();

        $productSpecification = $this->productSpecificationRepository->updateProductSpecification($input, $id);

        $messages = ['success' => "Successfully updated", 'redirect' => route('ProductSpecification.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Remove the specified ProductSpecification from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $productSpecification = $this->productSpecificationRepository->find($id);

        if (empty($productSpecification)) {
            $messages = ['success' => "Product Specification not found", 'redirect' => route('ProductSpecification.index')];
            return response()->json(['messages' => $messages]);
        }

        $this->productSpecificationRepository->delete($id);

        $messages = ['success' => "Successfully updated", 'redirect' => route('ProductSpecification.index')];
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

        $this->productSpecificationRepository->bulkDelete($request->ids);

        $messages = ['success' => "Successfully deleted", 'redirect' => route('ProductSpecification.index')];
        return response()->json(['messages' => $messages]);
    }
}
