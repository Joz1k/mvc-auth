<?php

class Pages extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $data = [
            'title' => 'Добро пожаловать',
            'description' => 'Простая социальная сеть',
        ];
        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'О нас',
            'description' => 'Делитесь впечатлениями',
        ];
        $this->view('pages/about', $data);
    }
}
