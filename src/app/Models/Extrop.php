<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Product;

class Extrop extends Model
{
    /**
     * @var string
     */
    protected $table = 'extprops';

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'season'];

    /**
     * @var bool
     */
    public $timestamps = false;

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'extprop_id');
    }
}
