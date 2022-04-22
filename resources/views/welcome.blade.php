<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.13.10/dist/css/uikit.min.css" />

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.13.10/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.13.10/dist/js/uikit-icons.min.js"></script>
    <title>受付システム</title>
</head>

<body class="antialiased">
    <button class="uk-button uk-button-primary uk-button-large uk-align-center"
        onclick="location.href='{{ url('/login') }}'"><span uk-icon="sign-in"></span>LOGIN</button>

    <footer class="main-footer uk-position-bottom" style="background-color:#115740; color:#fff">
        <p class="uk-text-small uk-text-center">ボーイスカウト東京連盟<br>
            {{ config('app.name') }} &copy;</p>
    </footer>
</body>

</html>
