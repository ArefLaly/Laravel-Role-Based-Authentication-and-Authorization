<?php

use App\Common\AuditableEntity;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("fullname");
            $table->string("email");
            $table->timestamp('email_verified_at')->nullable();
            $table->string("password");
            $table->string("job_title");
            $table->integer("count")->default(0);
            $table->string("photo");
            $table->boolean("islock")->default(false);
            $table->dateTime("lock_until")->nullable();
            AuditableEntity::commonColumn($table);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
