<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;
use App\Models\Book;

class BookTest extends TestCase
{
    public function test_contains_valid_fillable_properties()
    {
        $m = new Book();
        $this->assertEquals([
            'title',
            'description',
            'content',
            'image',
            'publisher_id',
            'quantity',
        ], $m->getFillable());
    }

    public function test_publisher_relation()
    {
        $m = new Book();
        $relation = $m->publisher();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('publisher_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getOwnerKeyName());
    }

    public function test_comment_relation()
    {
        $m = new Book();
        $relation = $m->comments();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('book_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getLocalKeyName());
    }

    public function test_like_relation()
    {
        $m = new Book();
        $relation = $m->likes();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('book_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getLocalKeyName());
    }

    public function test_rate_relation()
    {
        $m = new Book();
        $relation = $m->rates();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('book_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getLocalKeyName());
    }

    public function test_author_relation()
    {
        $m = new Book();
        $relation = $m->authors();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('author_book', $relation->getTable());
        $this->assertEquals('author_book.book_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('author_book.author_id', $relation->getQualifiedRelatedPivotKeyName());
    }

    public function test_category_relation()
    {
        $m = new Book();
        $relation = $m->categories();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('book_category.book_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('book_category.cate_id', $relation->getQualifiedRelatedPivotKeyName());
    }

    public function test_borrow_relation()
    {
        $m = new Book();
        $relation = $m->borrows();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('borrow_book.book_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('borrow_book.borrow_id', $relation->getQualifiedRelatedPivotKeyName());
    }
}
