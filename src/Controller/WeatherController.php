<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\MeasurementRepository;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class WeatherController extends AbstractController
{
    #[Route(
        '/weather/{city},{country}',
        name: 'app_weather_city',
        requirements: ['city' => '[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]+', 'country' => '[A-Z]{2}']
    )]
    public function city(
        #[MapEntity(mapping: ['city' => 'city', 'country' => 'country'])]
        Location $location,
        MeasurementRepository $repository
    ): Response {
        $measurements = $repository->findByLocation($location);

        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'measurements' => $measurements,
        ]);
    }
}
