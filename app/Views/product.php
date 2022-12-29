<?= $this->extend("partials/base") ?>

<?= $this->section("content") ?>

<section class="spad">
  <div class="container">
    <?php if (@session()->getFlashdata("error")) : ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata("error") ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>

    <?php if (@session()->getFlashdata("success")) : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata("success") ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>

    <div class="row">
      <?php if (!session()->isLoggedIn) : ?>
        <div class="alert alert-danger mb-4 mx-3 w-100" role="alert">
          <h4 class="alert-heading">You cannot buy this product</h4>
          <p class="mb-0 mt-1">You must <a href="/login" class="text-danger" style="text-decoration: underline;">login</a> with your account to buy this product. If you do not have an account, you can <a href="/register" class="text-danger" style="text-decoration: underline;">register here</a>.</p>
        </div>
      <?php endif; ?>

      <div class="col-lg-6 col-md-6 mt-2">
        <div class="product__details__pic">
          <div class="product__details__pic__item">
            <img class="product__details__pic__item--large" src="<?= base_url('modules/img/gallery/' . $category . '/' . $product[0]->photo) ?>" alt="Photo">
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6">
        <div class="product__details__text">
          <span class="text-secondary"><?= $product[0]->category ?></span>
          <h3><?= $product[0]->product_name ?></h3>
          <span><?= $product[0]->sold ?> Sold</span>
          <div class="product__details__price"><?= "Rp. " . number_format($product[0]->price, 0, "", ",") ?></div>
          <?php if (session()->isLoggedIn) : ?>
            <form action="<?= base_url('/cart/add') ?>" method="post">
              <?= csrf_field() ?>
              <input type="text" name="url" value="<?= str_replace('/index.php', '', $_SERVER['PHP_SELF']) ?>" hidden>
              <input type="text" name="product" value="<?= $product[0]->id_product ?>" hidden>
              <div class="mb-4">
                <span>Color</span>
                <div class="product__details__tab">
                  <ul class="nav nav-tabs mt-2" role="tablist" style="gap: 10px;">
                    <?php foreach ($sizecolor as $sc) : ?>
                      <li class="nav-item border rounded px-3">
                        <a class="nav-link <?= $sizecolor[0]->id === $sc->id ? 'active' : '' ?>" data-toggle="tab" href="#tabs-<?= $sc->id ?>" role="tab" aria-selected="true" onclick="selectColor(<?= $sc->id ?>)"><?= $sc->color ?></a>
                        <input type="radio" name="color" id="tabs-color-<?= $sc->id ?>" value="<?= $sc->id ?>" <?= $sizecolor[0]->id === $sc->id ? 'checked' : '' ?> hidden>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                  <div class="tab-content mt-3">
                    <span>Size</span>
                    <?php foreach ($sizecolor as $sc) : ?>
                      <div class="tab-pane mt-2 <?= $sizecolor[0]->id === $sc->id ? 'active' : '' ?>" id="tabs-<?= $sc->id ?>" role="tabpanel">
                        <div class="product__details__tab__desc d-flex" style="gap: 5px;">
                          <div class="d-flex border px-2 rounded" style="gap: 5px;">
                            <input type="radio" name="size" style="cursor: pointer;" <?= $sc->size35 < 1 ? "disabled" : "" ?> value="35">
                            <label class="<?= $sc->size35 < 1 ? 'text-secondary' : '' ?>" style="margin-top: .45em;">35</label>
                          </div>
                          <div class="d-flex border px-2 rounded" style="gap: 5px;">
                            <input type="radio" name="size" style="cursor: pointer;" <?= $sc->size36 < 1 ? "disabled" : "" ?> value="36">
                            <label class="<?= $sc->size36 < 1 ? 'text-secondary' : '' ?>" style="margin-top: .45em;">36</label>
                          </div>
                          <div class="d-flex border px-2 rounded" style="gap: 5px;">
                            <input type="radio" name="size" style="cursor: pointer;" <?= $sc->size37 < 1 ? "disabled" : "" ?> value="37">
                            <label class="<?= $sc->size37 < 1 ? 'text-secondary' : '' ?>" style="margin-top: .45em;">37</label>
                          </div>
                          <div class="d-flex border px-2 rounded" style="gap: 5px;">
                            <input type="radio" name="size" style="cursor: pointer;" <?= $sc->size38 < 1 ? "disabled" : "" ?> value="38">
                            <label class="<?= $sc->size38 < 1 ? 'text-secondary' : '' ?>" style="margin-top: .45em;">38</label>
                          </div>
                          <div class="d-flex border px-2 rounded" style="gap: 5px;">
                            <input type="radio" name="size" style="cursor: pointer;" <?= $sc->size39 < 1 ? "disabled" : "" ?> value="39">
                            <label class="<?= $sc->size39 < 1 ? 'text-secondary' : '' ?>" style="margin-top: .45em;">39</label>
                          </div>
                          <div class="d-flex border px-2 rounded" style="gap: 5px;">
                            <input type="radio" name="size" style="cursor: pointer;" <?= $sc->size40 < 1 ? "disabled" : "" ?> value="40">
                            <label class="<?= $sc->size40 < 1 ? 'text-secondary' : '' ?>" style="margin-top: .45em;">40</label>
                          </div>
                          <div class="d-flex border px-2 rounded" style="gap: 5px;">
                            <input type="radio" name="size" style="cursor: pointer;" <?= $sc->size41 < 1 ? "disabled" : "" ?> value="41">
                            <label class="<?= $sc->size41 < 1 ? 'text-secondary' : '' ?>" style="margin-top: .45em;">41</label>
                          </div>
                          <div class="d-flex border px-2 rounded" style="gap: 5px;">
                            <input type="radio" name="size" style="cursor: pointer;" <?= $sc->size42 < 1 ? "disabled" : "" ?> value="42">
                            <label class="<?= $sc->size42 < 1 ? 'text-secondary' : '' ?>" style="margin-top: .45em;">42</label>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
              <div class="product__details__quantity">
                <div class="quantity">
                  <div class="pro-qty">
                    <input type="text" name="quantity" value="1" min="1" max="100">
                  </div>
                </div>
              </div>
              <button type="submit" class="primary-btn btn">ADD TO CART</button>
            </form>
          <?php endif; ?>
          <ul class="mt-4">
            <li><b>Availability</b> <span>In Stock</span></li>
            <li><b>Shipping</b> <span>3 day shipping.</span></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="product__details__tab" style="margin-top: 85px;">
          <hr>
          <div class="tab-content">
            <div class="tab-pane active" id="tabs-1" role="tabpanel">
              <div class="product__details__tab__desc">
                <h6>Products Infomation</h6>
                <p><?= $product[0]->description ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
<section class="related-product">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title related__product__title">
          <h2>Related Product</h2>
        </div>
      </div>
    </div>
    <div class="row">
      <?php foreach ($related as $relate) : ?>
        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="product__item">
            <div class="product__item__pic set-bg" data-setbg="<?= base_url('modules/img/gallery/' . $category . '/' . $relate->photo) ?>">
              <ul class="product__item__pic__hover">
                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
              </ul>
            </div>
            <div class="product__item__text">
              <span style="font-size: .8em;" class="text-secondary"><?= $product[0]->category ?></span>
              <h6><a href="/shop/<?= $category . '/' . str_replace(' ', '-', strtolower($relate->product_name)) ?>"><?= $relate->product_name ?></a></h6>
              <h5><?= "Rp. " . number_format($relate->price, 0, "", ",") ?></h5>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?= $this->endSection() ?>