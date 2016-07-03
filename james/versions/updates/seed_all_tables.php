<?php namespace James\Versions\Updates;

use October\Rain\Database\Updates\Seeder;
use James\Versions\Models\Software;
use James\Versions\Models\Version;

class SeedAllTables extends Seeder
{

    public function run()
    {
        Software::create([
            'name' => 'Unity3D'
        ]);

        Version::create([
            'software_id' => 1,
            'version' => "5.3.5f1"
        ]);
    }

}
