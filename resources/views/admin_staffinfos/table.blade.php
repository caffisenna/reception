    <div class="table-responsive">
        <table class="uk-table uk-table-divider uk-table-small" id="staffinfos-table">
            <tr>
                <td>氏名</td>
                <td>チーム</td>
                <td>所属</td>
                <td>役務</td>
                <td>action</td>
            </tr>
            @foreach ($staffinfos as $staffinfo)
                <tr>
                    <td class="uk-text-small">{{ $staffinfo->user->name }} ({{ $staffinfo->furigana }})</td>
                    <td class="uk-text-small">{{ $staffinfo->team }}</td>
                    <td class="uk-text-small">{{ $staffinfo->prefecture }}連盟<br>{{ $staffinfo->district }}地区
                        {{ $staffinfo->dan }}団</td>
                    <td class="uk-text-small">{{ $staffinfo->role }}</td>
                    <td width="120">
                        {!! Form::open(['route' => ['admin_staffinfos.destroy', $staffinfo->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('admin_staffinfos.edit', [$staffinfo->id]) }}"
                                class='btn btn-default btn-xs'>
                                編集
                            </a>
                            {!! Form::button('削除', [
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-xs',
                                'onclick' => "return confirm('スタッフ情報を削除しますか?')",
                            ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
