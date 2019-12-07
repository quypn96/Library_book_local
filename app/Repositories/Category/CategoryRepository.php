<?php

namespace App\Repositories\Category;

use App\Repositories\EloquentRepository;
use App\User;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryRepository extends EloquentRepository implements CategoryRepositoryInterface
{

    public function getModel()
    {
        return Category::class;
    }

}
