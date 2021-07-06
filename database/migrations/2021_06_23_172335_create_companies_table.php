<?php

use App\Models\Contact;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->default('none');
            $table->string('sector', 50)->default('none');
            $table->string('city', 60)->default('none');
            $table->string('country', 60)->default('none');
            $table->string('phone', 50)->default('none');
            $table->unsignedInteger('employers')->default(0);
            $table->integer('turnover')->default(0);
            $table->string('website', 100)->default('none');
            $table->string('description', 1000)->default('none');
            $table->string('zip', 30)->default('none');
            $table->timestamps();

            $table->foreignId('contact_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
