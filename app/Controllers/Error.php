<?php namespace App\Controllers;

use Todo\BaseController;

class Error extends BaseController
{
    public function pageNotFound()
    {
        $this->seo('Error 404!', 'Page not found');

        $this->render();
    }
}