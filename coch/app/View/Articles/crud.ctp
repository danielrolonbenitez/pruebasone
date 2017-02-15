<h1><?php
if(!empty($this->data)) echo h(__('Editar artículo'));
else echo h(__('Nuevo artículo'));
?></h1>

<?php

echo $this->Form->create('Article', array('enctype' => 'multipart/form-data'));
if(!empty($this->data)) echo $this->Form->input('id');
/*echo $this->Form->input('published', array('label' => __('Publicar')));*/
echo $this->Form->input('title', array('label' => __('Título')));
echo $this->Form->input('picture', array('name' => 'picture', 'label' => __('Imagen'), 'type' => 'file'));
echo $this->Form->input('lead', array('label' => __('Texto corto'), 'style' => 'height: 10em; width: 600px'));
echo $this->Form->input('body', array('label' => __('Cuerpo'), 'style' => 'height: 10em; width: 600px',));
echo $this->Form->end(__('Guardar cambios'));
?>
<script type="text/javascript" src="<?php echo Router::url('/tinymce/js/tinymce/tinymce.min.js'); ?>"></script>
<script type="text/javascript">
tinymce.init({
  selector: "#ArticleBody",
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