<?php

namespace olof_core\data;

class Pager
{
    protected $pageNow;
    protected $pageSize;
    protected $totalCount;

    public function __construct(int $pageSize, int $totalCount, int $pageNow = 1)
    {
		$this->pageNow = $pageNow;
		$this->pageSize = $pageSize;
		$this->totalCount = $totalCount;
    }

    public function setPageNow(int $value)
    {
        $this->pageNow = $value;
    }

    public function getPageNow()
    {
        return $this->pageNow;
    }

    public function getOffset()
    {
        $p = (int) $this->pageNow;
        $pm = $this->getPageMax();

        if ($p < 1) {
            $p = 1;
        }
        elseif ($p > $pm) {
            $p = $pm;
        }

        return ($p - 1) * $this->getPageSize();
    }

    public function getTotalCount()
    {
        return $this->totalCount;
    }

    public function getPageSize()
    {
        return $this->pageSize;
    }

    public function getPageMax()
    {
        $t = $this->getTotalCount();
        $ps = $this->getPageSize();

        if ($t < $ps) {
            return 1;
        }

        $x = ($t % $ps) ? 1 : 0;
        return intval($t / $ps) + $x;
    }
}
