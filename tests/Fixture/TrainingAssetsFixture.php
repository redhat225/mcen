<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TrainingAssetsFixture
 *
 */
class TrainingAssetsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'asset_details' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'training_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'training_asset_type_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'deleted' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'training_id' => ['type' => 'index', 'columns' => ['training_id'], 'length' => []],
            'training_asset_type_id' => ['type' => 'index', 'columns' => ['training_asset_type_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'training_assets_ibfk_1' => ['type' => 'foreign', 'columns' => ['training_id'], 'references' => ['trainings', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'training_assets_ibfk_2' => ['type' => 'foreign', 'columns' => ['training_asset_type_id'], 'references' => ['training_asset_types', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => '20892e3e-26ed-4f14-92f6-eb803b685023',
                'asset_details' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'training_id' => 'f73edecf-eb26-430d-98cc-904d82405702',
                'training_asset_type_id' => '493ea51e-1ef3-43fe-9980-b1d4f5315cbf',
                'created' => '2018-05-13 14:42:07',
                'modified' => '2018-05-13 14:42:07',
                'deleted' => '2018-05-13 14:42:07'
            ],
        ];
        parent::init();
    }
}
