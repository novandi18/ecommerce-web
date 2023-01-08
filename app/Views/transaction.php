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
    <a class="nav-link" style="color: black;" href="/profile/transaction/canceled">Canceled</a>
    <a class="nav-link font-weight-bold" style="color: black;" href="/profile/transaction">Waiting for Payment</a>
    <a class="nav-link" style="color: black;" href="/profile/transaction/processed">Processed</a>
    <a class="nav-link" style="color: black;" href="/profile/transaction/shipped">Shipped</a>
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

  <div class="mb-4 mt-4">
    <?php if (count($transactions) > 0) : ?>
      <table class="table mb-5">
        <thead>
          <tr>
            <th scope="col">Product</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total</th>
            <th scope="col">Order Time</th>
            <th scope="col">Payment Deadline</th>
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
              <td><?= date("H:i:s", strtotime($transaction->order)) ?></td>
              <td class="deadlinepay" data-order="<?= $transaction->order ?>"><?= $transaction->payment_deadline !== NULL ? $transaction->payment_deadline : '' ?></td>
              <td><span class="badge badge-<?= $transaction->status == '1' ? 'warning' : 'secondary' ?>" data-order="<?= $transaction->order ?>"><?= $transaction->status == '1' ? 'waiting' : 'pending' ?></span></td>
              <td class="border-right"><a href="/profile/transaction/detail/<?= $transaction->id_transaction ?>" class="btn btn-primary" style="font-size: .8em;">VIEW</a></td>
              <?php if ($i === 0 || ($transactions[$i - 1]->order !== $transaction->order)) : ?>
                <td style="display: flex; justify-content: center; flex-direction: column; gap: .3em" rowspan="3">
                  <button type="button" class="btn btn-warning continuepay-btn" style="font-size: .8em;" data-order="<?= $transaction->order ?>" data-orderid="<?= $transaction->order_id !== NULL ? $transaction->order_id : '' ?>" data-token="<?= $transaction->snap_token !== NULL ? $transaction->snap_token : '' ?>" onclick="continuePay(this)" <?= $transaction->status == '2' ? '' : 'hidden' ?>>CONTINUE PAY</button>
                  <div>
                    <?php foreach ($transactions as $t) : ?>
                      <?php if ($t->order == $transaction->order) : ?>
                        <input type="text" name="transaction[]" value="<?= $t->id_transaction ?>" data-order="<?= $transaction->order ?>" hidden>
                      <?php endif ?>
                    <?php endforeach ?>
                    <button type="button" class="btn btn-success buy-button w-100" onclick="buy(this, '<?= $transaction->order ?>')" style="font-size: .8em;" <?= $transaction->status == '1' ? '' : 'hidden' ?>>BUY NOW</button>
                  </div>
                  <form action="<?= base_url('/profile/transaction/cancel') ?>" method="POST">
                    <?php foreach ($transactions as $t) : ?>
                      <?php if ($t->order == $transaction->order) : ?>
                        <input type="text" name="transaction[]" value="<?= $t->id_transaction ?>" hidden>
                      <?php endif ?>
                    <?php endforeach ?>
                    <button class="btn btn-danger w-100" style="font-size: .8em;">CANCEL</button>
                  </form>
                </td>
              <?php endif ?>
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