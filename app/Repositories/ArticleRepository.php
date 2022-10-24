<?php

namespace App\Repositories;

use App\Models\Article;
use App\Repositories\BaseRepository;
use Image;

/**
 * Class ArticleRepository
 * @package App\Repositories
 * @version June 19, 2022, 8:15 am UTC
*/

class ArticleRepository extends BaseRepository
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
        return Article::class;
    }
    /**
     * create a new article
     */

    public function createArticle($input)
    {
        $data = $input;
        $image = isset($input['image']) ? $input['image'] : null;

        if(!empty($image)){
            // for save original image
            $img = Image::make($image);
            $imgPath = 'uploads/article/';
            $imgName =time().$image->getClientOriginalName();
            $img =  $img->save($imgPath.$imgName);
            $data['image']=$imgName;
        }
        $data['title'] = [
            'en' => $input['title_en'],
            'ar' => $input['title_ar'],
        ];
        $data['short_description'] = [
            'en' => $input['short_description_en'],
            'ar' => $input['short_description_ar'],
        ];
        $data['details'] = [
            'en' => $input['details_en'],
            'ar' => $input['details_ar'],
        ];

        $this->create($data);
    }
    /**
     * update a article
     */
    public function updateArticle($input,$id)
    {
        $data = $input;
        $image = isset($input['image']) ? $input['image'] : null;
        if(!empty($image)){
            // for save original image
            $img = Image::make($image);
            $imgPath = 'uploads/article/';
            $imgName =time().$image->getClientOriginalName();
            $img =  $img->save($imgPath.$imgName);
            $data['image']=$imgName;
        }
        $data['title'] = [
            'en' => $input['title_en'],
            'ar' => $input['title_ar'],
        ];
        $data['short_description'] = [
            'en' => $input['short_description_en'],
            'ar' => $input['short_description_ar'],
        ];
        $data['details'] = [
            'en' => $input['details_en'],
            'ar' => $input['details_ar'],
        ];

        $this->update($data,$id);
    }
}
