<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;
use App\Models\Borrow;

class BorrowTest extends TestCase
{
    public function test_contains_valid_fillable_properties()
    {
        $m = new Borrow();
        $this->assertEquals([
            'user_id',
            'start_date',
            'end_date',
            'note',
        ], $m->getFillable());
    }

    public function test_book_relation()
    {
        $m = new Borrow();
        $relation = $m->books();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('borrow_book.borrow_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('borrow_book.book_id', $relation->getQualifiedRelatedPivotKeyName());
    }

    public function test_user_relation()
    {
        $m = new Borrow();
        $relation = $m->user();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getOwnerKeyName());
    }
}
