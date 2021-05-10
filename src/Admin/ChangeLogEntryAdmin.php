<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\ChangeLogEntry;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

final class ChangeLogEntryAdmin extends AbstractAdmin
{
    public function toString($object)
    {
        /* @var ChangeLogEntry $object */
        return $object instanceof ChangeLogEntry
            ? sprintf(
                '%s #%d at %s',
                $this->trans('Change log entry'),
                $object->getId(),
                $object->getMoment()->format('Y-m-d H:i:s')
            )
            : $this->trans('Change log entry'); // shown in the breadcrumb on id=null views
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['list', 'show']);
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('context')
            ->add('identifier')
            ->add('moment')
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('context')
            ->add('identifier')
            ->add('moment')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                ],
            ])
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('context')
            ->add('identifier')
            ->add('moment')
            ->add('changeset')
        ;
    }
}
