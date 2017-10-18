<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('financial_years')->delete();


        $financial_years = array(
            array(
                'year'      => '2015/2016',
            )
        );

        DB::table('financial_years')->insert( $financial_years );
    }

}
