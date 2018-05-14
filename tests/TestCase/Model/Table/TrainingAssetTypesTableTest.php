<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TrainingAssetTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TrainingAssetTypesTable Test Case
 */
class TrainingAssetTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TrainingAssetTypesTable
     */
    public $TrainingAssetTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.training_asset_types',
        'app.training_assets'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TrainingAssetTypes') ? [] : ['className' => TrainingAssetTypesTable::class];
        $this->TrainingAssetTypes = TableRegistry::get('TrainingAssetTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TrainingAssetTypes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
