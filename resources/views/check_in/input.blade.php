@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div style="background-color:#115740">
                <p class="uk-text-large uk-text-center" style="color:#FFF">100周年レセプション<br>チェックイン</p>
            </div>
            <p class="uk-text-warning uk-text-small">参列者を検索してください(チェックイン済みの方は表示されません)</p>
            <div class="card-body p-0">
                <div class="uk-card uk-card-default uk-card-body uk-width-1-1@m">
                    <h3 class="uk-card-title">検索</h3>
                    {{ Form::open() }}
                    {!! Form::text('furigana', old('furigana'), ['class' => 'uk-input', 'placeholder' => 'ふりがなを入力']) !!}
                    {!! Form::submit('検索', ['class' => 'uk-button uk-button-primary']) !!}
                    {{ Form::close() }}
                </div>
                @if (isset($participants))
                    <table class="uk-table uk-table-hover uk-table-striped uk-table-small">
                        <tr>
                            <th>氏名</th>
                            <th>座席番号</th>
                            <th>所属</th>
                            <th>チェックイン</th>
                        </tr>
                        @foreach ($participants as $participant)
                            <tr>
                                <td>{{ $participant->name }}</td>
                                <td>{{ $participant->seat_number }}</td>
                                <td>{{ $participant->pref }}</td>
                                <td><a href="#" class="uk-button uk-button-primary uk-button-small"><span
                                            uk-icon="sign-in"></span></a></td>
                            </tr>
                        @endforeach
                    </table>
                    {{-- {{ $participants->links() }} --}}
                @endif
            </div>
        </div>
    </div>
@endsection
