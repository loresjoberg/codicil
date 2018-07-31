<?php


namespace LoreSjoberg\Codicil\Core;

use WP_Term;
use WP_User;

interface CuratorInterface
{
    /**
     * @param string $by
     * @param string $direction
     *
     * @return $this
     */
    public function orderBy($by, $direction);

    /**
     * @param int $value
     *
     * @return $this
     */
    public function limit($value);

    /**
     * @param int $value
     *
     * @return $this
     */
    public function offset($value);

    /**
     * @param int[] $ids
     *
     * @return $this
     */
    public function exclude(array $ids);

    /**
     * @param int[] $ids
     *
     * @return $this
     */
    public function ids(array $ids);

    /**
     * @return \WP_Post[]|WP_Term[]|WP_User[]
     **/
    public function fetch();

    /**
     * @return \WP_Post|WP_Term|WP_User
     */
    public function first();

    /**
     * @return \WP_Post|WP_Term|WP_User
     */
    public function last();

    /* TODO: Implement these */
//    public function where(); // Big can of worms, many similar methods

    /**
     * @return $this
     */
    public function reset();

}