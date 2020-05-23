<h3>Uwagi ucznia</h3>
<table class="is-dataTable table-striped table-bordered mt-3" width="100%">
    <thead>
    <tr>
        <th>{{__('dashboard/note.Nauczyciel')}}</th>
        <th>{{__('dashboard/note.Student')}}</th>
        <th>{{__('dashboard/note.Przedmiot')}}</th>
        <th>{{__('dashboard/note.Treść')}}</th>
        <th>{{__('dashboard/note.Typ uwagi')}}</th>
        <th>{{__('dashboard/note.Czas utworzenia')}}</th>
        <th>{{__('dashboard/note.Akcje')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($notes as $note)
        <tr data-hash_id="{{$note->hashId}}" data-name="{{$note->student_id}}">
            <td>
                {{$note->teacher->meta->name . ' ' . $note->teacher->meta->surname}}
            </td>
            <td>
                {{$note->student->meta->name . ' ' . $note->student->meta->surname}}
            </td>
            <td>
                {{$note->subject->name}}
            </td>
            <td>
                {{$note->text}}
            </td>
            <td>
                {{$note->getStatusNameAttribute()}}
{{--                                    @if($note->getStatusNameAttribute()==1)--}}
{{--                                        <p style="color: green">POZYTWNA</p>--}}
{{--                                    @else--}}
{{--                                        <p style="color: red">NEGATYWNA</p>--}}
{{--                                    @endif--}}
            </td>
            <td>
                {{$note->created_at}}
            </td>
            <td>
{{--                <a href="{{ route( 'notes.edit', [ 'note' => $note->hashId ] ) }}">--}}
                <button class="btn btn-success diary-edit-btn" title="{{__('dashboard/note.Edytuj uwage')}}">
                    <i class="fas fa-edit"></i>
                </button>
{{--                </a>--}}
{{--                <a href="{{ route( 'notes.delete' ) }}">--}}
                    <button class="btn btn-danger delete-note" title="{{__('dashboard/note.Usuń uwage')}}">
                        <i class="fas fa-trash"></i>
                    </button>
{{--                </a>--}}
            </td>

    @endforeach
    </tbody>
</table>
