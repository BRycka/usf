<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 15/04/14
 * Time: 14:01
 */
class memoryObserver{
    protected $loop;
    static $memoryUsage;
    public function __construct($loop){
        $this->loop = $loop;
        $this->trackMemoryUsage(null);
    }
    public function getMemoryUsage(){
        return memory_get_usage();
    }
    public function trackMemoryUsage($timer)  {
        self::$memoryUsage = $this->getMemoryUsage();
        $this->loop->addTimer(1, array($this, 'trackMemoryUsage'));
    }
}
