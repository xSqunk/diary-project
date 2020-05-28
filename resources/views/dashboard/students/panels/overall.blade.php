<section class="section-data">
    <div class="section-data-row is-flex">
        <div class="row-label mr-2">{{__('dashboard/student.Data urodzenia')}}:</div>
        <div class="row-value">{{ $student->meta->birth_date}}</div>
    </div>

    <div class="section-data-row is-flex">
        <div class="row-label mr-2">{{__('dashboard/student.PESEL')}}:</div>
        <div class="row-value">{{ $student->meta->PESEL}}</div>
    </div>

    @if($student->schoolclass)
    <div class="section-data-row is-flex">
        <div class="row-label mr-2">{{__('dashboard/student.Klasa')}}:</div>
        <div class="row-value">{{ $student->schoolclass->fullName}}</div>
    </div>
    @endif
</section>