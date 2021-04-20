<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shipped_at',
        'delivered_at',
        'user_id',
        'status_id',
    ];

    protected $appends = [
        'shipped_at_format',
        'delivered_at_format'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];



    public function getShippedDateFormatAttribute()
    {

        return Carbon::parse($this->shipped_at)->format('d/m/Y');
    }

    public function getDeliveredDateFormatAttribute()
    {

        return Carbon::parse($this->delivered_at)->format('d/m/Y');
    }


    /**
     * Get the user that owns the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the sale status that owns the Status
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(SaleStatus::class, 'status_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(SaleDetail::class, 'sale_id', 'id');
    }
}
