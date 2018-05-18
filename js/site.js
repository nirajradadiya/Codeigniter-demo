$(function() {
	$('#upload_file').submit(function(e) {
		$('#files').show().html('<strong>Reloading files...</strong>');
		e.preventDefault();
		 $.ajax({
			url: "index.php/welcome/upload_file/",
			type: "POST",
			data: new FormData($('#upload_file')[0]), 
	
			success : function(data){
				
				
				if(data=='success')
				{
					$('#files').show().html('<strong>Image upload successfully.</strong>');
					$('#title').val('');
					$('#userfile').val('');
					$('#crop_x').val('');
					$('#crop_y').val('');
					$('#output_x').val('');
					$('#output_y').val('');
				}
				else
				{
					$('#files').show().html('<strong>Something went wrong when saving the file, please try again.</strong>');
				
				}
			},
			enctype: 'multipart/form-data',
			processData: false,
			contentType: false,
			cache: false
		});
		return false;
	});
});