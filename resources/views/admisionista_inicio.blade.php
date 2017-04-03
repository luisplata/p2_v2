Registro de Pacientes
{{Form::open(array("url"=>"admisionista/registrarPaciente"))}}
    nombre:<input type="text" name="nombre">
<br>
cedula: <input type="number" name="cedula">
<br>
telefono: <input type="tel" name="telefono">
<br>
direccion: <input type="text" name="direccion">
<br>
sexo: <input type="text" name="sexo" placeholder="Colocar H o M">
<br>
<input type="submit" value="Registrar">
{{Form::close()}}