<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Entity\Celebrity;
use App\Entity\ChangeLogEntry;
use App\Entity\Representative;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;

final class LogChangesSubscriber implements EventSubscriberInterface
{
    private $logEntries = [];

    public function getSubscribedEvents()
    {
        return [
            Events::preUpdate,
            Events::postFlush,
        ];
    }

    public function preUpdate(PreUpdateEventArgs $eventArgs)
    {
        $entity = $eventArgs->getObject();
        $em = $eventArgs->getObjectManager();

        if ($entity instanceof Celebrity || $entity instanceof Representative) {
            $logEntry = new ChangeLogEntry();
            $logEntry->setContext(get_class($entity));
            $logEntry->setIdentifier($entity->getId());
            $logEntry->setChangeset($eventArgs->getEntityChangeSet());

            $this->logEntries[] = $logEntry;
        }
    }

    public function postFlush(PostFlushEventArgs $eventArgs)
    {
        if (!empty($this->logEntries)) {
            $em = $eventArgs->getEntityManager();

            foreach ($this->logEntries as $logEntry) {
                $em->persist($logEntry);
            }

            $this->logEntries = [];
            $em->flush();
        }
    }
}
