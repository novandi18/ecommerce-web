<?= $this->extend("partials/base") ?>

<?= $this->section("content") ?>

<section class="d-flex justify-content-center">
  <div class="mb-5 mt-3">
    <h4 class="mb-3 text-center">Sign up Account</h4>

    <?php if (session()->getFlashdata("error") !== NULL) : ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata("error") ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>

    <?php $validation = \Config\Services::validation() ?>
    <form action="<?= base_url('register') ?>" method="POST" class="border p-4 mb-2" style="min-width: 350px;">
      <?= csrf_field() ?>
      <div class="mb-3">
        <label for="name" class="form-label">Full name</label>
        <input type="text" name="name" class="form-control <?php if ($validation->getError('name')) : ?>is-invalid<?php endif ?>" id="name" value="<?= set_value('name'); ?>">
        <?php if ($validation->getError('name')) : ?>
          <div class="invalid-feedback">
            <?= $validation->getError('name') ?>
          </div>
        <?php endif; ?>
      </div>
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
      <div class="mb-3">
        <label for="password_confirm" class="form-label">Confirm Password</label>
        <input type="password" type="password_confirm" name="password_confirm" class="form-control <?php if ($validation->getError('password_confirm')) : ?>is-invalid<?php endif ?>" id="password_confirm" value="<?= set_value('password_confirm'); ?>">
        <?php if ($validation->getError('password_confirm')) : ?>
          <div class="invalid-feedback">
            <?= $validation->getError('password_confirm') ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <div class="form-check">
          <input type="checkbox" class="form-check-input" name="accept" id="accept" value="accept" required checked>
          <label class="form-check-label" for="accept"><span class="text-danger">*</span> I accept to <a href="https://www.termsandconditionsgenerator.com/live.php?token=JSzHi20VVW4ymGpXP5Tv8aDJrNg6eEFs" target="_blank" class="text-primary">terms and conditions</a></label>
        </div>
        <?php if ($validation->getError('accept')) : ?>
          <div class="invalid-feedback">
            <?= $validation->getError('accept') ?>
          </div>
        <?php endif; ?>
      </div>
      <button type="submit" class="btn text-white w-100 mt-2" style="background-color: #7FAD39;">Sign up</button>
    </form>
    <span>Have an account? <a href="/login" class="text-primary text-underline">login here</a></span>
  </div>
</section>

<?= $this->endSection() ?>