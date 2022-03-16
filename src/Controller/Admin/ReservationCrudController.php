<?php

namespace App\Controller\Admin;

use App\Entity\Reservation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ReservationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reservation::class;
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setSearchFields(['author', 'start'])
            ->setDefaultSort(['createdAt' => 'DESC'])
        ;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id'),
            AssociationField::new('author'),
            AssociationField::new('studio'),
            DateTimeField::new('start'),
            DateTimeField::new('end'),
            BooleanField::new('registered'),
        ];
    }
    
}
