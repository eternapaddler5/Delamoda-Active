<?php
// Cart summary. Reads $_SESSION['cart'] as a list of items with
// id, name, price, qty, image. Replace this block once your cart is real.
$cart = $_SESSION['cart'] ?? [];
$cartCount = 0;
$cartTotal = 0;
foreach ($cart as $item) {
    $cartCount += $item['qty'];
    $cartTotal += $item['price'] * $item['qty'];
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <title>Delamoda Active</title>
    <meta name="description" content="Delamoda Active - activewear and sports accessories">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
    <meta name="theme-color" content="#131c18">
    <link rel="stylesheet" href="assets/vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap-icons/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/vendor/drift/drift-basic.min.css">
    <link rel="stylesheet" href="assets/css/site.css">
</head>
<body id="top">
    <!-- Sign in / sign up modal-->
    <div class="modal fade" id="signin-modal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <ul class="nav nav-tabs card-header-tabs border-0" role="tablist">
              <li class="nav-item"><a class="nav-link active" href="#signin-tab" data-bs-toggle="tab" role="tab"><i class="bi bi-unlock me-2"></i>Sign in</a></li>
              <li class="nav-item"><a class="nav-link" href="#signup-tab" data-bs-toggle="tab" role="tab"><i class="bi bi-person me-2"></i>Sign up</a></li>
            </ul>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body tab-content py-4">
            <form class="needs-validation tab-pane fade show active" id="signin-tab" method="post" novalidate>
              <div class="mb-3">
                <label class="form-label" for="si-email">Email address</label>
                <input class="form-control" type="email" id="si-email" name="email" placeholder="johndoe@example.com" required>
                <div class="invalid-feedback">Please provide a valid email address.</div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="si-password">Password</label>
                <input class="form-control" type="password" id="si-password" name="password" placeholder="Password" required>
              </div>
              <div class="mb-3 d-flex flex-wrap justify-content-between">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="si-remember" name="remember">
                  <label class="form-check-label" for="si-remember">Remember me</label>
                </div><a class="fs-sm" href="account-password-recovery.html">Forgot password?</a>
              </div>
              <button class="btn btn-primary btn-shadow d-block w-100" type="submit">Sign in</button>
            </form>
            <form class="needs-validation tab-pane fade" id="signup-tab" method="post" novalidate>
              <div class="row">
                <div class="col-sm-6 mb-3">
                  <label class="form-label" for="su-firstname">First Name</label>
                  <input class="form-control" type="text" id="su-firstname" name="first_name" placeholder="John" required>
                  <div class="invalid-feedback">Please fill in your name.</div>
                </div>
                <div class="col-sm-6 mb-3">
                  <label class="form-label" for="su-lastname">Last Name</label>
                  <input class="form-control" type="text" id="su-lastname" name="last_name" placeholder="Doe" required>
                  <div class="invalid-feedback">Please fill in your name.</div>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="su-email">Email address</label>
                <input class="form-control" type="email" id="su-email" name="email" placeholder="johndoe@example.com" required>
                <div class="invalid-feedback">Please provide a valid email address.</div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="su-password">Password</label>
                <input class="form-control" type="password" id="su-password" name="password" required>
              </div>
              <div class="mb-3">
                <label class="form-label" for="su-password-confirm">Confirm password</label>
                <input class="form-control" type="password" id="su-password-confirm" name="password_confirm" required>
              </div>
              <button class="btn btn-primary btn-shadow d-block w-100" type="submit">Sign up</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <main class="page-wrapper">
      <header class="site-header">
        <!-- Topbar-->
        <div class="bg-darker py-2 border-bottom">
          <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="text-nowrap fs-sm text-muted d-none d-md-flex align-items-center"><i class="bi bi-headset me-2"></i><a class="text-muted" href="tel:00331697720">Chatbot</a></div>
            <div class="fs-sm text-muted mx-auto mx-md-0">Friendly 24/7 customer support</div>
            <div class="d-flex align-items-center gap-3">
              <a class="fs-sm text-muted text-nowrap" href="order-tracking.html"><i class="bi bi-geo-alt me-1"></i>Order tracking</a>
              <div class="dropdown">
                <button class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                  <img class="me-2" src="imgz/zam-flag.png" width="20" alt="English">eng / ZMW
                </button>
                <ul class="dropdown-menu dropdown-menu-end p-2">
                  <li>
                    <select class="form-select form-select-sm">
                      <option value="zmw">K ZMW</option>
                      <option value="usd">$ USD</option>
                    </select>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- Main navbar-->
        <nav class="navbar navbar-expand-lg py-3 border-bottom" style="background-color: var(--dm-surface);">
          <div class="container">
            <a class="navbar-brand d-flex align-items-center flex-shrink-0" href="index-2.html">
              <img src="imgz/delamoda-logo.JPEG" width="36" class="rounded-2" alt="Delamoda Active">
              <span class="navbar-brand-name ms-2 fs-5">Delamoda</span>
            </a>

            <div class="navbar-search d-none d-lg-block flex-grow-1 mx-4">
              <i class="bi bi-search"></i>
              <input class="form-control" type="search" placeholder="Search for products" aria-label="Search for products">
            </div>

            <div class="d-flex align-items-center order-lg-3">
              <a class="navbar-tool d-none d-lg-inline-flex" href="account-wishlist.html" data-bs-toggle="tooltip" title="Wishlist">
                <span class="navbar-tool-icon"><i class="bi bi-heart fs-5"></i></span>
              </a>
              <a class="navbar-tool" href="#signin-modal" data-bs-toggle="modal" title="Sign in / My account">
                <span class="navbar-tool-icon"><i class="bi bi-person fs-5"></i></span>
              </a>

              <div class="dropdown">
                <a class="navbar-tool cart-toggle" href="shop-cart.html" data-bs-toggle="dropdown">
                  <span class="navbar-tool-icon"><i class="bi bi-cart3 fs-5"></i></span>
                  <span class="cart-badge"><?= $cartCount ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end cart-dropdown">
                  <div class="cart-dropdown-scroll">
                    <?php if (empty($cart)): ?>
                      <p class="cart-empty mb-0">Your cart is empty</p>
                    <?php else: foreach ($cart as $item): ?>
                      <div class="cart-item">
                        <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                        <div class="flex-grow-1">
                          <a class="cart-item-name d-block" href="#"><?= htmlspecialchars($item['name']) ?></a>
                          <div class="fs-sm"><span class="text-accent me-2">K<?= number_format($item['price'], 2) ?></span><span class="text-muted">x <?= (int)$item['qty'] ?></span></div>
                        </div>
                        <a class="cart-item-remove" href="cart-remove.php?id=<?= (int)$item['id'] ?>" aria-label="Remove"><i class="bi bi-x-lg"></i></a>
                      </div>
                    <?php endforeach; endif; ?>
                  </div>
                  <div class="d-flex justify-content-between align-items-center px-3 py-3">
                    <span class="text-muted fs-sm">Subtotal:</span><span class="text-accent">K<?= number_format($cartTotal, 2) ?></span>
                  </div>
                  <div class="px-3 pb-3">
                    <a class="btn btn-outline-secondary btn-sm d-block w-100 mb-2" href="shop-cart.html">Expand cart <i class="bi bi-arrow-right ms-1"></i></a>
                    <a class="btn btn-primary btn-sm d-block w-100" href="checkout-details.html"><i class="bi bi-credit-card me-2"></i>Checkout</a>
                  </div>
                </div>
              </div>

              <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-label="Toggle menu"><i class="bi bi-list fs-3"></i></button>
            </div>

            <div class="collapse navbar-collapse order-lg-2" id="navbarCollapse">
              <div class="d-lg-none my-3">
                <div class="navbar-search">
                  <i class="bi bi-search"></i>
                  <input class="form-control" type="search" placeholder="Search for products" aria-label="Search for products">
                </div>
              </div>
              <ul class="navbar-nav primary-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="bi bi-grid me-2"></i>Categories</a>
                  <div class="dropdown-menu mega-menu">
                    <div class="row g-3">
                      <div class="col-sm-6 mega-menu-col">
                        <a href="#"><img src="imgz/shorts.jpeg" alt="Clothing"></a>
                        <h3>Clothing</h3>
                        <ul class="list-unstyled fs-sm">
                          <li class="mb-1"><a class="widget-list-link" href="#">Women's Apparel</a></li>
                          <li class="mb-1"><a class="widget-list-link" href="#">Men's Apparel</a></li>
                          <li class="mb-1"><a class="widget-list-link" href="#">Kid's Apparel</a></li>
                        </ul>
                      </div>
                      <div class="col-sm-6 mega-menu-col">
                        <a href="#"><img src="imgz/accessories.jpg" alt="Sports Accessories"></a>
                        <h3>Sports Accessories</h3>
                        <ul class="list-unstyled fs-sm">
                          <li class="mb-1"><a class="widget-list-link" href="#">Arm Sleeves</a></li>
                          <li class="mb-1"><a class="widget-list-link" href="#">Gloves</a></li>
                          <li class="mb-1"><a class="widget-list-link" href="#">Bags</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="shop-grid-ls.html">Shop</a></li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Account</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="account-signin.html">Sign In / Sign Up</a></li>
                    <li><a class="dropdown-item" href="account-orders.html">Orders History</a></li>
                    <li><a class="dropdown-item" href="account-profile.html">Profile Settings</a></li>
                    <li><a class="dropdown-item" href="account-address.html">Account Addresses</a></li>
                    <li><a class="dropdown-item" href="account-payment.html">Payment Methods</a></li>
                    <li><a class="dropdown-item" href="account-wishlist.html">Wishlist</a></li>
                    <li><a class="dropdown-item" href="account-tickets.html">My Tickets</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="account-password-recovery.html">Password Recovery</a></li>
                  </ul>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Pages</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="about.html">About Us</a></li>
                    <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
                    <li><a class="dropdown-item" href="help-topics.html">Help Topics</a></li>
                    <li><a class="dropdown-item" href="help-submit-request.html">Submit a Request</a></li>
                    <li><a class="dropdown-item" href="about.html">Blog</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <?php
      if (isset($_SESSION['alert'])) {
      ?>
        <div class="container pt-4">
          <div class="alert alert-<?= htmlspecialchars($_SESSION['alert']['type']) ?>">
            <?= $_SESSION['alert']['message'] ?>
          </div>
        </div>
      <?php
      unset($_SESSION['alert']);
      }
      ?>
