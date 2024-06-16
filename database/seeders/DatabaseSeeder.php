<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->truncate();
        DB::table('role_user')->truncate();
        DB::table('policy')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();

        $admin = User::factory()->create([
            'full_name' => 'Administrator',
            'nickname' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('12345678'),
        ]);

        $moderator = User::factory()->create([
            'full_name' => 'Moderator',
            'nickname' => 'moderator',
            'email' => 'moderator@mail.com',
            'password' => bcrypt('12345678'),
        ]);

        // Создание ролей
        $adminRole = Role::create([
            'name' => 'admin',
            'description' => 'Administrator',
        ]);

        $moderatorRole = Role::create([
            'name' => 'moderator',
            'description' => 'Moderator',
        ]);

        // Создание разрешений
        $createArticles = Permission::create([
            'name' => 'create_articles',
            'description' => 'Publish articles',
        ]);

        $editArticles = Permission::create([
            'name' => 'edit_articles',
            'description' => 'Edit articles',
        ]);

        $deleteArticles = Permission::create([
            'name' => 'delete_articles',
            'description' => 'Delete articles',
        ]);

        $archiveArticles = Permission::create([
            'name' => 'archive_articles',
            'description' => 'Delete articles',
        ]);

        $publishArticles = Permission::create([
            'name' => 'publish_articles',
            'description' => 'Delete articles',
        ]);

        $assignRole = Permission::create([
            'name' => 'assign_role',
            'description' => 'Assign role',
        ]);

        $adminRole->permissions()->attach([$createArticles->id, $deleteArticles->id, $archiveArticles->id, $publishArticles->id, $assignRole->id]);
        $moderatorRole->permissions()->attach([$editArticles->id, $archiveArticles->id, $publishArticles->id]);

        $admin->roles()->attach($adminRole->id);
        $moderator->roles()->attach($moderatorRole->id);

        $this->call([
            CategorySeeder::class,
        ]);
    }
}
