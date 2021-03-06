<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validation;

//use App\Entity\Product;
//use App\Entity\Category;

class DefaultController extends AbstractController
{
    protected $categoryJSON;

    /**
     * @Route("/api/admin")
     */
    public function admin()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }

}
/*
$data = json_decode($request->getContent(), true);
        $validator = new Validator();
        $validation = $validator->validate(
            $data,
            (object)[
                "name" => "array",
                "category" => (object)[
                    "new_layout" => (object)[
                        "type"=> "string"
                    ]
                ],
                "required" => [
                    "new_layout"
                ]
            ]);
 */