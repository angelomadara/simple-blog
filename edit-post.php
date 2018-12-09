<?php
require 'header.php';

if(!Session::isLogin()){
	Redirect::to('../../login.php');
}

$user = Session::get(Config::get('session/profile'));
?>


		<!-- Page Header -->
		<header class="masthead" style="background-image: url('<?= Config::get('address/image') ?>home-bg.jpg')">
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-md-10 mx-auto">
						<div>
							
						</div>
						<div class="site-heading">
						<img src="<?= Config::get('address/image').'avatar.png' ?>" alt="" style="width:200px;height:200px;">
							<h1> <?= title_case($user->fullname) ?> </h1>
							<span class="subheading"> <?= $user->username ?> </span>
						</div>
					</div>
				</div>
			</div>
		</header>

        <?php $e = (new Query())->select('posts')->where('id','=',Request::get('id'))->first(); ?>

		<!-- Main Content -->
		<div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <form action="actions/update-post.php" method='post'>
                    <div class="<?= Request::get('class') ?>" role="alert">
                        <?= Request::get('message') ?>
                    </div>
                    <input type="hidden" name="post_id" value="<?=Request::get('id')?>">
                    <div class="form-group">
                        <label for="title" >Title</label>
                        <input type="text" name="title" value="<?=$e->title?>" id="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="post" >Write a topic</label>
                        <textarea name="post" id="post" class="form-control" cols="" rows=""><?=$e->post?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update topic</button>
                    </form>
                </div>
            </div>
		    </div>
        </div>

		<hr>

		<?php include 'footer.php'; ?>


		<script>
		
	    </script>
	</body>

</html>
