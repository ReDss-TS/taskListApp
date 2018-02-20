<?php

class ViewHelpersPagination
{
    protected $pagination;
    //items to show per page
    protected $resultsPerPage;
    //adjacent pages
    protected $adjacents;
    //number Of Pages
    protected $numberOfPages;
    //first item to display on page
    protected $pageFirstResult;
    //active page
    protected $page;
    //previous page
    protected $prevPage;
    //next page
    protected $nextPage;
    //last page
    protected $lastPage;
    //last page minus 1
    protected $lpm1;
    //order by
    protected $column;
    //sort by
    protected $sort;
    //curent page uri
    protected $targetpage;

    public function getPagination($data)
    {
        $this->setProperties($data);
        $pagination = '';
        if ($this->lastPage > 1) {
            $pagination .= "<div class=\"pagination\">";

            //previous button
            $pagination .= $this->previousButton();

            //pages
            $pagination .= $this->pages();
            
            //next button
            $pagination .= $this->nextButton();

            $pagination .= "</div>\n";
        }
        return $pagination;
    }

    private function setProperties($data)
    {
        $this->resultsPerPage  = (int)$data['pagination']['resultsPerPage'];
        $this->adjacents       = (int)$data['pagination']['adjacents'];
        $this->numberOfPages   = (int)$data['pagination']['numberOfPages'];
        $this->pageFirstResult = (int)$data['pagination']['pageFirstResult'];
        $this->page            = (int)$data['pagination']['page'];
        $this->prevPage        = (int)$data['pagination']['prevPage'];
        $this->nextPage        = (int)$data['pagination']['nextPage'];
        $this->lastPage        = (int)$data['pagination']['lastPage'];
        $this->lpm1            = (int)$data['pagination']['lpm1'];
        $this->column          = $data['sorting']['column'];
        $this->sort            = $data['sorting']['sort'];
        $this->targetpage      = $data['uri'];
    }

    private function getLink($page, $name)
    {
        return "<a href=\"/$this->targetpage/page:$page/column:$this->column/sort:$this->sort\">$name</a>";
    }

    private function getThreeDots()
    {
        return "<span class = \"threeDots\"> ... </span>";
    }

    private function getPages($i)
    {
        if ($i == $this->page) {
            return "<span class=\"current\">$i</span>";
        } else {
            return $this->getLink($i, $i);
        }
    }

    private function previousButton()
    {
        $pagination = '';
        if ($this->page > 1) {
            $pagination .= $this->getLink($this->prevPage, 'Previous');
        } else {
            $pagination .= "<span class=\"disabled\">Previous</span>";
        }
        return $pagination;
    }

    private function nextButton()
    {
        $pagination = '';
        if ($this->page < $this->numberOfPages) {
            $pagination.= $this->getLink($this->nextPage, 'Next');
        } else {
            $pagination.= "<span class=\"disabled\">Next</span>";
        }
        return $pagination;
    }

    private function pages()
    {
        $pagination = '';
        if ($this->lastPage < 7 + ($this->adjacents * 2)) {
            for ($i = 1; $i <= $this->lastPage; $i++) {
                $pagination .= $this->getPages($i);
            }
        } elseif ($this->lastPage > 5 + ($this->adjacents * 2)) {     
            if ($this->page < 1 + ($this->adjacents * 2)) {
                //near the beginning;only hide later pages
                $this->beginningPages();
            } elseif ($this->lastPage - ($this->adjacents * 2) > $this->page && $this->page > ($this->adjacents * 2)) {
                //in middle;hide some front and some back
                $this->middlePages();
            } else {
                //near the end;only hide early pages
                $this->endingPages();
            }
        }
        return $pagination;
    }


    private function beginningPages()
    {
        $pagination = '';
        for ($i = 1; $i < 4 + ($this->adjacents * 2); $i++) {
            $pagination .= $this->getPages($i);
        }

        $pagination .= $this->getThreeDots();
        $pagination .= $this->getLink($this->lpm1, $this->lpm1);
        $pagination .= $this->getLink($this->lastPage, $this->lastPage);
        return $pagination;
    }

    private function endingPages()
    {
        $pagination = '';
        $pagination .= $this->getLink('1', '1');
        $pagination .= $this->getLink('2', '2');
        $pagination .= $this->getThreeDots();

        for ($i = $this->lastPage - (2 + ($this->adjacents * 2)); $i <= $this->lastPage; $i++) {
            $pagination .= $this->getPages($i);
        }
        return $pagination;
    }

    private function middlePages()
    {
        $pagination = '';
        $pagination .= $this->getLink('1', '1');
        $pagination .= $this->getLink('2', '2');
        $pagination .= $this->getThreeDots();

        for ($i = $this->page - $this->adjacents; $i <= $this->page + $this->adjacents; $i++) {
            $pagination .= $this->getPages($i);
        }

        $pagination .= $this->getThreeDots();
        $pagination .= $this->getLink($this->lpm1, $this->lpm1);
        $pagination .= $this->getLink($this->lastPage, $this->lastPage);
        return $pagination;
    }
}
