<?php
namespace Magenest\Movie\Setup;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
class UpgradeSchema implements UpgradeSchemaInterface {
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '2.0.4') < 0) {
            $installer = $setup;
            $installer->startSetup();
            $connection = $installer->getConnection();
            //Install new database table
            if ($connection->isTableExists($installer->getTable('magenest_director')) != true){
                $this->createTableDirector($installer);
            } if($connection->isTableExists($installer->getTable('magenest_actor')) != true){
                $this->createTableActor($installer);
            } if($connection->isTableExists($installer->getTable('magenest_movie')) != true){
                $this->createTableMovie($installer);
            } if($connection->isTableExists($installer->getTable('magenest_movie_actor')) != true){
                $this->createTableMovieActor($installer);
            }

            $installer->endSetup();
        }
    }

    protected function createTableDirector(SchemaSetupInterface $installer){
        $table = $installer->getConnection()->newTable(
            $installer->getTable('magenest_director')
        )->addColumn(
            'director_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null, [
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary' => true,
            'auto_increment' => true
        ],
            'Director Id'
        )->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            64,
            ['nullable' => false],
            'Name'
        );
        $installer->getConnection()->createTable($table);
    }
    protected function createTableActor(SchemaSetupInterface $installer){
        $table = $installer->getConnection()->newTable(
            $installer->getTable('magenest_actor')
        )->addColumn(
            'actor_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null, [
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary' => true,
            'auto_increment' => true
        ],
            'Actor Id'
        )->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            64,
            ['nullable' => false],
            'Name'
        );
        $installer->getConnection()->createTable($table);
    }
    protected function createTableMovie(SchemaSetupInterface $installer){
        $table = $installer->getConnection()->newTable(
            $installer->getTable('magenest_movie')
        )->addColumn(
            'movie_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null, [
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary' => true,
            'auto_increment' => true
        ],
            'Movie Id'
        )->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            64,
            ['nullable' => false],
            'Name'
        )->addColumn(
            'description',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            64,
            ['nullable' => false],
            'Description'
        )->addColumn(
            'rating',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            255,
            ['nullable' => false],
            'Rating'
        )->addColumn(
            'director_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null, ['unsigned'=>true, 'nullable'=>false, 'default' => '0'],
            'Director Idf'
        )->addIndex(
            $installer->getIdxName('magenest_movie', ['director_id']),
            ['director_id']
        )->addForeignKey( // Add foreign key for table entity
            $installer->getFkName(
                'magenest_movie', // New table
                'director_id', // Column in New Table
                'magenest_director', // Reference Table
                'director_id' // Column in Reference table
            ),
            'director_id', // New table column
            $installer->getTable('magenest_director'), // Reference Table
            'director_id', // Reference Table Column
            // When the parent is deleted, delete the row with foreign key
            \Magento\Framework\Db\Ddl\Table::ACTION_CASCADE
        );
        $installer->getConnection()->createTable($table);
    }
    protected function createTableMovieActor(SchemaSetupInterface $installer){
        $table = $installer->getConnection()->newTable(
            $installer->getTable('magenest_movie_actor')
        )->addColumn(
            'movie_actor_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null, [
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary' => true,
            'auto_increment' => true
        ],
            'Movie Actor Id'
        )->addColumn(
            'movie_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null, [
            'unsigned'=>true, 'nullable'=>false, 'default' => '0'],
            'Movie Idf'
        )->addColumn(
            'actor_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null, ['unsigned'=>true, 'nullable'=>false, 'default' => '0'],
            'Actor Idf'
        )->addIndex(
            $installer->getIdxName('magenest_movie_actor', ['movie_id']),
            ['movie_id']
        )->addIndex(
            $installer->getIdxName('magenest_movie_actor', ['actor_id']),
            ['actor_id']
        )->addForeignKey( // Add foreign key for table magenest_movie_actor
            $installer->getFkName(
                'magenest_movie_actor', // New table
                'movie_id', // Column in New Table
                'magenest_movie', // Reference Table
                'movie_id' // Column in Reference table
            ),
            'movie_id', // New table column
            $installer->getTable('magenest_movie'), // Reference Table
            'movie_id', // Reference Table Column
            // When the parent is deleted, delete the row with foreign key
            \Magento\Framework\Db\Ddl\Table::ACTION_CASCADE
        )->addForeignKey( // Add foreign key for table magenest_movie_actor
            $installer->getFkName(
                'magenest_movie_actor', // New table
                'actor_id', // Column in New Table
                'magenest_actor', // Reference Table
                'actor_id' // Column in Reference table
            ),
            'actor_id', // New table column
            $installer->getTable('magenest_actor'), // Reference Table
            'actor_id', // Reference Table Column
            // When the parent is deleted, delete the row with foreign key
            \Magento\Framework\Db\Ddl\Table::ACTION_CASCADE
        );
        $installer->getConnection()->createTable($table);
    }
    protected function addStatus(SchemaSetupInterface $installer){
        $installer->getConnection()->addColumn(
            $installer->getTable('magenest_movie'),
            'director_id',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                'size' => null, ['unsigned'=>true, 'nullable'=>false, 'default' => '0'],
                'comment' => 'Director Idf'
            ]
        )->addForeignKey( // Add foreign key for table entity
            $installer->getFkName(
                'magenest_movie', // New table
                'movie_id', // Column in New Table
                'magenest_director', // Reference Table
                'director_id' // Column in Reference table
            ),
            'movie_id', // New table column
            $installer->getTable('magenest_director'), // Reference Table
            'director_id', // Reference Table Column
            // When the parent is deleted, delete the row with foreign key
            \Magento\Framework\Db\Ddl\Table::ACTION_CASCADE
        );
    }

}