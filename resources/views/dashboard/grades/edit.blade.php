@extends('dashboard.home')

@section('title', $head_text)

@section('content_header')
	<div class="content-header-inner">
		<h1>{!! $head_text !!}</h1>

		<a href="{{route('grades.index')}}">
			<button class="btn btn-info btn-sm"><i class="fa fa-undo"></i>{{__('dashboard/grade.Anuluj')}}</button>
		</a>
	</div>
@stop


@section('content')

	<div class="diary-container">
		<div class="diary-container-body">

			@include('dashboard.common.errors', [ 'errors' => $errors ] )

			<form action="{{ route( 'grades.update' ) }}" id="form-user-insert" method="POST" novalidate enctype="multipart/form-data">
				@csrf

				<input type="hidden" name="gradeId" value="{{$grade->hashId}}" />

				<div class="" style="display: flex;padding: 40px 0;">
					<div class="diary-form-grid grid-size-2" style="flex:1;margin-bottom: 20px;">


						<div class="diary-form-row">
							<label for="teacher">{{__('dashboard/grade.Wystawiający')}}</label>
							<input type="text" class="form-control" name="teacher" id="teacher" value="{{$user->meta->name}} {{$user->meta->surname}}" readonly>
						</div>

						<div class="diary-form-row">
							<label for="student_id">{{__('dashboard/grade.Uczeń')}}</label>
							<select name="student_id" id="student_id" class="form-control input-md input-select2" required>
								<option value="0" selected>{{__('dashboard/grade.Wybierz ucznia')}}</option>
								@foreach($students as $student)
									<option value="{{$student->id}}" @if( old( 'student_id', $grade->student_id) == $student->id ) selected @endif>
										{{$student->meta->name}} {{$student->meta->surname}}
									</option>
								@endforeach
							</select>
						</div>


						<div class="diary-form-row">
							<label for="subject_id">{{__('dashboard/grade.Przedmiot')}}</label>
							<select name="subject_id" id="subject_id" class="form-control input-md" required>
								<option value="0" selected>{{__('dashboard/grade.Wybierz przedmiot')}}</option>
								@foreach($subjects as $key => $subject)
									<option value="{{$key}}" @if( old( 'subject', $grade->subject_id) == $key ) selected @endif>
										{{$subject}}
									</option>
								@endforeach
							</select>
						</div>


						<div class="diary-form-row">
							<label for="grade">{{__('dashboard/grade.Ocena')}}</label>
							<input type="number" class="@if( $errors->has('grade') ) input-error @endif form-control" name="grade" id="grade" value="{{ old('grade', $grade->grade) }}" required>
						</div>


						<div class="diary-form-row">
							<label for="weight">{{__('dashboard/grade.Waga')}}</label>
							<input type="number" class="@if( $errors->has('weight') ) input-error @endif form-control" name="weight" id="weight" value="{{ old('weight', $grade->weight) }}" required>
						</div>


						<div class="diary-form-row">
							<label for="description">{{__('dashboard/grade.Opis')}}</label>
							<input type="text" class="@if( $errors->has('description') ) input-error @endif form-control" name="description" id="description" value="{{ old('description', $grade->description) }}" required>
						</div>

						<div class="form-btn-group form-rows" style="justify-content: flex-end;">
							<button class="action-button btn btn-success confirm"><i class="fas fa-check"></i>{{__('dashboard/grade.Zapisz')}}</button>
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