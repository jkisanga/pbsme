<?php

class RolesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();

        $adminRole = new Role;
        $adminRole->name = 'admin';
        $adminRole->save();

        $commentRole = new Role;
        $commentRole->name = 'comment';
        $commentRole->save();

        $user = User::where('username','=','victor')->first();
        $user->attachRole( $adminRole );
        $user = User::where('username','=','josh')->first();
        $user->attachRole( $adminRole );
        $user = User::where('username','=','silayo')->first();
        $user->attachRole( $adminRole );
        $user = User::where('username','=','frida')->first();
        $user->attachRole( $adminRole );

        $user = User::where('username','=','temba')->first();
        $user->attachRole( $commentRole );
    }

}
