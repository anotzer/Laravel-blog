<?php


namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BlogCategoryRepository
 * @package App\Repositories
 *
 */
class BlogCategoryRepository extends MainRepository
{
    /**
     * Getting the model to edit
     * @param int $id
     *
     * @return Model
     */
    public function getEdit(int $id){
        return $this->startConditions()->find($id);
    }

    /**
     * Get a list of categories for a list
     * @return Collection
     */
    public function getForComboBox(){
        $columns = implode(', ', [
            'id',
            'CONCAT (id, ". ", title) AS id_title',
        ]);
//        $result[] = $this->startConditions()->all();
//        $result[] = $this
//            ->startConditions()
//            ->select('blog_categories.*',
//                \DB::raw('CONCAT (id, ". ", title) AS id_title'))
//            ->toBase() //чобь не делал агрегирование
//            ->get();
        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();
        return $result;
    }

    /**
     * @return string
     */
    protected function getModelClass(){
        return Model::class;
    }

    public function getAllWithPaginate($perPage = 5){
        $fields = ['id', 'title', 'parent_id'];
        $result = $this
            ->startConditions()
            ->select($fields)
            ->paginate($perPage);
        return $result;
    }

}
