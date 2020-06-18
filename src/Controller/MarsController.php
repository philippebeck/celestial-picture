<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class MarsController
 * @package App\Controller
 */
class MarsController extends MainController
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
    {
        if (empty($this->getPost()->getPostArray())) {

            return $this->render("mars.twig");
        }

        $rover  = $this->getPost()->getPostVar("rover");
        $camera = $this->getPost()->getPostVar("camera");

        $query = "https://api.nasa.gov/mars-photos/api/v1/rovers/" . $rover . "/photos?sol=1000&camera=" . $camera . "&api_key=" . NASA_API;

        $mars = $this->service->getCurl()->getApiData($query);
        $mars = $mars["photos"];

        return $this->render("mars.twig", ["mars" => $mars]);
    }
}
