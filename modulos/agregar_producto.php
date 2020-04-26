<?php
check_admin();

if (isset($enviar)) {
	$name = clear($name);
	$price = clear($price);

	$imagen = "";

	if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
		$imagen = $name . rand(0, 1000) . ".jpg";
		move_uploaded_file($_FILES['imagen']['tmp_name'], "productos/" . $imagen);
	}

	$mysqli->query("INSERT INTO productos (name,price,imagen) VALUES ('$name','$price','$imagen')");
	alert("Producto agregado");
	redir("?p=agregar_producto");
}

if (isset($eliminar)) {
	$mysqli->query("DELETE FROM productos WHERE id  = '$eliminar'");
	redir("?p=agregar_producto");
}

?>
<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
		<input type="text" class="form-control" name="name" placeholder="Nombre del producto" />
	</div>

	<div class="form-group">
		<input type="text" class="form-control" name="price" placeholder="Precio del producto" />
	</div>

	<label>Imagen del producto</label>

	<div class="form-group">
		<input type="file" class="form-control" name="imagen" title="Imagen del producto" placeholder="Imagen del producto" />
	</div>

	<div class="form-group">

		<select name="categoria" required class="form-control">
			<option value="">Seleccione una categoria</option>
			<?php
			$q = $mysqli->query("SELECT * FROM categorias ORDER BY categoria ASC");

			while ($r = mysqli_fetch_array($q)) {
			?>
				<option value="<?= $r['id'] ?>"><?= $r['categoria'] ?></option>
			<?php
			}
			?>
		</select>

	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-success" name="enviar"><i class="fa fa-check"></i> Agregar Producto</button>
	</div>

</form> <br>

<br>

<table class="table table-striped">
	<tr>
		<th>Nombre</th>
		<th>Precio</th>
		<th>Imagen</th>
		<th>Categoria</th>
		<th>Acciones</th>
	</tr>

	<?php
	$prod = $mysqli->query("SELECT * FROM productos ORDER BY id DESC");
	while ($rp = mysqli_fetch_array($prod)) {

		$cat = $mysqli->query("SELECT * FROM categorias WHERE id = '" . $rp['id_categoria'] . "'");
		if (mysqli_num_rows($cat) > 0) {
			$rcat = mysqli_fetch_array($cat);
			$categoria = $rcat['categoria']; //Antes era:  $categoria = $cat['categoria'];
		} else {
			$categoria = '--';
		}

	?>
		<tr>
			<td><?= $rp['name'] ?></td>
			<td><?= $rp['price'] ?></td>
			<td><img src="productos/<?= $rp['imagen'] ?>" class="imagen_carro"></td>
			<td><?= $categoria ?></td>
			<td>

				<a href="?p=modificar_producto&id=<?= $rp['id'] ?>"><i class="fa fa-edit"></i></a>
				&nbsp;
				<a href="?p=agregar_producto&eliminar=<?= $rp['id'] ?>"><i class="fa fa-times"></i></a>

			</td>
		</tr>
	<?php
	}

	?>

</table>