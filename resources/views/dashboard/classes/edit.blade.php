@extends('dashboard.home')

@section('title', $head_text)

@section('content_header')
	<div class="content-header-inner">
		<h1>{!! $head_text !!}</h1>

		<a href="{{route('classes.index')}}">
			<button class="btn btn-info btn-sm"><i class="fa fa-undo"></i> Anuluj</button>
		</a>
	</div>
@stop


@section('content')

	<div class="diary-container">
		<div class="diary-container-body">

			@include('dashboard.common.errors', [ 'errors' => $errors ] )

			<form action="{{ route( 'classes.update' ) }}" id="form-user-insert" method="POST" novalidate enctype="multipart/form-data">
				@csrf

				<input type="hidden" name="classId" value="{{$class->hashId}}" />

				<div class="" style="display: flex;padding: 40px 0;">
					<div class="diary-form-grid grid-size-2" style="flex:1;margin-bottom: 20px;">

						<div class="diary-form-row">
							<label for="sign">{{__('dashboard/class.Oznaczenie klasy')}}</label>
							<input type="text" class="@if( $errors->has('sign') ) input-error @endif form-control" name="sign" id="sign" value="{{ old('sign', $class->sign) }}" required>
						</div>

						<div class="diary-form-row">
							<label for="description">{{__('dashboard/class.Opis')}}</label>
							<textarea id="description" name="description" placeholder="{{__('dashboard/class.Opis')}}" class="form-control input-md">{{old('description', $class->description)}}</textarea>
						</div>

						<div class="diary-form-row">
							<label for="max_members">{{__('dashboard/class.Ilość miejsc')}}</label>
							<input type="number" class="@if( $errors->has('max_members') ) input-error @endif form-control" name="max_members" id="max_members" value="{{ old('max_members', $class->max_members) }}" required>
						</div>

						<div class="diary-form-row">
							<label for="teacher_id">{{__('dashboard/class.Wychowawca')}}</label>
							<select name="teacher_id" id="teacher_id" class="form-control input-md input-select2" required>
								<option value="0" selected>{{__('dashboard/class.Wybierz wychowawcę')}}</option>
								@foreach($teachers as $teacher)
									<option value="{{$teacher->id}}" @if( old( 'teacher_id', $class->teacher_id) == $teacher->id ) selected @endif>
										{{$teacher->meta->name}} {{$teacher->meta->surname}}
									</option>
								@endforeach
							</select>
						</div>

						<div class="diary-form-row">
							<label for="type">{{__('dashboard/class.Typ klasy')}}</label>
							<select name="type" id="teacher_id" class="form-control input-md" required>
								<option value="0" selected>{{__('dashboard/class.Wybierz typ')}}</option>
								@foreach($types as $key => $type)
									<option value="{{$key}}" @if( old( 'type', $class->type) == $key ) selected @endif>
										{{$type}}
									</option>
								@endforeach
							</select>
						</div>

						<div class="form-btn-group form-rows" style="justify-content: flex-end;">
							<button class="action-button btn btn-success confirm"><i class="fas fa-check"></i> Zapisz</button>
						</div>

					</div>

				</div>
			</form>
		</div>
	</div>
@stop


@section('js')
	<script>
	@include('dashboard.common.errorsJs')
	</script>
	@include('dashboard.classes.js.create')
@stop