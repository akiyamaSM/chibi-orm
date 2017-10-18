<?php

namespace App\Controllers;

use App\Request;
use App\Response;
use App\Models\Product;

class ProductController
{
    public function edit(Request $request, Response $response)
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        $product = $id ? Product::load($id) : new Product();

        $html = '<form action="/product/save" method="POST">'
            . '<table border="1">';

        foreach ($product as $field => $value) {
            $html.= '<tr><td><label>'.$field.'</label></td>'
                . '<td><input type="text" name="'.$field.'" value="'.$value.'"></td></tr>';
        }

        $html .= '</table><input type="submit" value="Save"></form>';

        return $response->setBody($html);
    }

    public function save(Request $request, Response $response)
    {
        Product::make($_POST)->store();

        header("Location: /product/list");
    }

    public function listAction(Request $request, Response $response)
    {
        $html = '<a href="/">main menu</a> - <a href="/product/edit">add new</a><hr/>'
            . '<table border="1"><tr>';

        foreach (Product::getModelFields() as $field) {
            $html.= '<th>'.$field.'</th>';
        }

        $html.= '<th></th></tr>';

        foreach (Product::all() as $product) {
            $html.= '<tr>';
            foreach (Product::getModelFields() as $field) {
                $html.= '<td>'.$product->{$field}.'</td>';
            }
            $html.= '<td><a href="/product/edit?id='.$product->getPrimaryKeyValue().'">edit</a></td></tr>';
        }

        $html.= '</table>';

        return $response->setBody($html);
    }
}