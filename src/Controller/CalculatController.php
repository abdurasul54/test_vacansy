<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CalculatController extends AbstractController
{
    #[Route('/calculat', name: 'app_calculat', methods: ['POST'])]
    public function calculatebirthdate(Request $request)
    {
        $fixedDate = \DateTime::createFromFormat('d/m/Y', '01/01/2000');

        $date = \DateTime::createFromFormat('d/m/Y', $request->request->get('birthdate'));

        $birthdate = $fixedDate->diff($date)->y;

        if ($date < $fixedDate) {
            return new JsonResponse(['messbirthdate' => 'Дата рождения больше расчетного возраста']);
        }

        return new JsonResponse(['Вам сейчас ' => $birthdate]);
    }
}
