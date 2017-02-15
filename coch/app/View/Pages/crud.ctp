<h1>Modificar página: <?php echo h($this->data['Page']['title']); ?></h1>
<?php 
echo $this->Form->create('Page');
echo $this->Form->input('id');
echo $this->Form->input('html_code', array('label' => '', 'style' => 'height: 200px'));
echo $this->Form->submit('Guardar cambios');
?>


<script type="text/javascript" src="<?php echo h(Router::url('/tinymce/js/tinymce/tinymce.min.js', true)); ?>"></script>
<script type="text/javascript">
 
tinymce.init({
  selector: "textarea",
  plugins: [
    "advlist autolink lists link image charmap print preview anchor",
    "searchreplace visualblocks code fullscreen",
    "insertdatetime media table contextmenu paste jbimages"
  ],
	
  // ===========================================
  // PUT PLUGIN'S BUTTON on the toolbar
  // ===========================================
	
  toolbar: "insertfile undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
	
  // ===========================================
  // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
  // ===========================================
	
  relative_urls: true,
  document_base_url: "<?php echo h(Router::url('/')); ?>",
  forced_root_block: 'div',
  menubar: false,
  block_formats: "Normal=div;Título=h1",
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