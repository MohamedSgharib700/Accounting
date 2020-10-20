<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $create = Permission::create([
        
            'name' => 'create_users',
            'display_name' => 'create users',
            'description' => 'create users .'
    
           ]);
    
           $read = Permission::create([
        
            'name' => 'read_users',
            'display_name' => 'read users',
            'description' => 'read users .'
    
           ]);

           $update = Permission::create([
        
            'name' => 'update_users',
            'display_name' => 'update users',
            'description' => 'update users .'
    
           ]);

           $delete = Permission::create([
        
            'name' => 'delete_users',
            'display_name' => 'delete users',
            'description' => 'delete users .'
    
           ]);

           $create = Permission::create([
        
            'name' => 'create_categories',
            'display_name' => 'create categories',
            'description' => 'create categories .'
    
           ]);
    
           $read = Permission::create([
        
            'name' => 'read_categories',
            'display_name' => 'read categories',
            'description' => 'read categories .'
    
           ]);

           $update = Permission::create([
        
            'name' => 'update_categories',
            'display_name' => 'update categories',
            'description' => 'update categories .'
    
           ]);

           $delete = Permission::create([
        
            'name' => 'delete_categories',
            'display_name' => 'delete categories',
            'description' => 'delete categories .'
    
           ]);

           $create = Permission::create([
        
            'name' => 'create_services',
            'display_name' => 'create services',
            'description' => 'create services .'
    
           ]);
    
           $read = Permission::create([
        
            'name' => 'read_services',
            'display_name' => 'read services',
            'description' => 'read services .'
    
           ]);

           $update = Permission::create([
        
            'name' => 'update_services',
            'display_name' => 'update services',
            'description' => 'update services .'
    
           ]);

           $delete = Permission::create([
        
            'name' => 'delete_services',
            'display_name' => 'delete services',
            'description' => 'delete services .'
    
           ]);


           $create = Permission::create([
        
            'name' => 'create_companies',
            'display_name' => 'create companies',
            'description' => 'create companies .'
    
           ]);
    
           $read = Permission::create([
        
            'name' => 'read_companies',
            'display_name' => 'read companies',
            'description' => 'read companies .'
    
           ]);

           $update = Permission::create([
        
            'name' => 'update_companies',
            'display_name' => 'update companies',
            'description' => 'update companies .'
    
           ]);

           $delete = Permission::create([
        
            'name' => 'delete_companies',
            'display_name' => 'delete companies',
            'description' => 'delete companies .'
    
           ]);


           $create = Permission::create([
        
            'name' => 'create_pos',
            'display_name' => 'create pos',
            'description' => 'create pos .'
    
           ]);
    
           $read = Permission::create([
        
            'name' => 'read_pos',
            'display_name' => 'read pos',
            'description' => 'read pos .'
    
           ]);

           $update = Permission::create([
        
            'name' => 'update_pos',
            'display_name' => 'update pos',
            'description' => 'update pos .'
    
           ]);

           $delete = Permission::create([
        
            'name' => 'delete_pos',
            'display_name' => 'delete pos',
            'description' => 'delete pos .'
    
           ]);

           $create = Permission::create([
        
            'name' => 'create_balances',
            'display_name' => 'create balances',
            'description' => 'create balances .'
    
           ]);
    
           $read = Permission::create([
        
            'name' => 'read_balances',
            'display_name' => 'read balances',
            'description' => 'read balances .'
    
           ]);

           $update = Permission::create([
        
            'name' => 'update_balances',
            'display_name' => 'update balances',
            'description' => 'update balances .'
    
           ]);

           $delete = Permission::create([
        
            'name' => 'delete_balances',
            'display_name' => 'delete balances',
            'description' => 'delete balances .'
    
           ]);


           $create = Permission::create([
        
            'name' => 'create_transactions',
            'display_name' => 'create transactions',
            'description' => 'create transactions .'
    
           ]);
    
           $read = Permission::create([
        
            'name' => 'read_transactions',
            'display_name' => 'read transactions',
            'description' => 'read transactions .'
    
           ]);

           $update = Permission::create([
        
            'name' => 'update_transactions',
            'display_name' => 'update transactions',
            'description' => 'update transactions .'
    
           ]);

           $delete = Permission::create([
        
            'name' => 'delete_transactions',
            'display_name' => 'delete transactions',
            'description' => 'delete transactions .'
    
           ]);


           $create = Permission::create([
        
            'name' => 'create_locations',
            'display_name' => 'create locations',
            'description' => 'create locations .'
    
           ]);
    
           $read = Permission::create([
        
            'name' => 'read_locations',
            'display_name' => 'read locations',
            'description' => 'read locations .'
    
           ]);

           $update = Permission::create([
        
            'name' => 'update_locations',
            'display_name' => 'update locations',
            'description' => 'update locations .'
    
           ]);

           $delete = Permission::create([
        
            'name' => 'delete_locations',
            'display_name' => 'delete locations',
            'description' => 'delete locations .'
    
           ]);
    }
}
