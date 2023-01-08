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
    <a class="nav-link font-weight-bold" style="color: black;" href="/profile">Profile</a>
    <a class="nav-link" style="color: black;" href="/profile/transaction">Transaction</a>
    <a class="nav-link" style="color: black;" href="/profile/change_password">Change Password</a>
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
    <form action="<?= base_url('profile') ?>" method="POST" class="border p-3 rounded shadow-sm">
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

      <button type="submit" class="btn text-white mt-4" style="background-color: #7FAD39;">Update Profile</button>
    </form>

    <div class="mt-4 mb-5 p-3 border rounded shadow-sm">
      <span style="font-size: 1.2em;">Address</span>
      <div id="accordion" class="mt-3">
        <?php foreach ($address as $a) : ?>
          <div class="card">
            <div class="card-header d-flex justify-content-between" style="align-items: center;">
              <a class="card-link text-dark font-weight-bold" data-toggle="collapse" href="#address<?= $a->id_address ?>">
                <?= $a->title ?>
              </a>
              <div class="d-flex" style="gap: .4em;">
                <a href="/profile/address/<?= $a->id_address ?>/edit" class="btn btn-success py-1" style="font-size: .8em;">Edit</a>
                <a href="/profile/address/<?= $a->id_address ?>/delete" class="btn btn-danger py-1" style="font-size: .8em;">Delete</a>
              </div>
            </div>
            <div id="address<?= $a->id_address ?>" class="collapse" data-parent="#accordion">
              <div class="card-body" style="display: grid; gap: 1.5em; grid-template-columns: 1fr 1fr;">
                <div class="d-flex" style="flex-direction: column;">
                  <span style="font-size: .8em;" class="text-secondary">Address</span>
                  <span><?= $a->address ?></span>
                </div>
                <div class="d-flex" style="flex-direction: column;">
                  <span style="font-size: .8em;" class="text-secondary">City</span>
                  <span><?= $a->city ?></span>
                </div>
                <div class="d-flex" style="flex-direction: column;">
                  <span style="font-size: .8em;" class="text-secondary">Province</span>
                  <span><?= $a->province ?></span>
                </div>
                <div class="d-flex" style="flex-direction: column;">
                  <span style="font-size: .8em;" class="text-secondary">Postcode</span>
                  <span><?= $a->postcode ?></span>
                </div>
                <div class="d-flex" style="flex-direction: column;">
                  <span style="font-size: .8em;" class="text-secondary">Phone Number</span>
                  <span><?= $a->phone_number ?></span>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach ?>

        <div class="card">
          <div class="card-header">
            <a class="collapsed card-link text-primary font-weight-bold" data-toggle="collapse" href="#newaddress">
              <i class="fa fa-plus mr-2"></i> New Address
            </a>
          </div>
          <div id="newaddress" class="collapse show" data-parent="#accordion">
            <div class="card-body">
              <form action="<?= base_url('/profile/address/new') ?>" method="post">
                <?= csrf_field() ?>
                <div style="display: grid; gap: 1.5em; grid-template-columns: 1fr 1fr;">
                  <div>
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?php if ($validation->getError('title')) : ?>is-invalid<?php endif ?>" name="title" id="title" value="<?= set_value('title'); ?>" placeholder="Enter your title address...">
                    <?php if ($validation->getError('title')) : ?>
                      <div class="invalid-feedback">
                        <?= $validation->getError('title') ?>
                      </div>
                    <?php endif; ?>
                  </div>
                  <div>
                    <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?php if ($validation->getError('address')) : ?>is-invalid<?php endif ?>" name="address" id="address" value="<?= set_value('address'); ?>" placeholder="Enter your address...">
                    <?php if ($validation->getError('address')) : ?>
                      <div class="invalid-feedback">
                        <?= $validation->getError('address') ?>
                      </div>
                    <?php endif; ?>
                  </div>
                  <div>
                    <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?php if ($validation->getError('city')) : ?>is-invalid<?php endif ?>" name="city" id="city" value="<?= set_value('city'); ?>" placeholder="Enter your city address...">
                    <?php if ($validation->getError('city')) : ?>
                      <div class="invalid-feedback">
                        <?= $validation->getError('city') ?>
                      </div>
                    <?php endif; ?>
                  </div>
                  <div>
                    <label for="province" class="form-label">Province <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?php if ($validation->getError('province')) : ?>is-invalid<?php endif ?>" name="province" id="province" value="<?= set_value('province'); ?>" placeholder="Enter your province address...">
                    <?php if ($validation->getError('province')) : ?>
                      <div class="invalid-feedback">
                        <?= $validation->getError('province') ?>
                      </div>
                    <?php endif; ?>
                  </div>
                  <div>
                    <label for="postcode" class="form-label">Postcode <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?php if ($validation->getError('postcode')) : ?>is-invalid<?php endif ?>" name="postcode" id="postcode" value="<?= set_value('postcode'); ?>" placeholder="Enter your postcode address...">
                    <?php if ($validation->getError('postcode')) : ?>
                      <div class="invalid-feedback">
                        <?= $validation->getError('postcode') ?>
                      </div>
                    <?php endif; ?>
                  </div>
                  <div>
                    <label for="phone_number" class="form-label">Phone Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?php if ($validation->getError('phone_number')) : ?>is-invalid<?php endif ?>" name="phone_number" id="phone_number" value="<?= set_value('phone_number'); ?>" placeholder="Enter your phone number for this address...">
                    <?php if ($validation->getError('phone_number')) : ?>
                      <div class="invalid-feedback">
                        <?= $validation->getError('phone_number') ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
                <button type="submit" class="btn mt-4 text-white btn-primary">Create address</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>