<?php

namespace App\Repositories;

use App\Models\ArticleCategory;
use App\Repositories\BaseRepository;
use Image;

/**
 * Class ArticleCategoryRepository
 * @package App\Repositories
 * @version June 19, 2022, 8:15 am UTC
*/

class ArticleCategoryRepository extends BaseRepository
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
        return ArticleCategory::class;
    }
    /**
     * create a new article category
     */

    public function createArticleCategory($input)
    {
        $data = $input;

        $image = isset($input['image']) ? $input['image'] : null;

        if(!empty($image)){
            // for save original image
            $img = Image::make($image);
            $imgPath = 'uploads/article_category/';
            $imgName =time().$image->getClientOriginalName();
            $img =  $img->save($imgPath.$imgName);
            $data['image']=$imgName;
        }
        $data ['name'] = [
                'en' => $input['name_en'],
                'ar' => $input['name_ar'],
            ];


        $articleCategory = $this->create($data);
        return $articleCategory;
    }

    /**
     * update a article category
     */
    public function updateArticleCategory($id, $input)
    {
        $data = $input;
        $image = (isset($input['image'])?$input['image']:null);
        if(!empty($image)){
            // for save original image
            $img = Image::make($image);
            $imgPath = 'uploads/article_category/';
            $imgName =time().$image->getClientOriginalName();
            $img =  $img->save($imgPath.$imgName);
            $data['image']=$imgName;
        }
        $data ['name'] = [
                'en' => $input['name_en'],
                'ar' => $input['name_ar'],
            ];
        $articleCategory = $this->update($data, $id);
        return $articleCategory;
    }
}
