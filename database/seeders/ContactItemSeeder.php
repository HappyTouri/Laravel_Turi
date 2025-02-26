<?php

namespace Database\Seeders;

use App\Models\ContactItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obj = new ContactItem();
        $obj->map = "Code";
        $obj->save();
    }
}
