<!-- Hero Section Begin -->
<section class="hero hero-normal">
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <div class="hero__categories">
          <div class="hero__categories__all">
            <i class="fa fa-bars"></i>
            <span>All categories</span>
          </div>
          <ul>
            <?php foreach ($categories as $category) : ?>
              <li><a href="/shop/<?= preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($category->category_name))) ?>"><?= $category->category_name ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="col-lg-9">
        <div class="hero__search" style="overflow: visible">
          <div class="hero__search__form w-100">
            <form action="#" class="d-flex align-items-center pl-1">
              <select style="width: 400px; background: transparent;">
                <option value="all">All Categories</option>
                <?php foreach ($categories as $category) : ?>
                  <option value="<?= $category->id_category ?>"><?= $category->category_name ?></option>
                <?php endforeach; ?>
              </select>
              <input type="text" placeholder="What do you want?">
              <button type="submit" class="site-btn">SEARCH</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Hero Section End -->