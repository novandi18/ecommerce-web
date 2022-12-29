<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
  <div class="humberger__menu__logo">
    <a href="#"><img src=<?= base_url("modules/img/logo.png") ?> alt="" width="120"></a>
  </div>
  <div class="humberger__menu__cart">
    <ul>
      <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
      <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
    </ul>
    <div class="header__cart__price">item: <span>$150.00</span></div>
  </div>
  <div class="humberger__menu__widget">
    <div class="header__top__right__auth">
      <a href="#"><i class="fa fa-user"></i> Login</a>
    </div>
  </div>
  <nav class="humberger__menu__nav mobile-menu">
    <ul>
      <li class="active"><a href="/">Home</a></li>
      <li><a href="/shop">Shop</a></li>
      <li><a href="#">Shoes</a>
        <ul class="header__menu__dropdown">
          <?php foreach ($categories as $category) : ?>
            <li><a href="/shop/<?= preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($category->category_name))) ?>"><?= $category->category_name ?></a></li>
          <?php endforeach; ?>
        </ul>
      </li>
      <li><a href="/contact">Contact</a></li>
    </ul>
  </nav>
  <div id="mobile-menu-wrap"></div>
  <div class="header__top__right__social">
    <a href="#"><i class="fa fa-facebook"></i></a>
    <a href="#"><i class="fa fa-twitter"></i></a>
    <a href="#"><i class="fa fa-linkedin"></i></a>
    <a href="#"><i class="fa fa-pinterest-p"></i></a>
  </div>
  <div class="humberger__menu__contact">
    <ul>
      <li><i class="fa fa-envelope"></i> admin@mike.com</li>
    </ul>
  </div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header">
  <div class="header__top">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6">
          <div class="header__top__left">
            <ul>
              <li><i class="fa fa-envelope"></i> admin@mike.com</li>
            </ul>
          </div>
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="header__top__right">
            <div class="header__top__right__social pr-3">
              <a href="#"><i class="fa fa-facebook"></i></a>
              <a href="#"><i class="fa fa-twitter"></i></a>
              <a href="#"><i class="fa fa-linkedin"></i></a>
            </div>
            <?php if (session()->get("name")) : ?>
              <div class="header__top__right__auth border-left pl-3">
                <a href="/profile"><i class="fa fa-user"></i> <?= session()->get("name") ?></a>
              </div>
              <div class="header__top__right__auth ml-2">
                <a href="<?= base_url('/logout') ?>" class="bg-danger text-white px-2 rounded">Logout</a>
              </div>
            <?php else : ?>
              <div class="header__top__right__auth border-right border-left px-3">
                <a href="/login"><i class="fa fa-user"></i> Login</a>
              </div>
              <div class="header__top__right__auth ml-2 pl-1">
                <a href="/register"><i class="fa fa-user"></i> Register</a>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-3 d-flex align-items-center">
        <div class="header__logo">
          <a href="/"><img src=<?= base_url("modules/img/logo.png") ?> alt="Logo" width="120"></a>
        </div>
      </div>
      <div class="col-lg-6">
        <nav class="header__menu">
          <ul>
            <?php $menuUrl = explode("/", str_replace('/index.php', '', $_SERVER["PHP_SELF"])); ?>
            <li class="<?= count($menuUrl) <= 1 && $menuUrl[0] == '' ? 'active' : '' ?>"><a href="/">Home</a></li>
            <li class="<?= count($menuUrl) === 2 && $menuUrl[1] == 'shop' ? 'active' : '' ?>"><a href="/shop">Shop</a></li>
            <li class="<?= count($menuUrl) >= 3 && $menuUrl[1] == 'shop' ? 'active' : '' ?>"><a href="#">Shoes</a>
              <ul class="header__menu__dropdown">
                <?php foreach ($categories as $category) : ?>
                  <li><a href="/shop/<?= preg_replace('/[^a-z]/i', '-', str_replace(' ', '', strtolower($category->category_name))) ?>"><?= $category->category_name ?></a></li>
                <?php endforeach; ?>
              </ul>
            </li>
            <li><a href="/about">About us</a></li>
          </ul>
        </nav>
      </div>
      <?php if (@session()->id) : ?>
        <div class="col-lg-3">
          <div class="header__cart">
            <ul>
              <li><a href="/cart" target="_blank"><i class="fa fa-shopping-bag"></i> <span><?= $cart["qty"] ?></span></a></li>
            </ul>
            <div class="header__cart__price">item: <span><?= "Rp " . number_format($cart["total"] === NULL ? 0 : $cart["total"], 0, "", ".") ?></span></div>
          </div>
        </div>
      <?php endif; ?>
    </div>
    <div class="humberger__open">
      <i class="fa fa-bars"></i>
    </div>
  </div>
</header>
<!-- Header Section End -->