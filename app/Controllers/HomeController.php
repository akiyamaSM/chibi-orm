<?php

namespace App\Controllers;

use App\Request;
use App\Response;

class HomeController
{
    public function index(Request $request, Response $response)
    {
        return $response->setBody("HomeController");
    }

    public function json(Request $request, Response $response)
    {
        $name = $request->only('name');
        return $response->withJson([
            'name' => $name
        ])->withStatus(200);
    }

    public function menu(Request $request, Response $response)
    {
        return $response->setBody('
            <ul>
                <li><a href="/customer/edit">Create new customer</a></li>
                <li><a href="/customer/list">List all customers</a></li>
                <li><a href="/product/edit">Create new product</a></li>
                <li><a href="/product/list">List all products</a></li>
            <ul>
        ');
    }
}