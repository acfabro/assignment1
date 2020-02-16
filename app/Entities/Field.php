<?php


namespace Acfabro\MailerLiteAssignment\Entities;


/**
 * Class Field
 *
 * Implementation of a subscriber's data field
 *
 * @package Acfabro\MailerLiteAssignment\Entities
 */
class Field extends AbstractEntity
{
    use HasState; // this entity has states that indicate newness

    public const TYPE_STRING = 'string';
    public const TYPE_NUMBER = 'number';
    public const TYPE_DATE = 'date';
    public const TYPE_BOOLEAN = 'boolean';

    public const STATE_OK = 'ok'; // no change
    public const STATE_CHANGED = 'changed'; // changed, for updating to db
    public const STATE_NEW = 'new'; // new item, for saving to db

    /**
     * @var int Unique identifier
     */
    protected $id;

    /**
     * @var string Field title
     */
    protected $title;

    /**
     * @var string Field type, use `Field::TYPE_*` for values
     */
    protected $type;

    /**
     * @var string value
     */
    protected $value;

    /**
     * @var int Subscriber id this field belongs to
     */
    protected $subscriberId;

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    /**
     * @return int|null
     */
    public function getSubscriberId(): ?int
    {
        return !empty($this->subscriberId)? $this->subscriberId: null;
    }

    /**
     * @param int|null $subscriberId
     */
    public function setSubscriberId(int $subscriberId): void
    {
        $this->subscriberId = $subscriberId;
    }

    /**
     * @param array|object $data
     * @return Field
     */
    public function fill($data)
    {
        $item = (array)$data;
        $this->id = isset($item['id'])? $item['id']: null;
        $this->title = $item['title'];
        $this->type = $item['type'];
        $this->value = $item['value'];
        $this->subscriberId = isset($item['subscriberId'])? $item['subscriberId']: null;
        $this->_state = isset($item['_state'])? $item['_state']: null;

        return $this;
    }

    /**
     * Return the array representation of the object
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'type' => $this->getType(),
            'value' => $this->getValue(),
            'subscriber_id' => $this->getSubscriberId(),
            '_state' => $this->_state,
        ];
    }

    /**
     * return data without non-db items
     * @return array
     */
    public function data()
    {
        $data = $this->toArray();
        unset($data['_state']);

        return $data;
    }

}