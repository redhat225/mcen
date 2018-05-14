<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RolePrivilegesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RolePrivilegesTable Test Case
 */
class RolePrivilegesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RolePrivilegesTable
     */
    public $RolePrivileges;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.role_privileges',
        'app.roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RolePrivileges') ? [] : ['className' => RolePrivilegesTable::class];
        $this->RolePrivileges = TableRegistry::get('RolePrivileges', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RolePrivileges);

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
