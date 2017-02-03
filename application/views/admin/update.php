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
	.tags label, .status-section label{
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

<!-- Modal code for the article preview -->
<div class="modal fade" id="modal-id">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?php echo $row['title']; ?></h4>
			</div>
			<div class="modal-body">
				<header class="header" style="position: relative;">
					<div>
						<img src="<?php echo base_url().'assets/images/'.$row['cover']; ?>" class="img-responsive" style="width:100%;">
					</div>
					<h2 class="text-primary" style="position: absolute; bottom:10px; background-color: rgba(0,0,0,0.5);padding:10px;"><?php echo $row['title']; ?></h2><br>
					<p>Written by - <?php echo $row['author']; ?></p>
				</header>
				
				<article>
					<?php echo html_entity_decode($row['body']); ?>
				</article>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
<!-- Modal code for the article preview -->

<!-- Modal for the cover photo preview -->

<div class="modal fade" id="cover_photo">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">current Cover Photo</h4>
			</div>
			<div class="modal-body">
				<div class="thumbnail">
					<img src="<?php echo base_url().'assets/images/'.$row['cover']; ?>" alt="">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- Modal for the cover photo preview -->

<div class="myform">
				<form action="<?php echo base_url().'admin/update/'.$row['id']; ?>" method="POST" role="form" class=" form" enctype="multipart/form-data">
					<legend>
						<p style="margin:10px;">
							<h3 style="font-size: 25px; display:inline;"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Updating:</h3>
							<span class="text-primary"><a href="<?php echo base_url().'post/'.$row['id']; ?>"><?php echo $row['title']; ?></a></span>
							<a class="btn btn-success pull-right" data-toggle="modal" href='#modal-id'><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Preview </a>
						</p>
						
						<?php 
						if(isset($errors)) {?>
							<div class="alert alert-danger" id="success-alert">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Errors:</strong> 
								<?php echo $errors; ?>
							</div>
						<?php } ?>
					</legend>
					
					<div class="form-group field">
						<label for="" class="col-sm-2">Title</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="" placeholder="Type the title here ..." name="title" value="<?php 
							if(isset($_POST['title'])){
								echo set_value('title');
							}else{
								echo $row['title'];
							}
							 ?>" required="required">
							<p class="pull-right text-success">Use a cathcy title.</p>
						</div>
					</div>

					<div class="form-group field">
						<label for="textarea" class="col-sm-2 control-label">Description:</label>
						<div class="col-sm-10">
							<textarea name="description" id="textarea" class="form-control" rows="5" required="required" onkeyup="track(this.value)" style="resize: none;"><?php 
							if(isset($_POST['description'])){
								echo set_value('description');
							}else{
								echo $row['description'];
							}
							 ?></textarea>
							<p class="pull-right text-success">
							<span id="total" class="text-info"></span>
							A maximum of 250 words.</p>
						</div>
					</div>

					<div class="form-group">
						<label style="margin-top: 50px;" for="textarea" class="col-sm-2 control-label">Article content</label>
						<div class="col-sm-10" style="margin-bottom: 50px;margin-top: 50px;">
							<textarea name="body" id="mytextarea" class="form-control" rows="3" required="required"><?php 
							if(isset($_POST['body'])){
								echo set_value('body');
							}else{
								echo $row['body'];
							}
							 ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2">
							Tags
						</label>
						<div class="col-sm-10 tags">
							<label>
								<input class="tags" type="checkbox" name="tags[]" value="love" >
								Love
							</label>
							<label>
								<input class="tags" type="checkbox" name="tags[]" value="God" >
								God
							</label>
							<label>
								<input class="tags" type="checkbox" name="tags[]" value="Reality" >
								Reality
							</label>
							<label>
								<input class="tags" type="checkbox" name="tags[]" value="Entrepreneurship">
								Entrepreneurship
							</label>
						</div>
					</div>


					<br><br>
					<div class="form-group">
						<label class="col-sm-2" for="status">Status</label>
						<div class="col-sm-10 status-section">
							<label>
								<input  class="status" type="radio" name="status" value="0">  Pause
							</label>
							<label>
								<input  class="status" type="radio" name="status" value="1">  Pending/Incomplete
							</label>
							<label>
								<input  class="status" type="radio" name="status" value="2">  Publish 
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2">Cover Photo</label>
						<div class="col-sm-10">
							<p>
								<a class="btn btn-success" data-toggle="modal" href='#cover_photo'><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Preview current photo</a> - You can keep the original photo or choose another photo.
							</p>
							
							<select name="covers" id="covers" class="form-control" onchange="coverOptions(this.value)">
								<option value="0">-- Select One --</option>
								<option value="1">-- Keep current photo --</option>
								<option value="2">-- Upload a different one --</option>
							</select>
							<section id="upload" style="margin-top: 10px; display: none;">
								<input type="file" class="form-control" name="cover_photo">
								<p class="text-right text-info">Dimentions 700 x 350 px</p>
								<p class="text-right text-info">Image size less than 50 kilobytes</p>
								<p class="text-right text-info">Image formats - .jpg or .png or .gif</p>
							</section>
						</div>
					</div>
				
					
					<div class="col-sm-offset-2 col-sm-10" style="border-bottom: none;">
						<button type="submit" class="clearfix btn btn-primary btn-block" name="update" style="margin-top: 30px;">UPDATE ARTICLE</button><br><br>
						
					</div>
					<!--Hidden data -->
					<input type="hidden" name="date_modified" value="<?php echo $row['date_created']; ?>">
					<input type="hidden" name="author" value="<?php echo $row['author']; ?>">
					<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
					<input type="hidden" name="photo" value="<?php echo $row['cover']; ?>">
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

(function(){
	var tag_string = '<?php echo $row['tags']; ?>',
		tags = tag_string.split(', '),
		boxes = document.getElementsByClassName('tags');

	for(i = 0; i< boxes.length;i++ ){
		if(tags.toString().includes(boxes[i].value)){
			boxes[i].checked = "checked";
		}
	}
})();

(function(){
	var status = '<?php echo $row['status']; ?>',
		boxes = document.getElementsByClassName('status');

	for(i = 0; i< boxes.length;i++ ){
		if(boxes[i].value == status){
			boxes[i].checked = "checked";
		}
	}
})();

function coverOptions(option){
	console.log(option);
	option != 2 ? $('#upload').hide() : $('#upload').show();
}

var success_alert = document.getElementById('success-alert');
setTimeout(function(){
	$('#success-alert').fadeOut('slow');
}, 2000);
	
</script>
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script type="text/javascript">
//editor tinymce
	CKEDITOR.replace('mytextarea');
</script>