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

        $customer = $id ? Customer::load($id) : new Customer();

        $html = '<form action="/customer/save" method="POST">'
              . '<table border="1">';

        foreach ($customer as $field => $value) {
            $html.= '<tr><td><label>'.$field.'</label></td>'
                  . '<td><input type="text" name="'.$field.'" value="'.$value.'"></td></tr>';
        }

        $html .= '</table><input type="submit" value="Save"></form>';

        return $response->setBody($html);
    }

    public function save(Request $request, Response $response)
    {
        Customer::make($_POST)->store();

        header("Location: /customer/list");
    }

    public function listAction(Request $request, Response $response)
    {
        $html = '<a href="/">main menu</a> - <a href="/customer/edit">add new</a><hr/>'
              . '<table border="1"><tr>';

        foreach (Customer::getModelFields() as $field) {
            $html.= '<th>'.$field.'</th>';
        }

        $html.= '<th></th></tr>';

        foreach (Customer::all() as $customer) {
            $html.= '<tr>';
            foreach (Customer::getModelFields() as $field) {
                $html.= '<td>'.$customer->{$field}.'</td>';
            }
            $html.= '<td><a href="/customer/edit?id='.$customer->getPrimaryKeyValue().'">edit</a></td></tr>';
        }

        $html.= '</table>';

        return $response->setBody($html);
    }
}
