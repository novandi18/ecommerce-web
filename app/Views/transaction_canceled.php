<?= $this->extend("partials/base") ?>

<?= $this->section("content") ?>

<section class="breadcrumb-section set-bg" data-setbg="<?= base_url("modules/img/breadcrumb.png") ?>">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="breadcrumb__text">
          <h2>Transaction</h2>
          <div class="breadcrumb__option text-white">
            <a href="/">Home</a> / <a href="/profile">Profile</a> / <span>Transaction</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="bg-light py-2" style="border-bottom: 1px solid #ddd;">
  <nav class="nav container">
    <a class="nav-link" style="color: black;" href="/profile">Profile</a>
    <a class="nav-link font-weight-bold" style="color: black;" href="/profile/transaction">Transaction</a>
    <a class="nav-link" style="color: black;" href="/profile/change_password">Change Password</a>
  </nav>
</section>

<section class="bg-light py-2 my-4 container d-flex justify-content-center" style="border: 1px solid #ddd; border-radius: 25px">
  <nav class="nav">
    <a class="nav-link font-weight-bold" style="color: black;" href="/profile/transaction/canceled">Canceled</a>
    <a class="nav-link" style="color: black;" href="/profile/transaction">Waiting for Payment</a>
    <a class="nav-link" style="color: black;" href="/profile/transaction/processed">Processed</a>
    <a class="nav-link" style="color: black;" href="/profile/transaction/shipped">Shipped</a>
  </nav>
</section>

<section class="container mb-4">
  <div class="mb-4 mt-4">
    <?php if (count($transactions) > 0) : ?>
      <table class="table mb-5">
        <thead>
          <tr>
            <th scope="col">Product</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total</th>
            <th scope="col">Order</th>
            <th scope="col">Status</th>
            <th scope="col">Details</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0;
          $row = 1;
          foreach ($transactions as $transaction) : ?>
            <?php if ($i === 0 || (date("d F Y", strtotime($transactions[$i - 1]->order)) !== date("d F Y", strtotime($transaction->order)))) : ?>
              <tr>
                <td colspan="8" class="bg-info text-white text-center py-1" style="font-size: .8em;"><?= date("d F Y", strtotime($transaction->order)) ?></td>
              </tr>
            <?php endif ?>
            <tr>
              <td><?= $transaction->product_name ?></td>
              <td><?= $transaction->quantity ?></td>
              <td><?= "Rp " . number_format($transaction->total, 0, "", ",") ?></td>
              <td><?= date("d F Y", strtotime($transaction->order)) ?></td>
              <td><span class="badge badge-danger">canceled</span></td>
              <td><a href="/profile/transaction/detail/<?= $transaction->id_transaction ?>" class="btn btn-primary" style="font-size: .8em;">VIEW</a></td>
            </tr>
          <?php $i++;
            $row++;
          endforeach; ?>
        </tbody>
      </table>
    <?php else : ?>
      <div class="d-flex justify-content-center mb-5">
        <div class="d-flex" style="flex-direction: column;">
          <img src="<?= base_url('modules/img/nodata.svg') ?>" alt="No Data" width="300">
          <span class="text-center" style="font-weight: 700; font-size: 2em; margin-top: -1em">No transaction.</span>
        </div>
      </div>
    <?php endif ?>
  </div>
</section>

<?= $this->endSection() ?>