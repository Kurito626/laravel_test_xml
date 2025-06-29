<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Category;
use App\Models\Extrop;

class Product extends Model
{
    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'url',
        'price',
        'opt_price',
        'picture',
        'articul',
        'vendor',
        'description',
        'available',
        'status_new',
        'status_action',
        'status_top',
        'extprop_id',
        'category_id',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function extrop(): BelongsTo
    {
        return $this->belongsTo(Extrop::class, 'extprop_id');
    }
}
