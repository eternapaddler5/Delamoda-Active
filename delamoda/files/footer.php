</main>

    <!-- Footer-->
    <footer class="site-footer pt-5">
      <div class="container">
        <div class="row gy-4 pb-2">
          <div class="col-md-4 col-sm-6">
            <h3 class="fs-base text-light mb-3">Categories</h3>
            <ul class="list-unstyled">
              <li class="mb-2"><a class="footer-link" href="shop-grid-ls.html">Athletic Apparel</a></li>
              <li class="mb-2"><a class="footer-link" href="shop-grid-ls.html">Athletic Accessories</a></li>
            </ul>
          </div>
          <div class="col-md-4 col-sm-6">
            <h3 class="fs-base text-light mb-3">Account &amp; Delivery Info</h3>
            <ul class="list-unstyled mb-4">
              <li class="mb-2"><a class="footer-link" href="account-signin.html">My Account</a></li>
              <li class="mb-2"><a class="footer-link" href="#">Delivery Info</a></li>
              <li class="mb-2"><a class="footer-link" href="order-tracking.html">Order Tracking</a></li>
            </ul>
            <h3 class="fs-base text-light mb-3">About Us</h3>
            <ul class="list-unstyled">
              <li class="mb-2"><a class="footer-link" href="about.html">About Company</a></li>
              <li class="mb-2"><a class="footer-link" href="help-topics.html">FAQs</a></li>
            </ul>
          </div>
          <div class="col-md-4">
            <h3 class="fs-base text-light mb-3">Stay Informed</h3>
            <!-- Posts to your own handler. Wire this to your mailing list, not a template demo account. -->
            <form class="needs-validation" action="subscribe.php" method="post" novalidate>
              <div class="input-group">
                <span class="input-group-text bg-transparent border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                <input class="form-control border-start-0" type="email" name="email" placeholder="Your email" required>
                <button class="btn btn-primary" type="submit">Subscribe</button>
                <div class="invalid-feedback">Please enter a valid email address.</div>
              </div>
              <div class="form-text text-light opacity-50">Early discount offers, updates and new product info, straight to your inbox.</div>
            </form>
          </div>
        </div>
      </div>

      <div class="footer-band py-5 mt-4">
        <div class="container">
          <div class="row gy-4 pb-3">
            <div class="col-md-3 col-sm-6">
              <div class="d-flex">
                <i class="bi bi-rocket-takeoff text-accent fs-2"></i>
                <div class="ps-3">
                  <h4 class="fs-base text-light mb-1">Fast Delivery</h4>
                  <p class="mb-0 fs-sm text-light opacity-50">We begin processing your order the moment you check out.</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="d-flex">
                <i class="bi bi-arrow-repeat text-accent fs-2"></i>
                <div class="ps-3">
                  <h4 class="fs-base text-light mb-1">Money Back Guarantee</h4>
                  <p class="mb-0 fs-sm text-light opacity-50">We return your money within 14 days.</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="d-flex">
                <i class="bi bi-headset text-accent fs-2"></i>
                <div class="ps-3">
                  <h4 class="fs-base text-light mb-1">24/7 Customer Support</h4>
                  <p class="mb-0 fs-sm text-light opacity-50">Friendly support, whenever you need it.</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="d-flex">
                <i class="bi bi-credit-card text-accent fs-2"></i>
                <div class="ps-3">
                  <h4 class="fs-base text-light mb-1">Secure Online Payment</h4>
                  <p class="mb-0 fs-sm text-light opacity-50">We hold a valid SSL / security certificate.</p>
                </div>
              </div>
            </div>
          </div>

          <hr class="footer-hr mb-4">

          <div class="row gy-4 align-items-center pb-2">
            <div class="col-md-6 text-center text-md-start">
              <a class="d-inline-flex align-items-center text-decoration-none mb-3" href="index-2.html">
                <img class="rounded-2" src="imgz/delamoda-logo.JPEG" width="48" alt="Delamoda">
                <span class="ms-2 fs-5 fw-bold text-light" style="font-family:'Barlow Semi Condensed',sans-serif;">Delamoda</span>
              </a>
              <ul class="list-unstyled d-flex flex-wrap justify-content-center justify-content-md-start gap-3 gap-md-4 mb-0">
                <li><a class="footer-link" href="#">Outlets</a></li>
                <li><a class="footer-link" href="#">Affiliates</a></li>
                <li><a class="footer-link" href="help-submit-request.html">Support</a></li>
                <li><a class="footer-link" href="#">Privacy</a></li>
                <li><a class="footer-link" href="#">Terms of use</a></li>
              </ul>
            </div>
            <div class="col-md-6 text-center text-md-end">
              <a class="btn-social" href="#" aria-label="Delamoda on Twitter"><i class="bi bi-twitter-x"></i></a>
              <a class="btn-social" href="#" aria-label="Delamoda on Facebook"><i class="bi bi-facebook"></i></a>
              <a class="btn-social" href="#" aria-label="Delamoda on Instagram"><i class="bi bi-instagram"></i></a>
            </div>
          </div>

          <div class="pb-2 fs-xs text-light opacity-50 text-center text-md-start">&copy; <?= date('Y') ?> Delamoda Active. All rights reserved.</div>
        </div>
      </div>
    </footer>

    <!-- Toolbar for handheld devices-->
    <div class="handheld-toolbar d-lg-none">
      <div class="d-table table-layout-fixed w-100">
        <a class="d-table-cell handheld-toolbar-item" href="account-wishlist.html">
          <span class="d-block fs-4"><i class="bi bi-heart"></i></span><span class="fs-xs">Wishlist</span>
        </a>
        <a class="d-table-cell handheld-toolbar-item" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" onclick="window.scrollTo(0, 0)">
          <span class="d-block fs-4"><i class="bi bi-list"></i></span><span class="fs-xs">Menu</span>
        </a>
        <a class="d-table-cell handheld-toolbar-item" href="shop-cart.html">
          <span class="d-block fs-4 position-relative">
            <i class="bi bi-cart3"></i>
            <span class="badge bg-primary rounded-pill handheld-toolbar-badge"><?= (int)($cartCount ?? 0) ?></span>
          </span>
          <span class="fs-xs">K<?= number_format($cartTotal ?? 0, 2) ?></span>
        </a>
      </div>
    </div>

    <!-- Back to top-->
    <a class="btn-scroll-top" href="#top" aria-label="Back to top"><i class="bi bi-arrow-up"></i></a>

    <script src="assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/js/site.js"></script>
  </body>
</html>
