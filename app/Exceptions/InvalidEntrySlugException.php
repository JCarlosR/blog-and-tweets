<?php namespace App\Exceptions;

use App\Entry;
use Exception;
use Throwable;

class InvalidEntrySlugException extends Exception
{
    private $entry;

    public function __construct(Entry $entry, $message = "", $code = 0, Throwable $previous = null)
    {
        $this->entry = $entry;
        parent::__construct($message, $code, $previous);
    }

    public function render()
    {
        return redirect($this->entry->getUrl());
    }
}
