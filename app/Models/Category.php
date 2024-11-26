<?php

namespace App\Models;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin IdeHelperCategory
 */
class Category extends Model
{
    /** @use HasFactory<CategoryFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'slug', 'commentable', 'likeable', 'order', 'is_published'];

    /**
     * @return HasMany<Post, $this>
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Scope a query to only include published posts.
     *
     * @param Builder<Post> $query
     * @return Builder<Post>
     */
    public function scopeIsPublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }
}
