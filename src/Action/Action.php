<?php

namespace App\Action;

use DomainException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;

abstract class Action
{

    protected $request;
    protected $response;
    protected $args;

    public function __construct()
    {
    }

    public function __invoke(Request $request, Response $response, $args): Response
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;

        try {
            return $this->action();
        } catch (DomainException $e) {
            throw new HttpNotFoundException($this->request, $e->getMessage());
        }
    }

    abstract protected function action(): Response;

    protected function getFormData()
    {
        $input = json_decode(file_get_contents('php://input'));

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new HttpBadRequestException($this->request, 'Malformed JSON input.');
        }

        return $input;
    }

    protected function resolveArg(string $name)
    {
        if (!isset($this->args[$name])) {
            throw new HttpBadRequestException($this->request, "Could not resolve argument `{$name}`.");
        }

        return $this->args[$name];
    }

    protected function respondWithData($data = null, int $statusCode = 200): Response
    {
        $payload = new ActionPayload($statusCode, $data);

        return $this->respond($payload);
    }

    protected function respond(ActionPayload $payload): Response
    {
        $json = json_encode($payload);

        $json = $this->formatJson($json);

        $this->response->getBody()->write($json);

        return $this->response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($payload->getStatusCode());
    }

    protected function formatJson(string $json)
    {
        $json = preg_replace('/,/', '$0 ', $json);

        return $json;
    }

    protected function respondOk(string $message = "OK")
    {
        $this->response->getBody()->write($message);

        return $this->response
            ->withStatus(200);
    }

    protected function respondNotFound($message = "")
    {
        $this->response->getBody()->write($message);

        return $this->response
            ->withStatus(404);
    }
}
