<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', '氏名:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Furigana Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'ふりがな:') !!}
    {!! Form::text('furigana', null, ['class' => 'form-control']) !!}
</div>
<div class="clearfix"></div>
<!-- Pref Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pref', '県連盟:') !!}
    {!! Form::select('pref', ['' => '', '北海道' => '北海道', '青森' => '青森', '岩手' => '岩手', '宮城' => '宮城', '秋田' => '秋田', '山形' => '山形', '福島' => '福島', '茨城' => '茨城', '栃木' => '栃木', '群馬' => '群馬', '埼玉' => '埼玉', '千葉' => '千葉', '東京' => '東京', '神奈川' => '神奈川', '新潟' => '新潟', '富山' => '富山', '石川' => '石川', '福井' => '福井', '山梨' => '山梨', '長野' => '長野', '岐阜' => '岐阜', '静岡' => '静岡', '愛知' => '愛知', '三重' => '三重', '滋賀' => '滋賀', '京都' => '京都', '大阪' => '大阪', '兵庫' => '兵庫', '奈良' => '奈良', '和歌山' => '和歌山', '鳥取' => '鳥取', '島根' => '島根', '岡山' => '岡山', '広島' => '広島', '山口' => '山口', '徳島' => '徳島', '香川' => '香川', '愛媛' => '愛媛', '高知' => '高知', '福岡' => '福岡', '佐賀' => '佐賀', '長崎' => '長崎', '熊本' => '熊本', '大分' => '大分', '宮崎' => '宮崎', '鹿児島' => '鹿児島', '沖縄' => '沖縄'], null, ['class' => 'form-control custom-select']) !!}


</div>

<!-- District Field -->
<div class="form-group col-sm-6">
    {!! Form::label('district', '地区:') !!}
    {!! Form::text('district', null, ['class' => 'form-control']) !!}
</div>

<!-- Dan Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dan_name', '団名:') !!}
    {!! Form::text('dan_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Dan Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dan_number', '団番号:') !!}
    {!! Form::text('dan_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Role Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role', '役務:') !!}
    {!! Form::text('role', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', '電話:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Seat Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('seat_number', '座席番号:') !!}
    {!! Form::text('seat_number', null, ['class' => 'form-control']) !!}
</div>
