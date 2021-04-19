<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository 
{
    protected $fieldSearchable = [
        'name',
        'birth_date',
        'phone',
        'city',
        'state',
        'street',
        'zip_code',
        'email',
        'expires_at'
    ];

    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }


    public function model(){
        return User::class;
    }

    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
