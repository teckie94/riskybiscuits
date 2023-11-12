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
        Schema::create('staff_role_bids', function (Blueprint $table) {
            $table->id();
            $table->integer('cafe_id')->default(1)->nullable();
            $table->unsignedBigInteger('staff_role_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('status')->default(0)->comment('Status:-1=Rejected; 0=Pending Approval; 1=Approved;');
            $table->text('remarks')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('staff_role_id')->references('id')->on('staff_roles')->cascadeOnDelete()->cascadeOnUpdate();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
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
        Schema::dropIfExists('staff_role_bids');
    }
};
