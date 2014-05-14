<?php

/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 15/04/14
 * Time: 14:01
 */
class tempObserver
{
    protected $loop;
    static $temp;
    /**
     * @var \PhpGpio\Sensors\DS18B20
     */
    protected $termometer;
    public $callbacks = array();

    public function __construct($loop, \PhpGpio\Sensors\DS18B20 $termometer)
    {
        $this->loop = $loop;
        $this->termometer = $termometer;
        $this->trackTemp(null);
    }

    public function getTemp()
    {
        return round($this->termometer->read(), 1);
    }
    public function addCallback($callback){
        array_push($this->callbacks, $callback);
    }
    public function trackTemp($timer)
    {
        self::$memoryUsage = $this->getTemp();
        foreach($this->callbacks as $callback){
            call_user_func($callback, self::$memoryUsage);
        }
        $this->loop->addTimer(1, array($this, 'trackMemoryUsage'));
    }
}

