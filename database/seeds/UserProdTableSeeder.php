<?php
use App\User;
use Illuminate\Database\Seeder;

class UserProdTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker= Faker\Factory::create(); 
        for($i=0;$i<30;$i++){
            User::create([
                'name'=> $faker->sentence(4),
                'email'=> $faker->unique()->email,
                'password'=> $faker->sentence(4)
                ])->prods()->attach([
                    rand(1,7),
                    rand(1,4)
                ]);
        }
    }
}
