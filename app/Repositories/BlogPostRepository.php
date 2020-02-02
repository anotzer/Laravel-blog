<?php


namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class BlogCategoryRepository
 * @package App\Repositories
 *
 */
class BlogPostRepository extends MainRepository
{
   /**
     * @return string
     */
    protected function getModelClass(){

        return Model::class;

    }

    /**
     * get model for manage
     * @param int $id
     * @return Model
     */
    public function getEdit($id){
        return $this->startConditions()->find($id);
    }

    public function getAllWithPaginate($perPage = 5)
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',

        ];
        /**
         * Список статей для вывода
         * @return
         */
        $result =  $this->startConditions()
                        ->select($columns)
                        ->orderBy('id', 'DESC')
                        //->with(['category','user']) //lazy load
                        ->with(['category'=> function ($query) {
                        $query->select(['id','title']);
                        },
                        'user:id,name',
                            ])
                        ->paginate($perPage);
        /*
         * Альтернатива
         * ->with('category'=> function ($query) {
         *  $query->select(['id','title']);
         *
         * },
         *  'user:id,name'
         * ])
         * */
        return $result;
    }

}
