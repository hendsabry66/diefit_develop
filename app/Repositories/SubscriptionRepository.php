<?php

namespace App\Repositories;

use App\Models\Subscription;
use App\Repositories\BaseRepository;
use Image;

/**
 * Class SubscriptionRepository
 * @package App\Repositories
 * @version June 29, 2022, 11:35 am UTC
*/

class SubscriptionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Subscription::class;
    }

    /**
     * create a new subscription
     */
    public function createSubscription($input)
    {
        $image = $input['image'] ?? null;
        if(!empty($image)){
            // for save original image
            $img = Image::make($image);
            $imgPath = 'uploads/subscription/';
            $imgName =time().$image->getClientOriginalName();
            $img =  $img->save($imgPath.$imgName);
            $input['image']=$imgName;
        }
        $input['name'] = [
            'en' => $input['name_en'],
            'ar' => $input['name_ar'],
        ];
        $input['details'] = [
            'en' => $input['details_en'],
            'ar' => $input['details_ar'],
        ];

        $input['calories']= json_encode($input['calories']);
        $subscription = $this->create($input);
        return $subscription;
    }

    /*
     * update a subscription
     */
    public function updateSubscription($input ,$id)
    {
       $image = $input['image'] ?? null;
        if(!empty($image)){
            // for save original image
            $img = Image::make($input['image']);
            $imgPath = 'uploads/subscription/';
            $imgName =time().$input['image']->getClientOriginalName();
            $img =  $img->save($imgPath.$imgName);
            $input['image']=$imgName;
        }
        $input['name'] = [
            'en' => $input['name_en'],
            'ar' => $input['name_ar'],
        ];
        $input['details'] = [
            'en' => $input['details_en'],
            'ar' => $input['details_ar'],
        ];
        $input['calories']= json_encode($input['calories']);
        $subscription = $this->update($input, $id);
        return $subscription;
    }

}
