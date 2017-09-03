<?php

use Illuminate\Database\Seeder;

class Cubiculos extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //
        for ($i = 1; $i <= 5; $i++) {
            $cubiculo = new \p2_v2\Cubiculo();
            $cubiculo->numero = $i;
            $cubiculo->save();
        }
    }

}
