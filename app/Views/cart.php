<?= $this->extend("partials/base") ?>

<?= $this->section("content") ?>

<section class="breadcrumb-section set-bg" data-setbg="<?= base_url("modules/img/breadcrumb.png") ?>">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="breadcrumb__text">
          <h2>Your Cart</h2>
          <div class="breadcrumb__option text-white">
            <a href="/">Home</a>
            /
            <span>Cart</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="shoping-cart spad">
  <div class="container">

    <?php if (@session()->getFlashdata("success")) : ?>
      <div class="alert alert-success alert-dismissible mt-2 fade show" role="alert">
        <?= session()->getFlashdata("success") ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>

    <?php if (@session()->getFlashdata("error")) : ?>
      <div class="alert alert-danger alert-dismissible mt-2 fade show" role="alert">
        <?= session()->getFlashdata("error") ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>

    <?php if ($cart["qty"] > 0) : ?>
      <div class="row mt-5">
        <div class="col-lg-12">
          <div class="shoping__cart__table">
            <table>
              <thead>
                <tr>
                  <th class="shoping__product">Products</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($results as $result) : ?>
                  <tr>
                    <td class="shoping__cart__item">
                      <img src="<?= base_url('modules/img/gallery/' . preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($result->category_name))) . "/" . $result->photo) ?>" width="100">
                      <div class="d-flex" style="flex-direction: column;">
                        <span class="text-secondary"><?= $result->category_name ?></span>
                        <a href="/shop/<?= preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($result->category_name))) . '/' . str_replace(' ', '-', strtolower($result->product_name)) ?>" style="font-weight: 600; font-size: 1.4em; color: black"><?= $result->product_name ?></a>
                        <span class="mt-1" style="font-size: .8em;">Color: <strong><?= $result->color ?></strong> &#8226; Size: <strong><?= $result->size ?></strong></span>
                      </div>
                    </td>
                    <td class="shoping__cart__price">
                      <?= "Rp " . number_format($result->price, 0, "", ",") ?>
                    </td>
                    <td class="shoping__cart__quantity">
                      <div class="quantity">
                        <div class="pro-qty">
                          <input type="text" data-qty=<?= $i++ ?> value="<?= $result->quantity ?>" min="1" max="100">
                        </div>
                      </div>
                    </td>
                    <td>
                      <a href="<?= base_url('/cart/delete/' . $result->id) ?>" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6"></div>
        <div class="col-lg-6">
          <div class="p-0 mt-2 d-flex" style="justify-content: flex-end;">
            <form action="<?= base_url('/cart/checkout') ?>" method="post" id="checkout">
              <?= csrf_field() ?>
              <?php $i = 1;
              foreach ($results as $result) : ?>
                <input type="text" name="qty[]" id="checkout-<?= $i++ ?>" value="<?= $result->quantity ?>" hidden>
                <input type="text" name="cart[]" value="<?= $result->id ?>" hidden>
              <?php endforeach; ?>
              <button type="submit" name="checkout" class="primary-btn btn">PROCEED TO CHECKOUT</button>
            </form>
          </div>
        </div>
      </div>
    <?php else : ?>
      <div class="row d-flex justify-content-center">
        <div class="d-flex" style="flex-direction: column;">
          <img src="<?= base_url('modules/img/nodata.svg') ?>" alt="No Data" width="500">
          <span class="text-center" style="font-weight: 700; font-size: 2em">No product in your cart.</span>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>

<?= $this->endSection() ?>