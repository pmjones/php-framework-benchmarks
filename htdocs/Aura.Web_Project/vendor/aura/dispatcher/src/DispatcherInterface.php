<?php
/**
 * 
 * This file is part of Aura for PHP.
 * 
 * @package Aura.Dispatcher
 * 
 * @license http://opensource.org/licenses/bsd-license.php BSD
 * 
 */
namespace Aura\Dispatcher;

/**
 * 
 * Interface for dispatchers.
 * 
 * @package Aura.Dispatcher
 * 
 */
interface DispatcherInterface
{
    /**
     * 
     * Uses the params to get an dispatchable object, then invokes it with the
     * same params.
     * 
     * @param array|ArrayAccess $params Named params for the invocation.
     * 
     * @return mixed The return from the invoked object.
     * 
     */
    public function __invoke($params = []);
    
    /**
     * 
     * Sets the parameter indicating the dispatchable object name.
     * 
     * @param string $object_param The parameter name to use.
     * 
     * @return null
     * 
     */
    public function setObjectParam($object_param);
    
    /**
     * 
     * Gets the parameter indicating the dispatchable object name.
     * 
     * @return string
     * 
     */
    public function getObjectParam();
    
    /**
     * 
     * Sets the parameter indicating the dispatchable object name.
     * 
     * @param string $object_param The parameter name to use.
     * 
     * @return null
     * 
     */
     
    /**
     * 
     * Sets the parameter indicating the method to call on the created object.
     * 
     * @param string $method_param The parameter name to use.
     * 
     * @return null
     * 
     */
    public function setMethodParam($method_param);
    
    /**
     * 
     * Gets the parameter indicating the method to call on the created object.
     * 
     * @return string
     * 
     */
    public function getMethodParam();
    
    
    /**
     * 
     * Set the array of dispatchable objects; this clears all existing objects.
     * 
     * @param array $objects An array where the key is a name and the value
     * is an dispatchable object.
     * 
     * @return null
     * 
     */
    public function setObjects(array $objects);

    /**
     * 
     * Adds to the array of dispatchable objects; this merges with existing
     * objects.
     * 
     * @param array $objects An array where the key is a name and the value
     * is an dispatchable object.
     * 
     * @return null
     * 
     */
    public function addObjects(array $objects);
    
    /**
     * 
     * Returns the array of dispatchable objects.
     * 
     * @return array
     * 
     */
    public function getObjects();
    
    /**
     * 
     * Sets an dispatchable object by name.
     * 
     * @param string $name The name.
     * 
     * @param object $object The dispatchable object.
     * 
     */
    public function setObject($name, $object);
    
    /**
     * 
     * Does an dispatchable object exist?
     * 
     * @param string $name The name of the dispatchable object.
     * 
     * @return bool
     * 
     */
    public function hasObject($name);
    
    /**
     * 
     * Returns an dispatchable object using its name.
     * 
     * @param string $name The name of the dispatchable object.
     * 
     * @return object
     * 
     */
    public function getObject($name);
    
    /**
     * 
     * Returns an dispatchable object using an array of params; if the
     * `$object_param` is an object, it is returned directly, otherwise it is
     * treated as an dispatchable object name.
     * 
     * @param array|ArrayAccess $params Params to look up the dispatchable
     * object.
     * 
     * @return object The dispatchable object.
     * 
     */
    public function getObjectByParams($params);
}
