<?php require_once 'admin-header.html'; ?>

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
	.form-group i{
		color:orange;
		font-style:italic;
	}
</style>
<div class="myform">
				<form action="" method="POST" role="form" class=" form">
					<legend class="text-primary text-center" style="font-size: 25px;">
						<h3>Add a new Quote</h3>
					</legend>
				

					<div class="form-group field">
						<label for="" class="col-sm-2">Originator/ Author</label>
						<div class="col-sm-10">
							<select name="" id="input" class="form-control" required="required" onchange="detectAuthor(this.value)" style="margin:10px 0;">
								<option value="#" selected="true">-- quote by --</option>
								<option value="0"> Unknown / Anynonmus</option>
								<option value="1"> Know (Specify below)</option>
							</select>
							<input type="text" class="form-control" id="author" placeholder="Author's name here..." style="margin:10px 0;">
							<p class="pull-right text-success" id="author-helper">Observe capital letters and punctuation.</p>
						</div>
					</div>

					<div class="form-group field" >
						<label style="margin-top: 70px;" for="textarea" class="col-sm-2 control-label">The quote:</label>
						<div class="col-sm-10" style="margin-top: 50px;">
							<textarea name="" id="textarea" class="form-control" rows="6" required="required"  style="resize: none;"></textarea>
							
						</div>
					</div>

					<div class="form-group">
						<label style="margin-top: 50px;" for="textarea" class="col-sm-2 control-label">Upload a Photo</label>
						<div class="col-sm-10" style="margin-bottom: 50px;margin-top: 50px;">
							<input type="file" name="photo" class="form-control">
							<p class="text-right text-info">Dimensions must be <i>700 </i>by <i>300 </i> px</p>
							<p class="text-right text-info">Type/ Format must be <i>jpg</i> or <i>png</i></p>
							<p class="text-right text-info">File size must be <i>20</i> - <i>70</i> kbs</p>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2">
							Tags
						</label>
						<div class="col-sm-10 tags" style="margin-bottom:50px;">
							<label>
								<input type="checkbox" value="">
								Love
							</label>
							<label>
								<input type="checkbox" value="">
								God
							</label>
							<label>
								<input type="checkbox" value="">
								Reality
							</label>
							<label>
								<input type="checkbox" value="">
								Entrepreneurship
							</label>
						</div>
					</div>
				
					<br><br><button type="submit" class="clearfix btn btn-primary btn-block" >PUBLISH QUOTE</button>
				</form>
			</div>

<script type="text/javascript">
	function track(string){
		var target = document.getElementById('total');
		var length = string.length;
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

	//get the selected option and act accordingly
	function detectAuthor(value){
		console.log(value);
		if(value == 0){
			document.getElementById('author').style.display = 'none';
			document.getElementById('author-helper').style.display = 'none';
		}else{
			document.getElementById('author').style.display = 'block';
			document.getElementById('author-helper').style.display = 'block';
		}
	}

	
</script>
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script type="text/javascript">
//editor tinymce
	CKEDITOR.replace('mytextarea');
</script>


<?php require_once 'admin-footer.html'; ?>
