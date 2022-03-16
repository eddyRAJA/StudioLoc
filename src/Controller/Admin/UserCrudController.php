<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;


class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           
            //IdField::new('id'),
            TextField::new('firstname'),
            TextField::new('lastname'),
            TextField::new('email'),
            TextField::new('phone'),
            TextField::new('adress'),
            TextField::new('linkedin'),
            TextField::new('twitter'),
            TextField::new('facebook'),
            TextEditorField::new('description'),
            //TextField::new('roles'),
        ];
    }


    public function configureActions(Actions $actions): Actions
{
    return $actions
        // ...
        // this will forbid to create or delete entities in the backend
        ->disable(Action::NEW)
    ;
}
}
