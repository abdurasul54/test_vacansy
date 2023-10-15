<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends AbstractController
{
    #[Route('/api/calculate', name: 'app_calculator', methods: ['POST'])]
    public function calculate(Request $request)
    {
        $operation = $request->request->get('operation');
        $operand1 = $request->request->get('operand1');
        $operand2 = $request->request->get('operand2');
        $result = null;

        switch ($operation) {
            case 'plus': // плюсь
                $result = $operand1 + $operand2;
                break;
            case 'minus': // минус
                $result = $operand1 - $operand2;
                break;
            case 'multiplication': // умножение
                $result = $operand1 * $operand2;
                break;
            case 'division': // деление
                if ($operand2 != 0) {
                    $result = $operand1 / $operand2;
                } else {
                    return new JsonResponse(['error' => 'Деление на ноль невозможно']);
                }
                break;
            default:
                return new JsonResponse(['error' => 'Неверная операция']);
        }

        return new JsonResponse(['result' => $result]);
    }
}
