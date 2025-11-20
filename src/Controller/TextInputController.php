<?php

namespace App\Controller;

use App\Form\TextInputType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TextInputController extends AbstractController
{
    #[Route('/text/input', name: 'app_text_input')]
    public function index(Request $request): Response
    {
        // 1. Utworzenie formularza
        $form = $this->createForm(TextInputType::class);

        // 2. Obsługa żądania (sprawdzenie czy formularz został wysłany)
        $form->handleRequest($request);

        // Zmienna na tekst z formularza
        $submittedText = null;

        // 3. Jeśli formularz wysłany i poprawny – pobieramy dane
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData(); // tablica ['text' => '...']
            $submittedText = $data['text'] ?? null;
        }

        // 4. Render widoku z formularzem i ewentualnym tekstem
        return $this->render('text_input/index.html.twig', [
            'form' => $form->createView(),
            'submittedText' => $submittedText,
        ]);
    }
}
