<?php

include "config.php";

$host_mysql = "localhost";
$user_mysql = "root";
$pass_mysql = "";
$db_mysql = "tienda";
$mysqli = mysqli_connect($host_mysql,$user_mysql,$pass_mysql,$db_mysql);

function clear($var){
	htmlspecialchars($var);

	return $var;
}

function check_admin(){
	if(!isset($_SESSION['id'])){
		redir("./");
	}
}


function redir($var){
	?>
	<script>
		window.location="<?=$var?>";
	</script>
	<?php
	die();
}

function alert($var){

    ?>
    <script type="text/javascript">
        alert("<?=$var?>")
    </script>
    <?php
	
}

function check_user($url){

	if(!isset($_SESSION['id_cliente'])){
		redir("?p=login&return=$url");
	}else{

	}

}

function nombre_cliente($id_cliente){
	$mysqli = connect();

	$q = $mysqli->query("SELECT * FROM clientes WHERE id = '$id_cliente'");
	$r = mysqli_fetch_array($q);
	return $r['name'];
}

function connect(){
	$host_mysql = "localhost";
	$user_mysql = "root";
	$pass_mysql = "";
	$db_mysql = "tienda";


 	$mysqli = mysqli_connect($host_mysql,$user_mysql,$pass_mysql,$db_mysql);

	return $mysqli;
}

function fecha($fecha){
	$e = explode("-",$fecha);

	$year = $e[0];
	$month = $e[1];
	$e2 = explode(" ",$e[2]);
	$day = $e2[0];
	$time = $e2[1];

	$e3 = explode(':',$time);
	$hour = $e3[0];
	$mins = $e3[1];

	return $day."/".$month."/".$year." ".$hour.":".$mins;

}

function estado($id_estado){
	if ($id_estado == 0) {
		$status = "Iniciando";
	} elseif ($id_estado == 1) {
		$status = "Preparando";
	} elseif ($id_estado == 2) {
		$status = "Despachando";
	} elseif ($id_estado == 3) {
		$status = "Finalizado";
	} else {
		$status = "Indefinido";
	}
	return $status;
}

function admin_name_connected(){
	$id = $_SESSION['id'];
	$mysqli = connect();

	$q = $mysqli->query("SELECT * FROM admins WHERE id = '$id'");
	$r = mysqli_fetch_array($q);

	return $r['name'];
}

?>