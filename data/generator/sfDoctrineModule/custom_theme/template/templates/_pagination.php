<ul class="pagination sf_admin_pagination">
    <li class="prev">
        <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=1">
            <span>
                <i class="fa fa-angle-double-left"></i>
                [?php echo Translate::from(array("backend","pager:btn:first:text"));?]
            </span>
        </a>
    </li>
    <li>
        <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getPreviousPage() ?]">
            <span>
                <i class="fa fa-angle-left"></i>
                [?php echo Translate::from(array("backend","pager:btn:previous:text"));?]
            </span>
        </a>
    </li>
    [?php foreach ($pager->getLinks() as $page): ?]
        [?php if ($page == $pager->getPage()): ?]
            <li class="active">
                <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $page ?]">[?php echo $page ?]</a>
            </li>
        [?php else: ?]
            <li>
                <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $page ?]">[?php echo $page ?]</a>
            </li>
        [?php endif; ?]
    [?php endforeach; ?]
    <li>
        <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getNextPage() ?]">
            <span>
                [?php echo Translate::from(array("backend","pager:btn:next:text"));?]
                <i class="fa fa-angle-right"></i>
            </span>
        </a>
    </li>
    <li class="next">
        <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getLastPage() ?]">
            <span>
                [?php echo Translate::from(array("backend","pager:btn:last:text"));?]
                <i class="fa fa-angle-double-right"></i>
            </span>
        </a>
    </li>
</ul>
