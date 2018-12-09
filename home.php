<?php 
	include 'header.php'; 
	$user = Session::isLogin() ? Session::get(Config::get('session/profile')) : null;
?>
		<!-- Page Header -->
		<header class="masthead" style="background-image: url('<?= Config::get('address/image') ?>home-bg.jpg')">
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-md-10 mx-auto">
						<div class="site-heading">
							<h1>Simple Blog</h1>
							<span class="subheading">Freedom wall for everyone</span>
						</div>
					</div>
				</div>
			</div>
		</header>
		<?php $e = (new Query())->select('posts')->whereNull('deleted_at','IS')->get(); ?>
		<!-- Main Content -->
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-10 mx-auto">
				<?php if($e): ?>
					<?php foreach($e as $post): ?>
						<div class="post-preview">
							<!-- <a href="post.html"> -->
							<h2 class="post-title">
								<?= $post->title ?>
							</h2>
							<p class="post-subtitle">
								<?= $post->post ?>
							</p>
							<!-- </a> -->
							<p class="post-meta">Posted by
							<span>
								<?= $post->user_id == ($user ? $user->id : 0) ? 'me' : (new Query())->select('users')->where('id','=',$post->user_id)->first()->fullname;?>
							</span>
							on <?= readable_date($post->created_at) ?></p>
							
							<!-- comment list -->
							<div>
								<div><small>Comments:</small></>
								<div style="padding-left:2em;">
									<?php $comments = (new Query())->select('comments')->where('post_id','=',$post->id)->get(); ?>
									<?php if($comments): ?>
									<?php foreach($comments as $comment): ?>
										<div style="border-bottom:1px solid #ddd;"> 
											<small>
											<?= $post->user_id == ($user ? $user->id : 0) ? 'me' : (new Query())->select('users')->where('id','=',$comment->user_id)->first()->fullname ?> : 
												<?= $comment->comment ?>
												<br>
												<span style='font-size:10px;font-style:italic'> Date : <?= readable_datetime($comment->created_at) ?> </span>
											</small> 
										</div>
									<?php endforeach; ?>
									<?php endif; ?>
								</div>
							</div>

							<!-- comment form -->
							<?php if($user): ?>
							<div>
								<div><small>Leave a comment</small></div>
								<div id="form">
									<div class="form-group">
										<textarea name="post" id="post" class="form-control" cols="" rows=""></textarea>
									</div>
									<button type="submit" data-id="<?=$post->id?>" class="btn btn-primary leave-comment">post</button>
								</div>
							</div>
							<?php endif; ?>

							<br><br><br>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div class="post-preview">
						<p class="post-subtitle">
							No posts yet
						</p>
					</div>
				<?php endif; ?>
				</div>
			</div>
		</div>

		<hr>

		<!-- Footer -->
		<?php include 'footer.php'; ?>

	<script>
		$('.leave-comment').click(function(){
			let id = $(this).data('id');
			let comment = $(this).siblings('div').children('textarea').val();
			
			if(comment == "") return false;

			$.ajax({
            	method: "POST",
				url: "actions/comment.php",
				data: { 
					comment : comment,
					post_id : id,
					user_id : "<?= $user->id ?>"
				},
				success: function(data){
					location.reload();
				}
			})
		});
	</script>
	</body>

</html>
