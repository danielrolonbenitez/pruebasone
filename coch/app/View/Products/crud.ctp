<h1><?php
if(!empty($this->data)) echo h(__('Editar producto'));
else echo h(__('Nuevo producto'));
?></h1>

<?php

echo $this->Form->create(
	'Product',
	array(
		'enctype' => 'multipart/form-data',
		'action' => 'crud'
	)
);
if(!empty($this->data)) echo $this->Form->input('id');

//if(!empty($category_id)) echo $this->Form->input('category_id', array('type' => 'hidden', 'value' => $category_id));

echo $this->Form->input('name', array('label' => __('Nombre')));
?>

<div class="input file">
	<label for="ProductPicture">Imagen (Res: 1600x392)</label>
	<span class="holo"><input type="file" name="picture" placeholder="Imagen" id="ProductPicture"></span>
	<?php if(!empty($this->data['ProductFeature']['id'])) : ?>
		<br><label style="width: auto; margin-left: 100px">
			<input type="checkbox" name="delete-picture" value="1" id="delete-picture">
			Eliminar imagen actual
		</label>
	<?php endif; ?>
</div>
<script type="text/javascript">
$("#delete-picture").click(function() {
	$("#ProductPicture").prop("disabled", $("#delete-picture").is(":checked"));
});
</script>
<?

/*echo $this->Form->input('picture', array('name' => 'picture', 'label' => __('Imagen'), 'type' => 'file'));*/
echo $this->Form->input('slogan', array('label' => __('Slogan')));
echo $this->Form->input('description', array('label' => __('Descripción'), 'type' => 'textarea', 'style' => 'width: 350px; height: 100px'));
echo $this->Form->input('specifications', array('label' => __('Características técnicas (Resumen)'), 'type' => 'textarea', 'style' => 'width: 350px; height: 100px'));

//echo $this->Form->input('features_picture', array('name' => 'features_picture', 'label' => __('Imagen (Características)'), 'type' => 'file'));
?>

<div class="input file">
	<label for="ProductFeaturesPicture" style="">Imagen (Características)</label>
	<span class="holo" style=""><input type="file" id="ProductFeaturesPicture" placeholder="Imagen (Características)" name="features_picture" style=""></span>
	<?php if(!empty($this->data['Product']['id'])) : ?>
		<br><label style="width: auto; margin-left: 100px">
			<input type="checkbox" name="delete-picture-features" value="1" id="delete-picture-features">
			Eliminar imagen actual
		</label>
	<?php endif; ?>
</div>
<script type="text/javascript">
$("#delete-picture-features").click(function() {
	$("#ProductFeaturesPicture").prop("disabled", $("#delete-picture-features").is(":checked"));
});
</script>
<?php
echo $this->Form->input('features', array('label' => __('Características técnicas (Detalle)'), 'type' => 'textarea', 'style' => 'width: 350px; height: 150px'));
?>
<h3>Ficha técnica</h3>
<table class="crud">
	<thead>
		<tr>
			<th>Característica</th>
			<th colspan="2">Valor</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody id="features">
		
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4" style="text-align: center">
				<a class="menu-item button" href="" id="add-feature">Agregar</a>
			</td>
		</tr>
	</tfoot>
</table>
<h3>Imágenes de la ficha técnica</h3>
<table class="crud">
	<thead>
		<tr>
			<th>Imagen</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody id="pics_specs">
		
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4" style="text-align: center">
				<a class="menu-item button" href="" id="add-spec">Agregar</a>
			</td>
		</tr>
	</tfoot>
</table>

<div id="del-items"></div>

<?php
echo $this->Form->end(__('Guardar cambios'));
?>

<script type="text/javascript">
var specs = <?php 
if(!empty($this->data['ProductSpec'])) echo json_encode($this->data['ProductSpec']);
else echo '[]'; ?>;
var acIndex = 0;
var agregarCaracteristica = function(nombre, valor, valor_2) {
	acIndex++;
	
	var tr = $('<tr></tr>');
	var td1 = $('<td></td>');
	var td2 = $('<td></td>');
	var td3 = $('<td></td>');
	var td4 = $('<td></td>');
	var input1 = $('<input style="width: 300px" type="text" name="feature[' + acIndex + '][name]"></input>');
	var input2 = $('<input style="width: 75px" type="text" name="feature[' + acIndex + '][value]"></input>');
	var input3 = $('<input style="width: 75px" type="text" name="feature[' + acIndex + '][value_2]"></input>');
	var link4 = $('<a></a>');
	
	input1.val(nombre);
	input2.val(valor);
	input3.val(valor_2);
	link4.text('Eliminar').addClass('menu-item').addClass('button').attr('href', '');
	
	td1.append(input1);
	td2.append(input2);
	td3.append(input3);
	td4.append(link4);
	
	tr.append(td1);
	tr.append(td2);
	tr.append(td3);
	tr.append(td4);
	
	$('#features').append(tr);
	
	link4.click(function(e) {
		e.preventDefault();
		if(confirm('¿Está seguro de que desea eliminar esta característica?')) link4.parent().parent().remove();
	});
}
for(i=0;i<specs.length;i++) agregarCaracteristica(specs[i].name, specs[i].value, specs[i].value_2);
$("#add-feature").click(function(e) {
	e.preventDefault();
	agregarCaracteristica('', '', '');
});




var aisIndex = 0;
var agregarImagenSpec = function(id, nombre) {
	aisIndex++;
	
	var tr = $('<tr></tr>');
	var td1 = $('<td></td>');
	var td2 = $('<td></td>');
	if(id) {
		var link1 = $('<a></a>');
		link1.attr('target', '_blank').attr('href', '<?php echo addslashes(Router::url('/', true)); ?>files/' + nombre);
		link1.text('Ver imagen');
		td1.append(link1);
	}	
	else {
		var input1 = $('<input type="file" name="fpics[' + aisIndex + ']"></input>');
		td1.append(input1);
	}
	var link2 = $('<a></a>');
	
	td2.append(link2);
	
	tr.append(td1);
	tr.append(td2);
	
	$('#pics_specs').append(tr);
	link2.text('Eliminar').addClass('menu-item').addClass('button').attr('href', '');
	if(id) {
		link2.attr("data-id", id);
	}
	
	link2.click(function(e) {
		var me = $(this);
		e.preventDefault();
		if(confirm('¿Está seguro de que desea eliminar esta imagen?')) {
			if(me.attr("data-id")) {
				var hidden = $("<input />");
				hidden.attr("type", "hidden");
				hidden.attr("name", "delpics[]");
				hidden.attr("value", me.attr("data-id"));
				$("#del-items").append(hidden);
			}
			me.parent().parent().remove();
		}
	});
}
$("#add-spec").click(function(e) {
	e.preventDefault();
	agregarImagenSpec('');
});

var pic_specs = <?php

if(!empty($this->data['ProductSpecPic'])) echo json_encode($this->data['ProductSpecPic']);
else echo '[]';
?>;
for(i=0;i<pic_specs.length;i++) agregarImagenSpec(pic_specs[i].id, pic_specs[i].picture);
</script>
<script type="text/javascript" src="<?php echo Router::url('/tinymce/js/tinymce/tinymce.min.js'); ?>"></script>
<script type="text/javascript">
tinymce.init({
  selector: "#ProductDescription",
  plugins: [
    "link code paste"
  ],
  toolbar: "undo redo removeformat | bold italic underline fontsizeselect | link | code",
	
  relative_urls: true,
  document_base_url: "<?php echo h(Router::url('/')); ?>",
  forced_root_block: 'div',
  menubar: false,
  width: 610,
  paste_as_text: true,
  formats: {
 	  bold: {
		  inline: 'span',
		  styles: {
			  fontWeight: 'bold'
		  }
	  },
	  italic: {
		  inline: 'span',
		  styles: {
			  fontStyle: 'italic'
		  }
	  },
	  underline: {
		  inline: 'span',
		  styles: {
			  textDecoration: 'underline'
		  }
	  }
  }
  
});
</script>