<?= $this->extend("partials/base") ?>

<?= $this->section("content") ?>

<section class="breadcrumb-section set-bg" data-setbg="<?= base_url("modules/img/breadcrumb.png") ?>">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="breadcrumb__text">
          <h2>Change Password</h2>
          <div class="breadcrumb__option text-white">
            <a href="/">Home</a> / <a href="/profile">Profile</a> / <span>Change Password</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="bg-light py-2" style="border-bottom: 1px solid #ddd;">
  <nav class="nav container">
    <a class="nav-link <?= $_SERVER["REQUEST_URI"] == '/profile' ? 'font-weight-bold' : '' ?>" style="color: black;" href="/profile">Profile</a>
    <a class="nav-link <?= $_SERVER["REQUEST_URI"] == '/profile/transaction' ? 'font-weight-bold' : '' ?>" style="color: black;" href="/profile/transaction">Transaction</a>
    <a class="nav-link <?= $_SERVER["REQUEST_URI"] == '/profile/change_password' ? 'font-weight-bold' : '' ?>" style="color: black;" href="/profile/change_password">Change Password</a>
  </nav>
</section>

<section class="container mb-4">
  <?php if (session()->getFlashdata("error") !== NULL) : ?>
    <div class="alert alert-danger alert-dismissible mt-4 fade show" role="alert">
      <?= session()->getFlashdata("error") ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif; ?>

  <?php $validation = \Config\Services::validation() ?>

  <div class="mb-4 mt-4">
    <form action="<?= base_url('profile/change_password') ?>" method="POST" class="p-3 border border-danger">
      <?= csrf_field() ?>
      <div class="mb-4">
        <h5 style="font-weight: 700;" class="text-danger">Change Password</h5>
        <span class="text-danger" style="font-size: .8em;">You will automatically logout after change your password.</span>
      </div>
      <div class="mb-3">
        <label for="current_password" class="form-label">Current Password</label>
        <input type="password" class="form-control <?php if ($validation->getError('current_password')) : ?>is-invalid<?php endif ?>" id="current_password" name="current_password" placeholder="Enter your current password...">
        <?php if ($validation->getError('current_password')) : ?>
          <div class="invalid-feedback">
            <?= $validation->getError('current_password') ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="new_password" class="form-label">New Password</label>
        <input type="password" class="form-control <?php if ($validation->getError('new_password')) : ?>is-invalid<?php endif ?>" id="new_password" name="new_password" placeholder="Enter your new password...">
        <?php if ($validation->getError('new_password')) : ?>
          <div class="invalid-feedback">
            <?= $validation->getError('new_password') ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="confirm_password" class="form-label">Confirm New Password</label>
        <input type="password" class="form-control <?php if ($validation->getError('confirm_password')) : ?>is-invalid<?php endif ?>" id="confirm_password" name="confirm_password" placeholder="Enter your confirm new password...">
        <?php if ($validation->getError('confirm_password')) : ?>
          <div class="invalid-feedback">
            <?= $validation->getError('confirm_password') ?>
          </div>
        <?php endif; ?>
      </div>

      <button type="submit" class="btn btn-danger mt-4">Update Password</button>
    </form>
  </div>
</section>

<?= $this->endSection() ?>