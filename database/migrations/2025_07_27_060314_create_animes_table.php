<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('animes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->json('main_picture')->nullable();
            $table->json('alternative_titles')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('synopsis')->nullable();

            $table->float('mean', 4, 2)->nullable();
            $table->integer('rank')->nullable();
            $table->integer('popularity')->nullable();
            $table->integer('num_list_users');
            $table->integer('num_scoring_users');

            $table->enum('nsfw', ['white', 'gray', 'black'])->nullable();

            $table->json('genres')->nullable();

            $table->enum('media_type', ['unknown', 'tv', 'ova', 'movie', 'special', 'ona', 'music']);
            $table->enum('status', ['finished_airing', 'currently_airing', 'not_yet_aired']);
            $table->json('my_list_status')->nullable();
            $table->integer('num_episodes');

            $table->json('start_season')->nullable();
            $table->json('broadcast')->nullable();

            $table->enum('source', [
                'other', 'original', 'manga', '4_koma_manga', 'web_manga', 'digital_manga',
                'novel', 'light_novel', 'visual_novel', 'game', 'card_game',
                'book', 'picture_book', 'radio', 'music'
            ])->nullable();

            $table->integer('average_episode_duration')->nullable(); // in seconds

            $table->enum('rating', ['g', 'pg', 'pg_13', 'r', 'r+', 'rx'])->nullable();

            $table->json('studios')->nullable();
            $table->json('pictures')->nullable();

            $table->text('background')->nullable();
            $table->json('related_anime')->nullable();
            $table->json('related_manga')->nullable();
            $table->json('recommendations')->nullable();
            $table->json('statistics')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animes');
    }
};
