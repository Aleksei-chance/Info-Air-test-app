<?php

namespace App\Controllers;

use App\Services\TreeService;

class TreeController
{
    protected TreeService $service;

    public function __construct()
    {
        $this->service = new TreeService();
    }

    public function index()
    {
        $arr = $this->service->getTree();

        return view('index', $arr);
    }
}
