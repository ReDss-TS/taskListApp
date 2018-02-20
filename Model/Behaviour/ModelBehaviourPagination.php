<?php

class ModelBehaviourPagination
{
    protected $pagination;
    //items to show per page
    protected $resultsPerPage = 3;
    //adjacent pages
    protected $adjacents = 2;

    //number Of Pages
    // protected $numberOfPages;
    // //first item to display on page
    // protected $pageFirstResult;
    // //active page
    // protected $page;
    // //previous page
    // protected $prevPage;
    // //next page
    // protected $nextPage;
    // //last page
    // protected $lastPage;
    // //last page minus 1
    // protected $lpm1;
    // //order by
    // protected $order;
    // //sort by
    // protected $sort;
    

    public function setProperties($curentPage, $numberOfRecords)
    {
        $this->pagination['resultsPerPage'] = $this->resultsPerPage;
        $this->pagination['adjacents'] = $this->adjacents;
        $this->pagination['numberOfPages'] = ceil((int)$numberOfRecords[0]['amt'] / $this->pagination['resultsPerPage']);
        $this->setCurentPage($curentPage);
        $this->pagination['pageFirstResult'] = ($this->pagination['page'] - 1) * $this->pagination['resultsPerPage'];
        $this->pagination['prevPage'] = $this->pagination['page'] - 1;
        $this->pagination['nextPage'] = $this->pagination['page'] + 1;
        $this->pagination['lastPage'] = $this->pagination['numberOfPages'];
        $this->pagination['lpm1']     = $this->pagination['lastPage'] - 1;
    }

    public function getLimitParams($param, $numberOfRecords)
    {
        $this->setProperties($param, $numberOfRecords);
        return $this->pagination;
    }

    private function setCurentPage($curentPage)
    {
        if (!isset($curentPage['page'])) {
            $this->pagination['page'] = 1;
        } else {
            $this->pagination['page'] = ceil((int)$curentPage['page']);
            //if the page is missing then move to 1 page
            if ($this->pagination['page'] > $this->pagination['numberOfPages'] || $this->pagination['page'] < 1) {
                header("Location: /page:1");
            }
        }
    }
}
