<!doctype html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>js/site.js"></script>
</head>
<body>
<div class="confirm-div"></div>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <h2 style="color: #fff; text-align: center; padding-bottom: 5px;">Image Crop Upload - Codeigniter</h2>
  </div>
</nav>
<div class="container">
<form method="post" id="upload_file" enctype="multipart/form-data">
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
          <label for="title">Title</label>
          <input class="form-control" type="text" name="title" id="title" required />
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="userfile">Image</label>
        <input class="form-control" type="file" multiple="multiple" name="userfile[]" id="userfile" size="20" required />
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="title">Crop from x-axis</label>
        <input class="form-control" type="text" name="crop_x" id="crop_x" /> (keep blank for center)
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="title">Crop from y-axis</label> 
        <input class="form-control" type="text" name="crop_y" id="crop_y" /> (keep blank for center)
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="title">Width</label>
        <input class="form-control" type="text" name="output_x" id="output_x" /> (keep blank for center)
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="title">Height</label> 
        <input class="form-control" type="text" name="output_y" id="output_y" /> (keep blank for center)
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="form-group">
        <button class="btn btn-primary" name="submit" id="submit">Upload</button>
      </div>
    </div>
  </div>
</form>
<div class="alert alert-success" id="files" style="display: none;">
</div>
</div>
</body>
</html>