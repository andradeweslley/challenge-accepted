<?php

namespace Database\Seeders;

use App\Models\Locale;
use App\Models\Weather;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Retrieve data from locales
        $allData = json_decode(Storage::disk('base')->get('weather.json'), true);

        // Input data into database
        foreach ($allData as $data) {     
            if (!Locale::find($data['locale']['id'])) {
                // Retrieve data from locale and adds in table
                $locale = new Locale();

                $locale->name = $data['locale']['name'];
                $locale->state = $data['locale']['state'];
                $locale->latitude = $data['locale']['latitude'];
                $locale->longitude = $data['locale']['longitude'];

                $locale->save();
            }

            foreach ($data['weather'] as $weatherData) {
                // Retrieve data from weather and adds in table
                $weather = new Weather();
    
                $weather->locale_id = $data['locale']['id'];
                $weather->date = $weatherData['date'];
                $weather->text = $weatherData['text'];
                $weather->temperature_min = $weatherData['temperature']['min'];
                $weather->temperature_max = $weatherData['temperature']['max'];
                $weather->rain_probability = $weatherData['rain']['probability'];
                $weather->rain_precipitation = $weatherData['rain']['precipitation'];
    
                $weather->save();
            }
        }
    }
}
