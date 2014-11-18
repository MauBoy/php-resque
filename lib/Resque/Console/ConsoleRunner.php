<?php

namespace Resque\Console;

use Resque\Client\ClientInterface;
use Resque\Version;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\Console\Helper\HelperSet;

class ConsoleRunner
{
    /**
     * Creates a helper set for the console component
     *
     * A convenience method (you could always define your own HelperSet separately). Useful for writing cli-config.php.
     *
     * @param ClientInterface $client Redis connection
     * @return HelperSet
     */
    public static function createHelperSet($client)
    {
        $helper = new HelperSet();
        $helper->set(new RedisHelper($client));
        return $helper;
    }

    /**
     * Runs the application using the given HelperSet
     *
     * This method is responsible for creating the console application, adding
     * relevant commands, and running it. Other code is responsible for producing
     * the HelperSet itself (your cli-config.php or bootstrap code), and for
     * calling this method (the actual bin command file).
     *
     * @param HelperSet $helperSet
     * @return integer 0 if everything went fine, or an error code
     */
    public static function run(HelperSet $helperSet)
    {
        $application = new Application('Resque Console Tool', Version::VERSION);
        $application->setCatchExceptions(true);
        $application->setHelperSet($helperSet);

        $application->add(new QueuesCommand());
        $application->add(new EnqueueCommand());

        return $application->run();
    }
}
