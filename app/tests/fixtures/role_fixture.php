<?php
/**
 * RoleFixture
 *
 * @uses CakeTestFixture
 * @package   CTLT.iPeer
 * @author    Pan Luo <pan.luo@ubc.ca>
 * @copyright 2012 All rights reserved.
 * @license   MIT {@link http://www.opensource.org/licenses/MIT}
 */
class RoleFixture extends CakeTestFixture
{
    public $name = 'Role';

    public $fields = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
        'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
    );

    public $records = array(
        array('id' => 1, 'name' => 'superadmin'),
        array('id' => 2, 'name' => 'admin'),
        array('id' => 3, 'name' => 'instructor'),
        array('id' => 4, 'name' => 'student'),

    );

}

