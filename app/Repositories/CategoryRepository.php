<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Category;

class CategoryRepository extends BaseRepository 
{
    protected $fieldSearchable = [
        'name',
        'description',
    ];

    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }


    public function model(){
        return Category::class;
    }

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
}
