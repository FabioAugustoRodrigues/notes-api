<?php

namespace App\Action\Note;

use App\Action\Note\NoteAction;
use App\Domain\Note\Assembler\NoteAssembler;
use App\Domain\Note\Note;
use App\Domain\Note\Service\NoteCreator;
use App\Domain\Note\Service\NoteReader;
use Psr\Http\Message\ResponseInterface as Response;

class NoteGetAllByUserAction extends NoteAction
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
        $id_user = $this->request->getAttribute("id");

        $notes = $this->noteReader->readAllNotesByUser($id_user);
        $notesArray = array();
        for ($i = 0; $i < count($notes); $i++){
            $note = new Note($notes[$i]["id"], $notes[$i]["id_user"], $notes[$i]["title"], $notes[$i]["content"]);
            array_push($notesArray, $this->noteAssembler->noteToArray($note));
        }

        return $this->respondWithData($notesArray, 200);

	}
}