<div class="table-responsive">
    <table class="table" id="participants-table">
        <thead>
            <tr>
                <th>役務</th>
                <th>代理</th>
                <th>氏名</th>
                <th>座席</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($participants as $participant)
                <tr>
                    <td>
                        @switch($participant->is_represent)
                            @case('県連代表(1)')
                                理事長
                            @break

                            @case('県連代表(2)')
                                県コミッショナー
                            @break

                            @case('県連代表(3)')
                                事務局長
                            @break

                            @case('県連代表(4)')
                                引率指導者
                            @break

                            @case('県連代表(5)')
                                VSスカウト
                            @break

                            @case('県連代表(6)')
                                BSスカウト
                            @break

                            @default
                        @endswitch
                    </td>
                    <td>{{ $participant->is_proxy }}</td>
                    <td><a href="{{ route('pref_participants.show', [$participant->id]) }}">{{ $participant->name }}</a>
                        <span class="uk-text-warning">
                            @if (isset($participant->vs))
                                <br>VS:{{ $participant->vs->name }}
                            @endif
                            @if (isset($participant->bs))
                                <br>BS:{{ $participant->bs->name }}
                            @endif
                        </span>
                    </td>
                    <td>{{ $participant->seat_number }}</td>
                    <td width="120">
                        {{-- {!! Form::open(['route' => ['pref_participants.destroy', $participant->id], 'method' => 'delete']) !!} --}}
                        <div class='btn-group'>
                            <a href="{{ route('pref_participants.edit', [$participant->id]) }}"
                                class='btn btn-default btn-xs'>
                                <span uk-icon="file-edit"></span>
                            </a>
                            {{-- {!! Form::button('<span uk-icon="trash"></span>', [
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-xs',
                                'onclick' => "return confirm('本当に削除しますか?')",
                            ]) !!} --}}
                        </div>
                        {{-- {!! Form::close() !!} --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
