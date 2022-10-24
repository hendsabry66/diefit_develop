<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     *
     */
    public function run()
    {
        $permissions = [
            'area-list',
            'area-create',
            'area-edit',
            'area-delete',
            'city-list',
            'city-create',
            'city-edit',
            'city-delete',
             'users-list',
            'users-create',
            'users-edit',
            'users-delete',
            'page-list',
            'page-create',
            'page-edit',
            'page-delete',
            'dashboard-list',

            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'article-list',
            'article-create',
            'article-edit',
            'article-delete',
            'article-category-list',
            'article-category-create',
            'article-category-edit',
            'article-category-delete',

            'video-list',
            'video-create',
            'video-edit',
            'video-delete',
            'video-category-list',
            'video-category-create',
            'video-category-edit',
            'video-category-delete',

            'food-list',
            'food-create',
            'food-edit',
            'food-delete',

            'food-category-list',
            'food-category-create',
            'food-category-edit',
            'food-category-delete',

            'branch-list',
            'branch-create',
            'branch-edit',
            'branch-delete',

            'teamMember-list',
            'teamMember-create',
            'teamMember-edit',
            'teamMember-delete',

            'clientReview-list',
            'clientReview-create',
            'clientReview-edit',
            'clientReview-delete',

            'slider-list',
            'slider-create',
            'slider-edit',
            'slider-delete',






        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
//        //create User
       // $user = \App\Models\User::find(1);
        $user = \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@diefit.com',
            'phone' => '0123456789',
            'password' => bcrypt('diefit@123456789')
        ]);
//
//        //create Role
        $role = Role::create(['name' => 'admin','guard_name' => 'web']);
        //$role= Role::find(1);
//
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);


  }
}
