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
                            <p class="uk-text-large uk-text-center" style="color:#FFF">100周年記念式典 & レセプション<br>デジタルパス</p>
                        </div>
                        <p class="uk-text-primary uk-text-small">このページをブックマーク、もしくはスクリーンショットを保存して受付でご提示下さい。</p>
                        <div class="card-body p-0">
                            <table class="uk-table uk-table-hover uk-table-striped">
                                <tr>
                                    <td>氏名</td>
                                    <td>{{ $participant->name }} 様</td>
                                </tr>
                                <tr>
                                    <td>QR</td>
                                    <td>{!! QrCode::size(200)->generate(url('/s/check_in?id=') . $participant->uuid) !!}</td>
                                </tr>
                                <tr>
                                    <td>座席番号</td>
                                    <td>{{ $participant->seat_number }}</td>
                                </tr>
                                <tr>
                                    <td>所属</td>
                                    <td>{{ $participant->pref }}連盟 @if ($participant->district){{ $participant->district }}地区@endif
                                        {{ $participant->dan_name }}@if($participant->dan_number){{ $participant->dan_number }}団@endif</td>
                                </tr>
                                <tr>
                                    <td>役務</td>
                                    <td>{{ $participant->role }}</td>
                                </tr>
                                <tr>
                                    <td>チェックイン</td>
                                    <td><a href="#modal-self-check-in" uk-toggle class=" uk-button uk-button-primary uk-width-1-1@m">チェックイン</a></td>
                                </tr>
                                <tr>
                                    <td>欠席手続</td>
                                    <td><a href="#modal-self-absent" uk-toggle class=" uk-button uk-button-danger uk-width-1-1@m">欠席</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="modal-self-check-in" uk-modal>
                    <div class="uk-modal-dialog uk-modal-body">
                        <h2 class="uk-modal-title">チェックイン</h2>
                        <p>ご自身でチェックイン(到着手続き)を行います。引率するスカウトも一緒に到着扱いとなります。</p>
                        <p class="uk-text-right">
                            <button class="uk-button uk-button-default uk-modal-close" type="button">キャンセル</button>
                            <button class="uk-button uk-button-primary" type="button">チェックインする</button>
                        </p>
                    </div>
                </div>

                <div id="modal-self-absent" uk-modal>
                    <div class="uk-modal-dialog uk-modal-body">
                        <h2 class="uk-modal-title">欠席手続き</h2>
                        <p>ご自身で欠席手続きを行います。諸事情で参加を取りやめる場合はこちらで手続きをしてください。</p>
                        <p class="uk-text-right">
                            <button class="uk-button uk-button-default uk-modal-close" type="button">キャンセル</button>
                            <button class="uk-button uk-button-danger" type="button">欠席する</button>
                        </p>
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
