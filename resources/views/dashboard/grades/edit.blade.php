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
							<select name="student_id" id="student_id" class="form-control input-md" readonly>
								<option value="{{$grade->student->id}}" selected>{{$grade->student->meta->name}} {{$grade->student->meta->surname}}
									({{$grade->student->meta->PESEL}})</option>
							</select>
						</div>

						<div class="diary-form-row">
							<label for="subject_id">{{__('dashboard/grade.Przedmiot')}}</label>
							<select name="subject_id" id="subject_id" class="form-control input-md" readonly>
								<option value="{{$grade->subject->id}}" selected>{{$grade->subject->name}}</option>
							</select>
						</div>

						<div class="diary-form-row">
							<label for="grade">{{__('dashboard/grade.Ocena')}}</label>
							<select name="grade" id="grade" class="form-control input-md" required>
								<option value="0" selected>{{__('dashboard/grade.Wybierz ocenę')}}</option>
								<option value="1"  @if( old( 'grade', $grade->grade) == "1" ) selected @endif>{{__('1')}}</option>
								<option value="1.5" @if( old( 'grade', $grade->grade) == "1.5" ) selected @endif>{{__('1.5')}}</option>
								<option value="2" @if( old( 'grade', $grade->grade) == "2" ) selected @endif>{{__('2')}}</option>
								<option value="2.5" @if( old( 'grade', $grade->grade) == "2.5" ) selected @endif>{{__('2.5')}}</option>
								<option value="3" @if( old( 'grade', $grade->grade) == "3" ) selected @endif>{{__('3')}}</option>
								<option value="3.5" @if( old( 'grade', $grade->grade) == "3.5" ) selected @endif>{{__('3.5')}}</option>
								<option value="4" @if( old( 'grade', $grade->grade) == "4" ) selected @endif>{{__('4')}}</option>
								<option value="4.5" @if( old( 'grade', $grade->grade) == "4.5" ) selected @endif>{{__('4.5')}}</option>
								<option value="5" @if( old( 'grade', $grade->grade) == "5" ) selected @endif>{{__('5')}}</option>
								<option value="5.5" @if( old( 'grade', $grade->grade) == "5.5" ) selected @endif>{{__('5.5')}}</option>
								<option value="6" @if( old( 'grade', $grade->grade) == "6" ) selected @endif>{{__('6')}}</option>
							</select>
						</div>

						<div class="diary-form-row">
							<label for="weight">{{__('dashboard/grade.Waga')}}</label>
							<select name="weight" id="weight" class="form-control input-md input-select2" required>
								<option value="0" selected>{{__('dashboard/grade.Wybierz wagę')}}</option>
								<option value="1" @if( old( 'weight', $grade->weight) == "1" ) selected @endif>{{__('1 - Zadanie domowe')}}</option>
								<option value="2" @if( old( 'weight', $grade->weight) == "2" ) selected @endif>{{__('2 - Aktywność')}}</option>
								<option value="3" @if( old( 'weight', $grade->weight) == "3" ) selected @endif>{{__('3 - Kartkówka')}}</option>
								<option value="4" @if( old( 'weight', $grade->weight) == "4" ) selected @endif>{{__('4 - Odpowiedź')}}</option>
								<option value="5" @if( old( 'weight', $grade->weight) == "5" ) selected @endif>{{__('5 - Przykładowa waga')}}</option>
								<option value="6" @if( old( 'weight', $grade->weight) == "6" ) selected @endif>{{__('6 - Przykładowa waga')}}</option>
								<option value="7" @if( old( 'weight', $grade->weight) == "7" ) selected @endif>{{__('7 - Praca klasowa')}}</option>
							</select>
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