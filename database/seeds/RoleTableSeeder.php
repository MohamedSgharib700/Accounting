<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       $superAdmin = Role::create([

        'name' => 'super_admin',
        'display_name' => 'super admin',
        'description' => 'The owner of this job can enjoy all the permissions .'

       ]);

       $subAdmin = Role::create([

        'name' => 'sub_admin',
        'display_name' => 'sub admin',
        'description' => 'The owner of this functionality can enjoy many permissions .'

       ]);

       $customerServicesAdmin = Role::create([

        'name' => 'customer_service_admin',
        'display_name' => 'customer service admin',
        'description' => 'This account can manage the customer service unit .'

       ]);

       $TechnicalSupportAdmin = Role::create([

        'name' => 'trchnical_support_admin',
        'display_name' => 'trchnical support admin',
        'description' => 'This account can manage the technical support unit .'

       ]);
        $delegate = Role::create([

            'name' => 'Delegate',
            'display_name' => 'Delegate',
            'description' => 'Delegate .'

        ]);

    } //end of run
} //end of seeder
