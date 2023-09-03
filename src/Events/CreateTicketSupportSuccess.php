<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang
 * @link       https://juzaweb.com
 * @license    GNU V2
 */

namespace Juzaweb\TicketSupport\Events;

use Juzaweb\TicketSupport\Models\TicketSupport;

class CreateTicketSupportSuccess
{
    public function __construct(public TicketSupport $ticketSupport)
    {
    }
}
