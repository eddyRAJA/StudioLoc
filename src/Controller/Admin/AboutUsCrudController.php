<?php

namespace App\Controller\Admin;

use App\Entity\AboutUs;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AboutUsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AboutUs::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id'),
            TextField::new('title'),
            TextField::new('poster'),
            TextEditorField::new('description'),
        ];
    }
    
}
