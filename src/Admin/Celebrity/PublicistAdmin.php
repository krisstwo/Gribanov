<?php

declare(strict_types=1);

namespace App\Admin\Celebrity;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

final class PublicistAdmin extends AbstractAdmin
{
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clear();
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('representative', ModelType::class, [
                'property' => 'name',
                'btn_add' => false,
            ])
            ->add('territory')
        ;
    }
}
