<div class="table-responsive">
    <table class="uk-table uk-table-divider uk-table-hover uk-table-responsive" id="participants-table">
        <thead>
            <tr>
                <th>県連</th>
                <th>役務</th>
                <th>氏名</th>
                <th>座席</th>
                <th>参加費</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($participants as $participant)
                <tr>
                    <td>{{ $participant->pref }}</td>
                    <td>
                        @switch($participant->category)
                            @case('県連代表(1)')
                                <span class="uk-text-success">理事長</span>
                            @break

                            @case('県連代表(2)')
                                <span class="uk-text-success">県コミッショナー</span>
                            @break

                            @case('県連代表(3)')
                                <span class="uk-text-success">事務局長</span>
                            @break

                            @case('県連代表(4)')
                                <span class="uk-text-success">引率指導者</span>
                            @break

                            @case('県連代表(5)')
                                <span class="uk-text-success">VSスカウト</span>
                            @break

                            @case('県連代表(6)')
                                <span class="uk-text-success">BSスカウト</span>
                            @break

                            @default
                                任意参加者
                        @endswitch
                        @if (isset($participant->is_proxy) && $participant->is_proxy !== '')
                            <br><span class="uk-text-small">(代理:{{ $participant->is_proxy }})</span>
                        @endif
                    </td>
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
                    <td>
                        @if (isset($participant->seat_number))
                            式典:{{ $participant->seat_number }}
                        @endif
                        @if (isset($participant->reception_seat_number))
                            <br>レセ:{{ $participant->reception_seat_number }}
                        @endif
                    </td>
                    <td>
                        @if (isset($participant->fee_checked_at))
                            済み
                        @endif
                    </td>
                    <td>
                        {!! Form::open(['route' => ['participants.destroy', $participant->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('participants.edit', [$participant->id]) }}"
                                class='btn btn-default btn-xs'>
                                <span uk-icon="file-edit"></span>
                            </a>
                            {!! Form::button('<span uk-icon="trash"></span>', [
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-xs',
                                'onclick' => "return confirm('本当に削除しますか?')",
                            ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
