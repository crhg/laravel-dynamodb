<?php

use BaoPham\DynamoDb\Tests\DynamoDbMigration;

return new class extends DynamoDbMigration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            $this->getClient()->deleteTable(['TableName' => 'test_model']);
        } catch (Exception $e) {
            // ignore
        }

        $this->getClient()->createTable(
            [
                'TableName'              => 'test_model',
                'KeySchema'              => [ // The type of of schema.  Must start with a HASH type, with an optional second RANGE.
                    [
                        'AttributeName' => 'id',
                        'KeyType'       => 'HASH',
                    ], // Required HASH type attribute
                ],
                'AttributeDefinitions'   => [ // The names and types of all primary and index key attributes only
                    [
                        'AttributeName' => 'id',
                        'AttributeType' => 'S', // (S | N | B) for string, number, binary
                    ],
                    [
                        'AttributeName' => 'count',
                        'AttributeType' => 'N', // (S | N | B) for string, number, binary
                    ],
                ],
                'ProvisionedThroughput'  => [ // required provisioned throughput for the table
                    'ReadCapacityUnits'  => 1,
                    'WriteCapacityUnits' => 1,
                ],
                'GlobalSecondaryIndexes' => [ // optional (list of GlobalSecondaryIndex)
                    [
                        'IndexName'             => 'count_index',
                        'KeySchema'             => [
                            [ // Required HASH type attribute
                                'AttributeName' => 'count',
                                'KeyType'       => 'HASH',
                            ],
                        ],
                        'Projection'            => [ // attributes to project into the index
                            'ProjectionType' => 'ALL', // (ALL | KEYS_ONLY | INCLUDE)
                        ],
                        'ProvisionedThroughput' => [ // throughput to provision to the index
                            'ReadCapacityUnits'  => 1,
                            'WriteCapacityUnits' => 1,
                        ],
                        // ... more global secondary indexes ...
                    ],
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->getClient()->deleteTable(['TableName' => 'test_model']);
    }
};
