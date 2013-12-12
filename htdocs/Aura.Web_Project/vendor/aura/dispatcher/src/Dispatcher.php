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

use Closure;

/**
 * 
 * A recursive dispatcher.
 * 
 * @package Aura.Dispatcher
 * 
 */
class Dispatcher implements DispatcherInterface
{
    use InvokeMethodTrait;
    use InvokeClosureTrait;
    
    /**
     * 
     * Dispatchable objects.
     * 
     * @var array
     * 
     */
    protected $objects = [];
    
    /**
     * 
     * The param indicating the dispatchable object name.
     * 
     * @var string
     * 
     */
    protected $object_param;
    
    /**
     * 
     * The param indicating the method to invoke on created objects.
     * 
     * @var string
     * 
     */
    protected $method_param;
    
    /**
     * 
     * Constructor.
     * 
     * @param array $objects An array of dispatchable objects keyed by name.
     * 
     * @param string $object_param The param indicating the dispatchable
     * object name.
     * 
     * @param string $method_param The param indicating the method to invoke
     * on the dispatchable object.
     * 
     */
    public function __construct(
        array $objects = [],
        $object_param = null,
        $method_param = null
    ) {
        $this->setObjects($objects);
        $this->setObjectParam($object_param);
        $this->setMethodParam($method_param);
    }
    
    /**
     * 
     * Uses the params to get a dispatchable object, then dispatches it using
     * the params.
     * 
     * @param array|ArrayAccess $params Params for the invocation.
     * 
     * @return mixed The return from the invoked object.
     * 
     */
    public function __invoke($params = [])
    {
        $object = $this->getObjectByParams($params);
        return $this->dispatch($object, $params);
    }
    
    /**
     * 
     * Dispatches to the object with the params; if the result is an object
     * with the dispatchable method, a closure, or an invokable object,
     * recursively to that result with the same params.
     * 
     * @param mixed $object Dispatch to this object.
     * 
     * @param array|ArrayAccess $params Params for the invocation.
     * 
     * @return The first non-dispatchable result.
     * 
     */
    protected function dispatch($object, $params = [])
    {
        $method = $this->getMethodByParams($params);
        if (is_callable([$object, $method])) {
            // the object has the specified method
            $result = $this->invokeMethod($object, $method, $params);
        } elseif ($object instanceof Closure) {
            // the object is a closure proper
            $result = $this->invokeClosure($object, $params);
        } elseif (is_object($object) && is_callable($object)) {
            // the object is invokable
            $result = $this->invokeMethod($object, '__invoke', $params);
        } else {
            // cannot dispatch any further; end recursion and return as-is
            return $object;
        }
        
        // recursively dispatch the result.
        return $this->dispatch($result, $params);
    }
    
    /**
     * 
     * Sets the parameter indicating the dispatchable object name.
     * 
     * @param string $object_param The parameter name to use.
     * 
     * @return null
     * 
     */
    public function setObjectParam($object_param)
    {
        $this->object_param = $object_param;
    }
    
    /**
     * 
     * Gets the parameter indicating the dispatchable object name.
     * 
     * @return string
     * 
     */
    public function getObjectParam()
    {
        return $this->object_param;
    }
    
    /**
     * 
     * Sets the parameter indicating the method to call on the created object.
     * 
     * @param string $method_param The parameter name to use.
     * 
     * @return null
     * 
     */
    public function setMethodParam($method_param)
    {
        $this->method_param = $method_param;
    }
    
    /**
     * 
     * Gets the parameter indicating the method to call on the created object.
     * 
     * @return string
     * 
     */
    public function getMethodParam()
    {
        return $this->method_param;
    }
    
    /**
     * 
     * Set the array of dispatchable objects; this clears all existing objects.
     * 
     * @param array $objects An array where the key is a name and the value
     * is a dispatchable object.
     * 
     * @return null
     * 
     */
    public function setObjects(array $objects)
    {
        $this->objects = $objects;
    }

    /**
     * 
     * Adds to the array of dispatchable objects; this merges with existing
     * objects.
     * 
     * @param array $objects An array where the key is a name and the value
     * is a dispatchable object.
     * 
     * @return null
     * 
     */
    public function addObjects(array $objects)
    {
        $this->objects = array_merge($this->objects, $objects);
    }
    
    /**
     * 
     * Returns the array of dispatchable objects.
     * 
     * @return array
     * 
     */
    public function getObjects()
    {
        return $this->objects;
    }
    
    /**
     * 
     * Sets a dispatchable object by name.
     * 
     * @param string $name The name.
     * 
     * @param object $object The dispatchable object.
     * 
     */
    public function setObject($name, $object)
    {
        $this->objects[$name] = $object;
    }
    
    /**
     * 
     * Does a dispatchable object exist?
     * 
     * @param string $name The name of the dispatchable object.
     * 
     * @return bool
     * 
     */
    public function hasObject($name)
    {
        return isset($this->objects[$name]);
    }
    
    /**
     * 
     * Returns a dispatchable object using its name.
     * 
     * @param string $name The name of the dispatchable object.
     * 
     * @return object
     * 
     */
    public function getObject($name)
    {
        if ($this->hasObject($name)) {
            return $this->objects[$name];
        }
        
        throw new Exception\ObjectNotDefined($name);
    }
    
    /**
     * 
     * Returns a dispatchable object using an array of params; if the
     * `$object_param` is an object, it is returned directly, otherwise it is
     * treated as a dispatchable object name.
     * 
     * @param array|ArrayAccess $params Params for the invocation.
     * 
     * @return object The dispatchable object.
     * 
     */
    public function getObjectByParams($params)
    {
        // do we have an object param available?
        $key = $this->getObjectParam();
        if (! isset($params[$key])) {
            throw new Exception\ObjectNotSpecified;
        }
        
        // is the object param value already an object?
        $value = $params[$key];
        if (is_object($value)) {
            return $value;
        }
        
        // get the dispatchable object by name
        if ($this->hasObject($value)) {
            return $this->objects[$value];
        }
        
        // could not find the dispatchable object by name
        throw new Exception\ObjectNotDefined($value);
    }
    
    /**
     * 
     * Gets the method from the params.
     * 
     * @param array|ArrayAccess $params Params for the invocation.
     * 
     * @return mixed
     * 
     */
    public function getMethodByParams($params)
    {
        if ($this->method_param && isset($params[$this->method_param])) {
            return $params[$this->method_param];
        }
    }
}
