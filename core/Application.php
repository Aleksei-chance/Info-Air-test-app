<?php

namespace Core;

use Illuminate\Database\Capsule\Manager as Capsule;

class Application
{
    protected string $uri;

    public static Application $app;
    public Request $request;
    public Response $response;
    public Router $router;
    public View $view;

    public function __construct()
    {
        self::$app = $this;
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->request = new Request($this->uri);
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->view = new  View(LAYOUT);

        $this->setDbConnection();
    }

    public function run(): void
    {
        echo $this->router->dispatch();
    }

    public function setDbConnection(): void
    {
        $capsule = new Capsule;
        $capsule->addConnection(DB_SETTINGS);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}
