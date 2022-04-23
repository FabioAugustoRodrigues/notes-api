<?php

namespace App\Action\Note;

use App\Action\Note\NoteAction;
use App\Domain\Note\Assembler\NoteAssembler;
use App\Domain\Note\Service\NoteReader;
use Psr\Http\Message\ResponseInterface as Response;

class NoteGetByIdAction extends NoteAction
{
    private $noteReader;
    private $noteAssembler;

    public function __construct(NoteReader $noteReader, NoteAssembler $noteAssembler)
    {
        $this->noteReader = $noteReader;
        $this->noteAssembler = $noteAssembler;
    }

    protected function action(): Response
	{
        $id = $this->request->getAttribute("id");
        return $this->respondWithData($this->noteAssembler->noteToArray($this->noteReader->readById($id)), 200);
	}
}