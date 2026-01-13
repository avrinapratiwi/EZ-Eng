<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJenisAndKeteranganToMentorsTable extends Migration
{
    public function up()
    {
        Schema::table('mentors', function (Blueprint $table) {
            $table->enum('jenis', ['ekonomi', 'bisnis'])->after('gender');
            $table->text('keterangan')->after('address');
        });
    }

    public function down()
    {
        Schema::table('mentors', function (Blueprint $table) {
            $table->dropColumn(['jenis', 'keterangan']);
        });
    }
}
