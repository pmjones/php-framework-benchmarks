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

use Aura\Dispatcher\Exception;
use ReflectionMethod;

/**
 * 
 * Invokes an object method with named parameters, honoring method scope
 * relative to `$this`.
 * 
 * @package Aura.Dispatcher
 * 
 */
trait InvokeMethodTrait
{
    /**
     * 
     * Invokes an object method with named parameters, honoring method scope
     * relative to `$this`.
     * 
     * @param object $object The object to work with.
     * 
     * @param string $method The method to invoke on the object.
     * 
     * @param array|ArrayAccess $params An array of key-value pairs to use as
     * params for the method; the array keys are matched to the method param
     * names.
     * 
     * @return mixed The return of the invoked object method.
     * 
     */
    protected function invokeMethod($object, $method, $params = [])
    {
        // is the method defined?
        if (! method_exists($object, $method)) {
            $message = get_class($object) . '::' . $method;
            throw new Exception\MethodNotDefined($message);
        }
        
        // reflect on the object method
        $reflect = new ReflectionMethod($object, $method);
        
        // check accessibility from $this to honor protected/private methods
        $accessible = true;
        if ($reflect->isProtected()) {
            $access = 'protected';
            $accessible = ($object instanceof $this);
        } elseif ($reflect->isPrivate()) {
            $access = 'private';
            $declaring_class = $reflect->getDeclaringClass()->getName();
            $accessible = ($declaring_class == get_class($this));
        }
        
        // is the method accessible by $this?
        if (! $accessible) {
            $message = get_class($object) . "::$method is $access";
            throw new Exception\MethodNotAccessible($message);
        }
        
        // the method is accessible by $this
        $reflect->setAccessible(true);
        
        // sequential arguments when invoking
        $args = [];
        
        // match params with arguments
        foreach ($reflect->getParameters() as $i => $param) {
            if (isset($params[$param->name])) {
                // a named param value is available
                $args[] = $params[$param->name];
            } elseif (isset($params[$i])) {
                // a positional param value is available
                $args[] = $params[$i];
            } elseif ($param->isDefaultValueAvailable()) {
                // use the default value
                $args[] = $param->getDefaultValue();
            } else {
                // no default value and no matching param
                $message = get_class($object) . '::' . $method
                         . "($i : \${$param->name})";
                throw new Exception\ParamNotSpecified($message);
            }
        }
        
        // invoke with the args, and done
        return $reflect->invokeArgs($object, $args);
    }
}
