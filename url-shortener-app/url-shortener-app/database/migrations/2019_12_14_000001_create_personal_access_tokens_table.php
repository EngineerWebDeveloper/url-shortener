<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalAccessTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_access_tokens');
    }

//define('MYSQL_HOST', getenv('DB_HOST') ?: 'host.docker.internal');//367 - 442
//define('MYSQL_USER', getenv('DB_USERNAME') ?: 'root');
//define('MYSQL_PASS', getenv('DB_PASSWORD') ?: 'myrootpassword');
//define('MYSQL_DATABASE', getenv('DB_DATABASE') ?: 'flatworld');
}
