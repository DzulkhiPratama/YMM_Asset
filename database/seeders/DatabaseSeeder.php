<?php

namespace Database\Seeders;

use App\Models\asset_status;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\assets;
use App\Models\asset_types;
use App\Models\location;
use App\Models\purpose;
use App\Models\users_role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(15)->create();
        Assets::factory(10)->create();

        asset_types::create([

            'asset_type_name' => "Elektronik",
            'asset_type_Code' => "El",
            'asset_type_desc' => "barang yang membutuhkan listrik"
        ]);

        asset_types::create([

            'asset_type_name' => "Furniture",
            'asset_type_Code' => "F",
            'asset_type_desc' => "perlengkapan yang bisa dibuat dari beragam material"
        ]);

        asset_types::create([

            'asset_type_name' => "Cookware",
            'asset_type_Code' => "C",
            'asset_type_desc' => "perlengkapan yang terkait erat dengan kegiatan dapur"
        ]);

        asset_types::create([

            'asset_type_name' => "Book",
            'asset_type_Code' => "B",
            'asset_type_desc' => "Perlengkapan yang bentuk atau fungsinya dokumentasi"
        ]);

        asset_types::create([

            'asset_type_name' => "Equipment",
            'asset_type_Code' => "Eq",
            'asset_type_desc' => "Perlengkapan/Perkakas"
        ]);

        asset_status::create([

            'asset_status_name' => "Available",
            'asset_status_desc' => "property ada"
        ]);

        asset_status::create([

            'asset_status_name' => "On Loan/Maintanance",
            'asset_status_desc' => "property ada, namun sedang dibenahi"
        ]);

        asset_status::create([

            'asset_status_name' => "Not Exist",
            'asset_status_desc' => "property tidak lagi tersedia"
        ]);

        location::create([

            'asset_HL_LL' => "HL",
            'asset_loc_mp' => 68,
            'asset_loc_dkm' => "DKM A",
            'asset_loc_dkm_room' => "A",
            'asset_location_desc' => "Tembagapura MP 68 DKM A",
        ]);

        location::create([

            'asset_HL_LL' => "HL",
            'asset_loc_mp' => 72,
            'asset_loc_dkm' => "DKM B",
            'asset_loc_dkm_room' => "A",
            'asset_location_desc' => "Ridge Camp MP 72 DKM A",
        ]);

        location::create([

            'asset_HL_LL' => "LL",
            'asset_loc_mp' => 32,
            'asset_loc_dkm' => "DKM C",
            'asset_loc_dkm_room' => "A",
            'asset_location_desc' => "Port Camp MP 72 DKM A",
        ]);
        users_role::create([

            'roles_type_name' => "user",
            'roles_type_desc' => "common user",

        ]);
        users_role::create([

            'roles_type_name' => "admin",
            'roles_type_desc' => "developer and ymm admin",
        ]);

        purpose::create([
            'purpose_name' => "Loan",
            'purpose_desc' => "Loan to certain purpose",
        ]);
        purpose::create([
            'purpose_name' => "Maintanance",
            'purpose_desc' => "to fix the asset issues",
        ]);
    }
}
