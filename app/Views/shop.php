<?= $this->extend("partials/base") ?>

<?= $this->section("content") ?>

<section class="breadcrumb-section set-bg" data-setbg="<?= base_url("modules/img/breadcrumb.png") ?>">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="breadcrumb__text">
          <h2>Mike Shop</h2>
          <div class="breadcrumb__option text-white">
            <a href="/">Home</a>
            /
            <span>Shop</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="product spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-5">
        <div class="sidebar">
          <?php if (@$_GET["search_query"]) : ?>
            <div class="sidebar__item">
              <div class="py-2 px-3 d-flex rounded" style="flex-direction: column; background-color: #E1E1E1">
                <div class="d-flex justify-content-between align-items-center">
                  <span class="font-weight-bold" style="font-size: .8em;">Result for :</span>
                  <a href="/shop" class="text-danger"><i class='fa fa-close'></i></a>
                </div>
                <span style="font-size: 1.2em;"><?= @$_GET["search_query"] ? $_GET["search_query"] : "" ?></span>
              </div>
            </div>
          <?php else : ?>
            <div class="sidebar__item">
              <h4>Categories</h4>
              <ul>
                <li><a href="<?= (http_build_query($_GET) != "" ? '/shop?' : '/shop') . http_build_query($_GET) ?>" class="<?= $active === "all" ? 'active' : '' ?>">All</a></li>
                <?php foreach ($categories as $category) : ?>
                  <li><a href="/shop/<?= preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($category->category_name))) . (http_build_query($_GET) == "" ? "" : "?" . http_build_query($_GET)) ?>" class="<?= $active === preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($category->category_name))) ? 'active' : '' ?>"><?= $category->category_name ?></a></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>
          <div class="sidebar__item">
            <div class="d-flex align-items-center">
              <h4>Price</h4>
            </div>
            <form action="<?= str_replace("/index.php", "", $_SERVER["PHP_SELF"]) ?>" method="get">
              <div class="price-range-wrap d-flex" style="gap: 5px;">
                <div>
                  <span style="font-size: .8em;">Min (Rp.)</span>
                  <input type="number" name="min" class="form-control" value="<?= @$_GET['min'] ? $_GET['min'] : 0 ?>">
                </div>
                <div>
                  <span style="font-size: .8em;">Max (Rp.)</span>
                  <input type="number" name="max" class="form-control" value="<?= @$_GET['max'] ? $_GET['max'] : 5000000 ?>">
                </div>
              </div>
              <input type="text" name="sort" value="<?= @$_GET['sort'] ? $_GET['sort'] : 'relevance' ?>" hidden>
              <input type="text" name="price" value="<?= @$_GET['price'] ? $_GET['price'] : 'all' ?>" hidden>
              <?php if (@$_GET["search_query"]) : ?>
                <input type="text" name="search_query" value="<?= $_GET['search_query'] ?>" hidden>
                <input type="text" name="category" value="<?= $_GET['category'] ?>" hidden>
              <?php endif; ?>
              <div class="d-flex mt-2" style="gap: 5px;">
                <button type="submit" class="btn text-white" style="font-size: .8em; background-color: #7FAD39">Set Price</button>
                <button type="reset" class="btn text-white bg-secondary" style="font-size: .8em;">Reset Price</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-9 col-md-7">
        <div class="filter__item">
          <div class="row align-items-center d-flex">
            <div class="col">
              <form action="<?= str_replace("/index.php", "", $_SERVER["PHP_SELF"]) ?>" method="get" class="d-flex align-items-center" style="gap: 15px;">
                <input type="number" name="min" value="<?= @$_GET['min'] ? $_GET['min'] : 0 ?>" hidden>
                <input type="number" name="max" value="<?= @$_GET['max'] ? $_GET['max'] : 5000000 ?>" hidden>
                <?php if (@$_GET["search_query"]) : ?>
                  <input type="text" name="search_query" value="<?= $_GET['search_query'] ?>" hidden>
                  <input type="text" name="category" value="<?= $_GET['category'] ?>" hidden>
                <?php endif; ?>
                <div class="d-flex align-items-center" style="gap: 10px;">
                  <span style="width: 50px;">Sort by</span>
                  <select name="sort">
                    <option value="relevance" <?= @$_GET["sort"] && $_GET["sort"] == "relevance" ? "selected" : "" ?>>Relevance</option>
                    <option value="latest" <?= @$_GET["sort"] && $_GET["sort"] == "latest" ? "selected" : "" ?>>Latest</option>
                    <option value="top-sales" <?= @$_GET["sort"] && $_GET["sort"] == "top-sales" ? "selected" : "" ?>>Top Sales</option>
                  </select>
                </div>
                <div class="d-flex align-items-center" style="gap: 10px;">
                  <span>Price</span>
                  <select name="price">
                    <option value="all" <?= @$_GET["price"] && $_GET["price"] == "all" ? "selected" : "" ?>>All</option>
                    <option value="low-high" <?= @$_GET["price"] && $_GET["price"] == "low-high" ? "selected" : "" ?>>Low to High</option>
                    <option value="high-low" <?= @$_GET["price"] && $_GET["price"] == "high-low" ? "selected" : "" ?>>High to Low</option>
                  </select>
                </div>
                <div class="d-flex align-items-center" style="width: 100px;">
                  <button type="submit" class="btn text-white" style="font-size: .8em; background-color: #7FAD39">Set Filter</button>
                </div>
              </form>
            </div>
            <div class="col d-flex" style="justify-content: flex-end;">
              <h6><strong><?= $total_products ?></strong> Products found</h6>
            </div>
          </div>
        </div>
        <div class="row">
          <?php if ($total_products > 0) : ?>
            <?php foreach ($products as $product) : ?>
              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                  <div class="product__item__pic set-bg" data-setbg=<?= base_url("modules/img/gallery/" . preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($product->category))) . "/" . $product->photo) ?>>
                    <ul class="product__item__pic__hover">
                      <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                  </div>
                  <div class="product__item__text">
                    <span style="font-size: .8em;" class="text-secondary"><?= $product->category ?></span>
                    <h6><a href="/shop/<?= preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($product->category))) . "/" . str_replace(' ', '-', strtolower($product->product)) ?>"><?= $product->product ?></a></h6>
                    <h5><?= "Rp " . number_format($product->price, 0, "", ",") ?></h5>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else : ?>
            <div class="col d-flex justify-content-center">
              <img src="<?= base_url('modules/img/nodata.svg') ?>" alt="No Data" width="500">
            </div>
          <?php endif; ?>
        </div>
        <div class="mt-5 d-flex" style="justify-content: center;">
          <?= $links ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>