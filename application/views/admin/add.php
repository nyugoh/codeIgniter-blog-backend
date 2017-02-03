<style type="text/css">
	.main-content .well{
		margin:10px;
	}
	.myform{
		margin-bottom:48px;
	}
	.field{
		padding-top:20px;
		padding-bottom: 20px;
	}
	.tags label{
		margin-bottom:20px;
		margin-right: 30px;
		font-size:;
	}
	.col-sm-10{
		margin-bottom: 50px;
		border-bottom:1px solid #ddd;
		padding-bottom: 5px;
	}

</style>
<div class="myform">
				<form action="add" method="POST" role="form" class=" form" enctype="multipart/form-data">
					<legend class="text-primary" >
						<h3 style="font-size: 25px;">Write a new Article
						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>		
						</h3>
						<?php 
						if(isset($errors)) {?>
							<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Errors:</strong> 
								<?php echo $errors; ?>
							</div>
						<?php } ?>
					</legend>
					
					<div class="form-group field">
						<label for="" class="col-sm-2">Title</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="" placeholder="Type the title here ..." name="title" value="<?php echo set_value('title') ?>" required="required">
							<p class="pull-right text-success">Use a cathcy title.</p>
						</div>
					</div>

					<div class="form-group field">
						<label for="textarea" class="col-sm-2 control-label">Description:</label>
						<div class="col-sm-10">
							<textarea name="description" id="textarea" class="form-control" rows="5" required="required" onkeyup="track(this.value)" style="resize: none;"><?php echo set_value('description') ?></textarea>
							<p class="pull-right text-success">
							<span id="total" class="text-info"></span>
							A maximum of 250 words.</p>
						</div>
					</div>

					<div class="form-group">
						<label style="margin-top: 50px;" for="textarea" class="col-sm-2 control-label">Article content</label>
						<div class="col-sm-10" style="margin-bottom: 50px;margin-top: 50px;">
							<textarea name="body" id="mytextarea" class="form-control" rows="3" required="required">
							<?php echo set_value('body') ?>
							</textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2">
							Tags
						</label>
						<div class="col-sm-10 tags">
							<label>
								<input type="checkbox" name="tags[]" value="love">
								Love
							</label>
							<label>
								<input type="checkbox" name="tags[]" value="God">
								God
							</label>
							<label>
								<input type="checkbox" name="tags[]" value="Reality">
								Reality
							</label>
							<label>
								<input type="checkbox" name="tags[]" value="Entrepreneurship">
								Entrepreneurship
							</label>
						</div>
					</div>


					<br><br>
					<div class="form-group">
						<label class="col-sm-2" for="status">Status</label>
						<div class="col-sm-10">
							<label>
								<input type="radio" name="status" value="0">(Pause) Don't Publish
							</label>
							<label>
								<input type="radio" name="status" value="1">(Pending/Incomplete) Don't Publish
							</label>
							<label>
								<input type="radio" name="status" value="2">(Publish) Don't Publish
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2">Cover Photo</label>
						<div class="col-sm-10">
							<input type="file" class="form-control" name="cover_photo">
							<p class="text-right text-info">Dimentions 700 x 350 px</p>
							<p class="text-right text-info">Image size less than 50 kilobytes</p>
							<p class="text-right text-info">Image formats - .jpg or .png or .gif</p>
						</div>
					</div>
				
					
					<div class="col-sm-offset-2 col-sm-10" style="border-bottom: none;">
						<button type="submit" class="clearfix btn btn-primary btn-block" name="insert" style="margin-top: 30px;">PUBLISH ARTICLE</button><br><br>
						
					</div>
				</form>
			</div>

<script type="text/javascript">
	function track(string){
		var target = document.getElementById('total');
		var length = string.length;
		console.log(string);
		console.log(length);
		if(length <= 100){
			target.innerHTML = "{ <i style='color:red'>" + length + "</i> /250 }";
		}else if(length <= 250){
			target.innerHTML = "{ <i style='color:#267'>" + length + "</i> /250 }";
		}else if(length == 0){
			target.innerHTML = '';
		}else if(length > 250){
			target.innerHTML = '<i style="color:red;">STOP</i>';
		}else{

		}
	}

	
</script>
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script type="text/javascript">
//editor tinymce
	CKEDITOR.replace('mytextarea');
</script>