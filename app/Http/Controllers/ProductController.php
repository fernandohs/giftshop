<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Requests\Product\ProductDeleteRequest;
use App\Http\Requests\Product\ProductShowRequest;
use App\Http\Requests\Product\ProductAllRequest;

class ProductController extends Controller
{
    private $service;
    private $result;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
        $this->result = [
            'status' => 200,
            'message'=> '',
            'data' => []
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductAllRequest $request)
    {
        $data = $request->validated();
        unset($data['trashed']);
        
        return $this->service->all($data, $request->only('trashed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        try{
            $this->result['data'] = $this->service->add($request->validated());
        }catch(Exception $e){
            $result = [
                'status' => 500,
                'error'  => $e->getMessage()
            ];
        }

        return response()->json($this->result, $this->result['status']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProductShowRequest $request)
    {
        try{
            $this->result['data'] = $this->service->find($request->only('trashed'), $request->id);
        }catch(Exception $e){
            $result = [
                'status' => 500,
                'error'  => $e->getMessage()
            ];
        }

        return response()->json($this->result, $this->result['status']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        try{
            $data = $request->validated();
            unset($data['id']);
            $this->result['data'] = $this->service->update($data, $id);
        }catch(Exception $e){
            $result = [
                'status' => 500,
                'error'  => $e->getMessage()
            ];
        }

        return response()->json($this->result, $this->result['status']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductDeleteRequest $request)
    {
        try{
            $this->result['data'] = $this->service->delete($request->id);
        }catch(Exception $e){
            $result = [
                'status' => 500,
                'error'  => $e->getMessage()
            ];
        }

        return response()->json($this->result, $this->result['status']);
    }
}
