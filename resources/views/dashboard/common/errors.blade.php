@if(count($errors))
	<div class="form-group">
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" style="color: #ffffff">×</button>
			<ul style="list-style: none">
				@foreach($errors->all() as $error)
					<li>
						{!! str_replace('today', 'dzisiaj', $error) !!}
					</li>
				@endforeach
			</ul>
		</div>
	</div>
@endif