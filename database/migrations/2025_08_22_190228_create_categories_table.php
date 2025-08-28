<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            NestedSet::columns($table);
            $table->text('name')->nullable();
            $table->string('slug',150)->nullable()->index();
            $table->text('description')->nullable();
            $table->tinyInteger('hide_description')->default(0)->comment('0: No, 1: Yes');
            $table->string('image_path',255)->nullable();
            $table->string('icon_class',100)->nullable();
            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('seo_keywords')->nullable();
            $table->tinyInteger('is_for_permanent')->default(0)->comment('0: No, 1: Yes');
            $table->tinyInteger('active')->default(1)->comment('0: Inactive, 1: Active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
