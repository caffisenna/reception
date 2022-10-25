<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }} | デジタルパス</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <script src="{{ url('js/jquery.min.js') }}"></script>

    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ url('css/adminlte.min.css') }}" />

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="{{ url('css/uikit.min.css') }}" />

    <!-- UIkit JS -->
    <script src="{{ url('js/uikit.min.js') }}"></script>
    <script src="{{ url('js/uikit-icons.min.js') }}"></script>

    {{-- Swiper --}}
    <link rel="stylesheet" href="{{ url('/swiper/swiper-bundle.min.css') }}" />
    <script src="{{ url('/swiper/swiper-bundle.min.js') }}"></script>

    <style>
        .swiper {
            height: 150px;
        }
    </style>
</head>

<body class="uk-container-xsmall">
    <div class="">
        <div style="background-color:#115740">
            <p class="uk-text-default uk-text-center uk-margin-auto-vertical" style="color:#FFF">100周年記念式典 &
                レセプション<br>デジタルパス
            </p>
        </div>
        @include('flash::message')
        <div class=" uk-margin">
            <p class="uk-margin-medium uk-text-primary uk-text-small uk-margin-auto-vertical">
                ★このページをブックマーク、もしくはスクリーンショットを保存して受付でご提示下さい。</p>
            <p class="uk-text-danger">警備の関係で再入場はできません!</p>
        </div>
        <div class="card-body p-0">
            <table class="uk-table uk-table-hover uk-table-striped">
                <tr>
                    <th>氏名</th>
                    <td>{{ $participant->name }} 様
                        @unless(empty($participant->self_absent))
                            <span class="uk-text-danger">(欠)</span>
                        @endunless
                    </td>
                </tr>
                @if (isset($participant->vs->name) || isset($participant->bs->name))
                    <tr>
                        <th>引率スカウト</th>
                        {{-- シート番号も必要!! --}}
                        <td>
                            {{-- ベンチャースカウト --}}
                            @if (isset($participant->vs->name))
                                VS:{{ $participant->vs->name }} 様
                                ({{ $participant->vs->seat_number }})
                                @if (empty($participant->vs->self_absent))
                                @else
                                    <span class="uk-text-danger">(欠)</span>
                                @endif
                                <br>
                            @endif

                            {{-- ボーイスカウト --}}
                            @if (isset($participant->bs->name))
                                BS:{{ $participant->bs->name }} 様
                                ({{ $participant->bs->seat_number }})
                                @if (empty($participant->bs->self_absent))
                                @else
                                    <span class="uk-text-danger">(欠)</span>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endif
                <tr>
                    <th>QR</td>
                    <td>
                        <!-- Slider main container -->
                        <div class="swiper">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                <div class="swiper-slide">
                                    {!! QrCode::size(150)->generate(url('/s/check_in?id=') . $participant->uuid) !!}
                                </div>
                                <div class="swiper-slide">
                                    <a href="#" class="uk-button uk-button-large uk-button-primary">隠しチェックイン</a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>座席番号</th>
                    <td>{{ $participant->seat_number }}</td>
                </tr>

                <tr>
                    <th>チェックイン</th>
                    <td>
                        @if (empty($participant->checkedin_at) && empty($participant->self_absent))
                            <a href="#modal-self-check-in" uk-toggle
                                class=" uk-button uk-button-primary uk-width-1-1@m">チェックイン</a>
                        @elseif(isset($participant->self_absent))
                            <span class="uk-text-success">欠席入力済み</span>
                        @else
                            <span class="uk-text-success"><span uk-icon="icon: check"></span>チェックイン済み</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>欠席手続</th>
                    <td>
                        @if (empty($participant->checkedin_at) && empty($participant->self_absent))
                            <p class="uk-text-default"><a href="#modal-self-absent" uk-toggle
                                    class=" uk-button uk-button-danger uk-width-1-1@m">欠席(ご本人)</a></p>
                        @elseif(isset($participant->self_absent))
                            {{ $participant->name }}<br>
                        @endif
                        @if (isset($participant->vs->name) &&
                            empty($participant->vs->self_absent) &&
                            empty($participant->vs->checkedin_at))
                            <p class="uk-text-default"><a href="#modal-vs-absent" uk-toggle
                                    class=" uk-button uk-button-danger uk-width-1-1@m">{{ $participant->vs->name }}</a>
                            </p>
                        @elseif(isset($participant->vs->self_absent))
                            {{ $participant->vs->name }}<br>
                        @endif
                        @if (isset($participant->bs->name) &&
                            empty($participant->bs->self_absent) &&
                            empty($participant->bs->checkedin_at))
                            <p class="uk-text-default"><a href="#modal-bs-absent" uk-toggle
                                    class=" uk-button uk-button-danger uk-width-1-1@m">{{ $participant->bs->name }}</a>
                            </p>
                        @elseif(isset($participant->bs->self_absent))
                            {{ $participant->bs->name }}
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        <footer class="" style="background-color:#115740; color:#fff">
            <p class="uk-text-small uk-text-center uk-margin-auto-vertical">100周年記念式典部会<br>
                {{ config('app.name') }} &copy;</p>
        </footer>
    </div>

    {{-- ここからモーダルウィンドウ --}}
    <div id="modal-self-check-in" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <h2 class="uk-modal-title uk-text-primary">チェックイン</h2>
            <p>{{ $participant->name }}様ご自身でチェックイン(到着手続き)を行います。<br>
                @if (isset($participant->vs->name) || isset($participant->bs->name))
                    <span class="uk-text-warning">引率するスカウトも一緒に到着扱いとなります。スカウトが揃っているか確認してください。(欠席入力されていれば不要です)</span>
                @endif
            </p>
            <ul>
                @if (isset($participant->vs->name) && empty($participant->vs->self_absent))
                    <li>VS:{{ $participant->vs->name }}</li>
                @endif
                @if (isset($participant->bs->name) && empty($participant->bs->self_absent))
                    <li>BS:{{ $participant->bs->name }}</li>
                @endif
            </ul>
            <p class="uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close uk-width-1-1@m" type="button">キャンセル</button>
                <a class="uk-button uk-button-primary uk-width-1-1@m"
                    href="{{ url('/') }}/self_check_in/?checkin_id={{ $participant->uuid }}">チェックインする</a>
            </p>
        </div>
    </div>

    <div id="modal-self-absent" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <h2 class="uk-modal-title uk-text-danger">欠席手続き</h2>
            <p>{{ $participant->name }}様ご自身で欠席手続きを行います。参加を取りやめる場合は<span
                    class="uk-text-warning">欠席する</span>ボタンをタップしてください</p>
            @if (isset($participant->vs->name) || isset($participant->bs->name))
                <p class="uk-text-warning">引率スカウトは受付ブースで個別にチェックインを行って下さい。</p>
            @endif
            <p class="uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">キャンセル</button>
                <a class="uk-button uk-button-danger"
                    href="{{ url('/') }}/self/?absent={{ $participant->uuid }}">欠席する</a>
            </p>
        </div>
    </div>

    {{-- ベンチャー欠席ウィンドウ --}}
    @if (isset($participant->vs->name))
        <div id="modal-vs-absent" uk-modal>
            <div class="uk-modal-dialog uk-modal-body">
                <h2 class="uk-modal-title uk-text-danger">欠席手続き</h2>
                <p><span class="uk-text-danger">{{ $participant->vs->name }}</span>さんの欠席手続きを行います。参加を取りやめる場合は<span
                        class="uk-text-warning">欠席する</span>ボタンをタップしてください</p>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">キャンセル</button>
                    <a class="uk-button uk-button-danger"
                        href="{{ url('/') }}/self/?absent={{ $participant->vs->uuid }}">欠席する</a>
                </p>
            </div>
        </div>
    @endif
    {{-- ベンチャー欠席ウィンドウ --}}

    {{-- ボーイ欠席ウィンドウ --}}
    @if (isset($participant->bs->name))
        <div id="modal-bs-absent" uk-modal>
            <div class="uk-modal-dialog uk-modal-body">
                <h2 class="uk-modal-title uk-text-danger">欠席手続き</h2>
                <p><span class="uk-text-danger">{{ $participant->bs->name }}</span>さんの欠席手続きを行います。参加を取りやめる場合は<span
                        class="uk-text-warning">欠席する</span>ボタンをタップしてください</p>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">キャンセル</button>
                    <a class="uk-button uk-button-danger"
                        href="{{ url('/') }}/self/?absent={{ $participant->bs->uuid }}">欠席する</a>
                </p>
            </div>
        </div>
    @endif
    {{-- ボーイ欠席ウィンドウ --}}
    <script>
        const swiper = new Swiper('.swiper', {
            // Optional parameters
            direction: 'vertical',
            loop: false,

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            // And if we need scrollbar
            scrollbar: {
                el: '.swiper-scrollbar',
            },
        });
    </script>
</body>

</html>
