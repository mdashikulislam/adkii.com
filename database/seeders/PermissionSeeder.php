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
                'groupName' => 'State',
                'permission' => [
                    [
                        'label' => 'State List',
                        'name' => 'admin.state-list'
                    ],
                    [
                        'label' => 'Create State',
                        'name' => 'admin.create-state'
                    ],
                    [
                        'label' => 'Edit State',
                        'name' => 'admin.edit-state'
                    ],
                    [
                        'label' => 'Delete State',
                        'name' => 'admin.delete-state'
                    ]
                ]
            ],
            [
                'groupName' => 'City',
                'permission' => [
                    [
                        'label' => 'City List',
                        'name' => 'admin.city-list'
                    ],
                    [
                        'label' => 'Create City',
                        'name' => 'admin.create-city'
                    ],
                    [
                        'label' => 'Edit City',
                        'name' => 'admin.edit-city'
                    ],
                    [
                        'label' => 'Delete City',
                        'name' => 'admin.delete-city'
                    ]
                ]
            ],
            [
                'groupName' => 'Users',
                'permission' => [
                    [
                        'label' => 'User List',
                        'name' => 'admin.user-list'
                    ],
                    [
                        'label' => 'Create User',
                        'name' => 'admin.create-user'
                    ],
                    [
                        'label' => 'Edit User',
                        'name' => 'admin.edit-user'
                    ],
                    [
                        'label' => 'Delete User',
                        'name' => 'admin.delete-user'
                    ],
                    [
                        'label' => 'Delete Bulk User',
                        'name' => 'admin.delete-bulk-user'
                    ],
                    [
                        'label' => 'Export Excel',
                        'name' => 'admin.export-excel'
                    ]
                ]
            ],
            [
                'groupName' => 'Manage Brochure',
                'permission' => [
                    [
                        'label' => 'Brochure List',
                        'name' => 'admin.brochure-list'
                    ],
                    [
                        'label' => 'Create Brochure',
                        'name' => 'admin.create-brochure'
                    ],
                    [
                        'label' => 'Edit Brochure',
                        'name' => 'admin.edit-brochure'
                    ],
                    [
                        'label' => 'Delete Brochure',
                        'name' => 'admin.delete-brochure'
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
            [
                'groupName' => 'Inbox',
                'permission' => [
                    [
                        'label' => 'Inbox List',
                        'name' => 'admin.inbox-list'
                    ],
                ]
            ],
            [
                'groupName' => 'Stock List',
                'permission' => [
                    [
                        'label' => 'Stock List',
                        'name' => 'stock-list'
                    ],
                ]
            ],
            [
                'groupName' => 'Download / Log List',
                'permission' => [
                    [
                        'label' => 'Download / Log List',
                        'name' => 'download-list'
                    ],
                ]
            ],

            [
                'groupName' => 'Builder Dashboard',
                'permission' => [
                    [
                        'label' => 'Builder Dashboard',
                        'name' => 'builder.dashboard'
                    ]
                ]
            ],
            [
                'groupName' => 'Marketing Company Dashboard',
                'permission' => [
                    [
                        'label' => 'Company Dashboard',
                        'name' => 'company.dashboard'
                    ]
                ]
            ],
            [
                'groupName' => 'View Only User',
                'permission' => [
                    [
                        'label' => 'View Only User List',
                        'name' => 'view-only-user-list'
                    ],
                    [
                        'label' => 'Create View Only User',
                        'name' => 'create-view-only-user'
                    ],
                    [
                        'label' => 'Edit View Only User',
                        'name' => 'edit-view-only-user'
                    ],
                    [
                        'label' => 'Delete View Only User',
                        'name' => 'delete-view-only-user'
                    ],
                    [
                        'label' => 'Delete Bulk View Only User',
                        'name' => 'delete-bulk-view-only-user'
                    ],
                ]
            ],

            [
                'groupName' => 'Manage Package',
                'permission' => [
                    [
                        'label' => 'Package List',
                        'name' => 'package-list'
                    ],
                    [
                        'label' => 'Create Package',
                        'name' => 'create-package'
                    ],
                    [
                        'label' => 'Edit Package',
                        'name' => 'edit-package'
                    ],
                    [
                        'label' => 'Delete Package',
                        'name' => 'delete-package'
                    ],
                    [
                        'label' => 'Copy Package',
                        'name' => 'copy-package'
                    ],
                    [
                        'label' => 'Package Status',
                        'name' => 'package-status'
                    ]
                ]
            ],
            [
                'groupName' => 'Manage Build Info',
                'permission' => [
                    [
                        'label' => 'Build Info List',
                        'name' => 'build-info-list'
                    ],
                    [
                        'label' => 'Create Build Info',
                        'name' => 'create-build-info'
                    ],
                    [
                        'label' => 'Edit Build Info',
                        'name' => 'edit-build-info'
                    ],
                    [
                        'label' => 'Delete Build Info',
                        'name' => 'delete-build-info'
                    ],
                    [
                        'label' => 'Copy Build Info',
                        'name' => 'copy-build-info'
                    ]
                ]
            ],
            [
                'groupName' => 'Manage Estate Info',
                'permission' => [
                    [
                        'label' => 'Estate Info List',
                        'name' => 'estate-info-list'
                    ],
                    [
                        'label' => 'Create Estate Info',
                        'name' => 'create-estate-info'
                    ],
                    [
                        'label' => 'Edit Estate Info',
                        'name' => 'edit-estate-info'
                    ],
                    [
                        'label' => 'Delete Estate Info',
                        'name' => 'delete-estate-info'
                    ],
                    [
                        'label' => 'Copy Estate Info',
                        'name' => 'copy-estate-info'
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
