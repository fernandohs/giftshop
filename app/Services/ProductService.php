<?php
namespace App\Services;

use App\Repositories\ProductRepository;
use App\Interfaces\IServices;

class ProductService implements IServices{

    protected $repository;
    
    public function __construct(ProductRepository $repository){

        $this->repository = $repository;
    }

    public function add($request){
        $categories = $request['categories'];
        unset($request['categories']);
        return $this->repository->createWithCategories($request, $categories);
    }

    public function update(Array $request, int $id){
        return $this->repository->update($request, $id);
    }
    
    public function all($request, $trashed){
        return $this->repository->allWithCategories($request, $trashed);
    }

    public function find($request, $id){
        return $this->repository->findWithCategories($id, $request['trashed']);
    }

    public function delete($id){
        return $this->repository->delete($id);
    }

}
