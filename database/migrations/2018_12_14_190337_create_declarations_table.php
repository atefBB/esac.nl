<?php

use App\Model\Declaration\Declaration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeclarationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('declarations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('type');
            $table->string('state')->default(Declaration::STATE_PENDING);
            $table->string('activtiy');
            $table->date('date'); //the date for the declartion. Depending on the type this contains the payment or creation date
            $table->double('price');
            $table->text('description')->nullable();
            $table->text('decline_reason')->nullable();
            $table->integer('follow_number')->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->softDeletes();
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
        Schema::dropIfExists('declarations');
    }
}
