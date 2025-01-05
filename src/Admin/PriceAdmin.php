<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class PriceAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->tab('Général')
                ->with('details', ['label' => 'Details'])
                    ->add('type', TextType::class, [
                        'label' => 'admin.label.type',
                    ])
                    ->add('value', TextType::class, [
                        'label' => 'admin.label.value',
                    ])
                    ->add('place', ModelType::class, [
                        'label' => 'admin.label.place',
                    ])
                ->end()
            ->end()
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('type', null, [
                'label' => 'admin.label.type',
            ])
            ->add('value', FieldDescriptionInterface::TYPE_CURRENCY, [
                'currency' => '€',
                'label' => 'admin.label.value',
            ])
            ->add('place', null, [
                'label' => 'admin.label.place',
            ])
            ->add(ListMapper::NAME_ACTIONS, ListMapper::TYPE_ACTIONS, [
                'translation_domain' => 'SonataAdminBundle',
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('name')
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->tab('Général')
                ->with('details', ['label' => 'Details'])
                    ->add('type', null, [
                        'label' => 'admin.label.type',
                    ])
                    ->add('value', null, [
                        'label' => 'admin.label.value',
                    ])
                    ->add('place', null, [
                        'label' => 'admin.label.place',
                    ])
                ->end()
            ->end()
        ;
    }

    public function toString(object $object): string
    {
        return 'Price';
    }
}