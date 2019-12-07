<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tests\TestCase;
use App\Models\Author;

class AuthorTest extends TestCase
{
    public function test_contains_valid_fillable_properties()
    {
        $m = new Author();
        $this->assertEquals([
            'name',
            'description',
            'avatar',
            'birthday',
        ], $m->getFillable());
    }

    public function test_book_relation()
    {
        $m = new Author();
        $relation = $m->books();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('author_book.author_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('author_book.book_id', $relation->getQualifiedRelatedPivotKeyName());
    }
}
