<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;
use App\Models\Category;

class CategoryTest extends TestCase
{
    public function test_contains_valid_fillable_properties()
    {
        $m = new Category();
        $this->assertEquals([
            'name',
            'parent_id',
            'status',
        ], $m->getFillable());
    }

    public function test_book_relation()
    {
        $m = new Category();
        $relation = $m->books();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('book_category.cate_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('book_category.book_id', $relation->getQualifiedRelatedPivotKeyName());
    }

    public function test_category_relation()
    {
        $m = new Category();
        $relation = $m->categories();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('parent_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getLocalKeyName());
    }
}
