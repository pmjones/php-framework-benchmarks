<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Debug_Timer extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Debug_Timer = array(
    );
    
    protected $_delta = 0.005;
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $obj = Solar::factory('Solar_Debug_Timer');
        $this->assertInstance($obj, 'Solar_Debug_Timer');
    }
    
    /**
     * 
     * Test -- Displays formatted output of the current profile.
     * 
     */
    public function testDisplay()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches the current profile formatted as a table.
     * 
     */
    public function testFetch()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Marks the time.
     * 
     */
    public function testMark()
    {
        $timer = Solar::factory('Solar_Debug_Timer');
        
        $expect[0]['time'] = microtime(true);
        $timer->start();
        
        $uwait = rand(3, 8) * 100000;
        usleep($uwait);
        
        $expect[1]['time'] = microtime(true);
        $timer->mark('foo');
        
        $actual = $timer->profile();
        
        $count = count($expect);
        $this->assertSame(count($actual), $count);
        
        $keys = array('name', 'time', 'diff', 'total');
        $this->assertSame(array_keys($actual[1]), $keys);
        
        $this->assertSame($actual[1]['name'], 'foo');
        
        $this->assertInDelta(
            $actual[1]['time'],
            $expect[1]['time'],
            $this->_delta
        );
        
        $expect[1]['diff'] = $expect[1]['time'] - $expect[0]['time'];
        $this->assertInDelta(
            $actual[1]['diff'],
            $expect[1]['diff'],
            $this->_delta
        );
        
        $expect[1]['total'] = $expect[1]['time'] - $expect[0]['time'];
        $this->assertInDelta(
            $actual[1]['diff'],
            $expect[1]['diff'],
            $this->_delta
        );
        
        // do another mark to test the total time
        $expect[2]['time'] = microtime(true);
        $timer->mark('bar');
        $actual = $timer->profile();
        
        $expect[2]['total'] = $expect[2]['time'] - $expect[0]['time'];
        $this->assertInDelta(
            $actual[2]['total'],
            $expect[2]['total'],
            $this->_delta
        );
    }
    
    /**
     * 
     * Test -- Returns profiling information as an array.
     * 
     */
    public function testProfile()
    {
        $timer = Solar::factory('Solar_Debug_Timer');
        
        $expect[0]['time'] = microtime(true);
        $timer->start();
        
        $k = rand(3, 8);
        for ($i = 1; $i <= $k; $i++) {
            $uwait = rand(3, 8) * 100000;
            usleep($uwait);
            $expect[$i]['time'] = microtime(true);
            $timer->mark($i);
        }
        
        $k++;
        $expect[$k]['time'] = microtime(true);
        $timer->stop();
        
        $actual = $timer->profile();
        for ($i = 0; $i <= $k; $i ++) {
            $this->assertInDelta(
                $actual[$i]['time'],
                $expect[$i]['time'],
                $this->_delta
            );
        }
    }
    
    /**
     * 
     * Test -- Resets the profile and marks a new starting time.
     * 
     */
    public function testStart()
    {
        $timer = Solar::factory('Solar_Debug_Timer');
        
        $expect[0]['time'] = microtime(true);
        $timer->start();
        
        $actual = $timer->profile();
        
        $this->assertInDelta(
            $actual[0]['time'],
            $expect[0]['time'],
            $this->_delta
        );
    }
    
    /**
     * 
     * Test -- Stops the timer.
     * 
     */
    public function testStop()
    {
        $timer = Solar::factory('Solar_Debug_Timer');
        
        $expect[0]['time'] = microtime(true);
        $timer->start();
        
        $uwait = rand(3, 8) * 100000;
        usleep($uwait);
        
        $expect[1]['time'] = microtime(true);
        $timer->stop();
        
        $actual = $timer->profile();
        $this->assertInDelta(
            $actual[1]['time'],
            $expect[1]['time'],
            $this->_delta
        );
    }
    
    // public function testAll()
    // {
    //     // does the class create the locale config?
    //     $timer = Solar::factory('Solar_Debug_Timer', array('output' => 'text'));
    //     
    //     $mark['__start'] = microtime(true);
    //     $timer->start();
    //     for ($i = 0; $i < 4; $i++) {
    //         $wait = rand(1,2);
    //         sleep($wait);
    //         $mark[$i] = microtime(true);
    //         $timer->mark($i);
    //     }
    //     $mark['__stop'] = microtime(true);
    //     $timer->stop();
    //     
    //     // get the timer profile
    //     $profile = $timer->profile();
    //     
    //     // make sure we hit all the marks
    //     $this->assertTrue(count($profile) == count($mark));
    //     
    //     foreach ($profile as $val) {
    //         // make sure the profiled times are near the
    //         // times we marked
    //         $key = $val['name'];
    //         $diff = abs($val['time'] - $mark[$key]);
    //         $this->assertTrue($diff <= 0.0005);
    //     }
    // }
    
    public function assertInDelta($actual, $expect, $delta)
    {
        $diff = abs($actual - $expect);
        $this->assertTrue($diff <= $delta);
    }
}
