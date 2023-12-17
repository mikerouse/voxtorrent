<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Geography\City;
use Illuminate\Support\Facades\File;

class CitiesSeeder extends Seeder
{
    public function run()
    {
        $json = File::get("database/seeds/uk-cities.json");
        $data = json_decode($json);

        foreach ($data as $obj) {
            City::create(array(
                'name' => $obj->city,
                'lat' => $obj->lat,
                'lng' => $obj->lng,
                'country' => $obj->country,
                'iso2' => $obj->iso2,
                'admin_name' => $obj->admin_name,
                'capital' => $obj->capital,
                'population' => $obj->population,
                'population_proper' => $obj->population_proper,
            ));
        }
    }
}