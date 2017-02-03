<!-- main content -->
<div class="container-fluid" style="margin-top:50px;">
	<div class="row">
		<div class="col-xm-12 col-md-offset-1 col-md-10 main-content">
			<article>
				<?php 
				foreach ($posts as $row ) { ?>
					<section class="clearfix">
						<a href="<?php echo base_url().'post/'.$row['id']; ?>" style="text-decoration: none;">
							<h2 class="text-primary" style=" background-color: rgba(0,0,0,0.1);padding:10px;margin-bottom:0;"><?php echo $row['title'];?></h2>
						</a>
						<img src="<?php echo asset('images/'.$row['cover']); ?>" class="img-responsive pull-left" style="width:250px;heigth:250px;margin-right: 10px;">
						<p>
							<?php echo $row['description']; ?>
						</p>
						<p class="clearfix text-success">By <?php
							$bad_date = mysql_to_unix($row['date_modified']);
							 echo $row['author'].' Last edit: '.mdate('%M %d, %Y %H:%i', $bad_date); ?></p>
					</section>
					<hr>
				<?php } ?>
			</article>

			<!-- show a link to the next and previous article -->
			<section class="next-prev-btn">
				<ul class="pager">
					<?php echo $this->pagination->create_links(); ?>
					
				</ul>
			</section>

		</div>
		
	</div>
</div>