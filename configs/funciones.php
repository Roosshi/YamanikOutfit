<?php
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
?>