<?php

namespace Carbonite\Mediator;

class Pagination
{
    public $pageCount;
    public $currentPage;

    public function __construct($currentPage, $pageCount)
    {
        // save the current page
        $this->currentPage = $currentPage;

        // save the page count
        $this->pageCount = $pageCount;
    }

    /**
     * Forms an array for pagination to be implemented by any means
     *
     * @return array
     **/
    public function getHtml($linkAnchor = '')
    {
        if ($this->pageCount <= 1) {
            return '';
        }
        $data = $this->getData();
        ob_start();
        ?>
        <nav class="c-pagination">
            <ul class="c-pagination-list">

                <?php if ($this->currentPage > 1) : ?>
                    <li class="c-pagination-list__item c-pagination-list__item--prev">
                        <a class="c-pagination-list__link" href="<?php echo get_pagenum_link($this->currentPage - 1).$linkAnchor; ?>">
                            <span class="c-pagination-list__link--text" aria-hidden="true">Prev</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php foreach ($data as $number => $page) : ?>

                    <?php if ($page == 'current') : ?>
                        <li class="c-pagination-list__item">
                            <span class="c-pagination-list__link c-pagination-list__link--active"><?php echo $number; ?></span>
                        </li>

                    <?php elseif ($page == 'ellipsis') : ?>
                        <li class="c-pagination-list__item">
                            <span class="c-pagination-list__link c-pagination-list__link--ellipsis">Ã¢â‚¬Â¦</span>
                        </li>

                    <?php else : ?>
                        <li class="c-pagination-list__item">
                            <a class="c-pagination-list__link" href="<?php echo get_pagenum_link($number).$linkAnchor; ?>"><?php echo $number; ?></a>
                        </li>
                    <?php endif; ?>

                <?php endforeach; ?>

                <?php if ($this->currentPage < $this->pageCount) : ?>
                    <li class="c-pagination-list__item c-pagination-list__item--next">
                        <a class="c-pagination-list__link" href="<?php echo get_pagenum_link($this->currentPage + 1).$linkAnchor; ?>">
                            <span class="c-pagination-list__link--text" aria-hidden="true">Next</span>
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
        </nav>
        <?php
        return ob_get_clean();
    }

    /**
     * Forms an array for pagination to be implemented by any means
     *
     * @return array
     **/
    public function getData()
    {
        $pagination = [];
        if ($this->pageCount < 12) {
            return $this->all();
        } else {
            if ($this->currentPage <= 6) {
                return $this->firstEightLastTwo();
            } elseif ($this->currentPage >= $this->pageCount - 5) {
                return $this->firstTwoLastEight();
            } else {
                return $this->firstTwoMiddleFiveLastTwo();
            }
        }
        return $pagination;
    }

    private function all()
    {
        $pagination = [];
        for ($i = 1; $i <= $this->pageCount; $i++) {
            $pagination[$i] = $this->currentPage == $i ? 'current' : 'link';
        }
        return $pagination;
    }

    private function firstEightLastTwo()
    {
        $pagination = [];
        for ($i = 1; $i <= 8; $i++) {
            $pagination[$i] = $this->currentPage == $i ? 'current' : 'link';
        }
        $pagination[9] = 'ellipsis';
        for ($i = $this->pageCount - 1; $i <= $this->pageCount; $i++) {
            $pagination[$i] = 'link';
        }
        return $pagination;
    }

    private function firstTwoLastEight()
    {
        $pagination = [];
        for ($i = 1; $i <= 2; $i++) {
            $pagination[$i] = 'link';
        }
        $pagination[3] = 'ellipsis';
        for ($i = $this->pageCount - 7; $i <= $this->pageCount; $i++) {
            $pagination[$i] = $this->currentPage == $i ? 'current' : 'link';
        }
        return $pagination;
    }

    private function firstTwoMiddleFiveLastTwo()
    {
        $pagination = [];
        for ($i = 1; $i <= 2; $i++) {
            $pagination[$i] = 'link';
        }
        $pagination[3] = 'ellipsis';
        $comparison_number = $this->currentPage + 2;
        for ($i = $this->currentPage - 2; $i <= $comparison_number; $i++) {
            $pagination[$i] = $this->currentPage == $i ? 'current' : 'link';
        }
        $pagination[$this->currentPage + 3] = 'ellipsis';
        for ($i = $this->pageCount - 1; $i <= $this->pageCount; $i++) {
            $pagination[$i] = 'link';
        }
        return $pagination;
    }
}
