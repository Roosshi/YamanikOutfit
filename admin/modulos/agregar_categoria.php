<?php
check_admin();

if (isset($enviar)) {
    if(isset($enviar)){
        $categoria = clear($categoria);
    
        $s = $mysqli->query("SELECT * FROM categorias WHERE categoria = '$categoria'");
    
        if(mysqli_num_rows($s)>0){
            alert("Ya esta categoria esta agregada a la base de datos");
            redir("");
        }else{
            $mysqli->query("INSERT INTO categorias (categoria) VALUES ('$categoria')");
            alert("Categoria Agregada");
            redir("");
        }
    
    }
}   

if(isset($eliminar)){
	$eliminar = clear($eliminar);
	$mysqli->query("DELETE FROM categorias WHERE id = '$eliminar'");
	alert("Categoria eliminada");
	redir("?p=agregar_categoria");
}


?>

<h1>Agregar Categoria</h1><br>

<form method="post" action="">
	<div class="form-group">
		<input type="text" class="form-control" name="categoria" minlength="5" maxlength="20" placeholder="Categoria" required/>
	</div>

	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="enviar" value="Agregar categoria"/>
	</div>
</form><br>

<br>

<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>Categorias</th>
        <th>Acciones</th>
    </tr>

    <?php
	$q = $mysqli->query("SELECT * FROM categorias ORDER BY categoria ASC");
	while($r=mysqli_fetch_array($q)){
		?>
			<tr>
				<td><?=$r['id']?></td>
				<td><?=$r['categoria']?>
				<td>
					<a href="?p=agregar_categoria&eliminar=<?=$r['id']?>"><i class="fa fa-times"></i></a>
				</td>
			</tr>
		<?php
	}
	?>

</table>