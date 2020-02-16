<?php

namespace Acfabro\MailerLiteAssignmentTests\Repository;

use Acfabro\MailerLiteAssignment\Database\Connection;
use Acfabro\MailerLiteAssignment\Entities\Field;
use Acfabro\MailerLiteAssignment\Entities\Subscriber;
use Acfabro\MailerLiteAssignment\Repository\SubscriberRepository;
use Acfabro\MailerLiteAssignmentTests\TestCase;

class SubscriberRepositoryTest extends TestCase
{

    public function testCreate()
    {
        $repo = new SubscriberRepository();
        $subscriber = new Subscriber($this->data);

        // save to db
        $repo->save($subscriber);

        // find in db
        $this->assertTrue(true);
    }

    public function testUpdate()
    {
        $repo = new SubscriberRepository();
        $subscriber = new Subscriber($this->data);

        // save to db
        $newSub = $repo->save($subscriber);

        // update the data
        $newSub->setName('Terry');

        // save the object
        $repo->update($subscriber);

        // find the object

        // find in db
        $this->assertTrue(true);
    }

    public function testCreateWithFields()
    {
        $repo = new SubscriberRepository();
        $subscriber = new Subscriber($this->dataWithFields);

        // save to db
        $newSubscriber = $repo->save($subscriber);

        // find in db
        $this->assertSame($newSubscriber->data(), $subscriber->data());
    }

    public function testFind()
    {
        $repo = new SubscriberRepository();
        $subscriber = $repo->find(1);

        $this->assertSame($subscriber->getId(), 1);
    }

    public function testSubscriberAddField()
    {
        $repo = new SubscriberRepository();
        $subscriber = new Subscriber($this->data);

        // save to db
        $subscriber = $repo->save($subscriber);

        // add a new field and save to db again
        $subscriber->addField(new Field($this->dataField));
        $subscriber = $repo->save($subscriber);

        // find in db
        $this->assertTrue(true);
    }

    public function testDelete()
    {
        $repo = new SubscriberRepository();
        $result = $repo->delete(2);

        $this->assertTrue($result);

        // then find
        $row = $repo->find(2);

        $this->assertEmpty($row);
    }

    public function testSubscriberRemoveField()
    {
        $repo = new SubscriberRepository();
        $result = $repo->deleteField(1);

        $this->assertNotEmpty($result);
    }

    protected $data = [
        'name' => 'Jake Peralta',
        'email' => 'jake@nine-nine.com',
        'state' => Subscriber::STATUS_ACTIVE,
    ];

    protected $dataWithFields = [
        'name' => 'Jake Peralta',
        'email' => 'jake@nine-nine.com',
        'state' => Subscriber::STATUS_ACTIVE,
        'fields' => [
            [
                'title' => 'Name on Badge',
                'type' => Field::TYPE_STRING,
                'value' => 'Jake',
            ],
            [
                'title' => 'Date hired',
                'type' => Field::TYPE_DATE,
                'value' => '2020-02-14',
            ],
        ],
    ];

    protected $dataField = [
        'title' => 'Age',
        'type' => Field::TYPE_NUMBER,
        'value' => 30,
    ];

}
