<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class NeoController
 * @package App\Controller
 */
class NeoController extends MainController
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

            return $this->render("neo.twig");
        }

        $startDate  = $this->getPost()->getPostVar("start-date");
        $endDate    = $this->getPost()->getPostVar("end-date");

        $neo = $this->service->getCurl()->getApiData(
            "api.nasa.gov/neo/rest/v1/feed",
            "start_date=" . $startDate . "&end_date=" . $endDate
        );

        $neo = $neo["near_earth_objects"];

        return $this->render("neo.twig", ["neo" => $neo]);
    }
}
