@extends('layout.base')
@section('title', 'Test 1')

@section('content')
	<div class="container pt-4">
		<h4>Capture the following into the database</h4>
		<hr class="my-4">

		@include('includes.message')
	</div>

	<form class="input-group" action="/" enctype="multipart/form-data" method="post">
		<div class="container">
			<div class="row mb-4">
				<div class="col">
					<label>Name:</label>
					<input type="text" name="name" placeholder="Enter name" class="form-control">
				</div>

				<div class="col">
					<label>Surname:</label>
					<input type="text" name="surname" placeholder="Enter surname" class="form-control">
				</div>
			</div>

			<div class="row mb-4">
				<div class="col">
					<label>ID Number</label>
					<input type="text" name="id_no" placeholder="Enter ID Number" class="form-control">
				</div>

				<div class="col">
					<label>Select Date of Birth:</label>
					<input type="date" id="birthday" name="birthday" class="form-control">
				</div>
			</div>

			<div class="row">
				<div class="col my-2">
					<input type="submit" class="btn btn-primary btn-rounded" value="POST">
					<input type="hidden" name="token" value="{{ App\Classes\CSRFToken::_token() }}">
					<button type="reset" class="btn btn-danger btn-rounded">CANCEL</button>
				</div>
			</div>
		</div>

	</form>

@endsection
