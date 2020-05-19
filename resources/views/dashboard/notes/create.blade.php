@extends('dashboard.home')

@section('title', $head_text)

@section('content_header')
	<div class="content-header-inner">
		<h1>{!! $head_text !!}</h1>

		<a href="{{route('notes.index')}}">
			<button class="btn btn-info btn-sm"><i class="fa fa-undo"></i> Anuluj</button>
		</a>
	</div>
@stop


@section('content')

	<div class="diary-container">
		<div class="diary-container-body">

			@include('dashboard.common.errors', [ 'errors' => $errors ] )

			<form action="{{ route( 'notes.store' ) }}" id="form-user-insert" method="POST" novalidate enctype="multipart/form-data">
				@csrf

				<div class="" style="display: flex;padding: 40px 0;">
					<div class="diary-form-grid grid-size-2" style="flex:1;margin-bottom: 20px;">

						<div class="diary-form-row">
							<label for="teacher">{{__('dashboard/note.Nauczyciel')}}</label>
                            <select name="teacher_id" id="teacher_id" class="form-control input-md input-select2" required>
                                <option value="0" selected>{{__('dashboard/note.Nauczyciel')}}</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{$teacher->id}}" @if( old( 'teacher_id') == $teacher->id ) @endif>
                                        {{$teacher->meta->name}} {{$teacher->meta->surname}}
                                    </option>
                                @endforeach
                            </select>
						</div>

						<div class="diary-form-row">
							<label for="student">{{__('dashboard/note.Student')}}</label>
                            <select name="student_id" id="student_id" class="form-control input-md input-select2" required>
                                <option value="0" selected>{{__('dashboard/note.Student')}}</option>
                                @foreach($students as $student)
                                    <option value="{{$student->id}}" @if( old( 'student_id') == $student->id ) selected @endif>
                                        {{$student->meta->name}} {{$student->meta->surname}}
                                    </option>
                                @endforeach
                            </select>
						</div>

						<div class="diary-form-row">
                            <label for="subject_id">{{__('dashboard/note.Przedmiot')}}</label>
                            <select name="subject_id" id="subject_id" class="form-control input-md input-select2" required>
                                <option value="0" selected>{{__('dashboard/note.Przedmiot')}}</option>
                                @foreach($subjects as $subject)
                                    <option value="{{$subject->id}}" @if( old( '$subject_id') == $subject->id ) selected @endif>
                                        {{$subject->name}}
                                    </option>
                                @endforeach
                            </select>
						</div>

						<div class="diary-form-row">
							<label for="text">{{__('dashboard/note.Treść')}}</label>
                            <textarea id="text" name="text" placeholder="{{__('dashboard/note.Treść')}}" class="form-control input-md">{{old('text')}}</textarea>
						</div>

						<div class="diary-form-row">
							<label for="positiv">{{__('dashboard/note.Typ uwagi')}}</label>
							<select name="positiv" id="positiv" class="form-control input-md" required>
                                <option value="1" selected>{{__('Pozytywna')}}</option>
                                <option value="0" selected>{{__('Negatywna')}}</option>
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
