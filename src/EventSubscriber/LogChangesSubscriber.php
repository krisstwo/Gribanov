<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Entity\Celebrity;
use App\Entity\ChangeLogEntry;
use App\Entity\Representative;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
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
            Events::prePersist,
            Events::preUpdate,
            Events::preRemove,
            Events::postFlush,
        ];
    }

    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        /** @var Celebrity\AttachedRepresentativeInterface $entity */
        $entity = $eventArgs->getObject();
        $user = $this->security->getUser();

        if (!$entity instanceof Celebrity\AttachedRepresentativeInterface) {
            return;
        }

        // Should not happen
        if (null === $entity->getCelebrity() || null === $entity->getRepresentative()) {
            return;
        }

        // Prefill log entry with common values
        $logEntry = new ChangeLogEntry();
        $logEntry->setContext(Celebrity::class);
        $logEntry->setIdentifier($entity->getCelebrity()->getId());
        $logEntry->setUser($user->getUsername());

        $changeset = [];
        switch (true) {
            case $entity instanceof Celebrity\Agent:
                $changeset[] = sprintf('Added agent: %s', $entity->getRepresentative()->getName());
                break;
            case $entity instanceof Celebrity\Publicist:
                $changeset[] = sprintf('Added publicist: %s', $entity->getRepresentative()->getName());
                break;
            case $entity instanceof Celebrity\Manager:
                $changeset[] = sprintf('Added manager: %s', $entity->getRepresentative()->getName());
                break;
        }

        if (!empty($changeset)) {
            $logEntry->setChangeset($changeset);
            $this->logEntries[] = $logEntry;
        }
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
        } elseif ($entity instanceof Celebrity\AttachedRepresentativeInterface && $eventArgs->hasChangedField('representative')) {
            /** @var Celebrity\AttachedRepresentativeInterface $entity */

            // Should not happen
            if (null === $entity->getCelebrity() || null === $entity->getRepresentative()) {
                return;
            }

            // Prefill log entry with common values
            $logEntry = new ChangeLogEntry();
            $logEntry->setContext(Celebrity::class);
            $logEntry->setIdentifier($entity->getCelebrity()->getId());
            $logEntry->setUser($user->getUsername());

            /** @var Representative $oldRepresentative */
            $oldRepresentative = $eventArgs->getOldValue('representative');
            /** @var Representative $newRepresentative */
            $newRepresentative = $eventArgs->getNewValue('representative');
            $changeset = [];
            switch (true) {
                case $entity instanceof Celebrity\Agent:
                    $changeset[] = sprintf('Changed agent: "%s" to "%s"', $oldRepresentative->getName(), $newRepresentative->getName());
                    break;
                case $entity instanceof Celebrity\Publicist:
                    $changeset[] = sprintf('Changed publicist: "%s" to "%s"', $oldRepresentative->getName(), $newRepresentative->getName());
                    break;
                case $entity instanceof Celebrity\Manager:
                    $changeset[] = sprintf('Changed manager: "%s" to "%s"', $oldRepresentative->getName(), $newRepresentative->getName());
                    break;
            }

            if (!empty($changeset)) {
                $logEntry->setChangeset($changeset);
                $this->logEntries[] = $logEntry;
            }
        }
    }

    public function preRemove(LifecycleEventArgs $eventArgs)
    {
        /** @var Celebrity\AttachedRepresentativeInterface $entity */
        $entity = $eventArgs->getObject();
        $user = $this->security->getUser();

        if (!$entity instanceof Celebrity\AttachedRepresentativeInterface) {
            return;
        }

        // Refresh the entity to get it's current celebrity before removal
        $em = $eventArgs->getObjectManager();
        $em->refresh($entity);

        // Should not happen
        if (null === $entity->getCelebrity() || null === $entity->getRepresentative()) {
            return;
        }

        // Prefill log entry with common values
        $logEntry = new ChangeLogEntry();
        $logEntry->setContext(Celebrity::class);
        $logEntry->setIdentifier($entity->getCelebrity()->getId());
        $logEntry->setUser($user->getUsername());

        $changeset = [];
        switch (true) {
            case $entity instanceof Celebrity\Agent:
                $changeset[] = sprintf('Removed agent: %s', $entity->getRepresentative()->getName());
                break;
            case $entity instanceof Celebrity\Publicist:
                $changeset[] = sprintf('Removed publicist: %s', $entity->getRepresentative()->getName());
                break;
            case $entity instanceof Celebrity\Manager:
                $changeset[] = sprintf('Removed manager: %s', $entity->getRepresentative()->getName());
                break;
        }

        if (!empty($changeset)) {
            $logEntry->setChangeset($changeset);
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
