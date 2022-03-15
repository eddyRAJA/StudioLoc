<?php

namespace App\Controller\Admin;

use App\Entity\CategoryStudio;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryStudioCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategoryStudio::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id'),
            TextField::new('name'),
            TextField::new('poster'),
            TextEditorField::new('description'),
        ];
    }
}
