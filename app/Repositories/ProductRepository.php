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


    public function model()
    {
        return Product::class;
    }

    public function __construct(Product $model)
    {
        parent::__construct($model);
    }


    public function createCategories($product_id, $categories){
        foreach($categories as $i => $category){
            $this->model->getCategoryRelationship::create([
                'product_id' => $product_id,
                'category_id' => $category
            ]);
        }
    }

    public function createWithCategories($product, $categories){
        $product = $this->create($product);
        $this->createCategories($product->id, $categories);
        return $product;
    }

    public function allWithCategories($request, $trashed)
    {
        $rows = $this->model->all();
        $this->showCategories($rows);
        return $rows;
    }

    public function findWithCategories($id, $trashed){
        $product =  $this->model->find($id);
        $this->showCategories([$product]);
        return $product;
    }

    public function showCategories($rows)
    {
        foreach ($rows as $i => $row) {
            foreach ($row->categories->makeHidden(['id', 'product_id', 'category_id']) as $i => $category) {
                $category->category;
            }
        }
    }
}
