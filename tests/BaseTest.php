<?php
/**
 * PHP File
 * User: chocoboxxf
 * Date: 2017/8/22
 */
namespace chocoboxxf\Ulucu\Tests;

use Yii;

class BaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \chocoboxxf\Ulucu\Ulucu
     */
    protected $client;

    public function setUp()
    {
        parent::setUp();
        $this->client = Yii::createObject([
            'class' => 'chocoboxxf\Ulucu\Ulucu',
            'url' => $_ENV['ULUCU_URL'],
            'appId' => $_ENV['APP_ID'],
            'secret' => $_ENV['SECRET'],
            'version' => $_ENV['VERSION'],
        ]);
    }
}
