@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>招待メール送信(県連単位)</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="uk-table uk-table-divider" id="participants-table">
                        <thead>
                            <tr>
                                <th>県連</th>
                                <th>送信</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prefs as $pref)
                                <tr>
                                    <td>{{ $pref }}</td>
                                    <td>
                                        <a href="{{ url('/admin/sendmail_pref') . '/?pref=' }}{{ $pref }}"
                                            onclick="return confirm('{{ $pref }}連盟へデジタルパスを送信します。よろしいですか？')"
                                            class="uk-button uk-button-primary"><span uk-icon="mail"></span></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
