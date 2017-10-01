<?php

use Illuminate\Database\Seeder;

class Cubiculos extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //eliminamos todos los cubiculos
        for ($i = 1; $i <= 5; $i++) {
            $cubiculo = new \p2_v2\Cubiculo();
            $cubiculo->numero = $i;
            $cubiculo->save();
        }
		//creamos el primer administrador
		$admin = new \p2_v2\Personal();
		$admin->cedula = "0";
		$admin->nombre ="Admin";
		$admin->telefono ="x";
		$admin->sexo ="H";
		$admin->direccion = "x";
		$admin->tipo = "ADMINISTRADOR";
		$admin->estado ="ACTIVADO";
		$admin->pass ="b6589fc6ab0dc82cf12099d1c2d40ab994e8410c";
		$admin->save();
    }

}
