<?php

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
            $table->string('code')->default('NC/2022/013');
            $table->string('email')->unique();
            $table->string('name')->default();
            $table->string('gender')->default();
            $table->string('institution')->default('');
            $table->string('password')->default('');
            $table->text('description');

            $table->string('roomid')->default(''); //in cat of block and room num as in hostelname:block:room:posibentry
            $table->string('bunknumber')->default('');
            $table->integer('roomcount')->default(0); //The number of people currently assigned;

            
            $table->string('ticket')->default(''); //This is an array of json of [{ticket_id:, collect_state:, status:}] 

            $table->string('role')->default(''); //Member or exco
            $table->string('title')->default(''); 

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
        Schema::dropIfExists('users');
    }
};
