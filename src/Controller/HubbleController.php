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
     * @var string
     */
    private $type = "";

    /**
     * @var string
     */
    private $item = "";

    /**
     * @var string
     */
    private $page = "";

    /**
     * @var null
     */
    private $query = null;

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
    {
        return $this->render("hubble/hubble.twig");
    }

    private function setItem()
    {
        if (!empty($this->getPost()->getPostArray())) {
            $this->item = "/" . $this->getPost()->getPostVar("item");
        }
    }

    private function setPage()
    {
        if (!empty($this->getPost()->getPostArray())) {
            $this->page = "?page=" . $this->getPost()->getPostVar("page");
        }
    }

    private function setQuery()
    {
        $this->query = "https://hubblesite.org/api/v3/" . $this->type . $this->item . $this->page;
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function newsMethod()
    {
        $this->type = "news";

        if (empty($this->getPost()->getPostArray())) {

            return $this->render("hubble/hubbleNews.twig");
        }

        $this->setPage();
        $this->setQuery();

        $news = $this->service->getCurl()->getApiData($this->query);

        return $this->render("hubble/hubbleNews.twig", ["news" => $news]);
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function releaseMethod()
    {
        $this->type = "news_release";

        if (empty($this->getPost()->getPostArray())) {

            return $this->render("hubble/hubbleNews.twig");
        }

        $this->setItem();
        $this->setQuery();

        $release = $this->service->getCurl()->getApiData($this->query);

        return $this->render("hubble/hubbleRelease.twig", ["release" => $release]);
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function imagesMethod()
    {
        $this->type = "images";

        if (empty($this->getPost()->getPostArray())) {

            return $this->render("hubble/hubbleImages.twig");
        }

        $this->setPage();
        $this->setQuery();

        $images = $this->service->getCurl()->getApiData($this->query);

        return $this->render("hubble/hubbleImages.twig", ["images" => $images]);
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function imageMethod()
    {
        $this->type = "image";

        if (empty($this->getPost()->getPostArray())) {

            return $this->render("hubble/hubbleImages.twig");
        }

        $this->setItem();
        $this->setQuery();

        $image = $this->service->getCurl()->getApiData($this->query);

        return $this->render("hubble/hubbleImage.twig", ["image" => $image]);
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function videosMethod()
    {
        $this->type = "videos";

        if (empty($this->getPost()->getPostArray())) {

            return $this->render("hubble/hubbleVideos.twig");
        }

        $this->setPage();
        $this->setQuery();

        $videos = $this->service->getCurl()->getApiData($this->query);

        return $this->render("hubble/hubbleVideos.twig", ["videos" => $videos]);
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function videoMethod()
    {
        $this->type = "video";

        if (empty($this->getPost()->getPostArray())) {

            return $this->render("hubble/hubbleVideos.twig");
        }

        $this->setItem();
        $this->setQuery();

        $video = $this->service->getCurl()->getApiData($this->query);

        return $this->render("hubble/hubbleVideo.twig", ["video" => $video]);
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function glossaryMethod()
    {
        $this->type = "glossary";
        $this->page = "?page=all";

        $this->setQuery();

        $glossary = $this->service->getCurl()->getApiData($this->query);

        return $this->render("hubble/hubbleGlossary.twig", ["glossary" => $glossary]);
    }
}
