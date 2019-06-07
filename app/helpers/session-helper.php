<?php  
	session_start();

	// Flash messages
	// EXAMPLE - flash('register_success', 'Você foi registrado !', 'alert alert-success')
	// DISPLAY IN VIEW - echo flash('register_user')  
	function flash($name = '', $message = '', $class = 'alert alert-success') {
		if (!empty($name)) {
			if (!empty($message) && empty($_SESSION[$name])) {
				if (!empty($_SESSION[$name])) {
					unset($_SESSION[$name]);
				}

				if (!empty($_SESSION[$name . '_class'])) {
					unset($_SESSION[$name . '_class']);
				}

				$_SESSION[$name] = $message;
				$_SESSION[$name . '_class'] = $class;
			}elseif (empty($message) && !empty($_SESSION[$name])) {
				$class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
				echo "<div class='". $class ."' id='msg-flash'><strong></strong> ".$_SESSION[$name]."<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					    <span aria-hidden='true'>&times;</span>
					  </button></div>";
				unset($_SESSION[$name]);
				unset($_SESSION[$name . '_class']);
			}
		}

	}

	// Verif if user is logged
	function isLogged(){
		if (isset($_SESSION['id_usuario'])) {
			return true;
		}else{
			return false;
			// $this->logout();
		}
	}

?>