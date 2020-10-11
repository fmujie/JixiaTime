<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateStarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('star', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('star');
            $table->float('money');
            // $table->timestamps();
        });
        DB::insert("INSERT INTO `star` (`star`, `money`) VALUES
        ('2.5', '8'),
        ('3', '9.6'),
        ('3.5', '11.2'),
        ('4', '12.8'),
        ('4.5', '14.4'),
        ('5', '16')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('star');
    }
}
