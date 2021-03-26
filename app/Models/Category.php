<?php

namespace App\Models;

use App\Scopes\CategoryScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'parent_id', 'status', 'position'];

    /**
     * CategoryScope
     * Sorting categories by position column
     */
    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(new CategoryScope);
    }

    /**
     * Posts in category
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    /**
     * Child categories
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Active category
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
    public function getTestAttribute()
    {
        return $this->title;
    }
    public function status()
    {
        return $this->whereStatus(true);
    }

}
