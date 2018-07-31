<?php

use LoreSjoberg\Codicil\Core\QueryContainer;
use LoreSjoberg\Codicil\Curators\UserCurator;
use LoreSjoberg\Warp\Warp;

class IntegratedTest extends \PHPUnit\Framework\TestCase
{

    public function testIntegration()
    {
        /** @var Warp|\Mockery\MockInterface $warp */
        $warp = Mockery::mock(Warp::class);
        $users = [new WP_User()];
        $expectedArguments = [
            'number' => 10,
            'exclude' => null,
            'include' => null,
            'offset' => 2,
            'order' => 'DESC',
            'orderby' => 'id',
            'has_published_posts' => null
        ];
        $warp->shouldReceive('get_users')->once()->with($expectedArguments)->andReturn($users);


        $curators = [
            'users' => new UserCurator($warp),
        ];

        $query = new QueryContainer($curators);

        $result = $query->select('users')->limit(10)->offset(2)->orderBy('id', 'desc')->fetch();
        $this->assertEquals($users, $result);
    }
}