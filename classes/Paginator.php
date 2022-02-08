<?php

/***
 * 
 * 
 */
class Paginator
{

    public $limit;
    public $offset;
    public $previous;
    public $next;

    public function __construct($page, $records_per_page, $total)
    {
        $this->limit = $records_per_page;

        $page = filter_var($page, FILTER_VALIDATE_INT, [
            'options' => ['default' => 1, 'min_range' => 1]
        ]);

        if ($page > 0) {
            $this->offset = $records_per_page * ($page - 1);
            $this->previous = $page - 1;
        } else {
            $this->offset = 0;
        }

        $totalPage = ceil($total / $records_per_page);
        if ($page < $totalPage) {
            $this->next = $page + 1;
        }
    }
}
