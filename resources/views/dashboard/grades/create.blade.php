@extends('dashboard.home')

@section('title', $head_text)

@section('content_header')
	<div class="content-header-inner">
		<h1>{!! $head_text !!}</h1>

		<a href="{{route('grades.index')}}">
			<button class="btn btn-info btn-sm"><i class="fa fa-undo"></i> {{__('dashboard/grade.Anuluj')}}</button>
		</a>
	</div>
@stop


@section('content')

	<div class="diary-container">
		<div class="diary-container-body">

			@include('dashboard.common.errors', [ 'errors' => $errors ] )

			<form action="{{ route( 'grades.store' ) }}" id="form-grade-insert" method="POST" novalidate enctype="multipart/form-data">
				@csrf

				<div class="" style="display: flex;padding: 40px 0;">
					<div class="diary-form-grid grid-size-2" style="flex:1;margin-bottom: 20px;">

						<div class="diary-form-row">
							<label for="teacher">{{__('dashboard/grade.Wystawiający')}}</label>
							<input type="text" class="form-control" name="teacher" id="teacher" value="{{$user->meta->name}} {{$user->meta->surname}}" readonly>
						</div>

						<!-- <div class="diary-form-row">
							<label for="schoolclass">{{__('dashboard/class.Klasa')}}</label>
							<select name="schoolclass" id="schoolclass" class="form-control input-md" required>
								<option value="0" selected>{{__('dashboard/class.Wybierz klasę')}}</option>
								@foreach($schoolclasses as $schoolclass)
									<option value="{{$schoolclass->id}}" @if( old( 'schoolclass') == $schoolclass->id ) selected @endif>
										{{$schoolclass->fullName}}
									</option>
								@endforeach
							</select>
						</div>

						<div class="diary-form-row">
							<label for="classstudents">{{__('dashboard/class.Klasa')}}</label>
							<select name="classstudents" id="classstudents" class="form-control input-md" required>
								<option value="0" selected>{{__('dashboard/class.Wybierz klasę')}}</option>
								@foreach($schoolclasses as $schoolclass)
									<option value="{{$schoolclass->id}}" @if( old( 'schoolclass') == $schoolclass->id ) selected @endif>
										{{$schoolclass->fullName}}
									</option>
								@endforeach
							</select>
						</div> -->

						<div class="diary-form-row">
							<label for="student_id">{{__('dashboard/grade.Uczeń')}}</label>
							<select name="student_id" id="student_id" class="form-control input-md input-select2" required>
								<option value="0" selected>{{__('dashboard/grade.Wybierz ucznia')}}</option>
								@foreach($students as $student)
									<option value="{{$student->id}}" @if( old( 'student_id') == $student->id ) selected @endif>
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
									<option value="{{$key}}" @if( old( 'subject') == $key ) selected @endif>
										{{$subject}}
									</option>
								@endforeach
							</select>
						</div>

						<!-- <div class="diary-form-row">
							<label for="grade">{{__('dashboard/grade.Ocena')}}</label>
							<input type="number" class="@if( $errors->has('grade') ) input-error @endif form-control" name="grade" id="grade" value="{{ old('grade') }}" required>
						</div> -->

						<div class="diary-form-row">
							<label for="grade">{{__('dashboard/grade.Ocena')}}</label>
							<select name="grade" id="grade" class="form-control input-md input-select2" required>
								<option value="0" selected>{{__('dashboard/grade.Wybierz ocenę')}}</option>
								<option value="1" @if( old( 'grade') == "1" ) selected @endif>{{__('1')}}</option>
								<option value="1.5" @if( old( 'grade') == "1.5" ) selected @endif>{{__('1.5')}}</option>
								<option value="2" @if( old( 'grade') == "2" ) selected @endif>{{__('2')}}</option>
								<option value="2.5" @if( old( 'grade') == "2.5" ) selected @endif>{{__('2.5')}}</option>
								<option value="3" @if( old( 'grade') == "3" ) selected @endif>{{__('3')}}</option>
								<option value="3.5" @if( old( 'grade') == "3.5" ) selected @endif>{{__('3.5')}}</option>
								<option value="4" @if( old( 'grade') == "4" ) selected @endif>{{__('4')}}</option>
								<option value="4.5" @if( old( 'grade') == "4.5" ) selected @endif>{{__('4.5')}}</option>
								<option value="5" @if( old( 'grade') == "5" ) selected @endif>{{__('5')}}</option>
								<option value="5.5" @if( old( 'grade') == "5.5" ) selected @endif>{{__('5.5')}}</option>
								<option value="6" @if( old( 'grade') == "6" ) selected @endif>{{__('6')}}</option>
							</select>
						</div>


						<!-- <div class="diary-form-row">
							<label for="weight">{{__('dashboard/grade.Waga')}}</label>
							<input type="number" class="@if( $errors->has('weight') ) input-error @endif form-control" name="weight" id="weight" value="{{ old('weight') }}" required>
						</div> -->

						<div class="diary-form-row">
							<label for="weight">{{__('dashboard/grade.Waga')}}</label>
							<select name="weight" id="weight" class="form-control input-md input-select2" required>
								<option value="0" selected>{{__('dashboard/grade.Wybierz wagę')}}</option>
								<option value="1" @if( old( 'weight') == "1" ) selected @endif>{{__('1 - Zadanie domowe')}}</option>
								<option value="2" @if( old( 'weight') == "2" ) selected @endif>{{__('2 - Aktywność')}}</option>
								<option value="3" @if( old( 'weight') == "3" ) selected @endif>{{__('3 - Kartkówka')}}</option>
								<option value="4" @if( old( 'weight') == "4" ) selected @endif>{{__('4 - Odpowiedź')}}</option>
								<option value="5" @if( old( 'weight') == "5" ) selected @endif>{{__('5 - Przykladowa waga')}}</option>
								<option value="6" @if( old( 'weight') == "6" ) selected @endif>{{__('6 - Przykladowa waga')}}</option>
								<option value="7" @if( old( 'weight') == "7" ) selected @endif>{{__('7 - Praca klasowa')}}</option>
							</select>
						</div>

						<div class="diary-form-row">
							<label for="description">{{__('dashboard/grade.Opis')}}</label>
							<input type="text" class="@if( $errors->has('description') ) input-error @endif form-control" name="description" id="description" value="{{ old('description') }}" required>
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
	<!-- <script type="text/javascript">
		$('#schoolclass').on('change', function(e){
			console.log(e);
			var schoolclass_id = e.target.value;
			$.get('/json-classstudents?schoolclass_id=' + schoolclass_id,function(data) {
				console.log(data);
				$('classstudents').empty();
				$('classstudents').append('<option value="0" selected>{{__('dashboard/class.Wybierz klasę')}}</option>')

				$.each(data, function(index, classstudentsObj){
					$('classstudents').append('<option value="'+ classstudentsObj.id +'">'+ classstudentsObj.name + '</option>');
				})
			});
		})
	</script> -->
	 @include('dashboard.grades.js.create')
@stop