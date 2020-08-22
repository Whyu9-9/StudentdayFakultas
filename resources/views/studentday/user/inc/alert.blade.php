@if(count($errors) > 0)
		<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
			{{ $errors->first() }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
@endif

@if(session('success'))
		<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
			{{ session('success') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
@endif

@if(session('error'))
		<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
			{{ session('error') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
@endif

@if(session('info'))
		<div class="sufee-alert alert with-close alert-info alert-dismissible fade show">
			{{ session('info') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
@endif