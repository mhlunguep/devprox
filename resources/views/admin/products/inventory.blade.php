@extends('admin.layout.base')
@section('title', 'Manage Inventory')
@section('data-page-id', 'adminProduct')

@section('content')
	<div class="container">
		<h4 class="products">Manage Inventory Items</h4>
		<hr class="my-4">
	</div>

	@include('includes.message')

	<div class="products container">
		<div class="row">
			<div class="col">
                <a href="/admin/product/create" class="btn badge-primary float-end">
                    <i class="fa fa-plus"></i> Add new Product
                </a>
            </div>
		</div>
	</div>

	<div class="container my-5">
		@if (count($products))
			<table class="table-striped table-hover table-bordered table" data-form="deleteForm">
				<thead>
					<tr>
						<th scope="col">Image</th>
						<th scope="col">Name</th>
						<th scope="col">Price</th>
						<th scope="col">Quantity</th>
						<th scope="col">Category</th>
						<th scope="col">Subcategory</th>
						<th scope="col">Date Created</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($products as $product)
						<tr>
							<td>
                                <img src="/{{ $product['image_path'] }}" alt="{{ $product['name'] }}" height="40" width="40">
                            </td>
							<td>{{ $product['name'] }}</td>
							<td>{{ $product['price'] }}</td>
							<td>{{ $product['quantity'] }}</td>
							<td>{{ $product['category_name'] }}</td>
							<td>{{ $product['sub_category_name'] }}</td>
							<td>{{ $product['added'] }}</td>
							<td width='10%' class="text-right">

								<span data-mdb-toggle="tooltip" title="Edit Product">
									<a href="/admin/product/{{ $product['id'] }}/edit"><i class="fa fa-edit me-2"></i></a>
                                </span>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			{!! $links !!}
		@else
			<h4>You have not created any products</h4>
		@endif
	</div>

	
@endsection
