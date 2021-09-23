<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\MenuCategory;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //   \App\Models\User::factory(10)->create();
        //   $this->call(PermissionTableSeeder::class);
       //    $this->call(CreateAdminUserSeeder::class);
     //      $this->call(AppSettingSeeder::class);
     //      $this->call(TextSeeder::class);

        // $this->call(NavSeeder::class);

        MenuCategory::insert([
            [
                'name' => 'Home',
                'slug' => Str::slug('Home')
            ],
            [
                'name' => 'About Us',
                'slug' => Str::slug('About Us')
            ],
            [
                'name' => 'Software',
                'slug' => Str::slug('Software')
            ],
            [
                'name' => 'Services',
                'slug' => Str::slug('Services')
            ],
            [
                'name' => 'Team',
                'slug' => Str::slug('Team')
            ],
            [
                'name' => 'Contact',
                'slug' => Str::slug('Contact')
            ],

        ]);


    }
}
