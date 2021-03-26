<?php

namespace App\Models;

use App\Scopes\PostScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'slug',
        'author_id',
        'thumbnail_id',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(new PostScope);
    }

    /**
     * Return the post's author
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get post categories
     */
    public function categories(): belongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Scope a query to search posts
     */
    public function scopeSearch($query, ?string $search)
    {
        if ($search) {
            return $query->where('title', 'LIKE', "%{$search}%");
        }
    }

    /**
     * Posts in category
     */
    public function image()
    {
        return $this->belongsTo(Image::class, 'thumbnail_id');
    }
}
