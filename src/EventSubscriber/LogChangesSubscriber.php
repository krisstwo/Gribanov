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
use Symfony\Component\Security\Core\Security;

final class LogChangesSubscriber implements EventSubscriberInterface
{
    private $security;
    private $logEntries = [];

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

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
        $user = $this->security->getUser();

        if ($entity instanceof Celebrity || $entity instanceof Representative) {
            $logEntry = new ChangeLogEntry();
            $logEntry->setContext(get_class($entity));
            $logEntry->setIdentifier($entity->getId());
            $logEntry->setChangeset($eventArgs->getEntityChangeSet());
            $logEntry->setUser($user->getUsername());

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
