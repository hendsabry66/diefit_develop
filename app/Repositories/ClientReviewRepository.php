<?php

namespace App\Repositories;

use App\Models\ClientReview;
use App\Repositories\BaseRepository;

/**
 * Class ClientReviewRepository
 * @package App\Repositories
 * @version June 22, 2022, 11:18 am UTC
*/

class ClientReviewRepository extends BaseRepository
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
        return ClientReview::class;
    }

    /**
     * create a new ClientReview
     *
     */
    public function createClientReview(array $input){
        $image = $input['image'] ?? null;
        if(!empty($image)){
            // for save original image
            $img = Image::make($image);
            $imgPath = 'uploads/clientReview/';
            $imgName =time().$image->getClientOriginalName();
            $img =  $img->save($imgPath.$imgName);
            $input['image']=$imgName;
        }
        $input['name']=[
            'en' => $input['name_en'],
            'ar' => $input['name_ar']
        ];
        $input['details']=[
            'en' => $input['details_en'],
            'ar' => $input['details_ar']
        ];
        $clientReview = $this->create($input);
        return $clientReview;

    }

    /**
     * update a ClientReview
     */

    public function updateClientReview(array $input, $id)
    {
        $image = $input['image'] ?? null;
        if (!empty($image)) {
            // for save original image
            $img = Image::make($image);
            $imgPath = 'uploads/clientReview/';
            $imgName = time() . $image->getClientOriginalName();
            $img = $img->save($imgPath . $imgName);
            $input['image'] = $imgName;
        }
        $input['name'] = [
            'en' => $input['name_en'],
            'ar' => $input['name_ar']
        ];
        $input['details'] = [
            'en' => $input['details_en'],
            'ar' => $input['details_ar']
        ];
        $clientReview = $this->update($input, $id);
        return $clientReview;
    }
}
