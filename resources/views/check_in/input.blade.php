<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <script src="{{ url('js/jquery.min.js') }}"></script>

    <link rel="stylesheet" href="{{ url('css/adminlte.min.css') }}" />
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="{{ url('css/uikit.min.css') }}" />

    <!-- UIkit JS -->
    <script src="{{ url('js/uikit.min.js') }}"></script>
    <script src="{{ url('js/uikit-icons.min.js') }}"></script>


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <div class="content-wrapper">
            <section class="content">

                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                        </div>
                    </div>
                </section>

                <div class="content px-3">

                    <div class="card">
                        <div style="background-color:#115740">
                            <p class="uk-text-large uk-text-center" style="color:#FFF">100周年レセプション<br>チェックイン</p>
                        </div>
                        <p class="uk-text-warning uk-text-small">参列者を検索してください</p>
                        <div class="card-body p-0">
                            {{ Form::open() }}
                            {!! Form::text('furigana', old('furigana'), ['class' => 'uk-input','placeholder'=>'ふりがなを入力']) !!}
                            {!! Form::submit('検索', ['class' => 'uk-button uk-button-primary']) !!}
                            {{ Form::close() }}
                            @if (isset($participants))
                                <table class="uk-table uk-table-hover uk-table-striped uk-table-small">
                                    <tr>
                                        <th>氏名</th>
                                        <th>座席番号</th>
                                        <th>所属</th>
                                    </tr>
                                    @foreach ($participants as $participant)
                                        <tr>
                                            <td>{{ $participant->name }}</td>
                                            <td>{{ $participant->seat_number }}</td>
                                            <td>{{ $participant->pref }}連盟 @if ($participant->district){{ $participant->district }}地区@endif
                                                {{ $participant->dan_name }}@if ($participant->dan_number){{ $participant->dan_number }}団@endif</td>
                                        </tr>
                                    @endforeach
                                </table>
                                {{-- {{ $participants->links() }} --}}
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Main Footer -->
        <footer class="main-footer" style="background-color:#115740; color:#fff">
            <p class="uk-text-small uk-text-center">ボーイスカウト東京連盟<br>
                {{ config('app.name') }} &copy;</p>
        </footer>
    </div>
</body>

</html>
