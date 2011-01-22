<?php
/**
 * 
 * Example class to support unit tests.
 * 
 * @category Solar
 * 
 * @package Mock_Solar
 * 
 * @author Paul M. Jones <pmjones@solarphp.com>
 * 
 * @license http://opensource.org/licenses/bsd-license.php BSD
 * 
 * @version $Id: Example.php 4557 2010-05-05 21:56:28Z pmjones $
 * 
 */
class Mock_Solar_Example extends Solar_Base
{
    /**
     * 
     * Default configuration values.
     * 
     * @config string foo Example config key and value.
     * 
     * @config string baz Example config key and value.
     * 
     * @config string zim Example config key and value.
     * 
     * @var array
     * 
     */
    protected $_Solar_Example = array(
        'foo' => 'bar',
        'baz' => 'dib',
        'zim' => 'gir',
    );
    
    /**
     * 
     * Protected variable for testing.
     * 
     * @var string
     * 
     */
    protected $_protected_var = 'semi-visible';
    
    /**
     * 
     * Private variable for testing.
     * 
     * @var string
     * 
     */
    private $_private_var = 'invisible';
    
    /**
     * 
     * Gets a config value.
     * 
     * @param string $key The config key.
     * 
     * @return mixed
     * 
     */
    public function getConfig($key = null)
    {
        if (! $key) {
            return $this->_config;
        } elseif (! empty($this->_config[$key])) {
            return $this->_config[$key];
        }
    }
    
    /**
     * 
     * Throws ERR_CUSTOM_CONDITION for this class.
     * 
     * @return void
     * 
     */
    public function classSpecificException()
    {
        throw $this->_exception('ERR_CUSTOM_CONDITION');
    }
    
    /**
     * 
     * Throws ERR_FILE_NOT_FOUND for this class.
     * 
     * @return void
     * 
     */
    public function solarSpecificException()
    {
        throw $this->_exception('ERR_FILE_NOT_FOUND');
    }
    
    /**
     * 
     * Throws ERR_GENERIC_CONDITION for this class.
     * 
     * @return void
     * 
     */
    public function classGenericException()
    {
        throw $this->_exception('ERR_GENERIC_CONDITION');
    }
    
    /**
     * 
     * Throws ERR_NO_SUCH_CONDITION for this class.
     * 
     * @return void
     * 
     */
    public function solarGenericException()
    {
        throw $this->_exception('ERR_NO_SUCH_CONDITION');
    }
    
    /**
     * 
     * Throws a user-specified error code for this class.
     * 
     * @param string $code The error code to throw.
     * 
     * @return void
     * 
     */
    public function exceptionFromCode($code) {
        throw $this->_exception($code);
    }
    
    /**
     * 
     * Used for testing Solar_Filter::callback() as an instance method.
     * 
     * @param string $value The value to filter.
     * 
     * @param mixed $find Find this string in the value.
     * 
     * @param mixed $with Replace with this string.
     * 
     * @return string The filtered value.
     * 
     */
    public function filterCallback($value, $find, $with)
    {
        return str_replace($find, $with, $value);
    }
    
    /**
     * 
     * Used for testing Solar_Filter::callback() as a static method.
     * 
     * @param string $value The value to filter.
     * 
     * @param mixed $find Find this string in the value.
     * 
     * @param mixed $with Replace with this string.
     * 
     * @return string The filtered value.
     * 
     */
    public static function staticFilterCallback($value, $find, $with)
    {
        return str_replace($find, $with, $value);
    }
    
    /**
     * 
     * Used for testing Solar_Valid::callback() as an instance method.
     * 
     * @param mixed $value The value to validate with is_int().
     * 
     * @return bool True if $value is_int(), false if not.
     * 
     */
    public function validIsInt($value)
    {
        return is_int($value);
    }
    
    /**
     * 
     * Used for testing Solar_Valid::callback() as a static method.
     * 
     * @param mixed $value The value to validate with is_int().
     * 
     * @return bool True if $value is_int(), false if not.
     * 
     */
    static public function staticValidIsInt($value)
    {
        return is_int($value);
    }
}
