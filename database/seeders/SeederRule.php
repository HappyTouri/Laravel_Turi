<?php

namespace Database\Seeders;

use App\Models\Rule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeederRule extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rules = ["Admin", "Tour Operator", "Tour Guide", "Hotel", "Travel Agency", "Driver"];

        foreach ($rules as $ruleName) {
            $obj = new Rule();
            $obj->rule = $ruleName;
            $obj->save();
        }
    }
}
