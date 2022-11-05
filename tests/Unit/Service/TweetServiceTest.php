<?php

namespace Tests\Unit\Service;

use App\Modules\ImageUpload\ImageManagerInterface;
use PHPUnit\Framework\TestCase;
use App\Services\TweetService;
use Mockery;

class TweetServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     * @runInSeparateProcess
     * @return void
     * 
     */
    public function test_check_own_tweet()
    {
        $tweetService = new TweetService(); // TweetServiceのインスタンス作成

        $mock = Mockery::mock('alias:App\Models\Tweet');
        $mock->shouldReceive('where->first')->andReturn((object)[
            'id' => 1,
            'user_id' => 1
        ]);
        $imageManager = Mockery::mock(ImageManagerInterface::class);
        $result = $tweetService($imageManager);
        $this->assertTrue($result);

        $result = $tweetService->checkOwnTweet(2, 1);
        $this->assertFalse($result);
    }
}
