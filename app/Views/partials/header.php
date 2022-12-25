<!-- Hero Section Begin -->
<section class="hero hero-normal">
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <div class="hero__categories">
          <div class="hero__categories__all">
            <i class="fa fa-bars"></i>
            <?php foreach ($categories as $category) : ?>
              <span>
                <?php
                if (@$_GET["category"]) {
                  echo $_GET["category"] === preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($category->category_name))) ? $category->category_name : "";
                } else {
                  echo strpos((string) current_url(true), preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($category->category_name)))) !== false ? $category->category_name : "";
                }
                ?>
                <?php
                $i = 0;
                if (count(explode('/', str_replace("/index.php", "", $_SERVER["PHP_SELF"]))) <= 2 || explode("/", str_replace("/index.php", "", $_SERVER["PHP_SELF"]))[2] == "/") {
                  $i++;
                  echo "All Categories";
                  if ($i === 1) break;
                } else if (@$_GET["category"] && $_GET["category"] == "all") {
                  $i++;
                  echo "All Categories";
                  if ($i === 1) break;
                }
                ?>
              </span>
            <?php endforeach; ?>
          </div>
          <ul>
            <li>
              <a href="/shop" class="<?= count(explode('/', str_replace("/index.php", "", $_SERVER["PHP_SELF"]))) <= 2 || explode('/', str_replace("/index.php", "", $_SERVER["PHP_SELF"]))[2] == '/' ? 'font-weight-bold' : '' ?>">All Categories</a>
            </li>
            <?php foreach ($categories as $category) : ?>
              <li><a class="<?= strpos((string) current_url(true), preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($category->category_name)))) !== false ? 'font-weight-bold' : '' ?>" href="/shop/<?= preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($category->category_name))) ?>"><?= $category->category_name ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="col-lg-9">
        <div class="hero__search" style="overflow: visible">
          <div class="hero__search__form w-100">
            <form action="<?= base_url('/shop/search') ?>" method="POST" class="d-flex align-items-center pl-1">
              <?= csrf_field() ?>
              <input type="text" name="param" value="<?= http_build_query($_GET) ?>" hidden>
              <select style="width: 400px; background: transparent;" name="category">
                <option value="all" <?= @$_GET['category'] === "all" ? "selected" : "" ?>>All Categories</option>
                <?php foreach ($categories as $category) : ?>
                  <option value="<?= preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($category->category_name))) ?>" <?= @$_GET['category'] === preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($category->category_name))) ? "selected" : "" ?>><?= $category->category_name ?></option>
                <?php endforeach; ?>
              </select>
              <input type="text" class="text-dark" placeholder="What do you want?" name="search" value="<?= @$_GET['search_query'] ? $_GET['search_query'] : '' ?>" required>
              <button type="submit" class="site-btn">SEARCH</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Hero Section End -->