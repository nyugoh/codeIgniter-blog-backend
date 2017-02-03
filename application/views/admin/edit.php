<style type="text/css">
	.edit-header {
		margin:8px;
	}
	.table thead tr th{
		font-size: 18px;
	}
	table tbody tr td, table thead tr td{
		
	}
	.actions button{
		display:block;
		margin:8px 5px;
	}
	.actions a{
		text-decoration: none;
	}
	.modal-footer{
		text-align: center;
	}
</style>
<div class="">
	<div class=" well edit-header">
		<h4 class="text-info">Edit, delete, pause or play articles.</h4>
	</div>
	<div class="">
		<table class="table table-striped table-bordered">
			<thead>
				<tr class="text-primary active">
					<th>#</th>
					<th>Article Details</th>
					<th>Author</th>
					<th><span class="glyphicon glyphicon-thumbs-up" style="color:"></span></th>
					<th><span class="glyphicon glyphicon-share-alt" style="color:"></span></th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($rows as $row) { ?>
					<tr id='<?php echo $row['id']; ?>'>
						<td><?php echo $row['id'];?></td>
						<td>
							<h4>Title: </h4>
							<p class="text-primary">
								<a href="<?php echo base_url()."post/".$row['id'];?>" target="_blank">
									<?php echo $row['title'];?>
								</a>
							</p>
							<hr>
							<h4>Description: </h4>
							<p><?php echo $row['description'];?></p>
							<hr>
							
							<p>Last Edit --<span class="text-primary">
							<?php if($row['date_created'] == $row['date_modified']){
									echo "Never";
								}else{
									$bad_date = mysql_to_unix($row['date_modified']); 
								echo mdate('%M %d, %Y %H:%i', $bad_date);
								}
							?>
							</span></p>
							<p>Date Published --<span class="text-primary"><?php 
								$bad_date = mysql_to_unix($row['date_created']); 
								echo mdate('%M %d, %Y %H:%i', $bad_date); ?></span></p>
						</td>
						<td><?php echo $row['author'];?></td>
						<td><?php echo $row['likes'];?></td>
						<td><?php echo $row['shares'];?></td>
						<td class="actions">
							<a href="<?php echo base_url()."admin/update/".$row['id'].'/'.$this->uri->segment(3);?>">
								<button type="button" class="btn btn-success">
									<span class="glyphicon glyphicon-edit" style="color:"></span> Edit
								</button>
							</a>
							<a data-toggle="modal" href='<?php echo "#delete-".$row['id']; ?>'>
								<button type="button" class="btn btn-danger">
									<span class="glyphicon glyphicon-trash" style="color:"></span> Delete
								</button>
							</a>
							<div class="modal fade" id='<?php echo "delete-".$row['id']; ?>'>
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title">Confirm delete</h4>
										</div>
										<div class="modal-body">
											<h3 class="text-center">You are about to delete this article</h3>
										</div>
										<div class="modal-footer">
											<a class="btn btn-default" data-dismiss="modal">Close</a>
											<a class="btn btn-danger" href='<?php echo base_url()."admin/delete/".$row['id'].'/'.$this->uri->segment(3); ?>'>DELETE</a>
										</div>
									</div>
								</div>
							</div>
							<?php if($row['status'] == 0){ ?>
								<a data-toggle="modal" href='<?php echo base_url()."admin/play/".$row['id'].'/'.$this->uri->segment(3); ?>'>
									<button type="button" class="btn btn-primary">
										<span class="glyphicon glyphicon-play" style="color:"></span> Play
									</button>
								</a>
							<?php }else if($row['status'] == 2){ ?>
								<a data-toggle="modal" href='<?php echo base_url()."admin/pause/".$row['id'].'/'.$this->uri->segment(3); ?>'>
									<button type="button" class="btn btn-warning">
										<span class="glyphicon glyphicon-pause" style="color:"></span> Pause
									</button>
								</a>
							<?php }else{ ?>
								<a href='<?php echo base_url()."admin/update/".$row['id']; ?>'>
									<button type="button" class="btn btn-info">
										<span class="glyphicon glyphicon-ok" style="color:;"></span> Complete
									</button>
								</a>
							<?php } ?>
							
							
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<section class="text-center">
			<ul class="pagination pagination-lg">
			<?php echo $this->pagination->create_links(); ?>
			</ul>
		</section>
	</div>
</div>