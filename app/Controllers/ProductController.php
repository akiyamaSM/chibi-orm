<?php

namespace App\Controllers;

use App\Request;
use App\Response;

class ProductController {

    public function edit(Request $request, Response $response)
    {
        return $response->setBody("HomeController");
    }

    public function listAction(Request $request, Response $response)
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
            <ul>
        ');
    }
}