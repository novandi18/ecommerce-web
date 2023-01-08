<?= $this->extend("partials/base") ?>

<?= $this->section("content") ?>

<section class="breadcrumb-section set-bg" data-setbg="<?= base_url("modules/img/breadcrumb.png") ?>">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="breadcrumb__text">
          <h2><?= explode(" ", session()->get("name"))[0]; ?>'s Profile</h2>
          <div class="breadcrumb__option text-white">
            <a href="/">Home</a> / <a href="/profile">Profile</a> / <span>Edit Address</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="bg-light py-2" style="border-bottom: 1px solid #ddd;">
  <nav class="nav container">
    <a class="nav-link font-weight-bold" style="color: black;" href="/profile">Profile</a>
    <a class="nav-link" style="color: black;" href="/profile/transaction">Transaction</a>
    <a class="nav-link" style="color: black;" href="/profile/change_password">Change Password</a>
  </nav>
</section>

<section class="container mb-4">
  <?php $validation = \Config\Services::validation() ?>

  <div class="mb-4 mt-4">
    <h3 class="mb-4">Edit Address</h3>
    <form action="<?= base_url('/profile/address/edit') ?>" method="POST" class="border p-3 rounded shadow-sm">
      <?= csrf_field() ?>
      <input type="text" name="id_address" value="<?= $address->id_address ?>" hidden>
      <div class="mb-3">
        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control <?php if ($validation->getError('title')) : ?>is-invalid<?php endif ?>" name="title" id="title" placeholder="Enter your title..." value="<?= $address->title ?>">
        <?php if ($validation->getError('title')) : ?>
          <div class="invalid-feedback">
            <?= $validation->getError('title') ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
        <input type="text" class="form-control <?php if ($validation->getError('address')) : ?>is-invalid<?php endif ?>" name="address" id="address" placeholder="Enter your address..." value="<?= $address->address ?>">
        <?php if ($validation->getError('address')) : ?>
          <div class="invalid-feedback">
            <?= $validation->getError('address') ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="city" class="form-label">City <span class="text-danger">*</span></label>
        <input type="text" class="form-control <?php if ($validation->getError('city')) : ?>is-invalid<?php endif ?>" name="city" id="city" placeholder="Enter your city..." value="<?= $address->city ?>">
        <?php if ($validation->getError('city')) : ?>
          <div class="invalid-feedback">
            <?= $validation->getError('city') ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="province" class="form-label">Province <span class="text-danger">*</span></label>
        <input type="text" class="form-control <?php if ($validation->getError('province')) : ?>is-invalid<?php endif ?>" name="province" id="province" placeholder="Enter your province..." value="<?= $address->province ?>">
        <?php if ($validation->getError('province')) : ?>
          <div class="invalid-feedback">
            <?= $validation->getError('province') ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="postcode" class="form-label">Postcode <span class="text-danger">*</span></label>
        <input type="text" class="form-control <?php if ($validation->getError('postcode')) : ?>is-invalid<?php endif ?>" name="postcode" id="postcode" placeholder="Enter your postcode..." value="<?= $address->postcode ?>">
        <?php if ($validation->getError('postcode')) : ?>
          <div class="invalid-feedback">
            <?= $validation->getError('postcode') ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="phone_number" class="form-label">Phone Number <span class="text-danger">*</span></label>
        <input type="text" class="form-control <?php if ($validation->getError('phone_number')) : ?>is-invalid<?php endif ?>" name="phone_number" id="phone_number" placeholder="Enter your phone_number..." value="<?= $address->phone_number ?>">
        <?php if ($validation->getError('phone_number')) : ?>
          <div class="invalid-feedback">
            <?= $validation->getError('phone_number') ?>
          </div>
        <?php endif; ?>
      </div>

      <button type="submit" class="btn text-white mt-4" style="background-color: #7FAD39;">Update Address</button>
    </form>

  </div>
</section>

<?= $this->endSection() ?>