<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('furigana')->nullable();
            $table->string('pref');
            $table->string('district')->nullable();
            $table->string('dan_name')->nullable();
            $table->string('dan_number')->nullable();
            $table->string('role')->nullable();
            $table->integer('pref_priority')->nullable();       // 県連優先順位
            $table->string('is_represent')->nullable();         // 県連代表
            $table->string('is_proxy')->nullable();             // 代理 役職が入れば代理判定
            $table->boolean('wheel_chair')->default(false);     // 車椅子 0 1
            $table->string('with_helper')->nullable();          // 介助者同行 ID
            $table->string('go_with_leader')->nullable();       // 同行親リーダー メアド or uuid
            $table->string('go_with_scouts')->nullable();       // 引率されるスカウト uuid
            $table->string('self_absent')->nullable();          // 欠席理由 自己入力, 指導者入力, 発熱NG
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('seat_number')->nullable();
            $table->string('uuid')->unique();
            $table->dateTime('checkedin_at')->nullable();           // 式典チェックイン
            $table->dateTime('reception_checkedin_at')->nullable(); // レセプションチェックイン
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('participants');
    }
}
