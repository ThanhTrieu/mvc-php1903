<?php if(!defined('ROOT_PATH')) die('Can not access'); ?>

<div class="row">
	<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<h2>List tags</h2>
		<a href="?c=tag&m=add" class="btn btn-sm btn-primary"> Add Tag + </a>

		<div class="input-group my-3">
		  <input type="text" class="form-control" id="txtKeyword" value="<?= htmlentities($keyword); ?>">
		  <div class="input-group-append">
		    <span class="input-group-text" id="btnSearch">Search</span>
		  </div>
		</div>

		<table class="my-3 table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Description</th>
					<th>status</th>
					<th colspan="2" width="5%" class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($listTags as $key => $tag): ?>
				<tr>
					<td><?= $tag['id']; ?></td>
					<td><?= $tag['name_tag']; ?></td>
					<td><?= $tag['description']; ?></td>
					<td><?= $tag['status'] == 1 ? 'Active' : 'Inactive'; ?></td>
					<td>
						<a href="?c=tag&m=detail&id=<?= $tag['id'];?>" class="btn btn-info">Edit</a>
					</td>
					<td>
						<button class="btn btn-danger" onclick="deleteTags(<?= $tag['id']; ?>, this);">Delete</button>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$('#btnSearch').click(function() {
			let keyword = $('#txtKeyword').val().trim();
			if(keyword.length > 0){
				window.location.href = "?c=tag&m=index&keyword=" + keyword;
			}
		});
	});

	function deleteTags(idTag, obj){
		if(confirm('Are you sure ?')){
			if($.isNumeric(idTag)){
				$.ajax({
					url: "?c=tag&m=delete",
					type: "POST",
					data: {id: idTag},
					beforeSend: function(){
						$(obj).text('Loading...');
					},
					success: function(data){
						$(obj).text('Delete');
						data = $.trim(data);
						if(data === 'ok'){
							alert('thanh cong');
							window.location.reload(true);
						} else {
							alert('That bai');
							return false;
						}
					}
				});
			}
		}
	}
</script>




