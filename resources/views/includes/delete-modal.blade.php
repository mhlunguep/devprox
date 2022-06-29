{{-- Start Delete Modal --}}
<div class="modal fade" id="confirm" tabindex="-1" aria-labelledby="CategoryModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Cofirm Delete</h5>
				<button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this item?</p>
			</div>
			<div class="modal-footer">
				<form action="/admin/product/categories/{{ $category['id'] }}/delete" class="delete-item" method="post">
					<input type="hidden" name="token" value="{{ App\Classes\CSRFToken::_token() }}">
					<button type="submit" class="btn btn-primary">Delete</button>
				</form>
				<button type="button" class="btn btn-outline-primary" data-mdb-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>

{{-- End Delete Modal --}}
