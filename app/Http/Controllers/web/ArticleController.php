<?php
namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ArticleCategoryRepository;
use App\Repositories\ArticleRepository;

class ArticleController extends Controller
{
    protected $articleCategoryRepository , $articleRepository;
    public function __construct( ArticleCategoryRepository $articleCategoryRepository, ArticleRepository $articleRepository)
    {
        $this->articleCategoryRepository = $articleCategoryRepository;
        $this->articleRepository = $articleRepository;
    }

    public function articleCategories()
    {
        $articleCategories = $this->articleCategoryRepository->all();
        return view('web.articles.articleCategories')->with('articleCategories', $articleCategories);
    }

    public function articles($articleCategoryId)
    {
        $articleCategory = $this->articleCategoryRepository->find($articleCategoryId);
        $articles = $articleCategory->articles()->orderBy('id', 'desc')->get();
        return view('web.articles.articles')->with('articleCategory', $articleCategory)->with('articles', $articles);
    }


    public function article($id)
    {
        $article = $this->articleRepository->find($id);
        return view('web.articles.article')->with('article', $article);
    }

    public function commentStore(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);
        $article = $this->articleRepository->find($request->article_id);
        $article->articleComments()->create([
            'body' => $request->body,
            'user_id' => auth()->user()->id,
        ]);
        return view('web.articles.comment',compact('article'));
    }
    public function addFavorite(Request $request)
    {
         $article = $this->articleRepository->find($request->article_id);
        $article->favourites()->create([
            'user_id' => auth()->user()->id,
        ]);
        return response()->json(['success'=>'Added to favorite list']);
    }

}
