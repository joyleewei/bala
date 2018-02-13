<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        // php artisan db:seed --class=TopicsTableSeeder
        $this->call(UsersTableSeeder::class);
        // php artisan db:seed --class=TopicsTableSeeder
		$this->call(TopicsTableSeeder::class);
    }

}
