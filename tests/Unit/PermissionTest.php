<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;
use App\Models\Permission;

class PermissionTest extends TestCase
{
    public function test_contains_valid_fillable_properties()
    {
        $m = new Permission();
        $this->assertEquals([
            'name',
            'permission',
        ], $m->getFillable());
    }

    public function test_role_relation()
    {
        $m = new Permission();
        $relation = $m->roles();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('permission_role.permission_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('permission_role.role_id', $relation->getQualifiedRelatedPivotKeyName());
    }
}
