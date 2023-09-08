<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\ProgramAuthor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Program::create([
            'title' => 'Beneficiaries of the Wellness Program Visit UA Eco Farm',
            'description' => 'Twenty-seven senior citizens of Purok 8, San Jose, City of San Fernando, Pampanga and 15 children from the Eco Kids program were treated to an Ecology Tour at the UA ECO FARM in San Jose Matulid in Mexico.
            
            UA Wellness Program is a joint project of the College of Nursing and Pharmacy (CNP), School of Arts and Sciences (SAS), College of Hospitality and Tourism Management (CHTM) and College of Information Technology, Computing and Library Science (CITCLS) under the auspices of the Community Extension Office (CEO). Its goal is to help the beneficiaries increase their knowledge on nutrition, maintain a healthy lifestyle and improve physical condition and quality community living as well.
            
            The Eco Kids program aims to teach the children about the protection and preservation of the
            environment.
            
            Students of Bachelor of Science in Tourism Management and Bachelor of Science in Hospitality Management made a brief presentation on the significance of ecology tours and the importance of travelling light and conscious effort on safety.
            ',
            'date' => '2019-07-16',
        ]);

        ProgramAuthor::create([
            'program_id' => 1,
            'user_id' => 1,
        ]);

        Program::create([
            'title' => 'UAJHS Opening Activity at UA Eco Farm',
            'description' => 'November 4, 2019. University of the Assumption Junior High School faculty and staff started the opening of the second semester of School Year 2019-2020 with a greening activity at the UA Eco Farm in coordination with UA Community Extension Office.

            Sr. Marissa Figueroa, OP, CEO Director, facilitated the opening activity which culminated with a pledge to protect creation.
            
            This was followed by planting, watering and cultivating of the plants led by the UAJHS Principal Ms. Edita Sagmit.
            ',
            'date' => '2019-11-04',
        ]);

        ProgramAuthor::create([
            'program_id' => 2,
            'user_id' => 1,
        ]);

        Program::create([
            'title' => 'CEO Volunteers Mission Action Batch 2 - Christmas Family Reflection @ UA ECO Farm',
            'description' => 'CEO Volunteers Mission Action Batch 2 - Christmas Family Reflection @ UA ECO Farm facilitated by VERE 2nd in coordination with Thelogy professors, Mr. Khervin Domingo and Mr. CJ Lopez, Dec. 21, 2019.
            ',
            'date' => '2019-12-21',
        ]);

        ProgramAuthor::create([
            'program_id' => 3,
            'user_id' => 1,
        ]);

        Program::create([
            'title' => 'Tourism Students Gardening and Outreach Activity @ UA ECO Farm',
            'description' => 'Tourism Students Gardening Activity - Outreach Activity - Doing Theology and Living Laudato Si @ UA ECO Farm December 21, 2019.
            ',
            'date' => '2019-12-21',
        ]);

        ProgramAuthor::create([
            'program_id' => 4,
            'user_id' => 1,
        ]);
    }
}
