<?php


namespace Acfabro\MailerLiteAssignment\Entities;


/**
 * Class AbstractEntity
 *
 * Parent class of all entities
 *
 * @package Acfabro\MailerLiteAssignment\Entities
 */
abstract class AbstractEntity
{
    public function __construct($data = null)
    {
        if (!empty($data)) {
            $this->fill($data);
        }
    }

    /**
     * return an array version of this object's data
     * @return array
     */
    abstract public function toArray();

    /**
     * Populate the object with data
     * @param $data
     * @return mixed
     */
    abstract public function fill($data);

}
