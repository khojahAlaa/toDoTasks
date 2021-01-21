<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Department;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roles=[
            'user',
            'admain',
            'exc',
            'manager'
        ];
        foreach($roles as $role){
            Role::create(['title'=>$role]);
        }
       
        $Departments=[
            'E-health',
            'Biomedical Engineering',
            'Medical Supply and warehouse',
            'Follow-up Department',
            'Patients Relationship',
            'Inventory Control',
            'Physiotherapy',
            'Infection Prevention and Control Department (IPCD)',
            'Nursing'
        ];
        foreach($Departments as $Department){
            Department::create(['name'=>$Department]);
        }
       
       
        factory(App\MyTask::class, rand(1,8))->create();
       
    }
}
