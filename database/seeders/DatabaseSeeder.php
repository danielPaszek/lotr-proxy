<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Image;
use App\Models\LightCharacter;
use App\Models\Movie;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        cache all names and their api ids
//        Redis::flushAll();
        if (($open = fopen(storage_path() . '/characters_names.csv', "r")) !== false) {
            while (($data = fgetcsv($open, 1000, ";")) !== false) {
                LightCharacter::updateOrCreate([
                    'name' => $data[0],
                    'api_id' => $data[1]
                ]);
            }
            fclose($open);
        }
//        TODO: fix header issues
        if (($open = fopen(storage_path() . '/movies.csv', "r")) !== false) {
            while (($data = fgetcsv($open, 1000, ";")) !== false) {
                Movie::create([
                    'name' => $data[0],
                    'runtimeInMinutes' => $data[1],
                    'budgetInMillions' => $data[2],
                    'boxOfficeRevenueInMillions' => $data[3],
                    'academyAwardNominations' => $data[4],
                    'academyAwardWins' => $data[5],
                    'rottenTomatoesScore' => $data[6],
                    'api_id' => $data[7]
                ]);
            }
            fclose($open);
        }
        if (($open = fopen(storage_path() . '/images.csv', "r")) !== false) {
            while (($data = fgetcsv($open, 1000, ";")) !== false) {
                Image::create([
                    'characters_api_id' => $data[0],
                    'url' => $data[1],
                ]);
            }
            fclose($open);
        }

    }
}
