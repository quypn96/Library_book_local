<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;
use App\Models\Comment;

class CommentTest extends TestCase
{
    public function test_contains_valid_fillable_properties()
    {
        $m = new Comment();
        $this->assertEquals([
            'content',
            'user_id',
            'book_id',
            'parent_id',
            'status',
        ], $m->getFillable());
    }

    public function test_book_relation()
    {
        $m = new Comment();
        $relation = $m->book();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('book_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getOwnerKeyName());
    }

    public function test_user_relation()
    {
        $m = new Comment();
        $relation = $m->user();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getOwnerKeyName());
    }

    public function test_comment_relation()
    {
        $m = new Comment();
        $relation = $m->comments();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('parent_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getLocalKeyName());
    }
}
