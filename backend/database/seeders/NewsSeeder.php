<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        News::create([
            'title' => 'University of the Assumption formally inaugurated its Eco Farm in San Jose Matulid in Mexico, Pampanga',
            'description' => 'The University of the Assumption (UA) formally inaugurated its Eco Farm in San Jose Matulid in Mexico, Pampanga on December 14, 2018.

            The Eco Farm is part of the initiatives of UA, through the Community Extension Office (CEO), to contribute to the preservation and care of the environment. 
                
            Fr. Joselito Henson, University President, said that the UA Eco Farm will be the place where Assumptionists can work together to heal the earth. "The earth is like our mother. We have neglected her for the longest time. This is the place where we can, once again, make concerted efforts to heal the wound we caused her," Fr. Josel said.
            
            The UA Eco Farm is envisioned to house an aquaponics garden, a composting area and a training center.
            
            Sr. Marissa Figueroa, OP, Director of CEO, presented the different programs in the farm. Members of the UA community gather in the farm regularly to till the land, plant a tree, tend to the plants or simply enjoy the gift of nature. Integral also to the program is the formation of UA students and those who live nearby. "Our student volunteers gather the children in the area to conduct catechism classes and some tutorials," Sr. Marissa explained.
            
            Rain did not stop the members of the executive council and management committee, several teachers and students and some residents to wtness the inauguration. Fr. Oliver Yalung, Assistant to the Vice President and Director of the Institute for Theological and Religious Studies, noted before leading the leading the community in the prayer of blessing that "God has already blessed the place", referring to the downpour which became stronger at the moment the prayer was said.
            
            Each of the members of the executive council and management committee adopted one tree and pledged to take care of it. 
            
            The farm is located about 1.8 miles from the campus.
            ',
            'date' => '2018-12-15',
        ]);

        News::create([
            'title' => 'Exploring Creativity during the Covid-19 pandemic',
            'description' => "Exploring Creativity during the Covid-19 pandemic, the CEO initiated an activity that will engage young members of UA SPARK to enhance their God's given talent through Arts. Aside from gardening at the UA ECO Farm, they are given the opportunity to raise funds for their education and enjoy the beauty of God's creation.
            ",
            'date' => '2020-08-28',
        ]);

        News::create([
            'title' => 'UA in the Season of Creation',
            'description' => 'UA in the Season of Creation
            "Alone, we can do so little, Together, we can do so much" - H. Keller
            Samahan ng Pamilyang Aktibo at Responsable sa Kalikasan (SPARK) Hands-on Training on Mushroom Tissue Culture, Spawn and Fruit Bag Production - DA R3 Mushroom Project in Luzon last September 18, 2020 at the UA ECO Farm.
            ',
            'date' => '2020-09-22',
        ]);

        News::create([
            'title' => 'ITRS Extension activities: BFAST session with UA SPARK volunteers',
            'description' => 'ITRS Extension activities: BFAST session with UA SPARK volunteers facilitated by Mr. Romario Polintan and Mr. CJ Lopez last Oct. 16 @ UA Eco Farm. Catechesis on Mary and Rosary shared by Mr. Reynald Velardo and Sr. Antonette Lumbang, OP to the beneficiaries of the HEAL Program (Tri-wheeler drivers and UA SPARK volunteers) Oct. 17, 2020. Thank you for sharing your time, knowledge and love.
            ',
            'date' => '2020-10-17',
        ]);

        News::create([
            'title' => 'Culminating Mass for the Season of Creation 2021',
            'description' => 'The Culminating Mass for the Season of Creation was celebrated by Fr. Oliver G. Yalung, Vice President for the Academic Affairs at 9:00 AM today at the UA ECO Farm. The UA President, Fr. Joselito Henson and Vice-President for the Administration, Fr. Victor Nicdao, graced also the event together with other representatives from other offices. The UACSC officers, select students, and UA Eco Farm volunteers attended the Holy Mass and enjoyed the beauty and bounty of the Creation.
            ',
            'date' => '2021-10-01',
        ]);

        News::create([
            'title' => 'Season of Creation 2022 - E-Connect: A Recollection on Ecological Spirituality',
            'description' => 'Season of Creation 2022- E- Connect: A Recollection on Ecological Spirituality attended by the UA YSLEP Scholars and INA Officers yesterday, Sept. 10 @ UA ECO - Farm. Facilitated by Mr. Reynald Velardo and Mr. Carlo Bondoc, REVE 2016.
            ',
            'date' => '2022-09-10',
        ]);
    }
}
