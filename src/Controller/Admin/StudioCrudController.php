<?php

namespace App\Controller\Admin;

use App\Entity\Studio;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class StudioCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Studio::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id'),
            TextField::new('name'),
            AssociationField::new('category'),
            TextField::new('poster'),
            TextEditorField::new('summary'),
            NumberField::new('unitPrice'),
            TextEditorField::new('detail'),
        ];
    }
}
