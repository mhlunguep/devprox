@extends('admin.layout.base')
@section('title', 'Edit Product')
@section('data-page-id', 'adminProduct')

@section('content')
	<div class="container">
		<h4 class="edit-product">Edit {{ $product->name }}</h4>
		<hr class="my-4">

		@include('includes.message')
	</div>

	<form class="input-group" action="/admin/product/edit" enctype="multipart/form-data" method="post">
		<div class="container">
			<div class="row mb-4">
				<div class="col">
					<label for="productName">Product name:</label>
					<input type="text" name="name" 
						value="{{ $product->name }}" class="form-control" />
				</div>

				<div class="col">
					<label for="productName">Product price:</label>
					<input type="text" name="price"
						value="{{ $product->price }}" class="form-control" />
				</div>
			</div>

			<div class="row mb-4">
				<div class="col">
					<label for="productName">Product Category:</label>
					<select name="category" id="product-category"class="form-control">
						<option value="{{ $product->category->id }}">
							{{ $product->category->name}}
						</option>

						@foreach ($categories as $category)
							<option value="{{ $category->id }}">{{ $category->name }}</option>
						@endforeach
					</select>
				</div>

				<div class="col">
					<label for="productSub">Product Subcategory:</label>
					<select name="subcategory" id="product-subcategory"class="form-control">
						<option value="{{$product->subCategory->id}}">
							{{ $product->subCategory->name }}
						</option>

					</select>
				</div>
			</div>


			<div class="row mb-4">
				<div class="col">
					<label>Product Quantity:</label>
					<select name="quantity" class="form-control">
						<option value="{{ $product->quantity }}">
							{{ $product->quantity }}
						</option>
						@for ($i = 1; $i <= 50; $i++)
							<option value="{{ $i }}">{{ $i }}</option>
						@endfor
					</select>
				</div>

				<div class="col">
					<label class="form-label imageText" for="customFile">Product Image</label>
					<input type="file" name="productImage" class="form-control" id="customFile" />
				</div>
			</div>

			<div class="row">
				<div class="col">
					<label>Product Description</label>
					<textarea name="description"class="form-control" rows="4">
					{{ $product->description }}
				</textarea>
					<input type="hidden" name="token" value="{{ App\Classes\CSRFToken::_token() }}">
					<input type="hidden" name="product_id" value="{{ $product->id }}">
				</div>
			</div>

			<div class="row">
				<div class="c">
					<div class="col my-2">
						<input type="submit" class="btn btn-warning float-end" value="Update Product">
					</div>
				</div>
			</div>
		</div>

	</form>


	{{-- Delete Product Modal 
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
		 End Delete Product Modal --}}

	@endsection
