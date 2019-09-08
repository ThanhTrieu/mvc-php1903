<?php if(!defined('ROOT_PATH')) die('Can not access'); ?>

<div class="row">
	<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<h2>Add tags</h2>
		<a href="?c=tag" class="btn btn-sm btn-primary"> List tags </a>
	
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 my-3">
			<?php if($errAdd): ?>
				<ul>
					<?php foreach($errAdd as $err): ?>
						<li class="text-danger"><?= $err; ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<?php if($message === 'exist'): ?>
				<h5 class="text-danger">Name tag da ton tai</h5>
			<?php endif; ?>
		</div>

		<form action="?c=tag&m=handleAdd" method="post">
			<div class="form-group">
				<label for="nameTag"> Name tag</label>
				<input type="text" class="form-control" name="nameTag" id="nameTag">
			</div>
			<div class="form-group">
				<label for="descTag"> Description tag</label>
				<textarea name="descTag" id="descTag" class="form-control" rows="5"></textarea>
			</div>
			<button type="submit" name="btnAdd" class="btn btn-primary"> Add + </button>
		</form>
	</div>
</div>

