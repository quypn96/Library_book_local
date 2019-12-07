<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{

    public function test_contains_valid_fillable_properties()
    {
        $m = new User();
        $this->assertEquals([
            'name',
            'email',
            'password',
            'avatar',
            'phone_number',
            'birthday',
            'status',
            'role_id',
        ], $m->getFillable());
    }

    public function test_contains_valid_hidden_properties()
    {
        $m = new User();
        $this->assertEquals([
            'password',
            'remember_token',
        ], $m->getHidden());
    }

    public function test_contains_valid_cast_properties()
    {
        $m = new User();
        $this->assertEquals([
            'email_verified_at' => 'datetime',
            'id' => 'int',
        ], $m->getCasts());
    }

    public function test_like_relation()
    {
        $m = new User();
        $relation = $m->likes();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getLocalKeyName());
    }

    public function test_rate_relation()
    {
        $m = new User();
        $relation = $m->rates();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getLocalKeyName());
    }

    public function test_comment_relation()
    {
        $m = new User();
        $relation = $m->comments();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getLocalKeyName());
    }

    public function test_borrow_relation()
    {
        $m = new User();
        $relation = $m->borrows();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getLocalKeyName());
    }
}
