<?php

namespace Database\Seeders;
use App\Models\Language;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CreateLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $json = File::get("database/data/languages.json");
            $data = json_decode($json);
            foreach ($data as $obj) {
                Language::create([
                    "name_en"=> $obj->name_en,
                    "name_es"=> $obj->name_es,
                    "meaning_name_en"=> $obj->meaning_name_en,
                    "meaning_name_es"=> $obj->meaning_name_es
                ]);
            }
        } catch (\Illuminate\Contracts\Filesystem\FileNotFoundException $e) {
        }
    }
}
