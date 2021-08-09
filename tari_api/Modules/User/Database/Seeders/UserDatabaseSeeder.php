<?php

namespace Modules\User\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Schema::disableForeignKeyConstraints();
        // $this->command->info('Execute seeder for users');
        \DB::table('users')->truncate();

        $user = User::firstOrNew(['email' => 'superadministrator@tari.id']);
        $user->email = 'superadministrator@tari.id';
        $user->firstName = "super";
        $user->lastName = 'admin';
        $user->password = bcrypt('password');
        $user->homeAddress = 'bandung';
        $user->dateOfBirth = now();
        $user->nickName = 'SuperAdministrator';
        $user->noHp = '089621174934';
        $user->isVerified = false;
        $user->isSubcribe = false;

        $user->assignRole(['superadministrator']);
        $user->save();

        $user = User::firstOrNew(['email' => 'dikamahar884@tari.id']);
        $user->email = 'dikamahar884@tari.id';
        $user->firstName = "Mahardika";
        $user->lastName = 'Kessuma Denie';
        $user->password = bcrypt('password');
        $user->homeAddress = 'bandung';
        $user->dateOfBirth = now();
        $user->nickName = 'Denie';
        $user->noHp = '089621174935';
        $user->isVerified = false;
        $user->isSubcribe = false;

        $user->assignRole(['superadministrator']);
        $user->save();

        $user = User::firstOrNew(['email' => 'instructor@tari.id']);
        $user->email = 'instructor@tari.id';
        $user->firstName = "instructor";
        $user->lastName = 'Jago';
        $user->password = bcrypt('password');
        $user->homeAddress = 'bandung';
        $user->dateOfBirth = now();
        $user->nickName = 'instructor';
        $user->noHp = '089621174935';
        $user->isVerified = false;
        $user->isSubcribe = false;

        $user->assignRole(['instructor']);
        $user->save();
        Schema::enableForeignKeyConstraints();
    }
}