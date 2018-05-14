<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TrainingAssetsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TrainingAssetsTable Test Case
 */
class TrainingAssetsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TrainingAssetsTable
     */
    public $TrainingAssets;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.training_assets',
        'app.trainings',
        'app.training_asset_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TrainingAssets') ? [] : ['className' => TrainingAssetsTable::class];
        $this->TrainingAssets = TableRegistry::get('TrainingAssets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TrainingAssets);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
