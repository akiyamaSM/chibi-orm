<?php

namespace App\Controllers;

use App\Request;
use App\Response;
use App\Models\Customer;

class CustomerController
{
    public function edit(Request $request, Response $response)
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $customer = null;

        if ($id) {
            $customer = Customer::load($id);
        } else {
            $customer = new Customer();
        }

        $html = '<form action="/customer/save" method="POST">';

        foreach ($customer as $field => $value) {
            $html .= '<input type="text" name="'.$field.'" value="'.$value.'">';
        }

        $html .= '</form>';

        return $response->setBody($html);
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
            <ul>
        ');
    }
}