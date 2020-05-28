@extends('dashboard.home')

@section('title', 'Uczeń - ' . $student->fullName)

@section('content_header')
    <div class="content-header-inner">
        <h1>Uczeń: {{$student->fullName}}</h1>
        <a href="{{route('students.index')}}">
            <button class="btn btn-info btn-sm"><i class="fa fa-undo"></i> Cofnij</button>
        </a>
    </div>
@stop

@section('content')
    <div class="col-sm-12">
        <div class="action-links">
            <a href="{{ route('students.edit', ['user' => $student->hashid]) }}" class="page-header-action">
                <button type="button" class="btn btn btn-success btn-outline-primary text-white">
                    <i class="fas fa-user-edit"></i> {{__('dashboard/student.Edytuj ucznia')}}
                </button>
            </a>

            <form class="delete-form" action="{{ route('users.delete', ['hashId' => $student->hashId]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger btn-outline-primary delete-student-btn  text-white">
                    <i class="fas fa-trash"></i> {{__('dashboard/student.Usuń ucznia')}}
                </button>
            </form>

            @if (  $student->isActive() )
                <a href="{{ route('users.status', ['id' => $student->hashId, 0, 'student']) }}" class="page-header-action">
                    <button type="button" class="btn btn btn-danger btn-outline-primary block-student-btn text-white">
                        <i class="fas fa-ban"></i> {{__('dashboard/student.Zablokuj ucznia')}}
                    </button>
                </a>
            @else
                <a href="{{ route('users.status', ['id' => $student->hashId, 1, 'student']) }}" class="page-header-action">
                    <button type="button" class="btn btn btn-success btn-outline-primary block-student-btn text-white">
                        <i class="fas fa-check-circle"></i> {{__('dashboard/student.Odblokuj ucznia')}}
                    </button>
                </a>
            @endif
        </div>
        <div class="basic-user-info">
            <section class="section-data">
                @if ( $student->isActive() )
                    <div class=" badge badge-success">
                        <span style="display: none">_active</span> {{__('dashboard/user.Aktywny')}}
                    </div>
                @else
                    <div class="badge badge-danger">
                        <span style="display: none">_inactive</span> {{__('dashboard/user.Nieaktywny')}}
                    </div>
                @endif
                <div class="section-data-row is-flex">
                    <div class="row-label mr-2">{{ __('dashboard/student.Uczeń') }}:</div>
                    <div class="row-value">{{ $student->fullName }}</div>
                </div>
            </section>
            <section class="section-data">
                <div class="section-data-row is-flex">
                    <div class="row-label mr-2">{{__('dashboard/student.Email')}}:</div>
                    <div class="row-value"><a href="mailto:{{ $student->email  }}">{{ $student->email  }}</a></div>
                </div>
                <div class="section-data-row is-flex">
                    <div class="row-label mr-2">{{__('dashboard/student.Nr telefonu')}}:</div>
                    <div class="row-value"><a href="tel:{{ $student->meta->phone  }}">{{ $student->meta->phone  }}</a></div>
                </div>
            </section>
        </div>
    </div>

    <nav data-id="{{$student->id}}">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link ajax-tab active" data-toggle="tab" href="#tab-overall" role="tab" aria-controls="tab-overall" aria-selected="true">{{__('dashboard/student.Dane ucznia')}}</a>
{{--            <a class="nav-item nav-link ajax-tab" data-toggle="tab" href="#tab-parents" role="tab" aria-controls="tab-parents" aria-selected="false">{{__('dashboard/student.Rodzice')}}</a>--}}
            <a class="nav-item nav-link ajax-tab" data-toggle="tab" href="#tab-grades" role="tab" aria-controls="tab-grades" aria-selected="false">{{__('dashboard/student.Oceny')}}</a>
{{--            <a class="nav-item nav-link ajax-tab" data-toggle="tab" href="#tab-presences" role="tab" aria-controls="tab-presences" aria-selected="false">{{__('dashboard/student.Obecności')}}</a>--}}
            <a class="nav-item nav-link ajax-tab" data-toggle="tab" href="#tab-notices" role="tab" aria-controls="tab-notices" aria-selected="false">{{__('dashboard/student.Uwagi')}}</a>
        </div>
    </nav>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="tab-overall" role="tabpanel" aria-labelledby="tab-overall"></div>

        <div class="tab-pane fade" id="tab-parents" role="tabpanel" aria-labelledby="tab-parents"></div>
        <div class="tab-pane fade" id="tab-grades" role="tabpanel" aria-labelledby="tab-grades"></div>
        <div class="tab-pane fade" id="tab-presences" role="tabpanel" aria-labelledby="tab-presences"></div>
        <div class="tab-pane fade" id="tab-notices" role="tabpanel" aria-labelledby="tab-notices"></div>
    </div>
@stop

@section('js')
    @include('dashboard.users.js.ajax-panels')
@stop

@section('css')

@stop
