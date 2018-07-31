<?php


namespace LoreSjoberg\Codicil\Core;

use LoreSjoberg\Warp\Warp;
use WP_Post;
use WP_Term;
use WP_User;

/**
 * Curators do the bulk of the work in forming and implementing a query.
 * The various fluent methods are named to be familiar to those who
 * have worked with ORMs. When in doubt, we've given methods the same
 * name as their equivalent method in Laravel's Query Builder.
 *
 * At the moment, our Curators only read information, there's no functionality
 * to create, update or delete information from the database.
 *
 * Class Curator
 * @package LoreSjoberg\Codicil\Core
 */
abstract class Curator implements CuratorInterface
{


    /**
     * @var string
     */
    protected $className;

    /** @var array  */
    protected $constraints = [];

    /** @var  CuratorInterface */
    protected $curator;

    /** @var Warp  */
    protected $warp;

    /** @var array  */
    protected $defaults = [];

    /**
     * Curator constructor.
     *
     * @param Warp $warp
     */
    public function __construct(Warp $warp) {
        $this->warp = $warp;
        $this->overrideDefaults();
    }

    /**
     * @return $this
     */
    public function reset() {
        $this->constraints = [];
        return $this;
    }

    /**
     * @param $by
     * @param string $direction
     *
     * @return $this
     */
    public function orderBy($by, $direction = 'ASC')
    {
        if (strtoupper($direction) !== 'ASC' && strtoupper($direction) !== 'DESC') {
            throw new \RuntimeException('Order direction must be either ASC or DESC');
        }

        return $this->setConstraint('order', ['by' => $by, 'direction' => strtoupper($direction)]);
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function limit($value)
    {
        return $this->setConstraint('limit', $value);
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function offset($value)
    {
        return $this->setConstraint('offset', $value);
    }

    /**
     * @param array $ids
     *
     * @return $this
     */
    public function exclude(array $ids)
    {
        return $this->setConstraint('exclude', $ids);
    }

    /**
     * @param int[] $ids
     *
     * @return $this
     */
    public function ids(array $ids) {
        return $this->setConstraint('ids', $ids);
    }


    protected function byId($id) {
        $this->setConstraint('ids', [$id]);
        return $this->fetch()[0];
    }

    /**
     *
     * @return WP_Post[]|WP_Term[]|WP_User[]
     */
    public function fetch()
    {
        $this->mergeWithDefault();
        $args = $this->prepareCoreArgs();
        $args = $this->prepareArgs($args);
        return $this->fetchRaw($args);
    }

    public function first()
    {
        $array = $this->fetch();
        return isset($array[0]) ? $array[0] : null;
    }

    public function last() {

        // This is one of the more reliable ways to get the last element of an array,
        // and will work even if our array is, for some reason, not in consecutive indexed order.
        $array = $this->fetch();
        if (empty($array)) {
            return null;
        }
        $lastElement = end($array);
        reset($array);
        return $lastElement;
    }

    /**
     *
     * @return array
     */
    protected abstract function prepareCoreArgs();

    /**
     * @param $args
     *
     * @return mixed
     */
    protected function prepareArgs($args) {
        return $args;
    }

    abstract protected function getDefaultConstraints();

    /**
     *
     */
    protected function mergeWithDefault() {
        $this->constraints = $this->constraints + $this->getDefaultConstraints();
    }

    /**
     * @param array $args
     *
     * @return WP_Post[]|WP_Term[]|WP_User[]
     */
    protected abstract function fetchRaw(array $args);

    /**
     * @param $key
     * @param $value
     *
     * @return $this
     */
    protected function setConstraint($key, $value)
    {
        $this->constraints[$key] = $value;

        return $this;
    }

    protected function overrideDefaults()
    {
        if (! empty($this->defaults) && is_array($this->defaults)) {
            foreach ($this->defaults as $key => $value) {
                $this->constraints[$key] = $value;
            }
        }
    }

}