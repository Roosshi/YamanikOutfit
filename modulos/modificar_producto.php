<?php
check_admin();

$id = clear($id);

$q = $mysqli->query("SELECT * FROM productos WHERE id = '$id'");
$rq = mysqli_fetch_array($q);

if(isset($enviar)){
	$idpro = clear ($idpro);
	$name = clear ($name);
	$price = clear ($price);
	$categoria = clear ($categoria);

	$mysqli->query("UPDATE productos SET name = '$name',price = '$price',id_categoria = '$categoria' WHERE id = '$idpro'");
	redir("?p=agregar_producto");
}

?>
<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
		<input type="text" class="form-control" name="name" value="<?= $rq['name'] ?>" placeholder="Nombre del producto" />
	</div>

	<div class="form-group">
		<input type="text" class="form-control" name="price" value="<?= $rq['price'] ?>" placeholder="Precio del producto" />
	</div>

	<div class="form-group">

		<select name="categoria" required class="form-control">
			<option value="">Seleccione una categoria</option>
			<?php
			$q = $mysqli->query("SELECT * FROM categorias ORDER BY categoria ASC");

			while ($r = mysqli_fetch_array($q)) {
			?>
				<option <?php if($rq['id_categoria'] == $r['categoria']) { echo "selected"; }?>  value="<?= $r['id'] ?>"><?= $r['categoria'] ?></option>
			<?php
			}
			?>
		</select>

	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-success" name="enviar"><i class="fa fa-check"></i>Modificar</button>
	</div>

	<input type="hidden" name="idpro" value="<?=$id?>">

</form>