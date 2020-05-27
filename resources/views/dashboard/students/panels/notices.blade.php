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
            </td>
            <td>
                {{$note->created_at}}
            </td>

    @endforeach
    </tbody>
</table>
