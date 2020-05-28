
<table class="is-dataTable table-striped table-bordered mt-3" width="100%">
		<thead>
			<tr>
				<th class="text-center" width="30%">{{__('dashboard/grade.Przedmiot')}}</th>
				<th class="text-center" width="60%">{{__('dashboard/grade.Oceny cząstkowe')}}</th>
				<th class="text-center" width="10%">{{__('dashboard/grade.Średnia')}}</th>
			</tr>
		</thead>
	
		<tbody>
		@foreach($class_subjects as $class_subject)

		@php
		$avg = 0.0;
		$weights = 0.0;
		@endphp

			<tr>
				<td>
					{{$class_subject->name}}
				</td>
				<td>
					@if($student->grades->where('subject_id','=', $class_subject->id)->count() > 0)
						@foreach($student->grades->where('subject_id','=', $class_subject->id) as $grade)
							@php
								if($grade->weight == 1){
                                    $bckcolor = "#FFA500";
                                }
                                elseif ($grade->weight == 2){
                                    $bckcolor = "#FFFF00";
                                }
                                elseif ($grade->weight == 3){
                                    $bckcolor = "#00FF00";
                                }
                                elseif ($grade->weight == 4){
                                    $bckcolor = "#008000";
                                }
                                elseif ($grade->weight == 5){
                                    $bckcolor = "#87CEEB";
                                }
                                elseif ($grade->weight == 6){
                                    $bckcolor = "#4169E1";
                                }
                                else {
                                    $bckcolor = "#FF0000";
                                }
							@endphp
							<div class="gradebox" style="background-color: {{$bckcolor}}" id="{{$gradenumber}}" data-teachername="{{$grade->teacher->meta->name}} {{$grade->teacher->meta->surname}}" data-grade="{{$grade->grade}}" data-weight="{{$grade->weight}}" data-description="{{$grade->description}}" data-createdat="{{$grade->created_at}}"><a style="color:black" href="#" class="hover">{{$grade->grade}}</a></div>
							@php
								$avg = $avg + $grade->grade * $grade->weight;
                                $weights+= $grade->weight;
                                $gradenumber+= 1;
							@endphp
						@endforeach
					@endif
				</td>
				<td>
					@php
					if($weights != 0) {
					$average = $avg / $weights;
					}
					else {
						$average = '-';
					}

					@endphp
					{{$average}}		
				</td>
				@endforeach
			</tr>
		</tbody>
<script type="text/javascript">

    $(document).ready(function() {
        $('.hover').click(function() {

            let row = $(this).closest('div');
            let teachername = row.data('teachername');
            let grade = row.data('grade');
            let weight = row.data('weight');
            let description = row.data('description');
            let createdat = row.data('createdat');


            swal.fire({
                html: "<b>Ocena:</b>  " + grade +"<br><b>Waga:</b> " + weight + "<br><b>Opis:</b> " + description + "<br><b>Nauczyciel wystawiający:</b> " + teachername + "<br><b>Data wystawienia:</b> " + createdat,
                type: 'info',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Zamknij',
                confirmButtonClass: 'btn btn-success',
                buttonsStyling: false
            })

        });
    });
</script>
@section('css')

@stop
