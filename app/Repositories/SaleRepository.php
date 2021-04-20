<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Sale;

class SaleRepository extends BaseRepository 
{
    protected $fieldSearchable = [
        'shipped_at',
        'delivered_at',
        'user_id',
        'status_id',
    ];

    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }


    public function model(){
        return Sale::class;
    }

    public function __construct(Sale $model)
    {
        parent::__construct($model);
    }
}
