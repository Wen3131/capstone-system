<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'role' => '1',
            'level' => '0',
            'name' => 'Community Extension Office',
            'username' => 'ceo',
            // 'email' => 'ceo@ua.edu.ph',
            'password' => Hash::make('admin123'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role' => '1',
            'level' => '3',
            'name' => 'College of Information Technology, Computing and Library Science',
            'username' => 'citcls',
            // 'email' => 'citcls@ua.edu.ph',
            'password' => Hash::make('admin123'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role' => '0',
            'level' => '1',
            'name' => 'Grade School',
            'username' => 'uags',
            // 'email' => 'uags@ua.edu.ph',
            'password' => Hash::make('uags'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role' => '0',
            'level' => '3',
            'name' => 'College of Accountancy',
            'username' => 'coa',
            // 'email' => 'coa@ua.edu.ph',
            'password' => Hash::make('coa'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role' => '0',
            'level' => '3',
            'name' => 'College of Engineering and Architecture',
            'username' => 'cea',
            // 'email' => 'cea@ua.edu.ph',
            'password' => Hash::make('cea'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role' => '0',
            'level' => '3',
            'name' => 'College of Hospitality and Tourism Management',
            'username' => 'chtm',
            // 'email' => 'chtm@ua.edu.ph',
            'password' => Hash::make('chtm'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role' => '0',
            'level' => '3',
            'name' => 'College of Nursing and Pharmacy',
            'username' => 'conp',
            // 'email' => 'conp@ua.edu.ph',
            'password' => Hash::make('conp'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role' => '0',
            'level' => '2',
            'name' => 'Junior High School',
            'username' => 'jhs',
            // 'email' => 'jhs@ua.edu.ph',
            'password' => Hash::make('jhs'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role' => '0',
            'level' => '3',
            'name' => 'School of Arts and Sciences',
            'username' => 'sas',
            // 'email' => 'sas@ua.edu.ph',
            'password' => Hash::make('sas'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role' => '0',
            'level' => '3',
            'name' => 'School of Business and Public Administration',
            'username' => 'sbpa',
            // 'email' => 'sbpa@ua.edu.ph',
            'password' => Hash::make('sbpa'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role' => '0',
            'level' => '3',
            'name' => 'School of Education',
            'username' => 'sed',
            // 'email' => 'sed@ua.edu.ph',
            'password' => Hash::make('sed'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role' => '0',
            'level' => '2',
            'name' => 'Senior High School',
            'username' => 'shs',
            // 'email' => 'shs@ua.edu.ph',
            'password' => Hash::make('shs'),
            'remember_token' => Str::random(10),
        ]);
    }
}
