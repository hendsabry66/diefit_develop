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
            'article-category-list',
            'article-category-create',
            'article-category-edit',
            'article-category-delete',
            'article-list',
            'article-create',
            'article-edit',
            'article-delete',
            'extra-list',
            'extra-create',
            'extra-edit',
            'extra-delete',
            'food-category-list',
            'food-category-create',
            'food-category-edit',
            'food-category-delete',
            'food-list',
            'food-create',
            'food-edit',
            'food-delete',
            'food-type-list',
            'food-type-create',
            'food-type-edit',
            'food-type-delete',
            'week-food-list',
            'week-food-create',
            'week-food-edit',
            'week-food-delete',
            'restaurant-order-list',
            'restaurant-order-create',
            'restaurant-order-edit',
            'restaurant-order-delete',
            'store-order-list',
            'store-order-create',
            'store-order-edit',
            'store-order-delete',
            'subscription-order-list',
            'subscription-order-create',
            'subscription-order-edit',
            'subscription-order-delete',
            'product-category-list',
            'product-category-create',
            'product-category-edit',
            'product-category-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'product-specification-category-list',
            'product-specification-category-create',
            'product-specification-category-edit',
            'product-specification-category-delete',
            'product-specification-list',
            'product-specification-create',
            'product-specification-edit',
            'product-specification-delete',
            'branch-list',
            'branch-create',
            'branch-edit',
            'branch-delete',
            'clientReview-list',
            'clientReview-create',
            'clientReview-edit',
            'clientReview-delete',
            'slider-list',
            'slider-create',
            'slider-edit',
            'slider-delete',
            'teamMember-list',
            'teamMember-create',
            'teamMember-edit',
            'teamMember-delete',
            'subscription-list',
            'subscription-create',
            'subscription-edit',
            'subscription-delete',
            'type-list',
            'type-create',
            'type-edit',
            'type-delete',
            'video-category-list',
            'video-category-create',
            'video-category-edit',
            'video-category-delete',
            'video-list',
            'video-create',
            'video-edit',
            'video-delete',
            'area-list',
            'area-create',
            'area-edit',
            'area-delete',
            'bank-accounts-list',
            'bank-accounts-create',
            'bank-accounts-edit',
            'bank-accounts-delete',
            'city-list',
            'city-create',
            'city-edit',
            'city-delete',
            'district-list',
            'district-create',
            'district-edit',
            'district-delete',
            'page-list',
            'page-create',
            'page-edit',
            'page-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'status-list',
            'status-create',
            'status-edit',
            'status-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'dashboard-list',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
//        //create User
        $user = \App\Models\User::find(1);
//        $user = \App\Models\User::create([
//            'name' => 'admin',
//            'email' => 'admin@diefit.com',
//            'phone' => '0123456789',
//            'password' => bcrypt('diefit@123456789')
//        ]);
//
//        //create Role
        //$role = Role::create(['name' => 'admin','guard_name' => 'web']);
        $role= Role::find(1);
//
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);


  }
}
