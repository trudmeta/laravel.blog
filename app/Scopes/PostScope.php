<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class PostScope implements Scope
{
    /**
     * Only posts from published categories
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder
            ->when(request()->routeIs('front.*'),function($builder){
                $builder
                    ->whereHas('categories', function($builder){
                        return $builder->where('status', true);
                    })
                    ->orWhereDoesntHave('categories');
            });
    }
}
