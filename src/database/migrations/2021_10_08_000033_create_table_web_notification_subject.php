<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableWebNotificationSubject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_notification_subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->smallInteger('type')->default(0);
            $table->smallInteger('status')->default(0);
            $table->integer('total')->default(0);
            $table->integer('total_success')->default(0);
            $table->integer('total_fail')->default(0);
            $table->integer('total_processing')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('web_notifications', function (Blueprint $table) {
            $table->bigInteger('notification_subject_id')->default(0)->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('web_notification_subjects');
    }
}
