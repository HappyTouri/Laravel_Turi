<?php

namespace Database\Seeders;

use App\Models\Cooperator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;

class CooperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obj = new Cooperator;
        $obj->name = "Kerollos";
        $obj->email = "tbilisitraveler@gmail.com";
        $obj->photo = "admin.jpg";
        $obj->password = Hash::make('1234');
        $obj->token = "";
        $obj->save();
    }
}
