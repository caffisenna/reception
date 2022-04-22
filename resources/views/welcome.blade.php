<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="{{ url('/uikit/uikit.min.css') }}" />

    <!-- UIkit JS -->
    <script src="{{ url('/uikit/uikit.min.js') }}"></script>
    <script src="{{ url('/uikit/uikit-icons.min.js') }}"></script>
    <title>受付システム</title>
</head>

<body class="antialiased">
    <div class="uk-container uk-container-large">
        <button class="uk-button uk-button-primary uk-button-large uk-align-center uk-margin-large-top"
            onclick="location.href='{{ url('/login') }}'"><span uk-icon="sign-in"></span>LOGIN</button>
    </div>
    <footer class="main-footer uk-position-bottom" style="background-color:#115740; color:#fff">
        <p class="uk-text-small uk-text-center">ボーイスカウト東京連盟<br>
            {{ config('app.name') }} &copy;</p>
    </footer>
</body>

</html>
