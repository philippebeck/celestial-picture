<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class HubbleController
 * @package App\Controller
 */
class HubbleController extends MainController
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
            $collectionsQuery = "http://hubblesite.org/api/v3/images?page=all";

            $collections = $this->service->getCurl()->getApiData($collectionsQuery);
            $collections = array_keys($this->service->getArray()->getArrayElements($collections, "collection"));

            return $this->render("hubble.twig", ["collections" => $collections]);
        }

        $collection         = $this->getPost()->getPostVar("collections");
        $collectionQuery    = "http://hubblesite.org/api/v3/images/" . $collection . "?page=1";

        $collection = $this->service->getCurl()->getApiData($collectionQuery);
        $collection = array_keys($this->service->getArray()->getArrayElements($collection, "id"));

        $pictures = [];

        foreach ($collection as $element) {
            $pictureQuery   = "http://hubblesite.org/api/v3/image/" . $element;
            $pictures[]     = $this->service->getCurl()->getApiData($pictureQuery);
        }

        return $this->render("hubble.twig", ["pictures" => $pictures]);
    }
}
