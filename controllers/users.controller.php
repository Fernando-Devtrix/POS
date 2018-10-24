<?php

class UserController {

	/*========================
	=      User Login        =
	========================*/

	public function ctrlUserLogin() {

		if (isset($_POST["enterUser"])) {
			
			if (preg_match('/^[-a-zA-Z0-9]+$/', $_POST["enterUser"]) &&
			    preg_match('/^[-a-zA-Z0-9]+$/', $_POST["enterPassword"])) {
				
			    $table = "usuarios";

			    $item = "usuario";
			    $value = $_POST["enterUser"];

			    $answer = UserModel::MdlShowUsers($table, $item, $value);

			    if($answer['usuario'] ==  $_POST["enterUser"] && $answer['password'] == $_POST["enterPassword"]) {

			    	$_SESSION['isLogIn'] = "ok";

			    	echo '<script>

						window.location = "main";

			    	</script>';


			    }else{

			    	echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentar</div>';

			    }

		    }

    	}
    }
		
}