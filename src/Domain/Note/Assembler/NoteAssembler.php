<?php

namespace App\Domain\Note\Assembler;

use App\Domain\Note\Note;

final class NoteAssembler
{
    
    public function noteToArray(Note $note): array
    {
        return [
            "id" => $note->getId(),
            "title" => $note->getTitle(),
            "content" => $note->getContent()
        ];
    }

}