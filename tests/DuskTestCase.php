<?php

namespace Tests;

use Laravel\Dusk\TestCase as BaseTestCase;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Prepare for Dusk test execution.
     *
     * @beforeClass
     * @return void
     */
    public static function prepare()
    {
        static::startChromeDriver();
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {

        $options = (new ChromeOptions)->addArguments([
            '--disable-gpu',
            //'--enable-logging',
            //'--auto-open-devtools-for-tabs',
            //'--remote-debugging-port=9222',
            '--headless'
        ]);


        return RemoteWebDriver::create(
            //'http://localhost:9515', DesiredCapabilities::chrome()->setCapability(
            'http://localhost:9515', DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY, $options
            )
        );
    }
}
