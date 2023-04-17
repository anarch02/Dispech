<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Region;
use App\Models\Organization;


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name');
            $table->foreignIdFor(Region::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('address');
            $table->timestamps();
            
        });

        // Schema::create('organizations_users_regions', function (Blueprint $table) {
        //     $table->id();

        //     $table->foreignIdFor(Organization::class)
        //         ->constrained()
        //         ->cascadeOnUpdate()
        //         ->cascadeOnDelete();

        //     $table->foreignIdFor(User::class)
        //         ->constrained()
        //         ->cascadeOnUpdate()
        //         ->cascadeOnDelete();

        //     $table->foreignIdFor(Region::class)
        //         ->constrained()
        //         ->cascadeOnUpdate()
        //         ->cascadeOnDelete();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations_users_regions');
        Schema::dropIfExists('organizations');
    }
};
