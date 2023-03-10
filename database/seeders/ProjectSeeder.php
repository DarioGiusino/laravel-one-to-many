<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 8; $i++) {
            // create new istance
            $project = new Project();

            // fill cols with faker utils
            $project->title = $faker->text(20);
            $project->description = $faker->paragraphs(10, true);
            // $project->image = $faker->imageUrl(200, 200);
            $project->repo_link = $faker->url(1);
            $project->is_published = $faker->boolean();

            // fill row
            $project->save();
        }
    }
}
