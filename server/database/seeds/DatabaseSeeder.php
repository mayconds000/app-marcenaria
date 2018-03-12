<?php

use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Customer;
use \App\Models\Environment;
use \App\Models\Order;
use \App\Models\Product;
use \App\Models\OrderProduct;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();
        Customer::truncate();
        Order::truncate();
        Product::truncate();

        $this->call('EnvironmentSeeder');

        //Insert a admin user
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => app('hash')->make('admin')
        ]);

        factory(User::class, 3)->create()->each(function ($user) {
            factory(Customer::class, 1)->create()->each(function ($customer) use ($user) {
                $customer = $user->customer()->save($customer);
                for ($i = 0; $i < 4; $i++) {
                    $newOrder = new Order();
                    $order = $customer->orders()->save($newOrder);
                    for ($j = 1; $j <= 3; $j++) {
                        $environment = Environment::find(mt_rand(1,6));
                        $environment_order = $order->environments()->save($environment);
                        factory(Product::class, 3)->create()->each(function($product) use ($environment_order) {
                            $faker = \Faker\Factory::create('pt_BR');
                            $product = $environment_order->products()->attach($product->id, [
                                'description' => $faker->sentence(8),
                                'value' => $faker->randomFloat(2, 100, 3000),
                                'quantity' => mt_rand(1, 3)
                                ]);
                        });
                    }
                }
            });
        });
    }
}
