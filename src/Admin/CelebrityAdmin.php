<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Celebrity;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\CollectionType;

final class CelebrityAdmin extends AbstractAdmin
{
    public function toString($object)
    {
        /* @var Celebrity $object */
        return $object instanceof Celebrity
            ? $object->getName()
            : $this->trans('Celebrity'); // shown in the breadcrumb on id=null views
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['list', 'create', 'show', 'edit', 'delete', 'batch']);
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('birthday')
            ->add('bio')
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('name')
            ->add('birthday')
            ->add('bio')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ])
        ;
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('name')
            ->add('birthday')
            ->add('bio')
            ->add('agents', CollectionType::class, [
                'by_reference' => false,
            ], [
                'edit' => 'inline',
                'inline' => 'table',
                'admin_code' => 'admin.celebrity.agent',
            ])
            ->add('publicists', CollectionType::class, [
                'by_reference' => false,
            ], [
                'edit' => 'inline',
                'inline' => 'table',
                'admin_code' => 'admin.celebrity.publicist',
            ])
            ->add('managers', CollectionType::class, [
                'by_reference' => false,
            ], [
                'edit' => 'inline',
                'inline' => 'table',
                'admin_code' => 'admin.celebrity.manager',
            ])
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('name')
            ->add('birthday')
            ->add('bio')
            ->add('agents', null, [
                'associated_property' => 'representative.name',
                'identifier' => false,
            ])
            ->add('publicists', null, [
                'associated_property' => 'representative.name',
                'identifier' => false,
            ])
            ->add('managers', null, [
                'associated_property' => 'representative.name',
                'identifier' => false,
            ])
        ;
    }
}
