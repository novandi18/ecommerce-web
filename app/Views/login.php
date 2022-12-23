<?= $this->extend("partials/base") ?>

<?= $this->section("content") ?>

<section class="d-flex justify-content-center">
  <div class="mb-5 mt-3">
    <h4 class="mb-3 text-center">Sign in to Your Account</h4>

    <?php if (session()->getFlashdata("success") !== NULL) : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata("success") ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata("error") !== NULL) : ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata("error") ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>

    <?php $validation = \Config\Services::validation() ?>
    <form action="<?= base_url("login") ?>" method="POST" class="border p-4 mb-2" style="min-width: 350px;">
      <?= csrf_field() ?>
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control <?php if ($validation->getError('email')) : ?>is-invalid<?php endif ?>" id="email" value="<?= set_value('email'); ?>">
        <?php if ($validation->getError('email')) : ?>
          <div class="invalid-feedback">
            <?= $validation->getError('email') ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" type="password" name="password" class="form-control <?php if ($validation->getError('password')) : ?>is-invalid<?php endif ?>" id="password" value="<?= set_value('password'); ?>">
        <?php if ($validation->getError('password')) : ?>
          <div class="invalid-feedback">
            <?= $validation->getError('password') ?>
          </div>
        <?php endif; ?>
      </div>
      <button type="submit" class="btn text-white w-100 mt-4" style="background-color: #7FAD39;">Sign in</button>
    </form>
    <span>Don't have an account? <a href="/register" class="text-primary text-underline">Register here</a></span>
  </div>
</section>

<?= $this->endSection() ?>