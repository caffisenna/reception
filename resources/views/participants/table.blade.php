<div class="table-responsive">
    <table class="table" id="participants-table">
        <thead>
            <tr>
                <th>氏名</th>
                <th>県連</th>
                <th>所属</th>
                <th>役務</th>
                <th>座席</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($participants as $participant)
                <tr>
                    <td><a href="{{ route('participants.show', [$participant->id]) }}">{{ $participant->name }}</a>
                        <span class="uk-text-warning">
                            @if (isset($participant->vs))
                                <br>VS:{{ $participant->vs->name }}
                            @endif
                            @if (isset($participant->bs))
                                <br>BS:{{ $participant->bs->name }}
                            @endif
                        </span>
                    </td>
                    <td>{{ $participant->pref }}</td>
                    <td>{{ $participant->district }} {{ $participant->dan_name }}{{ $participant->dan_number }}
                    </td>
                    <td>{{ $participant->role }}</td>
                    <td>{{ $participant->seat_number }}</td>
                    <td width="120">
                        {!! Form::open(['route' => ['participants.destroy', $participant->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('participants.edit', [$participant->id]) }}"
                                class='btn btn-default btn-xs'>
                                <span uk-icon="file-edit"></span>
                            </a>
                            {!! Form::button('<span uk-icon="trash"></span>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('本当に削除しますか?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
