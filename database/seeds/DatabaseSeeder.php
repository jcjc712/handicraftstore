<?php

use Illuminate\Database\Seeder;
use App\Category;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('CategoryTableSeeder');

        $this->command->info('User table seeded!');
    }
}

class CategoryTableSeeder extends Seeder {

    public function run()
    {
        DB::table('categories')->delete();
        $categories = ['Clothes', 'Shoes', 'Handicrafts'];
        foreach ($categories as $category){
            Category::create(array('category' => $category));
        }
    }

}