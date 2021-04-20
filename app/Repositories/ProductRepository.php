<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Product;

class ProductRepository extends BaseRepository 
{
    protected $fieldSearchable = [
        'name',
        'description',
        'url_image',
        'price',
        'stock',
    ];

    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }


    public function model(){
        return Product::class;
    }

    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
}
