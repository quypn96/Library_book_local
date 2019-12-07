<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Publisher;
use Tests\TestCase;

class PublisherTest extends TestCase
{
    public function test_contains_valid_fillable_properties()
    {
        $m = new Publisher();
        $this->assertEquals([
            'name',
            'address',
            'image',
        ], $m->getFillable());
    }

    public function test_book_relation()
    {
        $m = new Publisher();
        $relation = $m->books();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('publisher_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getLocalKeyName());
    }
}
