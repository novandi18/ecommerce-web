<?= $this->extend("partials/base") ?>

<?= $this->section("content") ?>

<section class="breadcrumb-section set-bg" data-setbg="<?= base_url("modules/img/breadcrumb.png") ?>">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="breadcrumb__text">
          <h2>Transaction Details</h2>
          <div class="breadcrumb__option text-white">
            <a href="/">Home</a> / <a href="/profile">Profile</a> / <a href="/profile/transaction">Transaction</a> / <span>Transaction Details</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="bg-light py-2" style="border-bottom: 1px solid #ddd;">
  <nav class="nav container">
    <a class="nav-link <?= $_SERVER["REQUEST_URI"] === '/profile' ? 'font-weight-bold' : '' ?>" style="color: black;" href="/profile">Profile</a>
    <a class="nav-link <?= strpos($_SERVER["REQUEST_URI"], '/profile/transaction') !== false ? 'font-weight-bold' : '' ?>" style="color: black;" href="/profile/transaction">Transaction</a>
    <a class="nav-link <?= strpos($_SERVER["REQUEST_URI"], '/profile/change_password') !== false ? 'font-weight-bold' : '' ?>" style="color: black;" href="/profile/change_password">Change Password</a>
  </nav>
</section>

<section class="container mb-4">
  <div class="mb-4 mt-4 py-4">
    <a href="/profile/transaction<?= $transactions[0]->status == '1' ? '' : ($transactions[0]->status != '2' ? '/processed' : '/shipped') ?>" class="mb-4 btn btn-light" style="display: inline-block; color: black">
      <i class="fa fa-arrow-left mr-2"></i>
      Back
    </a>

    <div class="d-flex" style="gap: 2em;">
      <img src=<?= base_url("modules/img/gallery/" . preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($transactions[0]->category))) . "/" . $transactions[0]->photo) ?> class="img-thumbnail" alt="Image" style="width: 200px; height: 200px">
      <div>
        <span class="px-3" style="background-color: #eee; border-radius: 25px; font-size: .8em"><?= $transactions[0]->category ?></span>
        <h3 class="mt-2"><?= $transactions[0]->product ?></h3>
        <div class="mt-2" style="display: grid; grid-template-columns: 1fr 4fr">
          <div style="display: flex; flex-direction: column">
            <span>Price</span>
            <span>Color</span>
            <span>Size</span>
            <span>Quantity</span>
            <span>Status</span>
          </div>
          <div style="display: flex; flex-direction: column;">
            <span>: <strong><?= "Rp " . number_format($transactions[0]->price, 0, "", ",") ?></strong></span>
            <span>: <strong><?= $transactions[0]->color ?></strong></span>
            <span>: <strong><?= $transactions[0]->size ?></strong></span>
            <span>: <strong><?= $transactions[0]->quantity ?></strong></span>
            <span>: <span class="badge badge-warning"><?= $transactions[0]->status == '1' ? 'waiting for payment' : ($transactions[0]->status == '2' ? 'pending payment' : 'processed') ?></span></span>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-4 border py-3 px-4 shadow-sm" style="border-radius: 10px;">
      <div class="mb-4">
        <span style="font-size: 1.5em; font-weight: 800">Shipping to</span>
      </div>
      <div class="mt-2" style="display: grid; grid-template-columns: 1fr 8fr">
        <div style="display: flex; flex-direction: column">
          <span>Address</span>
          <span>City</span>
          <span>Province</span>
          <span>Postcode / ZIP</span>
          <span>Phone Number</span>
        </div>
        <div style="display: flex; flex-direction: column;">
          <span>: <strong><?= $transactions[0]->address ?></strong></span>
          <span>: <strong><?= $transactions[0]->city ?></strong></span>
          <span>: <strong><?= $transactions[0]->province ?></strong></span>
          <span>: <strong><?= $transactions[0]->postcode ?></strong></span>
          <span>: <strong><?= $transactions[0]->phone ?></strong></span>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>