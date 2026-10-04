<?php
// Copy this file as a starting point for any page that still uses the old
// Cartzilla theme. The header and footer are shared; only the middle
// section between them is specific to this page.
session_start();
require_once('files/header.php');
?>

      <!-- Page title (optional - see page-title-band in product.php for an example) -->
      <div class="page-title-band py-4">
        <div class="container">
          <h1 class="h3 mb-0">Page title</h1>
        </div>
      </div>

      <div class="container py-5">
        <p>Page content goes here.</p>
      </div>

<?php
require_once('files/footer.php');
?>
