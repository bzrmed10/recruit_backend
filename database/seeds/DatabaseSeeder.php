<?php
use App\User;
use App\Manager;
use App\Departement;
use App\JobPosition;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::truncate();
        Departement::truncate();
        JobPosition::truncate();
        Manager::truncate();


        $usersQuantity = 10;
        $departementsQuantity = 10;
        $managersQuantity = 20;
        $jobpositionsQuantity = 30;

        factory(User::class,$usersQuantity)->create();
        factory(Departement::class,$departementsQuantity)->create();
        factory(Manager::class,$managersQuantity)->create();
        factory(JobPosition::class,$jobpositionsQuantity)->create();
    }
}
