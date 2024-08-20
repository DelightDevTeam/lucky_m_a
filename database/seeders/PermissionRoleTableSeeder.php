<?php

namespace Database\Seeders;

use App\Models\Admin\Permission;
use App\Models\Admin\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin permissions
        $admin_permissions = Permission::whereIn('title', [
            'admin_access',
            'agent_access',
            'role_index',
            'role_create',
            'role_store',
            'role_edit',
            'role_update',
            'role_delete',
            'permission_index',
            'permission_create',
            'permission_store',
            'permission_edit',
            'permission_update',
            'permission_delete',
            'agent_index',
            'agent_create',
            'agent_store',
            'agent_edit',
            'agent_show',
            'agent_delete',
            'agent_update',
            'agent_change_password_access',
            'transfer_log',
            'make_transfer',
            'game_type_access',
        ]);
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        // Admin permissions
        // Agent gets specific permissions
        $agent_permissions = Permission::whereIn('title', [
            'agent_access',
            'agent_index',
            'agent_create',
            'agent_store',
            'agent_edit',
            'agent_show',
            'agent_delete',
            'agent_update',
            'agent_change_password_access',
            'player_index',
            'player_create',
            'player_store',
            'player_edit',
            'player_show',
            'player_update',
            'player_delete',
            'transfer_log',
            'make_transfer',
            'withdraw',
            'deposit',
            'bank',
            'site_logo'
        ])->pluck('id');

        Role::findOrFail(2)->permissions()->sync($agent_permissions);
    }
}
