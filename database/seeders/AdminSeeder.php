<?php

namespace Database\Seeders;

use App\Helpers\AppConstants;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            'name'=>'admin',
            'email'=>'admin200@yopmail.com',
            'password'=>Hash::make('12345678'),
            'email_verified_at'=>formatDate(Carbon::now(),'Y-M-d H:i:s'),
            'status'=>AppConstants::ACTIVE_STATUS,
        ];

        User::firstOrCreate(
            ['email' => $data['email']],
            $data
        );
    }
}
