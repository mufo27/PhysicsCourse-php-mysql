<div class="row mt-3">
    <div class="col-sm-12 col-md-5">
        <div class="dataTables_info">
            กำลังแสดง <?= (($page - 1) * $per_page) + 1 ?> ถึง <?= min($page * $per_page, $total_records) ?> จาก <?= $total_records ?> รายการ
        </div>
    </div>
    <div class="col-sm-12 col-md-7">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <?php if ($page > 1) : ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?course&page=<?= $page - 1 ?>" tabindex="-1" aria-disabled="true">ก่อนหน้า</a>
                    </li>
                <?php else : ?>
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">ก่อนหน้า</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="index.php?course&page=<?= $i ?>">
                            <?= $i ?>
                            <?php if ($i == $page) : ?>
                                <span class="sr-only">(current)</span>
                            <?php endif; ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $total_pages) : ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?course&page=<?= $page + 1 ?>">ถัดไป</a>
                    </li>
                <?php else : ?>
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">ถัดไป</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>