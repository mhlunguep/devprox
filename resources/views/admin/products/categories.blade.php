@extends('admin.layout.base')
@section('title', 'Product Categories')
@section('data-page-id', 'adminCategories')

@section('content')
	<div class="container">
		<h4 class="category">Product Categories</h4>
		<hr class="my-4">
	</div>

	@include('includes.message')

	<div class="category container">
		<div class="row">
			<div class="col-md-5">
				<form class="input-group" action="" method="get">
					<input type="search" class="form-control" placeholder="Search category by name" aria-label="Search"
						aria-describedby="search-addon" />
					<input type="submit" value="search" class="btn btn-outline-primary" name="search">
				</form>

			</div>
			<div class="col-md-6">
				<form class="input-group" action="/admin/product/categories" method="post">
					<input type="text" name="name" class="form-control rounded" placeholder="Category name">
					<input type="hidden" name="token" value="{{ App\Classes\CSRFToken::_token() }}">
					<input type="submit" class="btn btn-outline-primary" value="create">
				</form>
			</div>
		</div>
	</div>

	<div class="container my-5">
		@if (count($categories))
			<table class="table-striped table-hover table-bordered table" data-form="deleteForm">
				<thead>
					<tr>
						<th scope="col">Category</th>
						<th scope="col">Slug</th>
						<th scope="col">Date Created</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($categories as $category)
						<tr>
							<td>{{ $category['name'] }}</td>
							<td>{{ $category['slug'] }}</td>
							<td>{{ $category['added'] }}</td>
							<td width='10%' class="text-right">

								<a data-mdb-toggle="modal" data-mdb-toggle="tooltip" title="Add Subcategory"
									data-mdb-target="#add-subcategory-{{ $category['id'] }}">
									<i class="fa fa-plus me-2"></i>
								</a>
								<a data-mdb-toggle="modal" data-mdb-target="#edit-{{ $category['id'] }}" data-mdb-toggle="tooltip"
									title="Edit Category">
									<i class="fa fa-edit me-2"></i>
								</a>
								<a data-mdb-toggle="modal" data-mdb-target="#delete-{{ $category['id'] }}" data-mdb-toggle="tooltip"
									title="Delete Category">
									<i class="fa fa-times"></i>
								</a>

								{{-- Add Subcategory Modal --}}
								<div class="modal fade add-modal" id="add-subcategory-{{ $category['id'] }}" tabindex="-1"
									aria-labelledby="CategoryModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title">Add Sub Category</h5>
												<a href="/admin/product/categories" type="button" class="btn-close" aria-label="Close"></a>

											</div>
											<div class="notification"></div>
											<div class="modal-body py-5">

												<div class="input-group">
													<div class="form-outline" style="width:70%">
														<input type="text" name="name" class="form-control rounded" placeholder=" Sub Category Name"
															id="subcategory-name-{{ $category['id'] }}">
													</div>
													<input type="submit" style="width:30%"id="{{ $category['id'] }}" class="btn btn-primary add-subcategory"
														name="token" data-token="{{ App\Classes\CSRFToken::_token() }}" value="create">

												</div>

											</div>

										</div>
									</div>
								</div>

								{{-- End Add Subcategory Modal --}}

								<!--Edit Category Modal -->
								<div class="modal fade" id="edit-{{ $category['id'] }}" tabindex="-1" aria-labelledby="CategoryModalLabel"
									aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title">Edit Category</h5>
												<a href="/admin/product/categories" type="button" class="btn-close" aria-label="Close"></a>
											</div>
											<div class="notification"></div>
											<div class="modal-body">
												<form>
													<input type="text" style="border:1px solid #ddc;" name="name" value="{{ $category['name'] }}"
														id="name-{{ $category['id'] }}">
												</form>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-primary update-category" value="Update"
													id="{{ $category['id'] }}" data-token="{{ App\Classes\CSRFToken::_token() }}">
												<a href="/admin/product/categories" type="button" class="btn btn-outline-primary">Close</a>
											</div>
										</div>
									</div>
								</div>
								{{-- End Edit Model --}}

								{{-- Start Delete Modal --}}
								<div class="modal fade delete-modal" id="delete-{{ $category['id'] }}" tabindex="-1"
									aria-labelledby="CategoryModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title">Cofirm Delete</h5>
												<button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<p>Are you sure you want to delete <strong>{{ $category['name'] }}</strong> category?</p>
											</div>
											<div class="modal-footer">
												<form action="/admin/product/categories/{{ $category['id'] }}/delete" class="delete-item"
													method="post">
													<input type="hidden" name="token" value="{{ App\Classes\CSRFToken::_token() }}">
													<button type="submit" class="btn btn-primary" id =" delete-btn">Delete</button>
												</form>
												<button type="button" class="btn btn-outline-primary" data-mdb-dismiss="modal">Cancel</button>
											</div>
										</div>
									</div>
								</div>

								{{-- End Delete Modal --}}


							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			{!! $links !!}
		@else
			<h4>You have not created any category</h4>
		@endif
	</div>

	{{-- ---------------------------- Sub categories --------------------------------- --}}
	<div class="container">
		<h4 class="subcategory">Subcategories</h4>
		<hr class="mb-3">
	</div>

	

	<div class="container my-4">
		@if (count($subcategories))
			<table class="table-striped table-hover table-bordered table" data-form="deleteForm">
				<thead>
					<tr>
						<th scope="col">Sub category</th>
						<th scope="col">Slug</th>
						<th scope="col">Created at</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($subcategories as $subcategory)
						<tr>
							<td>{{ $subcategory['name'] }}</td>
							<td>{{ $subcategory['slug'] }}</td>
							<td>{{ $subcategory['added'] }}</td>
							<td width='10%' class="text-right">

								<a data-mdb-toggle="modal" data-mdb-target="#edit-subcateory-{{ $subcategory['id'] }}"
									data-mdb-toggle="tooltip" title="Edit Sub Category">
									<i class="fa fa-edit me-2"></i>
								</a>
								<a data-mdb-toggle="modal" data-mdb-target="#delete-subcategory-{{ $subcategory['id'] }}"
									data-mdb-toggle="tooltip" title="Delete Sub Category">
									<i class="fa fa-times"></i>
								</a>

								<!--Edit SubCategory Modal -->
								<div class="modal fade" id="edit-subcateory-{{ $subcategory['id'] }}" tabindex="-1"
									aria-labelledby="subCategoryModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title">Edit Subcategory</h5>
												<a href="/admin/product/subcategory" type="button" class="btn-close" aria-label="Close"></a>
											</div>
											<div class="notification"></div>
											<div class="modal-body">
												<input type="text" style="border:1px solid #ddc;width:100%" value="{{ $subcategory['name'] }}"
													id="item-subcategory-name-{{ $subcategory['id'] }}">
												<label class="my-3">Change Category
													<select id="item-category-{{ $subcategory['category_id'] }}">
														@foreach (App\Models\Category::all() as $category)
															@if ($category->id == $subcategory['category_id'])
																<option selected value="{{ $category->id }}">{{ $category->name }}</option>
															@endif
															<option value="{{ $category->id }}">{{ $category->name }}</option>
														@endforeach
													</select>
												</label>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-primary update-subcategory" value="Update"
													id="{{ $subcategory['id'] }}" data-token="{{ App\Classes\CSRFToken::_token() }}"
													data-category-id="{{ $subcategory['category_id'] }}">
												<a href="/admin/product/subcategory" type="button" class="btn btn-outline-primary">Close</a>
											</div>
										</div>
									</div>
								</div>
								{{-- End Edit Subcategory Model --}}

								{{-- Start Delete Subcategory Modal --}}
								<div class="modal fade delete-modal" id="delete-subcategory-{{ $subcategory['id'] }}" tabindex="-1"
									aria-labelledby="SubcategoryModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title">Cofirm Delete</h5>
												<button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<p>Are you sure you want to delete <strong>{{ $subcategory['name'] }}</strong> category?</p>
											</div>
											<div class="modal-footer">
												<form action="/admin/product/subcategory/{{ $subcategory['id'] }}/delete" class="delete-subcategory"
													method="post">
													<input type="hidden" name="token" value="{{ App\Classes\CSRFToken::_token() }}">
													<button type="submit" class="btn btn-primary" id =" delete-btn">Delete</button>
												</form>
												<button type="button" class="btn btn-outline-primary" data-mdb-dismiss="modal">Cancel</button>
											</div>
										</div>
									</div>
								</div>
								{{-- End Delete Modal --}}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			{!! $subcategories_links !!}
		@else
			<h4>You have not created any subcategory</h4>
		@endif
	</div>
@endsection
