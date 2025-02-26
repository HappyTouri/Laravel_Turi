<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obj = new Setting();
        $obj->logo = "";
        $obj->favicon = "";
        $obj->top_bar_phone = "(+995) 558 593 221";
        $obj->top_bar_email = "tbilisitraveler@gmail.com";
        $obj->footer_phone = "(+995) 558 593 221";
        $obj->footer_email = "tbilisitraveler@gmail.com";
        $obj->footer_address = "";
        $obj->facebook = "#";
        $obj->instagram = '#';
        $obj->linkedin = "#";
        $obj->twitter = '#';
        $obj->youtube = "#";
        $obj->copyright = "";
        $obj->banner = "";
        $obj->save();
    }
}
