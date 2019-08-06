<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class ClientsMigration_100
 */
class ClientsMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('clients', [
                'columns' => [
                    new Column(
                        'id',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'autoIncrement' => true,
                            'size' => 11,
                            'first' => true
                        ]
                    ),
                    new Column(
                        'nom',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 45,
                            'after' => 'id'
                        ]
                    ),
                    new Column(
                        'prenom',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 45,
                            'after' => 'nom'
                        ]
                    ),
                    new Column(
                        'telephone',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 45,
                            'after' => 'prenom'
                        ]
                    ),
                    new Column(
                        'mail',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 45,
                            'after' => 'telephone'
                        ]
                    ),
                    new Column(
                        'adresse',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 45,
                            'after' => 'mail'
                        ]
                    ),
                    new Column(
                        'codepostal',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'size' => 11,
                            'after' => 'adresse'
                        ]
                    ),
                    new Column(
                        'ville',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 45,
                            'after' => 'codepostal'
                        ]
                    ),
                    new Column(
                        'emplacements_id',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'size' => 11,
                            'after' => 'ville'
                        ]
                    ),
                    new Column(
                        'administrateurs_id',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'size' => 11,
                            'after' => 'emplacements_id'
                        ]
                    )
                ],
                'indexes' => [
                    new Index('PRIMARY', ['id', 'emplacements_id', 'administrateurs_id'], 'PRIMARY'),
                    new Index('fk_clients_emplacements1_idx', ['emplacements_id'], null),
                    new Index('fk_clients_administrateurs1_idx', ['administrateurs_id'], null)
                ],
                'references' => [
                    new Reference(
                        'fk_clients_administrateurs1',
                        [
                            'referencedTable' => 'administrateurs',
                            'referencedSchema' => 'brocante',
                            'columns' => ['administrateurs_id'],
                            'referencedColumns' => ['id'],
                            'onUpdate' => 'NO ACTION',
                            'onDelete' => 'NO ACTION'
                        ]
                    ),
                    new Reference(
                        'fk_clients_emplacements1',
                        [
                            'referencedTable' => 'emplacements',
                            'referencedSchema' => 'brocante',
                            'columns' => ['emplacements_id'],
                            'referencedColumns' => ['id'],
                            'onUpdate' => 'NO ACTION',
                            'onDelete' => 'NO ACTION'
                        ]
                    )
                ],
                'options' => [
                    'TABLE_TYPE' => 'BASE TABLE',
                    'AUTO_INCREMENT' => '1',
                    'ENGINE' => 'InnoDB',
                    'TABLE_COLLATION' => 'utf8_general_ci'
                ],
            ]
        );
    }

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {

    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {

    }

}
