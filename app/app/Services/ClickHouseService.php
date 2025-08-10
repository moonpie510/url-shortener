<?php

namespace App\Services;

use ClickHouseDB\Client;
use ClickHouseDB\Statement;

class ClickHouseService
{
    public Client $client;

    public function __construct()
    {
        $this->client = new Client(config('clickhouse'));
    }

    public function write(string $statement): void
    {
        $this->client->write($statement);
    }

    public function insert(string $table, array $values, array $columns): void
    {
        $this->client->insert(table: $table, values: $values, columns: $columns);
    }

    public function select(string $statement): Statement
    {
        return $this->client->select($statement);
    }
}
