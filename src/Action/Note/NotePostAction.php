<?php

namespace App\Action\Note;

use App\Action\Note\NoteAction;
use App\Domain\Note\Service\NoteCreator;
use Psr\Http\Message\ResponseInterface as Response;

class NotePostAction extends NoteAction
{
    private $noteCreator;

    public function __construct(NoteCreator $noteCreator)
    {
        $this->noteCreator = $noteCreator;
    }

    protected function action(): Response
	{
        $data = (array)$this->request->getParsedBody();

        $id_note = $this->noteCreator->createNote($data);

        $result = [
            'id_note' => $id_note
        ];

        return $this->respondWithData($result, 201);

	}
}