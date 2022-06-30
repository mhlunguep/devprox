<div style="width:70%; margin: 0 auto">
	@if (isset($errors))
		<div class="alert alert-danger">
			@foreach ($errors as $error_array)
				@foreach ($error_array as $error_item)
					{{ $error_item }}
					<a class='alert-dismissible' data-mdb-dismiss="alert"><i class="fa fa-times ms-3"></i></a><br />
				@endforeach
			@endforeach

		</div>
	@endif


	@if (isset($success) || App\Classes\Session::has('success'))
		<div class="alert alert-success alert-dismissible">
			@if (isset($success))
				{{ $success }}
			@elseif(App\Classes\Session::has('success'))
				{{ App\Classes\Session::flash('success') }}
			@endif

			<a class='alert-dismissible' data-mdb-dismiss="alert"><i class="fa fa-times ms-3 primary"></i></a>
		</div>
	@endif
</div>
