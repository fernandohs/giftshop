<?php
namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Interfaces\IServices;

class CategoryService implements IServices{

    protected $repository;
    
    public function __construct(CategoryRepository $repository){

        $this->repository = $repository;
    }

    public function add($request){
        return $this->repository->create($request);
    }

    public function update(Array $request, int $id){
        return $this->repository->update($request, $id);
    }
    
    public function all($request, $trashed){
        return $this->repository->all($request, $trashed);
    }

    public function find($request, $id){
        return $this->repository->find($id, $request['trashed']);
    }

    public function delete($id){
        return $this->repository->delete($id);
    }

}
