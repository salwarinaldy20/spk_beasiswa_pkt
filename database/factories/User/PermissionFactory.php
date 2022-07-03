<?php

namespace Database\Factories\User;

use App\Models\User\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User\Permission>
 */
class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'kategori' => 'Master',
            'permission_key' => $this->faker->name,
            'created_by' => 'faker',
            'created_on' => date('Y-m-d H:i:s')
        ];
    }
}
