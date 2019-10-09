<?php
/**
 * Class UtilsTest
 *
 * @package PCCFramework
 */

use function PCCFramework\Utils\get_config_option;

/**
 * Utils tests.
 */
class UtilsTest extends WP_UnitTestCase
{

    /**
     * A single example test.
     */
    public function test_get_config_option()
    {
        $result = get_config_option('my_key', 'my_default_value');
        $this->assertEquals('my_default_value', $result);
        update_option('platformcoop_configuration', ['my_key' => 'my_value']);
        $result = get_config_option('my_key', 'my_default_value');
        $this->assertEquals('my_value', $result);
        delete_option('platformcoop_configuration');
        $result = get_config_option('my_other_key', 'my_other_default_value');
        $this->assertEquals('my_other_default_value', $result);
    }
}
