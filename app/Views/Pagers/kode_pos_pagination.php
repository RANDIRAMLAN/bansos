<?php $pager->setSurroundCount(2) ?>

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-end">
        <?php if ($pager->hasPrevious()) : ?>
            <li class="page-item">
                <a href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pertama') ?>" class="page-link">
                    <span aria-hidden="true"><?= lang('Pertama') ?></span>
                </a>
            </li>
            <li class="page-item">
                <a href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Kembali') ?>" class="page-link">
                    <span aria-hidden="true"><?= lang('Kembali') ?></span>
                </a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a href="<?= $link['uri'] ?>" class="page-link">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <li class="page-item">
                <a href="<?= $pager->getNext() ?>" aria-label="<?= lang('Lanjut') ?>" class="page-link">
                    <span aria-hidden="true"><?= lang('Lanjut') ?></span>
                </a>
            </li>
            <li class="page-item">
                <a href="<?= $pager->getLast() ?>" aria-label="<?= lang('Terakhir') ?>" class="page-link">
                    <span aria-hidden="true"><?= lang('Terakhir') ?></span>
                </a>
            </li>
        <?php endif ?>
    </ul>
</nav>