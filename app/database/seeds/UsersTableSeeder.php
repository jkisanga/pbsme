<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();


        $users = array(
            array(
                'username'      => 'victor',
                'first_name'      => 'Victor',
                'last_name'      => 'Kalabamu',
                'email'      => 'nshabav@gmail.com',
                'password'   => Hash::make('tfs123'),
                'confirmed'   => 1,
                'unit_id' => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'username'      => 'silayo',
                'first_name'      => 'Silayo',
                'last_name'      => 'Pancrase',
                'email'      => 'silayo@tfs.go.tz',
                'password'   => Hash::make('tfs123'),
                'confirmed'   => 1,
                'unit_id' => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            )
        );

        DB::table('users')->insert( $users );
    }

}
