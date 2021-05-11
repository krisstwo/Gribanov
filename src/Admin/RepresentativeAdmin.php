<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Representative;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

final class RepresentativeAdmin extends AbstractAdmin
{
    public function toString($object)
    {
        /* @var Representative $object */
        return $object instanceof Representative
            ? $object->getName()
            : $this->trans('Representative'); // shown in the breadcrumb on id=null views
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['list', 'show', 'edit', 'delete', 'batch']);
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('company')
            ->add('emails')
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('name')
            ->add('company')
            ->add('emails', FieldDescriptionInterface::TYPE_ARRAY, [
                'inline' => false,
                'display' => 'values',
            ])
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
            ->add('company')
            ->add('emails', CollectionType::class, [
                'entry_type' => EmailType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ])
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('name')
            ->add('company')
            ->add('emails', null, [
                'display' => 'values',
            ])
            ->add('agentDuties', null, [
                'associated_property' => 'celebrity.name',
            ])
            ->add('publicistDuties', null, [
                'associated_property' => 'celebrity.name',
            ])
            ->add('managerDuties', null, [
                'associated_property' => 'celebrity.name',
            ])
        ;
    }
}
