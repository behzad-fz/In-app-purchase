<?php

namespace App\Exceptions;

use App\Traits\ResponseAPI;
use Exception;

class StoreNotFoundException extends Exception
{
    use ResponseAPI;
   /**
     * render  exception.
     *
     * @return
     */
    public function render()
    {
        return $this->error("This Operation System is not supported",422);
    }
}
