<?= $this->extend("partials/base") ?>

<?= $this->section("content") ?>

<section class="d-flex justify-content-center mb-5 pb-3">
  <div class="d-flex" style="flex-direction: column; text-align: center;">
    <img src="<?= base_url('modules/img/404.svg') ?>" width="300">
    <h3 class="mt-2" style="font-weight: 800; color: #263238">Page not found</h3>
  </div>
</section>

<?= $this->endSection() ?>