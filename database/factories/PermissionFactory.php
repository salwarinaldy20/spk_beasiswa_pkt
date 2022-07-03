<?php

namespace Database\Factories;

use App\Models\User\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PermissionFactory extends Factory
{
    protected $model = Permission::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => \Str::uuid(),
            'kategori' => 'Master',
            'permission_key' => $this->faker->permission_key,
            'created_by' => 'faker',
            'created_on' => date('Y-m-d H:i:s')
        ];
    }
}
