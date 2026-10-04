<?php
session_start();
require_once('files/header.php');

// Category product data. Placeholder activewear items — swap for a real
// catalog lookup once one exists. Keeping this as a plain array (rather
// than typing out markup three times) makes that swap a one-line change
// per section later.
$womens = [
  ['img'=>'imgz/leggings.jpeg', 'meta'=>"Women's Leggings", 'name'=>'Elastic Leggings Free-Size', 'price'=>494.50, 'was'=>699.50, 'rating'=>4.5],
  ['img'=>'imgz/women-top.jpeg','meta'=>"Women's Top",      'name'=>"Women's Elastic Gym Top",     'price'=>264.99, 'was'=>null,    'rating'=>5],
  ['img'=>'imgz/vest.jpeg',     'meta'=>'Vests',             'name'=>'Delamoda Vest',                'price'=>199.99, 'was'=>449.99, 'rating'=>4.2],
  ['img'=>'imgz/headband.jpeg','meta'=>'Accessories',        'name'=>'Free-Size Headband',           'price'=>99.99,  'was'=>null,    'rating'=>2.5],
  ['img'=>'imgz/vest-2.jpeg',  'meta'=>'Vests',              'name'=>'Delamoda Training Vest',       'price'=>219.99, 'was'=>null,    'rating'=>4],
  ['img'=>'imgz/leggings.jpeg','meta'=>"Women's Leggings",   'name'=>'High-Waist Gym Leggings',      'price'=>459.00, 'was'=>null,    'rating'=>4.8],
];
$mens = [
  ['img'=>'imgz/shorts.jpeg',  'meta'=>'Shorts (Unisex)', 'name'=>'Delamoda Active Shorts', 'price'=>599.99, 'was'=>null,    'rating'=>4],
  ['img'=>'imgz/sleeves.jpg',  'meta'=>'Arm Sleeves',     'name'=>'Elastic Arm Sleeves',    'price'=>149.99, 'was'=>null,    'rating'=>4.5],
  ['img'=>'imgz/gloves.jpg',   'meta'=>'Gym Gloves',      'name'=>'Gym Gloves',             'price'=>299.99, 'was'=>null,    'rating'=>5],
  ['img'=>'imgz/vest.jpeg',    'meta'=>'Vests',           'name'=>"Men's Training Vest",    'price'=>219.99, 'was'=>259.99,  'rating'=>4.3],
  ['img'=>'imgz/shorts.jpeg',  'meta'=>'Shorts',          'name'=>'Compression Shorts',     'price'=>329.00, 'was'=>null,    'rating'=>4.6],
  ['img'=>'imgz/headband.jpeg','meta'=>'Accessories',     'name'=>"Men's Sweatband Set",    'price'=>79.99,  'was'=>null,    'rating'=>3.8],
];
$kids = [
  ['img'=>'imgz/women-top.jpeg','meta'=>"Kid's Apparel", 'name'=>'Kids Training Top',    'price'=>149.99, 'was'=>null,   'rating'=>4.4],
  ['img'=>'imgz/leggings.jpeg', 'meta'=>"Kid's Apparel", 'name'=>'Kids Active Leggings', 'price'=>179.99, 'was'=>219.99, 'rating'=>4.7],
  ['img'=>'imgz/headband.jpeg', 'meta'=>'Accessories',   'name'=>'Kids Sport Headband',  'price'=>59.99,  'was'=>null,   'rating'=>4],
  ['img'=>'imgz/shorts.jpeg',   'meta'=>"Kid's Apparel", 'name'=>'Kids Running Shorts',  'price'=>129.99, 'was'=>null,   'rating'=>4.2],
  ['img'=>'imgz/vest.jpeg',     'meta'=>"Kid's Apparel", 'name'=>'Kids Team Vest',       'price'=>139.99, 'was'=>null,   'rating'=>4.5],
  ['img'=>'imgz/sleeves.jpg',   'meta'=>'Accessories',   'name'=>'Kids Arm Sleeves',     'price'=>69.99,  'was'=>null,   'rating'=>3.9],
];

// Renders one product card. Used by all three category carousels below,
// so a styling change only needs to happen in one place.
function delamoda_product_card($p) {
  ?>
  <div class="product-card">
    <?php if (!empty($p['was'])): ?><span class="badge bg-danger card-sale-badge">Sale</span><?php endif; ?>
    <button class="btn-wishlist" type="button" data-bs-toggle="tooltip" title="Add to wishlist"><i class="bi bi-heart"></i></button>
    <a class="card-img-wrap" href="product.php"><img src="<?= htmlspecialchars($p['img']) ?>" alt="<?= htmlspecialchars($p['name']) ?>"></a>
    <div class="card-body">
      <a class="card-meta d-block" href="shop-grid-ls.html"><?= htmlspecialchars($p['meta']) ?></a>
      <h3 class="card-title"><a href="product.php"><?= htmlspecialchars($p['name']) ?></a></h3>
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <span class="text-accent">K<?= number_format($p['price'], 2) ?></span>
          <?php if (!empty($p['was'])): ?> <del class="fs-sm text-muted">K<?= number_format($p['was'], 2) ?></del><?php endif; ?>
        </div>
        <span class="star-rating" data-rating="<?= $p['rating'] ?>"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></span>
      </div>
    </div>
  </div>
  <?php
}
?>

      <!-- Hero carousel -->
      <div class="container pt-4">
        <div id="heroCarousel" class="carousel slide carousel-fade hero-carousel" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active" style="background-color:#5a3a2e;">
              <div class="hero-slide-inner text-center text-lg-start mx-auto mx-lg-0 px-4 px-lg-5 py-5">
                <h3 class="h2 text-light fw-light mb-1">Hurry up! Limited time offer.</h3>
                <h2 class="text-light display-5 mb-3">Women's Sportswear Sale</h2>
                <p class="fs-lg text-light opacity-75 mb-4">Leggings, tops, vests &amp; much more...</p>
                <a class="btn btn-primary btn-shadow" href="shop-grid-ls.html">Shop Now<i class="bi bi-arrow-right ms-2"></i></a>
              </div>
            </div>
            <div class="carousel-item" style="background-color:#2e4a3a;">
              <div class="hero-slide-inner text-center text-lg-start mx-auto mx-lg-0 px-4 px-lg-5 py-5">
                <h3 class="h2 text-light fw-light mb-1">Just arrived!</h3>
                <h2 class="text-light display-5 mb-3">New Training Collection</h2>
                <p class="fs-lg text-light opacity-75 mb-4">Shorts, gym tops, arm sleeves &amp; much more...</p>
                <a class="btn btn-primary btn-shadow" href="shop-grid-ls.html">Shop Now<i class="bi bi-arrow-right ms-2"></i></a>
              </div>
            </div>
            <div class="carousel-item" style="background-color:#4a3a2e;">
              <div class="hero-slide-inner text-center text-lg-start mx-auto mx-lg-0 px-4 px-lg-5 py-5">
                <h3 class="h2 text-light fw-light mb-1">Complete your look with</h3>
                <h2 class="text-light display-5 mb-3">New Accessories</h2>
                <p class="fs-lg text-light opacity-75 mb-4">Headbands, gloves, arm sleeves &amp; much more...</p>
                <a class="btn btn-primary btn-shadow" href="shop-grid-ls.html">Shop Now<i class="bi bi-arrow-right ms-2"></i></a>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>

      <!-- Category: Women -->
      <section class="container pt-5">
        <div class="row g-4 hscroll-group">
          <div class="col-lg-4">
            <div class="category-banner d-flex flex-column p-4">
              <div>
                <h2 class="h4 mb-1">For Women</h2>
                <a class="category-banner-link" href="shop-grid-ls.html">Shop for women<i class="bi bi-arrow-right fs-xs ms-1"></i></a>
              </div>
              <div class="mt-auto pt-4 d-flex gap-2">
                <button class="hscroll-nav hscroll-nav-sm hscroll-prev" type="button" aria-label="Previous"><i class="bi bi-chevron-left"></i></button>
                <button class="hscroll-nav hscroll-nav-sm hscroll-next" type="button" aria-label="Next"><i class="bi bi-chevron-right"></i></button>
              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="hscroll">
              <?php foreach ($womens as $p) delamoda_product_card($p); ?>
            </div>
          </div>
        </div>
      </section>

      <!-- Category: Men -->
      <section class="container pt-5">
        <div class="row g-4 hscroll-group">
          <div class="col-lg-8 order-lg-1">
            <div class="hscroll">
              <?php foreach ($mens as $p) delamoda_product_card($p); ?>
            </div>
          </div>
          <div class="col-lg-4 order-lg-2">
            <div class="category-banner d-flex flex-column p-4">
              <div>
                <h2 class="h4 mb-1">For Men</h2>
                <a class="category-banner-link" href="shop-grid-ls.html">Shop for men<i class="bi bi-arrow-right fs-xs ms-1"></i></a>
              </div>
              <div class="mt-auto pt-4 d-flex gap-2">
                <button class="hscroll-nav hscroll-nav-sm hscroll-prev" type="button" aria-label="Previous"><i class="bi bi-chevron-left"></i></button>
                <button class="hscroll-nav hscroll-nav-sm hscroll-next" type="button" aria-label="Next"><i class="bi bi-chevron-right"></i></button>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Category: Kids -->
      <section class="container pt-5">
        <div class="row g-4 hscroll-group">
          <div class="col-lg-4">
            <div class="category-banner d-flex flex-column p-4">
              <div>
                <h2 class="h4 mb-1">For Kids</h2>
                <a class="category-banner-link" href="shop-grid-ls.html">Shop for kids<i class="bi bi-arrow-right fs-xs ms-1"></i></a>
              </div>
              <div class="mt-auto pt-4 d-flex gap-2">
                <button class="hscroll-nav hscroll-nav-sm hscroll-prev" type="button" aria-label="Previous"><i class="bi bi-chevron-left"></i></button>
                <button class="hscroll-nav hscroll-nav-sm hscroll-next" type="button" aria-label="Next"><i class="bi bi-chevron-right"></i></button>
              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="hscroll">
              <?php foreach ($kids as $p) delamoda_product_card($p); ?>
            </div>
          </div>
        </div>
      </section>

      <!-- Product widgets -->
      <section class="container pt-5 pb-4">
        <div class="row g-4">
          <div class="col-lg-4 col-md-6">
            <h3 class="widget-title">Bestsellers</h3>
            <?php foreach (array_slice($womens, 0, 4) as $p): ?>
            <div class="d-flex align-items-center gap-2 py-2 widget-product-row">
              <a href="product.php"><img src="<?= htmlspecialchars($p['img']) ?>" alt="<?= htmlspecialchars($p['name']) ?>"></a>
              <div>
                <a class="widget-product-title d-block" href="product.php"><?= htmlspecialchars($p['name']) ?></a>
                <span class="text-accent fs-sm">K<?= number_format($p['price'], 2) ?></span>
              </div>
            </div>
            <?php endforeach; ?>
            <a class="fs-sm d-inline-block mt-3" href="shop-grid-ls.html">View more<i class="bi bi-arrow-right fs-xs ms-1"></i></a>
          </div>
          <div class="col-lg-4 col-md-6">
            <h3 class="widget-title">New arrivals</h3>
            <?php foreach (array_slice($mens, 0, 4) as $p): ?>
            <div class="d-flex align-items-center gap-2 py-2 widget-product-row">
              <a href="product.php"><img src="<?= htmlspecialchars($p['img']) ?>" alt="<?= htmlspecialchars($p['name']) ?>"></a>
              <div>
                <a class="widget-product-title d-block" href="product.php"><?= htmlspecialchars($p['name']) ?></a>
                <span class="text-accent fs-sm">K<?= number_format($p['price'], 2) ?></span>
              </div>
            </div>
            <?php endforeach; ?>
            <a class="fs-sm d-inline-block mt-3" href="shop-grid-ls.html">View more<i class="bi bi-arrow-right fs-xs ms-1"></i></a>
          </div>
          <div class="col-lg-4 d-none d-lg-block">
            <div class="category-banner d-flex flex-column align-items-center justify-content-center text-center p-4 h-100">
              <i class="bi bi-lightning-charge text-accent fs-1 mb-3"></i>
              <h3 class="h5 mb-2">New season, new gear</h3>
              <p class="text-muted fs-sm mb-3">Browse the full range and find your fit.</p>
              <a class="btn btn-outline-accent btn-sm" href="shop-grid-ls.html">Shop the collection</a>
            </div>
          </div>
        </div>
      </section>

      <!-- Journal + Instagram-->
      <section class="container pb-5">
        <div class="row g-4">
          <div class="col-md-6">
            <a class="cta-panel" href="about.html">
              <i class="bi bi-pencil-square d-block mb-3"></i>
              <h3 class="h5 mb-1">Read our journal</h3>
              <p class="text-muted fs-sm mb-0">Training tips, product care &amp; store news</p>
            </a>
          </div>
          <div class="col-md-6">
            <a class="cta-panel" href="#">
              <i class="bi bi-instagram d-block mb-3"></i>
              <h3 class="h5 mb-1">Follow on Instagram</h3>
              <p class="text-muted fs-sm mb-0">@delamodaactive</p>
            </a>
          </div>
        </div>
      </section>

<?php
require_once('files/footer.php');
?>
