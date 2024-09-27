<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions =
        [
            [
                'group_name' => 'User',
                'permissions' => [
                    // Manager User Permissions
                    'user.create',
                    'user.view',
                    'user.edit',
                    'user.delete',
                ],
            ],
            [
                'group_name' => 'Role',
                'permissions' => [
                    // Manage Role Permissions
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                    'role.update',
                ],
            ],
            [
                'group_name' => 'Profile',
                'permissions' => [
                    // profile Permissions
                    'profile.view',
                    'profile.edit',
                    'profile.update',
                ],
            ],
            [
                'group_name' => 'Master Material',
                'permissions' => [
                    // Master Material Permissions
                    'material.create',
                    'material.view',
                    'material.edit',
                    'material.delete',
                    'material.update',
                ],
            ],
            [
                'group_name' => 'Master Supplier',
                'permissions' => [
                    // Master Supplier Permissions
                    'supplier.create',
                    'supplier.view',
                    'supplier.edit',
                    'supplier.delete',
                    'supplier.update',
                ],
            ],
            [
                'group_name' => 'Pembelian',
                'permissions' => [
                    // Pembelian Permissions
                    'pembelian.create',
                    'pembelian.view',
                    'pembelian.edit',
                    'pembelian.delete',
                    'pembelian.update',
                    'pembelian.approve',
                ],
            ],
            [
                'group_name' => 'Riwayat Pembelian',
                'permissions' => [
                    // Riwayat Pembelian Permissions
                    'pembelian.view',
                ],
            ],
            [
                'group_name' => 'Detail Pembelian',
                'permissions' => [
                    // Pembelian Detail Permissions
                    'pembelian-detail.view',
                    'pembelian-detail.create',
                    'pembelian-detail.edit',
                    'pembelian-detail.hapus',
                    'pembelian-detail.update',
                ],
            ],
        ];

        $sumin = User::where('username', 'superadmin')->first();
        $roleSuperAdmin = $this->createRoleSumin($sumin);

        // Create and Assign Permissions to Super admin
        for ($i = 0; $i < count($permissions); ++$i) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); ++$j) {
                $permissionExist = Permission::where('name', $permissions[$i]['permissions'][$j])->first();
                if (is_null($permissionExist)) {
                    $permission = Permission::create(
                        [
                            'name' => $permissions[$i]['permissions'][$j],
                            'group_name' => $permissionGroup,
                            'guard_name' => 'web',
                        ]
                    );
                    $roleSuperAdmin->givePermissionTo($permission);
                    $permission->assignRole($roleSuperAdmin);
                }
            }
        }

        // Assign super admin role permission to superadmin user
        if ($sumin) {
            $sumin->assignRole($roleSuperAdmin);
        }
    }

    private function createRoleSumin($sumin): Role
    {
        if (is_null($sumin)) {
            $roleSuperAdmin = Role::create(['name' => 'superadmin', 'guard_name' => 'web']);
        } else {
            $roleSuperAdmin = Role::where('name', 'superadmin')->where('guard_name', 'web')->first();
        }

        if (is_null($roleSuperAdmin)) {
            $roleSuperAdmin = Role::create(['name' => 'superadmin', 'guard_name' => 'web']);
        }

        return $roleSuperAdmin;
    }
}
