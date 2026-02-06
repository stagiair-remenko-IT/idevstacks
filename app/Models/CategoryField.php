<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryField extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'category_id',
        'key',
        'label',
        'field_type',
        'is_sensitive',
        'is_required',
        'sort_order',
        'help_text',
    ];

    /**
     * @return BelongsTo<Category, CategoryField>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

