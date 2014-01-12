<?php

namespace Resque;

/**
 * Client interface
 *
 * This interface represents the capabilities Resque expects from a client
 * object. Your client doesn't have to actually implement this interface: any
 * object that can handle these calls will do fine.
 *
 * This interface is also used to mock out a client for testing.
 *
 * The following clients should be compatible:
 *  - Predis\Client
 *  - Credis
 */
interface Client
{
    public function get($key);
    public function set($key, $value);
    public function del($key);

    public function incrby($key, $int);
    public function decrby($key, $int);

    public function lpop($key);
    public function llen($key);
    public function rpush($key, $value);

    public function sadd($key, $value);
    public function sismember($key, $value);
    public function smembers($key);

    public function flushdb($db = null);

    public function establishConnection();

    public function srem($key, $value);
}
