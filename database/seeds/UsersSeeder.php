<?php

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Card;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_admin = User::create([
            'username' => 'admin',
            'password' => Hash::make('password'),
            'name' => '매점관리자',
        ]);
        $user_admin->is_admin = true;
        $user_admin->save();
        $user = User::create([
            'username' => 'user',
            'password' => Hash::make('password'),
            'name' => '이준수',
            'grade' => 3,
            'class' => 7,
            'number' => 18
        ]);
        Wallet::create([
            'user_id' => $user->id,
            'balance' => 0,
        ]);
        Card::create([
            'user_id' => $user->id,
            'is_student_id' => true,
            'fingerprint' => '25:49:5A:27',
        ]);
        Card::create([
            'user_id' => $user->id,
            'is_student_id' => false,
            'fingerprint' => '45:8B:C0:7E',
        ]);
    }
}
