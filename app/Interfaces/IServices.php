<?php

namespace App\Interfaces;

interface  IServices
{
    public function add(array $request);
    public function update(array $request, int $id);
    public function all(array $request, $trashed);
    public function find(array $request, int $id);
    public function delete(int $id);
}
