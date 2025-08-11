<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
class PermissionSeeder extends Seeder
{
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('role_has_permissions')->truncate();
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach (ALL_USER_ROLE as $index => $role) {
            $slug = slugPreserveLevel($index);
            Role::firstOrCreate(['name' => $slug]);
        }

        $adminRole = Role::firstWhere('name', 'admin');


        //Need to change permission name according to the controller name
        $permissions = [
            [
                'groupName' => 'Admin Dashboard',
                'permission' => [
                    [
                        'label' => 'Admin Dashboard',
                        'name' => 'admin.dashboard'
                    ]
                ]
            ],
            [
                'groupName' => 'Manage Permission',
                'permission' => [
                    [
                        'label' => 'Role List',
                        'name' => 'admin.role-list'
                    ],
                    [
                        'label' => 'Create Role',
                        'name' => 'admin.create-role'
                    ],
                    [
                        'label' => 'Edit Role',
                        'name' => 'admin.edit-role'
                    ],
                    [
                        'label' => 'Role Delete',
                        'name' => 'admin.delete-role'
                    ],
                    [
                        'label' => 'Permission Access',
                        'name' => 'admin.admin-permission'
                    ]
                ]
            ],

        ];

        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['groupName'];
            for ($j = 0; $j < count($permissions[$i]['permission']); $j++) {
                $permissionData = $permissions[$i]['permission'][$j];
                $permission = Permission::firstOrCreate([
                    'name' => $permissionData['name'],
                ], [
                    'label' => $permissionData['label'],
                    'group' => $permissionGroup,
                    'guard_name' => 'web',
                ]);
                $adminRole->givePermissionTo($permission);
                $permission->assignRole($adminRole);
            }
        }

        $user = User::where('role',ADMIN_ROLE)->first();
        if ($user) {
            $user->assignRole($adminRole);
        }

    }
}
