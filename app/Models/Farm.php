<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Import the SoftDeletes trait

class Farm extends Model
{
    use HasFactory, SoftDeletes; // Use both HasFactory and SoftDeletes

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'farm_cat_id',
        'lat',
        'lng',
        'name',
        'description',
        'size',
        'farm_prefix',
    ];

    /**
     * Get the category that owns the farm.
     */
    public function farmCategory()
    {
        return $this->belongsTo(FarmCategory::class, 'farm_cat_id');
    }
}
