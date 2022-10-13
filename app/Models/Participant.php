<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Participant
 * @package App\Models
 * @version February 6, 2022, 2:50 am UTC
 *
 * @property string $name
 * @property string $uuid
 * @property string $pref
 * @property string $district
 * @property string $dan_name
 * @property string $dan_number
 * @property string $role
 * @property string $email
 * @property string $phone
 * @property string $seat_number
 */
class Participant extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'participants';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'furigana',
        'uuid',
        'pref',
        'district',
        'dan_name',
        // 'dan_number',
        'is_proxy',
        'role',
        'email',
        'phone',
        'seat_number'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'furigana' => 'string',
        'uuid' => 'string',
        'pref' => 'string',
        'district' => 'string',
        'dan_name' => 'string',
        // 'dan_number' => 'string',
        'role' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'seat_number' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'furigana' => 'required',
        'pref' => 'required',
        'email' => 'required'
    ];

    public static $messages = [
        'name.required' => '氏名を入力して下さい',
        'furigana.required' => 'ふりがなを入力して下さい',
        'pref.required' => '県連盟を入力して下さい',
        'email.required' => 'emailを入力して下さい',
    ];
}
