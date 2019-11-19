<?php

/**
 * This file is part of Gitonomy.
 *
 * (c) Alexandre Salomé <alexandre.salome@gmail.com>
 * (c) Julien DIDIER <genzo.wm@gmail.com>
 *
 * This source file is subject to the GPL license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Siravel\Models\Entytys\Digital\Code\Message;

use Siravel\Models\Entytys\Digital\Code\Message;

/**
 * @author Julien DIDIER <genzo.wm@gmail.com>
 */
class MergeMessage extends Message
{
    public function getSentence()
    {
        return 'merged';
    }

    public function getName()
    {
        return 'merge';
    }
}