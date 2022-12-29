<?= $this->extend("partials/base") ?>

<?= $this->section("content") ?>

<!-- Banner Begin -->
<div class="banner mb-5">
  <div class="container">
    <div class="banner__pic">
      <img src=<?= base_url("modules/img/banner/banner-2.jpg") ?> alt="Banner">
    </div>
  </div>
</div>
<!-- Banner End -->

<!-- Categories Section Begin -->
<section class="categories">
  <div class="container">
    <div class="row">
      <div class="categories__slider owl-carousel">
        <?php foreach ($categoryProduct as $cp) : ?>
          <div class="col-lg-3">
            <div class="categories__item set-bg" data-setbg=<?= base_url("modules/img/gallery/" . preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($cp->category))) . "/" . $cp->photo) ?>>
              <h5><a href="/shop/<?= preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($cp->category))) ?>"><?= $cp->category ?></a></h5>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
<!-- Categories Section End -->

<section class="featured spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title">
          <h2>Featured Product</h2>
        </div>
        <div class="featured__controls">
          <ul>
            <li class="active" data-filter="*">All</li>
            <?php foreach ($categories as $c) : ?>
              <li data-filter=".<?= preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($c->category_name))) ?>"><?= $c->category_name ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
    <div class="row featured__filter">
      <?php foreach ($featured as $f) : ?>
        <div class="col-lg-3 col-md-4 col-sm-6 mix <?= preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($f->category_name))) ?>">
          <div class="featured__item">
            <div class="featured__item__pic set-bg" data-setbg=<?= base_url("modules/img/gallery/" . preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($f->category_name))) . "/" . $f->photo) ?>>
            </div>
            <div class="featured__item__text">
              <h6><a href="/shop/<?= preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($f->category_name))) . "/" . strtolower(str_replace(' ', '-', $f->product_name)) ?>"><?= $f->product_name ?></a></h6>
              <h5><?= "Rp " . number_format($f->price, 0, "", ",") ?></h5>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- Featured Section End -->

<!-- Banner Begin -->
<div class="banner">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="banner__pic">
          <img src=<?= base_url("modules/img/banner/banner-1.jpg") ?> alt="Banner">
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="banner__pic">
          <img src=<?= base_url("modules/img/banner/banner-3.jpg") ?> alt="Banner">
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Banner End -->

<!-- Latest Product Section Begin -->
<section class="latest-product spad mb-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6">
        <div class="latest-product__text">
          <h4>Latest Products</h4>
          <div class="latest-product__slider owl-carousel">
            <div class="latest-prdouct__slider__item">
              <?php foreach ($latest as $l) : ?>
                <a href="/shop/<?= preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($l->category_name))) . "/" . $l->id_product ?>" class="latest-product__item">
                  <div class="latest-product__item__pic">
                    <img src=<?= base_url("modules/img/gallery/" . preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($l->category_name))) . "/" . $l->photo) ?> alt="latest-products">
                  </div>
                  <div class="latest-product__item__text">
                    <h6><?= $l->product_name ?></h6>
                    <span><?= "Rp " . number_format($l->price, 0, "", ",") ?></span>
                  </div>
                </a>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="latest-product__text">
          <h4>Top Sale Products</h4>
          <div class="latest-product__slider owl-carousel">
            <div class="latest-prdouct__slider__item">
              <?php foreach ($topProducts as $tp) : ?>
                <a href="/shop/<?= preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($l->category_name))) . "/" . strtolower(str_replace(' ', '-', $tp->product_name)) ?>" class="latest-product__item">
                  <div class="latest-product__item__pic">
                    <img src=<?= base_url("modules/img/gallery/" . preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($tp->category_name))) . "/" . $tp->photo) ?> alt="latest-products">
                  </div>
                  <div class="latest-product__item__text">
                    <h6><?= $tp->product_name ?></h6>
                    <span><?= "Rp " . number_format($tp->price, 0, "", ",") ?></span>
                  </div>
                </a>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="latest-product__text">
          <h4>Best Price Products</h4>
          <div class="latest-product__slider owl-carousel">
            <div class="latest-prdouct__slider__item">
              <?php foreach ($bestPrice as $bp) : ?>
                <a href="/shop/<?= preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($l->category_name))) . "/" . strtolower(str_replace(' ', '-', $bp->product_name)) ?>" class="latest-product__item">
                  <div class="latest-product__item__pic">
                    <img src=<?= base_url("modules/img/gallery/" . preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($bp->category_name))) . "/" . $bp->photo) ?> alt="latest-products">
                  </div>
                  <div class="latest-product__item__text">
                    <h6><?= $bp->product_name ?></h6>
                    <span><?= "Rp " . number_format($bp->price, 0, "", ",") ?></span>
                  </div>
                </a>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>