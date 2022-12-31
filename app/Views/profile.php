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

<section class="bg-light py-2" style="border-bottom: 1px solid #ddd;">
  <nav class="nav container">
    <a class="nav-link <?= $_SERVER["REQUEST_URI"] == '/profile' ? 'font-weight-bold' : '' ?>" style="color: black;" href="/profile">Profile</a>
    <a class="nav-link <?= $_SERVER["REQUEST_URI"] == '/profile/transaction' ? 'font-weight-bold' : '' ?>" style="color: black;" href="/profile/transaction">Transaction</a>
    <a class="nav-link <?= $_SERVER["REQUEST_URI"] == '/profile/change_password' ? 'font-weight-bold' : '' ?>" style="color: black;" href="/profile/change_password">Change Password</a>
  </nav>
</section>

<section class="container mb-4">
  <?php if (session()->getFlashdata("success") !== NULL) : ?>
    <div class="alert alert-success alert-dismissible mt-4 fade show" role="alert">
      <?= session()->getFlashdata("success") ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif; ?>

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
    <form action="<?= base_url('profile') ?>" method="POST">
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
  </div>
</section>

<?= $this->endSection() ?>