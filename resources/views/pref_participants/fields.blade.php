<table class="uk-table uk-table-divider uk-table-responsive uk-table-striped">
    <tr>
        <td>{!! Form::label('name', '氏名:') !!}</td>
        <td>{!! Form::text('name', null, ['class' => 'form-control']) !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('name', 'ふりがな:') !!}</td>
        <td>{!! Form::text('furigana', null, ['class' => 'form-control']) !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('pref', '県連盟:') !!}</td>
        <td>{{ $participant->pref }}</td>
        {!! Form::hidden('pref', $participant->pref) !!}
    </tr>
    <tr>
        <td>{!! Form::label('district', '地区:') !!}</td>
        <td>{!! Form::text('district', null, ['class' => 'form-control']) !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('dan_name', '団名:') !!}</td>
        <td>{!! Form::text('dan_name', null, ['class' => 'form-control', 'placeholder' => '例:荻窪1']) !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('role', '県連代表役務:') !!}</td>
        <td>{!! Form::select(
            'role',
            [
                '' => '',
                '理事長' => '理事長',
                '県コミ' => '県コミ',
                '事務局長' => '事務局長',
                '引率指導者' => '引率指導者',
                'VSスカウト' => 'VSスカウト',
                'BSスカウト' => 'BSスカウト',
            ],
            null,
            ['class' => 'form-control custom-select'],
        ) !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('is_proxy', '代理の場合の県連役務:') !!}</td>
        <td>{!! Form::text('is_proxy', null, ['class' => 'form-control']) !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('email', 'Email:') !!}</td>
        <td>{!! Form::text('email', null, ['class' => 'form-control']) !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('phone', '電話:') !!}</td>
        <td>{!! Form::text('phone', null, ['class' => 'form-control']) !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('seat_number', '座席番号:') !!}</td>
        <td>{{ $participant->seat_number }}</td>
    </tr>
</table>