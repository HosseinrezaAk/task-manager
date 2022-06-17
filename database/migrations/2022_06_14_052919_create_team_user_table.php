<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    protected $collection = "tm_team_user_pivot";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            $this->collection,
            function (Blueprint $table) {
//                $table->id();
                $table->string("_id");
                $table->string("team_id")->references("_id")->on("tm_teams");
                $table->string("user_id")->refrences("_id")->on("tm_users");
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
        Schema::dropIfExists('team_user');
    }
};
