<?php

namespace App\Http\Controllers\Admin\Article;

use App\DataTables\ArticleDataTable;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Repositories\ArticleRepository;
use App\Repositories\ArticleCategoryRepository;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Image;

class ArticleController extends AppBaseController
{
    /** @var ArticleRepository $articleRepository*/
    private $articleRepository;
    private $articleCategoryRepository;
    private $userRepository;

    public function __construct(ArticleRepository $articleRepo , ArticleCategoryRepository $articleCategoryRepo ,UserRepository $userRepo)
    {
        $this->articleCategoryRepository = $articleCategoryRepo;
        $this->articleRepository = $articleRepo;
        $this->userRepository = $userRepo;
//        $this->middleware('permission:article-list|article-create|article-edit|article-delete', ['only' => ['index','show']]);
//        $this->middleware('permission:article-create', ['only' => ['create','store']]);
//        $this->middleware('permission:article-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:article-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the Article.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(ArticleDataTable $dataTable)
    {
        return $dataTable->render('admin.articles.index');
    }

    /**
     * Show the form for creating a new Article.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->articleCategoryRepository->all();
        $users = $this->userRepository->all();
        return view('admin.articles.create',compact('categories','users'));
    }

    /**
     * Store a newly created Article in storage.
     *
     * @param CreateArticleRequest $request
     *
     * @return Response
     */
    public function store(CreateArticleRequest $request)
    {
        $article = $this->articleRepository->createArticle($request->all());

        $messages = ['success' => "Successfully added", 'redirect' => route('articles.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Display the specified Article.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $article = $this->articleRepository->find($id);

        if (empty($article)) {
            $messages = ['success' => "Article not found", 'redirect' => route('articles.index')];
            return response()->json(['messages' => $messages]);

        }

        return view('admin.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified Article.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $article = $this->articleRepository->find($id);

        if (empty($article)) {
            $messages = ['success' => "Article not found", 'redirect' => route('articles.index')];
            return response()->json(['messages' => $messages]);
        }
        $categories = $this->articleCategoryRepository->all();
        $users = $this->userRepository->all();
        return view('admin.articles.edit', compact('article','categories','users'));
    }

    /**
     * Update the specified Article in storage.
     *
     * @param int $id
     * @param UpdateArticleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateArticleRequest $request)
    {
        $article = $this->articleRepository->find($id);

        if (empty($article)) {
            $messages = ['success' => "Article not found", 'redirect' => route('articles.index')];
            return response()->json(['messages' => $messages]);
        }

        $article = $this->articleRepository->updateArticle($request->all(), $id);

        $messages = ['success' => "Successfully updated", 'redirect' => route('articles.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Remove the specified Article from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $article = $this->articleRepository->find($id);

        if (empty($article)) {
            $messages = ['success' => "Article not found", 'redirect' => route('articles.index')];
            return response()->json(['messages' => $messages]);
        }

        $this->articleRepository->delete($id);
        $messages = ['success' => "Successfully deleted", 'redirect' => route('articles.index')];
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

        $this->articleRepository->bulkDelete($request->ids);

        $messages = ['success' => "Successfully deleted", 'redirect' => route('articles.index')];
        return response()->json(['messages' => $messages]);
    }

}
