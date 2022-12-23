<?= $this->extend("partials/base") ?>

<?= $this->section("content") ?>

<section class="breadcrumb-section set-bg" data-setbg="<?= base_url("modules/img/breadcrumb.png") ?>">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="breadcrumb__text">
          <h2><?= explode(" ", session()->get("name"))[0]; ?>'s Profile</h2>
          <div class="breadcrumb__option text-white">
            <a href="/">Home</a>
            /
            <span>Profile</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="container py-5 mb-4">
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

  <div class="row mb-4" style="gap: 1em;">
    <form action="<?= base_url('profile') ?>" method="POST" class="col">
      <?= csrf_field() ?>
      <div class="mb-3">
        <label for="user_name" class="form-label">Full name <span class="text-danger">*</span></label>
        <input type="text" class="form-control <?php if ($validation->getError('user_name')) : ?>is-invalid<?php endif ?>" name="user_name" id="user_name" placeholder="Enter your full name..." value="<?= $profile->user_name ?>">
        <?php if ($validation->getError('user_name')) : ?>
          <div class="invalid-feedback">
            <?= $validation->getError('user_name') ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email address <span class="text-danger">*</span></label>
        <input type="email" class="form-control <?php if ($validation->getError('email')) : ?>is-invalid<?php endif ?>" name="email" id="email" placeholder="Enter your email..." value="<?= $profile->email ?>">
        <?php if ($validation->getError('email')) : ?>
          <div class="invalid-feedback">
            <?= $validation->getError('email') ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
        <input type="text" class="form-control <?php if ($validation->getError('address')) : ?>is-invalid<?php endif ?>" id="address" name="address" placeholder="Enter your address..." value="<?= $profile->address ?>">
        <?php if ($validation->getError('address')) : ?>
          <div class="invalid-feedback">
            <?= $validation->getError('address') ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="phone_number" class="form-label">Phone Number <span class="text-danger">*</span></label>
        <input type="text" class="form-control <?php if ($validation->getError('phone_number')) : ?>is-invalid<?php endif ?>" id="phone_number" name="phone_number" placeholder="Enter your phone number..." value="<?= $profile->phone_number ?>">
        <?php if ($validation->getError('phone_number')) : ?>
          <div class="invalid-feedback">
            <?= $validation->getError('phone_number') ?>
          </div>
        <?php endif; ?>
      </div>

      <button type="submit" class="btn text-white mt-4" style="background-color: #7FAD39;">Update Profile</button>
    </form>

    <form action="<?= base_url('profile/changepassword') ?>" method="POST" class="col p-3 border border-danger">
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
  </form>
</section>

<?= $this->endSection() ?>