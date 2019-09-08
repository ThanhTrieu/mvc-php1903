<?php if(!defined('ROOT_PATH')) die('Can not access'); ?>

<div class="row">
	<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<h2>Edit tag</h2>
		<a href="?c=tag" class="btn btn-sm btn-primary"> List tags </a>

		<form action="?c=tag&m=handleEdit&id=<?= $info['id']; ?>" method="post">
			<div class="form-group">
				<label for="nameTag"> Name tag</label>
				<input type="text" class="form-control" name="nameTag" id="nameTag" value="<?= $info['name_tag']; ?>">
			</div>
			<div class="form-group">
				<label for="descTag"> Description tag</label>
				<textarea name="descTag" id="descTag" class="form-control" rows="5"><?= $info['description']; ?></textarea>
			</div>
			<div class="form-group">
				<label for="status"> Status tag</label>
				<select name="status" id="status" class="form-control">
					<option value="1" <?= $info['status'] == 1 ? "selected='selected'" : ""; ?> >Active</option>
					<option value="0" <?= $info['status'] == 0 ? "selected='selected'
					" : ""; ?> >Inactive</option>
				</select>
			</div>
			<button type="submit" name="btnUpdate" class="btn btn-primary"> Update </button>
		</form>
	</div>
</div>

