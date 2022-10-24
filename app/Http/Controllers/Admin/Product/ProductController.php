<?php

namespace App\Http\Controllers\Admin\Product;

use App\DataTables\ProductDataTable;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\ProductImage;
use App\Repositories\ProductRepository;
use App\Repositories\ProductCategoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Image;

class ProductController extends AppBaseController
{
    /** @var ProductRepository $productRepository*/
    private $productRepository , $productCategoryRepository;

    public function __construct(ProductRepository $productRepo , ProductCategoryRepository $productCategoryRepo)
    {
        $this->productRepository = $productRepo;
        $this->productCategoryRepository = $productCategoryRepo;
    }


    /**
     * Display a listing of the Product.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.products.index');
    }


    /**
     * Show the form for creating a new Product.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->productCategoryRepository->all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param CreateProductRequest $request
     *
     * @return Response
     */
    public function store(CreateProductRequest $request)
    {
        $input = $request->all();

        $product = $this->productRepository->createProduct($input);

        $images = $request->file('images');

        if(!empty($images)){

            foreach ($images as $image){
                $img = Image::make($image);
                $imgPath = 'uploads/product/';
                $imgName =time().$image->getClientOriginalName();
                $img =  $img->save($imgPath.$imgName);
                $productimage = ProductImage::create([
                    'image' =>$imgName,
                    'product_id' =>$product->id,
                ]);
            }
        }

        $messages = ['success' => "Successfully added", 'redirect' => route('products.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Display the specified Product.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            $messages = ['success' => "Product not found", 'redirect' => route('products.index')];
            return response()->json(['messages' => $messages]);

        }

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified Product.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->find($id);
        $categories = $this->productCategoryRepository->all();

        if (empty($product)) {
            $messages = ['success' => "Product not found", 'redirect' => route('products.index')];
            return response()->json(['messages' => $messages]);
        }

        return view('admin.products.edit', compact('product','categories'));
    }

    /**
     * Update the specified Product in storage.
     *
     * @param int $id
     * @param UpdateProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductRequest $request)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            $messages = ['success' => "Product not found", 'redirect' => route('products.index')];
            return response()->json(['messages' => $messages]);
        }

        $input = $request->all();

        $product = $this->productRepository->update($input, $id);
        $images = $request->file('images');
        if(!empty($images)){

            foreach ($images as $image){
                $img = Image::make($image);
                $imgPath = 'uploads/product/';
                $imgName =time().$image->getClientOriginalName();
                $img =  $img->save($imgPath.$imgName);
                $product->images()->create([
                    'image' =>$imgName,
                ]);
            }
        }

        $messages = ['success' => "Successfully updated", 'redirect' => route('products.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Remove the specified Product from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            $messages = ['success' => "Product not found", 'redirect' => route('products.index')];
            return response()->json(['messages' => $messages]);
        }

        $this->productRepository->delete($id);

        $messages = ['success' => "Successfully deleted", 'redirect' => route('products.index')];
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

        $this->productRepository->bulkDelete($request->ids);

        $messages = ['success' => "Successfully deleted", 'redirect' => route('products.index')];
        return response()->json(['messages' => $messages]);
    }

}
