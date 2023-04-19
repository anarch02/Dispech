<?php

use App\Models\Application;
use App\Models\Drones;
use App\Models\Organization;
use App\Models\Pilots;
use App\Models\User;
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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Organization::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('height');
            $table->string('startDate')->nullable();
            $table->string('finishDate')->nullable();
            $table->string('file')->nullable();
            $table->string('radius');
            $table->string('place');
            $table->string('place_coordinates');
            $table->string('cause')->nullable();
            $table->boolean('status')->default(false);
            $table->boolean('isActive')->default(true);
            // $table->text('description')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });

        Schema::create('application_drones', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Application::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(Drones::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('application_pilots', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Application::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(Pilots::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
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
        Schema::dropIfExists('applications');
    }
};
