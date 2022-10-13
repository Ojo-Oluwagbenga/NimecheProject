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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default();
            $table->string('location')->default();
            $table->text('description');
            $table->mediumText('resources');//url list

            //Bio
            $table->string('date')->default();
            $table->string('time')->default();
            $table->string('duration')->default();
            $table->string('anchor')->default();
            
            $table->string('state')->default(); //0-queing, 1-active, 2-completed


            $table->json('thoughts');
            
            // in form
                // {
                //     0:{
                //         poster:Ns/3/32f,
                //         cid:0, //Where the parid pack is in this form too
                //         created: Tues, 12pm,
                //         text:thetext,
                //         replies:{
                //             0:{
                //                 poster:Ns/3/32f,
                //                 cid:0||0, //Where the parid pack is in this form too
                //                 created: Tues, 12pm,
                //                 text:thetext,
                //                 replies:{
            
                //                 }
                //             }, 

                //         }
                //     },    
            // }

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
        Schema::dropIfExists('events');
    }
};
