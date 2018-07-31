<?php


use LoreSjoberg\Codicil\Core\QueryContainer;


class QueryContainerTest extends  \PHPUnit\Framework\TestCase
{

    /** @var QueryContainer */
    private $queryContainer;

    /** @var \LoreSjoberg\Warp\Warp|\Mockery\MockInterface */
    private $warp;

    public function setUp() {

        $this->warp = Mockery::mock(\LoreSjoberg\Warp\Warp::class);
        $curators = [
            'users' => new \LoreSjoberg\Codicil\Curators\UserCurator($this->warp),
        ];
        $this->queryContainer = new QueryContainer($curators);
    }

    public function testInstantiate()
    {
        $this->assertInstanceOf(QueryContainer::class, $this->queryContainer);
    }

    public function testInstantiateWithBadCurator() {
        $curators = [
            'dateTime' => new DateTime(),
        ];
        $this->expectException(\Psr\Container\ContainerException::class);
        new QueryContainer($curators);
    }

    public function testSelect()
    {
        $this->assertInstanceOf(\LoreSjoberg\Codicil\Curators\UserCurator::class, $this->queryContainer->select('users'));
    }

    public function testSelectNonExistentThrowsException()
    {
        $this->expectException(\Psr\Container\NotFoundException::class);
        $this->queryContainer->select('postses');
        $this->addToAssertionCount(1);
    }

    public function testHasReturnsTrue()
    {
        $this->assertTrue($this->queryContainer->has('users'));
    }

    public function testHasReturnsFalse()
    {
        $this->assertFalse($this->queryContainer->has('postses'));
    }

}