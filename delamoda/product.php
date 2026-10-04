<?php
session_start();
// Product data. Hardcoded for now, since there's no product database yet;
// swap this for a real lookup (by $_GET['id'] or similar) later.
$product = [
    'name'  => 'Delamoda Vest',
    'price' => 199.99,
    'was'   => 449.99,
    'images' => [
        ['src' => 'imgz/vest.jpeg',      'alt' => 'Delamoda Vest'],
        ['src' => 'imgz/vest-2.jpeg',    'alt' => 'Delamoda Vest, second view'],
        ['src' => 'imgz/women-top.jpeg', 'alt' => "Women's top"],
        ['src' => 'imgz/leggings.jpeg',  'alt' => 'Leggings'],
    ],
    'rating' => 4.2,
    'reviewCount' => 74,
];
require_once('files/header.php');
?>
      <!-- Size chart modal-->
      <div class="modal fade" id="size-chart" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title h5">Size guide</h2>
              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
              <div class="table-responsive">
                <table class="table fs-sm text-center mb-0">
                  <thead>
                    <tr><th>Size</th><th>Chest (cm)</th><th>Waist (cm)</th><th>Hip (cm)</th></tr>
                  </thead>
                  <tbody>
                    <tr><td class="fw-medium">XS</td><td>82&ndash;86</td><td>66&ndash;70</td><td>88&ndash;92</td></tr>
                    <tr><td class="fw-medium">S</td><td>87&ndash;91</td><td>71&ndash;75</td><td>93&ndash;97</td></tr>
                    <tr><td class="fw-medium">M</td><td>92&ndash;96</td><td>76&ndash;80</td><td>98&ndash;102</td></tr>
                    <tr><td class="fw-medium">L</td><td>97&ndash;103</td><td>81&ndash;87</td><td>103&ndash;109</td></tr>
                    <tr><td class="fw-medium">XL</td><td>104&ndash;110</td><td>88&ndash;94</td><td>110&ndash;116</td></tr>
                  </tbody>
                </table>
              </div>
              <p class="fs-sm text-muted p-3 mb-0">Measurements are approximate. If you're between sizes, we recommend sizing up.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Page title-->
      <div class="page-title-band py-4">
        <div class="container d-lg-flex justify-content-between align-items-center py-2">
          <h1 class="h3 mb-3 mb-lg-0 text-center text-lg-start"><?= htmlspecialchars($product['name']) ?></h1>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center justify-content-lg-end mb-0">
              <li class="breadcrumb-item"><a href="index-2.html"><i class="bi bi-house me-1"></i>Home</a></li>
              <li class="breadcrumb-item"><a href="shop-grid-ls.html">Shop</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($product['name']) ?></li>
            </ol>
          </nav>
        </div>
      </div>

      <div class="container py-5">
        <div class="card mb-5">
          <div class="card-body p-3 p-lg-4">
            <div class="row g-4">
              <!-- Gallery-->
              <div class="col-lg-7">
                <div class="product-gallery">
                  <div class="product-gallery-main mb-3">
                    <img src="<?= htmlspecialchars($product['images'][0]['src']) ?>"
                         data-zoom="<?= htmlspecialchars($product['images'][0]['src']) ?>"
                         alt="<?= htmlspecialchars($product['images'][0]['alt']) ?>">
                  </div>
                  <div class="product-gallery-thumbs row row-cols-4 g-2">
                    <?php foreach ($product['images'] as $i => $img): ?>
                    <div class="col">
                      <a href="<?= htmlspecialchars($img['src']) ?>" class="<?= $i === 0 ? 'active' : '' ?>">
                        <img src="<?= htmlspecialchars($img['src']) ?>" alt="<?= htmlspecialchars($img['alt']) ?> thumbnail">
                      </a>
                    </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>

              <!-- Details-->
              <div class="col-lg-5">
                <div class="d-flex justify-content-between align-items-start mb-2">
                  <a class="d-flex align-items-center text-body" href="#reviews">
                    <span class="star-rating me-2" data-rating="<?= $product['rating'] ?>">
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </span>
                    <span class="fs-sm"><?= $product['reviewCount'] ?> Reviews</span>
                  </a>
                  <button class="btn-wishlist" type="button" data-bs-toggle="tooltip" title="Add to wishlist"><i class="bi bi-heart"></i></button>
                </div>

                <div class="mb-3">
                  <span class="h3 fw-normal text-accent me-2">K<?= number_format($product['price'], 2) ?></span>
                  <del class="text-muted fs-5 me-2">K<?= number_format($product['was'], 2) ?></del>
                  <span class="badge bg-danger align-middle">Sale</span>
                </div>

                <div class="mb-3">
                  <span class="fw-medium me-1">Color:</span><span class="text-muted" id="colorOption">Red / Dark blue / White</span>
                </div>
                <div class="mb-4">
                  <input class="color-swatch-input" type="radio" name="color" id="color1" value="Red / Dark blue / White" checked>
                  <label class="color-swatch-label me-2" for="color1" style="background-color:#8a3a3a;" title="Red / Dark blue / White"></label>

                  <input class="color-swatch-input" type="radio" name="color" id="color2" value="Beige / White / Dark grey">
                  <label class="color-swatch-label me-2" for="color2" style="background-color:#c9b79c;" title="Beige / White / Dark grey"></label>

                  <input class="color-swatch-input" type="radio" name="color" id="color3" value="Dark grey / White / Orange">
                  <label class="color-swatch-label me-2" for="color3" style="background-color:#4a4a4a;" title="Dark grey / White / Orange"></label>

                  <span class="product-badge-available ms-2"><i class="bi bi-shield-check me-1"></i>Product available</span>
                </div>

                <form class="mb-4" method="post" action="cart-add.php">
                  <input type="hidden" name="product" value="delamoda-vest">
                  <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                      <label class="form-label mb-0" for="product-size">Size</label>
                      <span class="fs-sm text-muted">See <a href="#" data-bs-toggle="modal" data-bs-target="#size-chart">size guide</a></span>
                    </div>
                    <select class="form-select" id="product-size" name="size" required>
                      <option value="">Select size</option>
                      <option value="xs">XS</option>
                      <option value="s">S</option>
                      <option value="m">M</option>
                      <option value="l">L</option>
                      <option value="xl">XL</option>
                    </select>
                  </div>
                  <div class="d-flex gap-3">
                    <select class="form-select" name="qty" style="width: 5.5rem;">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                    <button class="btn btn-primary btn-shadow flex-grow-1" type="submit"><i class="bi bi-cart3 me-2"></i>Add to Cart</button>
                  </div>
                </form>

                <div class="accordion mb-4" id="productPanels">
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#productInfo"><i class="bi bi-megaphone me-2"></i>Product info</button>
                    </h2>
                    <div class="accordion-collapse collapse show" id="productInfo" data-bs-parent="#productPanels">
                      <div class="accordion-body fs-sm">
                        <h6 class="fs-sm mb-2">Composition</h6>
                        <ul class="ps-3">
                          <li>Elastic rib: Cotton 95%, Elastane 5%</li>
                          <li>Lining: Cotton 100%</li>
                          <li>Body: Cotton 80%, Polyester 20%</li>
                        </ul>
                        <h6 class="fs-sm mb-2">Art. No.</h6>
                        <p class="mb-0">183260098</p>
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#shippingOptions"><i class="bi bi-truck me-2"></i>Delivery</button>
                    </h2>
                    <div class="accordion-collapse collapse" id="shippingOptions" data-bs-parent="#productPanels">
                      <div class="accordion-body fs-sm">
                        <select class="form-select mb-3">
                          <option value="">Select your location</option>
                          <option value="lusaka">Lusaka Province</option>
                          <option value="central">Central Province</option>
                          <option value="copperbelt">Copperbelt Province</option>
                          <option value="eastern">Eastern Province</option>
                          <option value="luapula">Luapula Province</option>
                          <option value="muchinga">Muchinga Province</option>
                          <option value="north-western">North-Western Province</option>
                          <option value="northern">Northern Province</option>
                          <option value="southern">Southern Province</option>
                          <option value="western">Western Province</option>
                        </select>
                        <div class="d-flex justify-content-between border-bottom pb-2">
                          <div><div class="fw-medium">Company Courier <small class="text-muted">(within Lusaka)</small></div><div class="text-muted">Less than a day</div></div>
                          <div class="text-nowrap">Distance-dependent</div>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                          <div><div class="fw-medium">Yango Courier <small class="text-muted">(within Lusaka)</small></div><div class="text-muted">Less than a day</div></div>
                          <div class="text-nowrap">Distance-dependent</div>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                          <div><div class="fw-medium">Nation-wide Delivery <small class="text-muted">(outside Lusaka)</small></div><div class="text-muted">1 - 2 days</div></div>
                          <div class="text-nowrap">Distance-dependent</div>
                        </div>
                        <div class="d-flex justify-content-between pt-2">
                          <div><div class="fw-medium">Pickup from Store</div><div class="text-muted">&mdash;</div></div>
                          <div>Free</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div>
                  <span class="fw-medium me-2">Share:</span>
                  <a class="btn-share me-2" href="#"><i class="bi bi-twitter-x"></i>Twitter</a>
                  <a class="btn-share me-2" href="#"><i class="bi bi-instagram"></i>Instagram</a>
                  <a class="btn-share" href="#"><i class="bi bi-facebook"></i>Facebook</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product description-->
        <div class="row align-items-center gy-4 py-4">
          <div class="col-lg-5 col-md-6 offset-lg-1 order-md-2 text-center">
            <img class="rounded-3" src="imgz/vest-2.jpeg" style="max-width:300px;" alt="Delamoda Vest">
          </div>
          <div class="col-lg-4 col-md-6 offset-lg-1 order-md-1">
            <h2 class="h3 mb-4">High quality materials</h2>
            <h3 class="fs-base mb-2">Soft cotton blend</h3>
            <p class="text-muted mb-4">A blend of flexible synthetic fibres and soft base textiles designed to stretch and return to its original shape.</p>
            <h3 class="fs-base mb-3">Washing instructions</h3>
            <ul class="nav nav-tabs mb-3" role="tablist">
              <li class="nav-item"><a class="nav-link active" href="#wash" data-bs-toggle="tab" role="tab" title="Machine wash"><i class="bi bi-moisture fs-4"></i></a></li>
              <li class="nav-item"><a class="nav-link" href="#bleach" data-bs-toggle="tab" role="tab" title="Bleaching"><i class="bi bi-droplet-half fs-4"></i></a></li>
              <li class="nav-item"><a class="nav-link" href="#hand-wash" data-bs-toggle="tab" role="tab" title="Hand wash"><i class="bi bi-hand-index-thumb fs-4"></i></a></li>
              <li class="nav-item"><a class="nav-link" href="#ironing" data-bs-toggle="tab" role="tab" title="Ironing"><i class="bi bi-lightning-charge fs-4"></i></a></li>
              <li class="nav-item"><a class="nav-link" href="#dry-clean" data-bs-toggle="tab" role="tab" title="Dry clean"><i class="bi bi-x-circle fs-4"></i></a></li>
            </ul>
            <div class="tab-content text-muted fs-sm">
              <div class="tab-pane fade show active" id="wash" role="tabpanel">30&deg; mild machine washing</div>
              <div class="tab-pane fade" id="bleach" role="tabpanel">Do not use any bleach</div>
              <div class="tab-pane fade" id="hand-wash" role="tabpanel">Hand wash normal (30&deg;)</div>
              <div class="tab-pane fade" id="ironing" role="tabpanel">Very low temperature ironing</div>
              <div class="tab-pane fade" id="dry-clean" role="tabpanel">Do not dry clean</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Reviews-->
      <div class="border-top border-bottom py-5">
        <div class="container" id="reviews">
          <div class="row pb-4">
            <div class="col-lg-4 col-md-5">
              <h2 class="h3 mb-3"><?= $product['reviewCount'] ?> Reviews</h2>
              <span class="star-rating me-2" data-rating="<?= $product['rating'] ?>">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
              </span><span class="align-middle"><?= number_format($product['rating'], 1) ?> Overall rating</span>
              <p class="pt-3 text-muted">58 out of 74 (77%)<br>Customers recommended this product</p>
            </div>
            <div class="col-lg-8 col-md-7">
              <?php
              $breakdown = [5 => 60, 4 => 27, 3 => 17, 2 => 9, 1 => 4];
              $counts    = [5 => 43, 4 => 16, 3 => 9, 2 => 4, 1 => 2];
              $colors    = [5 => '#4ac37f', 4 => '#a7e453', 3 => '#ffda75', 2 => '#fea569', 1 => '#e5544b'];
              foreach ($breakdown as $stars => $pct):
              ?>
              <div class="d-flex align-items-center mb-2">
                <div class="text-nowrap me-3"><span class="text-muted align-middle"><?= $stars ?></span><i class="bi bi-star-fill fs-xs ms-1"></i></div>
                <div class="progress flex-grow-1" style="height:4px;">
                  <div class="progress-bar" role="progressbar" style="width:<?= $pct ?>%; background-color:<?= $colors[$stars] ?>;"></div>
                </div>
                <span class="text-muted ms-3"><?= $counts[$stars] ?></span>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
          <hr class="mb-4">
          <div class="row">
            <!-- Reviews list-->
            <div class="col-md-7">
              <div class="d-flex justify-content-end pb-4">
                <label class="fs-sm text-muted text-nowrap me-2 d-none d-sm-block pt-1" for="sort-reviews">Sort by:</label>
                <select class="form-select form-select-sm" id="sort-reviews" style="max-width:10rem;">
                  <option>Newest</option>
                  <option>Oldest</option>
                  <option>Popular</option>
                  <option>High rating</option>
                  <option>Low rating</option>
                </select>
              </div>

              <div class="pb-4 mb-4 border-bottom">
                <div class="d-flex flex-wrap gap-3 mb-3">
                  <img class="review-avatar" src="imgz/omar.jpg" alt="Omar Mohammed Issa">
                  <div>
                    <h6 class="fs-sm mb-0">Omar Mohammed Issa</h6><span class="fs-ms text-muted">August 10, 2026</span>
                  </div>
                  <div class="ms-auto">
                    <span class="star-rating" data-rating="4"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></span>
                    <div class="fs-ms text-muted">83% of users found this review helpful</div>
                  </div>
                </div>
                <p class="mb-2">Great fit and holds up well through regular training. Breathable enough for Lusaka afternoons.</p>
                <ul class="list-unstyled fs-ms">
                  <li class="mb-1"><span class="fw-medium">Pros:</span> Elastic, breathable</li>
                  <li class="mb-1"><span class="fw-medium">Cons:</span> Runs slightly small</li>
                </ul>
                <button class="btn-vote btn-like me-2" type="button"><i class="bi bi-hand-thumbs-up me-1"></i>15</button>
                <button class="btn-vote btn-dislike" type="button"><i class="bi bi-hand-thumbs-down me-1"></i>3</button>
              </div>

              <div class="pb-4 mb-4 border-bottom">
                <div class="d-flex flex-wrap gap-3 mb-3">
                  <img class="review-avatar" src="imgz/barbra.jpg" alt="Barbra Banda">
                  <div>
                    <h6 class="fs-sm mb-0">Barbra Banda</h6><span class="fs-ms text-muted">May 17, 2025</span>
                  </div>
                  <div class="ms-auto">
                    <span class="star-rating" data-rating="5"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></span>
                    <div class="fs-ms text-muted">99% of users found this review helpful</div>
                  </div>
                </div>
                <p class="mb-2">My go-to for training. Free-fit and the fabric holds up wash after wash.</p>
                <ul class="list-unstyled fs-ms">
                  <li class="mb-1"><span class="fw-medium">Pros:</span> Free-fit, durable fabric</li>
                </ul>
                <button class="btn-vote btn-like me-2" type="button"><i class="bi bi-hand-thumbs-up me-1"></i>34</button>
                <button class="btn-vote btn-dislike" type="button"><i class="bi bi-hand-thumbs-down me-1"></i>1</button>
              </div>

              <div class="text-center">
                <button class="btn btn-outline-accent" type="button"><i class="bi bi-arrow-clockwise me-2"></i>Load more reviews</button>
              </div>
            </div>

            <!-- Leave a review-->
            <div class="col-md-5 mt-4 mt-md-0">
              <div class="bg-secondary p-4 rounded-3">
                <h3 class="h4 mb-3">Write a review</h3>
                <form class="needs-validation" method="post" action="review-add.php" novalidate>
                  <div class="mb-3">
                    <label class="form-label" for="review-name">Your name<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="review-name" name="name" required>
                    <div class="invalid-feedback">Please enter your name.</div>
                    <div class="form-text">Will be displayed on the comment.</div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="review-email">Your email<span class="text-danger">*</span></label>
                    <input class="form-control" type="email" id="review-email" name="email" required>
                    <div class="invalid-feedback">Please provide a valid email address.</div>
                    <div class="form-text">Authentication only, we won't spam you.</div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="review-rating">Rating<span class="text-danger">*</span></label>
                    <select class="form-select" id="review-rating" name="rating" required>
                      <option value="">Choose rating</option>
                      <option value="5">5 stars</option>
                      <option value="4">4 stars</option>
                      <option value="3">3 stars</option>
                      <option value="2">2 stars</option>
                      <option value="1">1 star</option>
                    </select>
                    <div class="invalid-feedback">Please choose a rating.</div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="review-text">Review<span class="text-danger">*</span></label>
                    <textarea class="form-control" rows="3" id="review-text" name="review" required minlength="50"></textarea>
                    <div class="invalid-feedback">Please write a review of at least 50 characters.</div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="review-pros">Pros</label>
                    <textarea class="form-control" rows="1" placeholder="Separated by commas" id="review-pros" name="pros"></textarea>
                  </div>
                  <div class="mb-4">
                    <label class="form-label" for="review-cons">Cons</label>
                    <textarea class="form-control" rows="1" placeholder="Separated by commas" id="review-cons" name="cons"></textarea>
                  </div>
                  <button class="btn btn-primary btn-shadow d-block w-100" type="submit">Submit a Review</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Carousel: Style with-->
      <div class="container py-5 hscroll-group">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2 class="h3 mb-0">Style with</h2>
          <div class="d-none d-sm-flex gap-2">
            <button class="hscroll-nav hscroll-prev" type="button" aria-label="Previous"><i class="bi bi-chevron-left"></i></button>
            <button class="hscroll-nav hscroll-next" type="button" aria-label="Next"><i class="bi bi-chevron-right"></i></button>
          </div>
        </div>
          <div class="hscroll">
            <?php foreach ([
              ['img'=>'imgz/shorts.jpeg','meta'=>"Shorts (Unisex)",'name'=>'Delamoda Active Shorts','price'=>599.99,'was'=>null,'rating'=>4],
              ['img'=>'imgz/leggings.jpeg','meta'=>"Women's Leggings",'name'=>'Elastic Leggings Free-Size','price'=>494.50,'was'=>699.50,'rating'=>4.5,'sale'=>true],
              ['img'=>'imgz/women-top.jpeg','meta'=>"Women's Top",'name'=>"Women's Elastic Gym Top",'price'=>264.99,'was'=>null,'rating'=>5],
            ] as $p): ?>
            <div class="product-card">
              <?php if (!empty($p['sale'])): ?><span class="badge bg-danger card-sale-badge">Sale</span><?php endif; ?>
              <button class="btn-wishlist" type="button" data-bs-toggle="tooltip" title="Add to wishlist"><i class="bi bi-heart"></i></button>
              <a class="card-img-wrap" href="#"><img src="<?= htmlspecialchars($p['img']) ?>" alt="<?= htmlspecialchars($p['name']) ?>"></a>
              <div class="card-body">
                <a class="card-meta d-block" href="#"><?= htmlspecialchars($p['meta']) ?></a>
                <h3 class="card-title"><a href="#"><?= htmlspecialchars($p['name']) ?></a></h3>
                <div class="d-flex justify-content-between align-items-center">
                  <div><span class="text-accent">K<?= number_format($p['price'], 2) ?></span><?php if ($p['was']): ?> <del class="fs-sm text-muted">K<?= number_format($p['was'], 2) ?></del><?php endif; ?></div>
                  <span class="star-rating" data-rating="<?= $p['rating'] ?>"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></span>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
      </div>

      <!-- Carousel: You may also like-->
      <div class="container pb-5 hscroll-group">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2 class="h3 mb-0">You may also like</h2>
          <div class="d-none d-sm-flex gap-2">
            <button class="hscroll-nav hscroll-prev" type="button" aria-label="Previous"><i class="bi bi-chevron-left"></i></button>
            <button class="hscroll-nav hscroll-next" type="button" aria-label="Next"><i class="bi bi-chevron-right"></i></button>
          </div>
        </div>
          <div class="hscroll">
            <?php foreach ([
              ['img'=>'imgz/sleeves.jpg','meta'=>'Arm Sleeves','name'=>'Elastic Arm Sleeves','price'=>149.99,'rating'=>4.5],
              ['img'=>'imgz/gloves.jpg','meta'=>'Gym Gloves','name'=>'Gym Gloves','price'=>299.99,'rating'=>5],
              ['img'=>'imgz/headband.jpeg','meta'=>'Headband','name'=>'Free-Size Headband','price'=>99.99,'rating'=>2.5],
            ] as $p): ?>
            <div class="product-card">
              <button class="btn-wishlist" type="button" data-bs-toggle="tooltip" title="Add to wishlist"><i class="bi bi-heart"></i></button>
              <a class="card-img-wrap" href="#"><img src="<?= htmlspecialchars($p['img']) ?>" alt="<?= htmlspecialchars($p['name']) ?>"></a>
              <div class="card-body">
                <a class="card-meta d-block" href="#"><?= htmlspecialchars($p['meta']) ?></a>
                <h3 class="card-title"><a href="#"><?= htmlspecialchars($p['name']) ?></a></h3>
                <div class="d-flex justify-content-between align-items-center">
                  <div><span class="text-accent">K<?= number_format($p['price'], 2) ?></span></div>
                  <span class="star-rating" data-rating="<?= $p['rating'] ?>"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></span>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
      </div>
      <script src="assets/vendor/drift/Drift.min.js"></script>
<?php
require_once('files/footer.php');
?>
