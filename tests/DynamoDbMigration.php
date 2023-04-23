<?php

namespace BaoPham\DynamoDb\Tests;

use Aws\DynamoDb\DynamoDbClient;
use BaoPham\DynamoDb\DynamoDbClientInterface;
use Illuminate\Database\Migrations\Migration;

class DynamoDbMigration extends Migration
{
    protected function getClient(): DynamoDbClient
    {
        return app()->make(DynamoDbClientInterface::class)->getClient();
    }
}
