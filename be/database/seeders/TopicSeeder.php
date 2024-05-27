<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listTopic = ['php','c++','python'];
        foreach($listTopic as $topic)
        {
            Topic::create([
                'name' => $topic,
            ]);
        }
    }
}
