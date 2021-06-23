<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role = [
            ['name' => 'Admin','description' => '','created_at' => '2019-09-05 11:13:00','updated_at' => '2019-09-05 11:13:00' ],
            ['name' => 'User','description' => '','created_at' => '2019-09-05 11:13:00','updated_at' => '2019-09-05 11:13:00' ],
            //['title' => 'Doctor', 'created_at' => '2019-09-05 11:13:00', 'updated_at' => '2019-09-05 11:13:00'],
            //['title' => 'Clinic', 'created_at' => '2019-09-05 11:13:00', 'updated_at' => '2019-09-05 11:13:00'],
            //['title' => 'Ambulance', 'created_at' => '2019-09-05 11:13:00', 'updated_at' => '2019-09-05 11:13:00'],
            //['title' => 'Caregivers', 'created_at' => '2019-09-05 11:13:00', 'updated_at' => '2019-09-05 11:13:00'],
        ];
        Role::insert($role);


        $users = [
            [
                'role_id' => '1',
                'name' => 'Robeul',
                //'username'=>'Admin',
                'email' => 'robeul.starit@gmail.com',
                //'country_code' => '+880',
                //'phone' => '1723144514',
                'password' => bcrypt('123456'),
                'created_at' => '2019-09-05 11:13:00',
                'updated_at' => '2019-09-05 11:13:00',
            ],

            [
                'role_id' => '2',
                'name' => 'Robi',
                //'username'=>'demo',
                'email' => 'robicse8@gmail.com',
                //'slug' => 'dr-md-demo',
                //'country_code' => '+880',
                //'phone' => '1723144515',
                'password' => bcrypt('123456'),
                'created_at' => '2019-09-05 11:13:00',
                'updated_at' => '2019-09-05 11:13:00',
            ],
//            [
//                'role_id' => '3',
//                'name' => 'Clinic manager',
//                'username'=>'clinic',
//                'slug' => 'clinic-manager',
//                'email' => 'clinic.manager@starit.com',
//                'country_code' => '+880',
//                'phone' => '1723144516',
//
//                'password' => bcrypt('123456'),
//                'created_at' => '2019-09-05 11:13:00',
//                'updated_at' => '2019-09-05 11:13:00',
//            ],
//            [
//                'role_id' => '4',
//                'name' => 'Ambulance Driver',
//                'username'=>'driver',
//                'slug' => 'ambulance-driver',
//                'email' => 'ambulance.driver@starit.com',
//                'country_code' => '+880',
//                'phone' => '1723144518',
//                'password' => bcrypt('123456'),
//                'created_at' => '2019-09-05 11:13:00',
//                'updated_at' => '2019-09-05 11:13:00',
//            ],
//            [
//                'role_id' => '5',
//                'name' => 'demo caregivers',
//                'username'=>'caregivers',
//                'slug' => 'demo-caregivers',
//                'email' => 'demo.caregivers@starit.com',
//                'country_code' => '+880',
//                'phone' => '1723144519',
//                'password' => bcrypt('123456'),
//                'created_at' => '2019-09-05 11:13:00',
//                'updated_at' => '2019-09-05 11:13:00',
//            ],
//            [
//                'role_id' => '6',
//                'name' => 'demo User',
//                'username'=>'user',
//                'slug' => 'demo-user',
//                'email' => 'demo.user@starit.com',
//                'country_code' => '+880',
//                'phone' => '1723144520',
//                'password' => bcrypt('123456'),
//                'created_at' => '2019-09-05 11:13:00',
//                'updated_at' => '2019-09-05 11:13:00',
//            ],

        ];
        //User::insert($user);
        foreach($users as $user){
            User::create($user);
        }

//        DB::table('doctors')->insert([
//            'user_id' => 2,
//            'title' => 'MBBS, FCPS, Dhaka Medical',
//            'slug' => 'mbbs-fcps-dhaka-medical',
//            'is_active' => 1,
//        ]);
//
//         DB::table('clinics')->insert([
//            'user_id' => 3,
//            'name' => 'Demo Clinic',
//            'slug' => 'demo-clinic',
//            'lat'=>'23.752972',
//            'long'=>'90.381671',
//            'emergency_phone' => '01723144525',
//        ]);
//
//        DB::table('ambulances')->insert([
//            'user_id' => 4,
//            'clinic_id' => 1,
//            'license_number' => '564165447',
//            'is_active' => 1,
//        ]);
//        DB::table('caregivers')->insert([
//            'user_id' => 5,
//            'user_id' => 1,
//            'title' => 'caregivers title',
//            'slug' => 'caregivers-title',
//            'gender' => 'female',
//            'department_id' => '1',
//        ]);
//        DB::table('trips')->insert([
//            'user_id' => 4,
//            'ambulance_id' =>1,
//            'from_address' => 'Dhanmondi',
//            'to_address' => 'Kollanpur',
//
//        ]);
//        DB::table('departments')->insert([
//            'id' => 1,
//            'name' => 'Neurology',
//            'slug' => 'Orthopedics',
//
//        ]);
    }
}
