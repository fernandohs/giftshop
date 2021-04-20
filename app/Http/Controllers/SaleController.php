<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SaleService;
use App\Http\Requests\Sale\SaleCreateRequest;
use App\Http\Requests\Sale\SaleUpdateRequest;
use App\Http\Requests\Sale\SaleDeleteRequest;
use App\Http\Requests\Sale\SaleShowRequest;
use App\Http\Requests\Sale\SaleAllRequest;

class SaleController extends Controller
{
    private $service;
    private $result;

    public function __construct(SaleService $service)
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
    public function index(SaleAllRequest $request)
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
    public function store(SaleCreateRequest $request)
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
    public function show(SaleShowRequest $request)
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
    public function update(SaleUpdateRequest $request, $id)
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
    public function destroy(SaleDeleteRequest $request)
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
