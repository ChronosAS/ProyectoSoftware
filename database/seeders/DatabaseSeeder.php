<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Role::create([
            'name' => 'admin'
        ]);

        $actions = [
            'create',
            'update',
            'delete',
            'accept',
            'view'
        ];

        foreach($this->models() as $model => $actions){
            foreach ($actions as $action) {
                tap(Permission::create([
                    'name' => $model.':'.$action
                ]),function($permission){
                    $permission->assignRole('admin');
                });
            }
        }

        $user = User::factory()->create([
            'document' => 12345678,
            'name' => 'Test User',
            'email' => 'test@example.com',
            'accepted' => true,
        ]);

        $user->assignRole('admin');
    }


    private function models(): array
    {
        return [
            'address' => $this->defaultActions(),
            'user' => $this->defaultActions(),
        ];
    }

    private function defaultActions(): array
    {
        return [
            'access',
            'view',
            'create',
            'edit',
            'delete',
            'restore'
        ];
    }
}
