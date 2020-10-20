<?php
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'name'  => 'accounting manager ',
            'email' => 'accounting@amwal.com',
            'phone' => '01014503418',
            'type'  => '7' ,
            'password' =>'12345678',
            'active' => '1',

        ]);

        $user->attachRole('sales_manager');
        $user->syncPermissions(['create_users' , 'read_users' , 'update_users' , 'delete_users' ,
                                'create_customers' , 'read_customers' , 'update_customers' , 'delete_customers',
                                 'read_pos',
                                'create_balances' , 'read_balances' , 'update_balances' , 'delete_balances',
                                'create_transactions' , 'read_transactions' , 'update_transactions' , 'delete_transactions',
                                'create_locations' , 'read_locations' , 'update_locations' , 'delete_locations'
                                ]);
    }//end of run
}// end of seeder
