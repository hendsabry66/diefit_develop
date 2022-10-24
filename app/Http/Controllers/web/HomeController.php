<?php
namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\PageRepository;
use App\Repositories\SubscriptionRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\FoodCategoryRepository;
use App\Repositories\TeamMemberRepository;

class HomeController extends Controller
{
    private $productCategoryRepository , $pageRepository , $subscriptionRepository , $articleRepository , $foodCategoryRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductCategoryRepository $productCategoryRepository , PageRepository $pageRepository, SubscriptionRepository $subscriptionRepository , ArticleRepository $articleRepository
        , FoodCategoryRepository $foodCategoryRepository , TeamMemberRepository $teamMemberRepository)
    {
        $this->productCategoryRepository = $productCategoryRepository;
        $this->pageRepository = $pageRepository;
        $this->subscriptionRepository = $subscriptionRepository;
        $this->articleRepository = $articleRepository;
        $this->foodCategoryRepository = $foodCategoryRepository;
        $this->teamMemberRepository = $teamMemberRepository;
    }



    public function home(){
        $product_categories = $this->productCategoryRepository->allQuery([],[],6)->orderBy('id','desc')->get();
        $about = $this->pageRepository->find(1);
        $centerManger = $this->pageRepository->find(2);
        $subscriptions = $this->subscriptionRepository->all();
        $articles = $this->articleRepository->allQuery([],[],6)->orderBy('id','desc')->get();
        $food_categories = $this->foodCategoryRepository->allQuery([],[],6)->orderBy('id','desc')->get();
        $team_members = $this->teamMemberRepository->allQuery([],[],6)->orderBy('id','desc')->get();
        return view('web.index', compact('product_categories','about','subscriptions','articles','food_categories','centerManger','team_members'));
    }

    public function contact(){
        return view('web.contact');
    }

    public function post_contact(Request $request){
        $this->validate($request, [
            'subject' => 'required',
            'message' => 'required',
        ]);
        $contact = new Contact;
        $contact->create($request->all());
        return redirect()->back()->with('success', __('web.message_send_successfully'));
    }
}
