<?php

namespace Database\Seeders;

use App\Models\Research;
use App\Models\ResearchAuthor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResearchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Research::create([
            'title' => 'Site Develop Plan for UA Eco Farm at San Jose Matulid',
            'description' => 'Future Architects from Senior High proposed Site Develop Plan for UA Eco Farm @ San Jose Matulid. Panels were Architect Valencia, Maam Violy and Sr. Marissa.
            ',
            'date' => '2018-02-23',
        ]);

        ResearchAuthor::create([
            'research_id' => 1,
            'user_id' => 12,
        ]);

        Research::create([
            'title' => 'Feasibility of using Wild Chili Peppers and Garlic as an Organic Insecticide Spray to Eliminate Aphids',
            'description' => 'Research Project - A group of Senior High school students from Our Lady of Guadalupe section visited the UA ECO Farm on February 17th to conduct a research study on the feasibility of using wild chili peppers and garlic as an organic insecticide spray to eliminate aphids. The study aimed to develop a sustainable and Eco-friendly solution for protecting and sustaining vegetable crops. The students hoped their research would provide insights into natural ingredients used for safer pest control.
            ',
            'date' => '2023-03-04',
        ]);

        ResearchAuthor::create([
            'research_id' => 2,
            'user_id' => 12,
        ]);
    }
}
