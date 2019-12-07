<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;
use App\Models\Role;

class RoleTest extends TestCase
{
    public function test_contains_valid_fillable_properties()
    {
        $m = new Role();
        $this->assertEquals([
            'name',
            'description',
        ], $m->getFillable());
    }

    public function test_user_relation()
    {
        $m = new Role();
        $relation = $m->users();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('role_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getLocalKeyName());
    }

    public function test_permission_relation()
    {
        $m = new Role();
        $relation = $m->permissions();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('permission_role.role_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('permission_role.permission_id', $relation->getQualifiedRelatedPivotKeyName());
    }
}
