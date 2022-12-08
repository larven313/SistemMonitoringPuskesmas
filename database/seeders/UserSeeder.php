<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\Models\User;
        $administrator->username = "Ahmad";
        $administrator->name = "Customer";
        $administrator->email = "customer@larashop.com";
        $administrator->roles = json_encode(["CUSTOMER"]);
        $administrator->password = Hash::make("bismillah");
        $administrator->avatar = "saat-ini-tidak-ada-file.png";
        $administrator->address = "Rangkapanjaya Pancoran Mas";

        $administrator->save();
        $this->command->info("User Customer telah di tambahkan");
    }
}
