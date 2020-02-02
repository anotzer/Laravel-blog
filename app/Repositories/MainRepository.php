<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
/**
 * Class MainRepository
 * @package App\Repositories
 * Репозиторий для работы с сущностью
 * Выдает сами данные без возможности создания или изменения
 */
abstract class MainRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * MainRepository constructor.
     */
    public function __construct()
    {
        //имя модели будет сообщать потомок
        $this->model = app($this->getModelClass());
    }

    /**
     * @return mixed
     */
    abstract protected function getModelClass();

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Model|mixed
     */
    protected function startConditions(){
        return clone $this->model;
    }

}
