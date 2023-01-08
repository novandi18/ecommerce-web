<?= $this->extend("partials/base") ?>

<?= $this->section("content") ?>

<section class="breadcrumb-section set-bg" data-setbg="<?= base_url("modules/img/breadcrumb.png") ?>">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="breadcrumb__text">
          <h2>Checkout</h2>
          <div class="breadcrumb__option text-white">
            <a href="/">Home</a> / <span>Checkout</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="checkout spad">
  <div class="container">
    <div class="checkout__form">
      <h4>Billing Details</h4>
      <form action="<?= base_url('/checkout') ?>" method="POST">
        <div class="row">
          <div class="col-lg-8 col-md-6 d-flex" style="flex-direction: column;">
            <div class="checkout__input">
              <p>Full Name<span>*</span></p>
              <input type="text" value="<?= $user->user_name ?>" name="name" disabled required>
              <span class="text-secondary" style="font-size: .8em;">Change this field on your profile.</span>
            </div>
            <div class="checkout__input">
              <p>Email<span>*</span></p>
              <input type="text" value="<?= $user->email ?>" name="email" disabled required>
              <span class="text-secondary" style="font-size: .8em;">Change this field on your profile.</span>
            </div>
            <div class="checkout__input">
              <p>Address<span>*</span></p>
              <?php if (count($address) > 0) : ?>
                <select name="address" class="w-100">
                  <?php foreach ($address as $a) : ?>
                    <option value="<?= $a->id_address ?>"><?= $a->title ?> &#8226; <?= $a->address ?> &#8226; <?= $a->phone_number ?></option>
                  <?php endforeach ?>
                </select>
              <?php else : ?>
                <span class="text-secondary">No address found, please <a href="/profile">add a new address</a>.</span>
              <?php endif ?>
            </div>
            <div class="checkout__input">
              <p>Order notes</p>
              <input type="text" placeholder="Notes about your order, e.g. special notes for delivery." name="notes">
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="checkout__order">
              <h4>Your Order</h4>
              <div class="checkout__order__products">
                <span>Products</span>
                <span>Total</span>
              </div>
              <ul>
                <?php foreach ($results as $result) : ?>
                  <li>
                    <div class="text-truncate"><?= $result->quantity . " x " . $result->product_name ?></div>
                    <div><?= "Rp " . number_format($result->price * $result->quantity, 0, "", ",") ?></div>
                  </li>
                <?php endforeach; ?>
              </ul>
              <div class="checkout__order__subtotal">
                <div>
                  <span>Subtotal</span>
                  <span><?= "Rp " . number_format($cart["total"], 0, "", ",") ?></span>
                </div>
                <div>
                  <span>Shipping</span>
                  <span>Free</span>
                </div>
                <div>
                  <span>Services</span>
                  <span>Rp 1,000</span>
                </div>
              </div>
              <div class="checkout__order__total">Total <span><?= "Rp " . number_format($cart["total"] + 1000, 0, "", ",") ?></span></div>
              <input type="text" name="total" value="<?= $cart["total"] + 1000 ?>" hidden>
              <button type="submit" class="site-btn" <?= count($address) > 0 ? '' : 'disabled' ?>>PLACE ORDER</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<?= $this->endSection() ?>