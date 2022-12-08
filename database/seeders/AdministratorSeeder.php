<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // role ADMIN, STAFF, CUSTOMER
        $administrator = new \App\Models\User;
        $administrator->username = "Larven";
        $administrator->name = "Staff Administrator";
        $administrator->email = "staff@larashop.com";
        $administrator->roles = json_encode(["STAFF"]);
        $administrator->password = Hash::make("bismillah");
        $administrator->avatar = "saat-ini-tidak-ada-file.png";
        $administrator->address = "Rangkapanjaya Pancoran Mas";

        $administrator->save();

        $this->command->info("User Admin berhasil di insert");
    }
}
