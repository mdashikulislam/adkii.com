<?php

namespace Database\Seeders;

use App\Models\User;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AssignRoleToExistingUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            if (empty($user->role)) {
                continue; // Skip if no role column value
            }

            // Check if user already has a role assigned
            $alreadyHasRole = DB::table('model_has_roles')
                ->where('model_id', $user->id)
                ->where('model_type', User::class)
                ->exists();

            if ($alreadyHasRole) {
                continue; // Skip if already assigned
            }

            // Convert user's role column to proper display name
            $userRoleName = getUserRoleName($user->role); // ← use your helper

            // Find Role by name (created earlier in roles table)
            $role = Role::firstWhere('name', $userRoleName);

            if ($role) {
                $user->assignRole($role);
                $this->command->info("Assigned '{$userRoleName}' role to user ID: {$user->id}");
            } else {
                $this->command->warn("Role '{$userRoleName}' not found for user ID: {$user->id}");
            }
        }
    }
}
