<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends MainController
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
    {
        $apod = $this->service->getCurl()->getApiData(
            "api.nasa.gov/planetary/apod",
            "concept_tags=True"
        );

        return $this->render("home.twig", ["apod" => $apod]);
    }
}
