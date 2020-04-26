<select id="categoria" onchange="redir_cat" class="form-control">
	<option value="">Seleccione una categoria</option>
	<?php
	$cats = $mysqli->query("SELECT * FROM categorias ORDER BY categoria ASC");
	while ($rcat = mysqli_fetch_array($cats)) {
	?>
		<option value="<?= $rcat['id'] ?>"><?= $rcat['categoria'] ?></option>
	<?php
	}
	?>
</select>



<?php

check_user("productos");

if (isset($cat)) {
	$sc = $mysqli->query("SELECT * FROM categorias WHERE id = '$cat'");
	$rc = mysqli_fetch_array($sc);
	?>
	<h1>Categoria filtrada por: <?=$rc['categoria']?></h1>
	<?php
}

if (isset($agregar) && isset($cant)) {

	$idp = clear($agregar);
	$cant = clear($cant);
	$id_cliente = clear($_SESSION['id_cliente']);


	$v = $mysqli->query("SELECT * FROM carro WHERE id_cliente = '$id_cliente' AND id_producto = '$idp'");

	if (mysqli_num_rows($v) > 0) {

		$q = $mysqli->query("UPDATE carro SET cant = cant + $cant WHERE id_cliente = '$id_cliente' AND id_producto = '$idp'");
	} else {

		$q = $mysqli->query("INSERT INTO carro (id_cliente,id_producto,cant) VALUES ($id_cliente,$idp,$cant)");
	}


	alert("Se ha agregado al carro de compras");
	redir("?p=productos");
}

if(isset($cat)){

	$q = $mysqli->query("SELECT * FROM productos WHERE id_categoria = '$cat' ORDER BY id DESC"); // quitarlo del if y ponerlo arriba del while
}else{
	$q = $mysqli->query("SELECT * FROM productos  ORDER BY id DESC");
}


while ($r = mysqli_fetch_array($q)) {
?>
	<div class="producto">
		<div class="name_producto"><?= $r['name'] ?></div>
		<div><img class="img_producto" src="productos/<?= $r['imagen'] ?>" /></div>
		<span class="precio"><?= $r['price'] ?> <?= $divisa ?></span>
		<button class="btn btn-primary pull-right" onclick="agregar_carro('<?= $r['id'] ?>');"><i class="fa fa-shopping-cart"></i></button>
	</div>
<?php
}
?>

<script type="text/javascript">
	function agregar_carro(idp) {
		var cant = prompt("¿Que cantidad desea agregar?", 1);

		if (cant.length > 0) {
			window.location = "?p=productos&agregar=" + idp + "&cant=" + cant;
		}
	}

	function redir_cat() {
		window.location = "?p=productos&cat=" + $("#categoria").val(); //Noseguro
	}
</script>