<?php

/***
 * 
 * 
 */
class Paginator
{

    public $limit;
    public $offset;

    public function __construct($page, $records_per_page)
    {
        $this->limit = $records_per_page;

        $this->offset = $records_per_page * ($page - 1);
    }
}
