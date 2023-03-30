<?php

namespace App\Controller;

use App\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    public function getCategory(int $id) {
        $em = $this->getDoctrine();
        $repo = $em->getRepository(Categories::class)->find($id);
        return $this->render('category/showCategory.html.twig', [
            'category' => $repo
        ]);
    }
}
