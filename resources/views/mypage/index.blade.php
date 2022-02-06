<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <script src="{{ url('js/jquery.min.js') }}"></script>

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
                        <p class="uk-text-large uk-text-center" style="color:#FFF">100周年レセプション<br>デジタルパス</p>
                    </div>
                        <p class="uk-text-primary uk-text-small">このページをブックマーク、もしくはスクリーンショットを保存して受付でご提示下さい。</p>
                        <div class="card-body p-0">
                            <table class="uk-table uk-table-hover uk-table-striped">
                                <tr>
                                    <td>氏名</td>
                                    <td>{{ $participant->name }} 様</td>
                                </tr>
                                <tr>
                                    <td>座席番号</td>
                                    <td>{{ $participant->seat_number }}</td>
                                </tr>
                                <tr>
                                    <td>県連盟</td>
                                    <td>{{ $participant->pref }}</td>
                                </tr>
                                <tr>
                                    <td>所属</td>
                                    <td>{{ $participant->district }} {{ $participant->dan_name }}
                                        {{ $participant->dan_number }}</td>
                                </tr>
                                <tr>
                                    <td>役務</td>
                                    <td>{{ $participant->role }}</td>
                                </tr>
                                <tr>
                                    <td>QR</td>
                                    <td>{!! QrCode::size(200)->generate(url('/?id=').$participant->uuid) !!}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </section>
        </div>

        <!-- Main Footer -->
        <footer class="main-footer">
            <p class="uk-text-small uk-text-center">ボーイスカウト東京連盟<br>
                {{ config('app.name') }} &copy;</p>
        </footer>
    </div>
</body>

</html>
