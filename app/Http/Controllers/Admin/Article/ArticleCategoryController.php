<?php

namespace App\Http\Controllers\Admin\Article;

use App\DataTables\ArticleCategoryDataTable;
use App\Http\Requests\CreateArticleCategoryRequest;
use App\Http\Requests\UpdateArticleCategoryRequest;
use App\Repositories\ArticleCategoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Image;

class ArticleCategoryController extends AppBaseController
{
    /** @var ArticleCategoryRepository $articleCategoryRepository*/
    private $articleCategoryRepository;

    public function __construct(ArticleCategoryRepository $articleCategoryRepo)
    {
        $this->articleCategoryRepository = $articleCategoryRepo;
//        $this->middleware('permission:article-category-list|article-category-create|article-category-edit|article-category-delete', ['only' => ['index','show']]);
//        $this->middleware('permission:article-category-create', ['only' => ['create','store']]);
//        $this->middleware('permission:article-category-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:article-category-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the ArticleCategory.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(ArticleCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.article_categories.index');
    }


    /**
     * Show the form for creating a new ArticleCategory.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->articleCategoryRepository->all();
        return view('admin.article_categories.create',compact('categories'));
    }

    /**
     * Store a newly created ArticleCategory in storage.
     *
     * @param CreateArticleCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateArticleCategoryRequest $request)
    {

        $articleCategory = $this->articleCategoryRepository->createArticleCategory($request->all());
        $messages = ['success' => "Successfully added", 'redirect' => route('article_categories.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Display the specified ArticleCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $articleCategory = $this->articleCategoryRepository->find($id);

        if (empty($articleCategory)) {
            $messages = ['success' => "Article Category not found", 'redirect' => route('article_categories.index')];
            return response()->json(['messages' => $messages]);
        }

        return view('admin.article_categories.show',compact('articleCategory'));
    }

    /**
     * Show the form for editing the specified ArticleCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $articleCategory = $this->articleCategoryRepository->find($id);
        $categories = $this->articleCategoryRepository->all();

        if (empty($articleCategory)) {
            $messages = ['success' => "Article Category not found", 'redirect' => route('article_categories.index')];
            return response()->json(['messages' => $messages]);

        }

        return view('admin.article_categories.edit',compact('articleCategory','categories'));
    }

    /**
     * Update the specified ArticleCategory in storage.
     *
     * @param int $id
     * @param UpdateArticleCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateArticleCategoryRequest $request)
    {
        $articleCategory = $this->articleCategoryRepository->find($id);

        if (empty($articleCategory)) {
            $messages = ['success' => "Article Category not found", 'redirect' => route('article_categories.index')];
            return response()->json(['messages' => $messages]);

        }

        $articleCategory = $this->articleCategoryRepository->updateArticleCategory($id, $request->all());

        $messages = ['success' => "Successfully updated", 'redirect' => route('article_categories.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Remove the specified ArticleCategory from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $articleCategory = $this->articleCategoryRepository->find($id);

        if (empty($articleCategory)) {
            $messages = ['success' => "Article Category not found", 'redirect' => route('article_categories.index')];
            return response()->json(['messages' => $messages]);

        }

        $this->articleCategoryRepository->delete($id);

        $messages = ['success' => "Successfully updated", 'redirect' => route('article_categories.index')];
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

        $this->articleCategoryRepository->bulkDelete($request->ids);

        $messages = ['success' => "Successfully deleted", 'redirect' => route('article_categories.index')];
        return response()->json(['messages' => $messages]);
    }

}
