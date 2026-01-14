<?php $pager->setSurroundCount(2) ?>

<nav aria-label="Page navigation" class="flex justify-center mt-12">
    <div class="flex items-center space-x-2">
        <?php if ($pager->hasPrevious()) : ?>
            <a href="<?= $pager->getPrevious() ?>" class="w-10 h-10 rounded-xl bg-white border border-gray-100 flex items-center justify-center text-gray-500 hover:bg-primary-600 hover:text-white transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
        <?php endif ?>

        <?php foreach ($pager->links() as $link): ?>
            <a href="<?= $link['uri'] ?>" class="w-10 h-10 rounded-xl flex items-center justify-center text-sm font-bold transition-all shadow-sm <?= $link['active'] ? 'bg-primary-600 text-white shadow-primary-200' : 'bg-white text-gray-500 border border-gray-100 hover:border-primary-500 hover:text-primary-600' ?>">
                <?= $link['title'] ?>
            </a>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <a href="<?= $pager->getNext() ?>" class="w-10 h-10 rounded-xl bg-white border border-gray-100 flex items-center justify-center text-gray-500 hover:bg-primary-600 hover:text-white transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        <?php endif ?>
    </div>
</nav>