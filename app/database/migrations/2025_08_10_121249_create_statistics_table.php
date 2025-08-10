<?php

use App\Services\ClickHouseService;
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
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->string('method')->nullable();
            $table->string('url')->nullable();
            $table->string('ip')->nullable();
            $table->string('full_link')->nullable();
            $table->string('short_link')->nullable();
            $table->timestamps();
        });

        /** @var ClickHouseService $clickhouseService */
        $clickhouseService = app(ClickHouseService::class);

        $clickhouseService->write("
            CREATE TABLE IF NOT EXISTS statistics (
                id UInt64,
                method Nullable(String),
                url Nullable(String),
                ip Nullable(String),
                full_link Nullable(String),
                short_link Nullable(String),
                created_at DateTime
            )
            ENGINE = MergeTree()
            ORDER BY (created_at, id)
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');

        /** @var ClickHouseService $clickhouseService */
        $clickhouseService = app(ClickHouseService::class);

        $clickhouseService->write("DROP TABLE IF EXISTS statistics");
    }
};
