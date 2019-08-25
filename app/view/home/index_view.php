<?php if(!defined('ROOT_PATH')) die('Can not access'); ?>

<div class="row">
	<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<h1>Hello word - <?php echo $name; ?></h1>
		<table class="table mt-3">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Gender</th>
					<th>Age</th>
					<th>Address</th>
					<th>Email</th>
					<th>Money</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($info as $key => $item): ?>
					<tr>
						<td><?= $item['id']; ?></td>
						<td><?= $item['name']; ?></td>
						<td><?= $item['gender']==1 ? 'Nam' : 'Nu'; ?></td>
						<td><?= $item['age']; ?></td>
						<td><?= $item['address']; ?></td>
						<td><?= $item['email']; ?></td>
						<td><?= number_format($item['money']); ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
