<style type="text/css">
	.like-love a{
		text-decoration: none;

	}
	.tags-share a{
		margin-top: 3px;
	}
</style>
<!-- main content -->
<div class="container-fluid" style="margin-top:50px;">
	<div class="row">
		<div class="col-xm-12 col-md-offset-1 col-md-8 main-content">
			<header class="header">
				<h2 class="text-primary" style="background-color: rgba(0,0,0,0.1);padding:10px;margin:0;font-size: 2.5em;"><?php echo $row['title']; ?>
				</h2>
			</header>

			
			<article style="margin-top:0;">
				<img src="../assets/images/<?php echo $row['cover']; ?>" class="img-responsive" style="width:900px;height:350px;">
				<p class="lead" style="margin:20px 0 5px 0; padding-bottom: 0;font-family:'Roboto';">Written by <?php
						$bad_date = mysql_to_unix($row['date_modified']); 
					 	echo $name['fname'].' '.$name['lname'].' on '. mdate('%M %d, %Y %H:%i', $bad_date); ?>
					 		
				</p>
				<p class="lead tags-share" style=" font-family:'Roboto';" >
				 	<?php $tags = explode(',', $row['tags']);
				 	foreach ($tags as $tag) {
				 	 	echo '<a href="#" class="btn btn-default glyphicon glyphicon-tags text-primary" style="margin-right:8px;font-size:17px;"> '.$tag.' </a>';
				 	 } ?>
			 	 	
				 	 	<a href="<?php echo base_url().'post/love/'.$row['id']; ?>" class="btn btn-success">
			 	 			<span class="glyphicon glyphicon-heart-empty" style="margin-right: 5px;"></span><?php if($row['shares'] == 0)
			 	 					echo "Share";
			 	 				 else
			 	 				 	echo $row['shares'];
			 	 				 	 ?>
				 	 	</a>
				 	 	<a href="<?php echo base_url().'post/like/'.$row['id']; ?>" class="btn btn-primary">
				 	 		<span class="glyphicon glyphicon-thumbs-up " style="margin-right: 5px"></span> Likes <?php if($row['likes'] == 0)
			 	 					echo "1";
			 	 				 else
			 	 				 	echo $row['likes'];
			 	 				 	 ?>
				 	 	</a>
				 	 	
							<a href="https://twitter.com/intent/tweet?text=<?php echo $row['title'].'&#inspire_me' ?>" class="btn btn-info" data-show-count="false" data-size="large" >
								<span class="glyphicon glyphicon-retweet"></span> Tweet
							</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
				</p>
				<?php echo html_entity_decode($row['body']); ?>
			</article>
			
			<!-- show a link to the next and previous article -->
			<hr>
			<section class="next-prev-btn" style="margin:48px 5px;">
				<ul class="pager">
					<li class="previous col-xs-6"><a href="<?php echo base_url('post/').$prev['id']; ?>">&larr; Previous<br> 
						<p><?php echo $prev['title'] ?></p>
					</a></li>
					<li class="next col-xs-6"><a href="<?php echo base_url('post/').$next['id']; ?>">Next &rarr;<br>	
						<p><?php echo $next['title'] ?></p>
					</a></li>
				</ul>
			</section>

			<!-- Comments from facebook plugin -->
			<hr>
			<section>
				<h3 class="text-primary"><span class="glyphicon glyphicon-comment"></span> Comments</h3>
				<div class="fb-comments" data-href="<?php echo base_url('post/').$row['id']; ?>" data-numposts="5"></div>
			</section>

		</div>
		<div class="col-xm-12 col-md-3" style="margin-top:20px;">
			<!-- Subscribe email -->
			<div class="well well-sm share text-center">
				<form action="" method="POST" role="form">
					<legend>Subscribe to our newsletter</legend>
					<div class="form-group">
						<input type="email" class="form-control" id="" placeholder="Your email address ...">
						<br><button type="submit" class="btn btn-success">SUBSCRIBE</button>
					</div>
				</form>
			</div>

			<!-- latest articles -->
			<div class="list-group">
				<h3 class="list-group-item active">Latest Articles</h3>
				<?php foreach ($latest as $row) { ?>
					<a href="<?php echo base_url('post/').$row['id'] ?>" class="list-group-item" style="font-size: 16px;">
						&rarr;
						<?php echo $row['title'] ?>
					</a>
				<?php } ?>
			</div>

			<section style="margin-top: 20px;">
				Advert goes here
			</section>
		</div>
	</div>
</div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>