<?php

/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 15/04/14
 * Time: 14:01
 */
class memoryObserver
{
    protected $loop;
    static $memoryUsage;
    /**
     * @var \PhpGpio\Sensors\DS18B20
     */
    protected $termometer;
    public $callbacks = array();

    public function __construct($loop, \PhpGpio\Sensors\DS18B20 $termometer)
    {
        $this->loop = $loop;
        $this->termometer = $termometer;
        $this->trackMemoryUsage(null);
    }

    public function getMemoryUsage()
    {
        return round($this->termometer->read(), 1);
    }
    public function addCallback($callback){
        array_push($this->callbacks, $callback);
    }
    public function trackMemoryUsage($timer)
    {
        self::$memoryUsage = $this->getMemoryUsage();
        foreach($this->callbacks as $callback){
            call_user_func($callback, self::$memoryUsage);
        }
        $this->loop->addTimer(1, array($this, 'trackMemoryUsage'));
    }
}

