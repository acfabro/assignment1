<?php


namespace Acfabro\MailerLiteAssignment\Entities;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Class Subscriber
 *
 * Subscriber entity
 *
 * @package Acfabro\MailerLiteAssignment\Entities
 */
class Subscriber extends AbstractEntity
{
    // subscriber statuses

    public const STATUS_ACTIVE = 'active';
    public const STATUS_UNSUBSCRIBED = 'unsubscribed';
    public const STATUS_JUNK = 'junk';
    public const STATUS_BOUNCED = 'bounced';
    public const STATUS_UNCONFIRMED = 'unconfirmed';

    /**
     * @var int Subscriber's unique identifier
     */
    protected $id;

    /**
     * @var string Subscriber's name, required field
     */
    protected $name;

    /**
     * @var string Subscriber's email, required field
     */
    protected $email;

    /**
     * @var string Subscriber state, use `Subscriber::STATUS_*` for values
     */
    protected $state;

    /**
     * @var Collection
     */
    protected $fields;

    public function __construct($data = null)
    {
        // init the fields collection
        $this->fields = new ArrayCollection();

        // call parent to fill
        parent::__construct($data);

    }

    /**
     * @return int|null
     */
    public function getId(): ?int
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState(string $state): void
    {
        $this->state = $state;
    }

    /**
     * Get the whole field collection
     * @return Collection
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Set the whole field collection
     * @param Collection $fields
     */
    public function setFields(Collection $fields): void
    {
        $this->fields = $fields;
    }

    /**
     * Get a field
     * @param int $fieldId Field ID
     * @return Field
     */
    public function getField($fieldId)
    {
        return $this->fields->get($fieldId);
    }

    /**
     * @param Field $field Field object to add to the subscriber
     */
    public function addField(Field $field): void
    {
        // if id exists
        if ($field->getId()) {
            // set value at key
            $this->fields->set($field->getId(), $field);
        } else {
            // add to end of collection
            $this->fields->add($field);
        }
    }

    /**
     * Populate the subscriber object's properties (and fields) from an object data
     * @param array|object $data
     * @return Subscriber
     */
    public function fill($data)
    {
        // populate primary fields
        $item = (array)$data;
        $this->id = isset($item['id'])? $item['id']: null;
        $this->name = $item['name'];
        $this->email = $item['email'];
        $this->state = $item['state'];

        // if fields is set then add the field to this subscriber
        if (!empty($item['fields'])) {
            $fields = (array)$item['fields'];
            foreach ($fields as $field) {
                $newField = new Field((array)$field);
                $this->addField($newField);
            }
        }

        return $this;
    }

    /**
     * Return the array representation of the object
     * @return array
     */
    public function toArray()
    {
        $fields = [];
        if (!empty($this->fields)) {
            foreach ($this->fields as $field) {
                $fields[] = $field->toArray();
            }
        }

        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'state' => $this->getState(),
            'fields' => $fields,
        ];
    }

    /**
     * Return the array representation of the object, without the relationship objects
     * @return array
     */
    public function data()
    {
        $data = $this->toArray();
        unset($data['fields']);

        return $data;
    }
}
