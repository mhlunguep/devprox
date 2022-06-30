@extends('layout.base')
@section('title', 'Test 2')

@section('content')
	<div class="container pt-4">
		<h4>Generate random names and save them to the database</h4>
		<hr class="my-4">

		@include('includes.message')
		
		<div class="row">
			<div class="col">
				<form class="input-group" action="/test2" enctype="multipart/form-data" method="post">
					<div class="row mb-4">
						<div class="col">
							<label class="form-label">Generate random names</label>
							<input type="text" class="form-control" name="number" placeholder="Enter number of names" />

							<input type="hidden" name="token" value="{{ App\Classes\CSRFToken::_token() }}">
							<button type="submit" class="btn btn-primary btn-rounded btn-block mt-2">Submit</button>
						</div>
					</div>
				</form>
			</div>

			<div class="col">
				<form class="input-group" action="/test2/import_csv" enctype="multipart/form-data" method="post">
					<div class="row mb-4">
						<div class="col mb-4">
							<label class="form-label" for="customFile">Upload CSV File</label>
							<input type="file" class="form-control" required name="file"/>

							<input type="hidden" name="token" value="{{ App\Classes\CSRFToken::_token() }}">
							<button type="submit" name="submit" class="btn btn-dark btn-block btn-rounded mt-2">Submit</button>
						</div>
					</div>
				</form>

			</div>
		</div>

	@endsection
