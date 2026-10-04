# Delamoda Active — cutover guide (Step 5)

This is the last step: converting whatever pages are still on the old
Cartzilla theme, retiring the old files safely, and a checklist to run
through before launch. It's written as a reference document, since it
covers work you'll do page by page rather than a single file to drop in.

## What's built so far

| Piece | File |
|---|---|
| Fonts, colours, Bootstrap theming | `assets/css/site.css` |
| Sticky header, gallery zoom, carousels, back-to-top, form validation | `assets/js/site.js` |
| Bootstrap, Bootstrap Icons, Drift, fonts (self-hosted) | `assets/vendor/`, `assets/fonts/` |
| Shared header (topbar, nav, search, cart, sign-in modal) | `files/header.php` |
| Shared footer (links, newsletter, toolbar, back-to-top) | `files/footer.php` |
| A full worked example | `product.php` |
| The homepage (hero slider, category carousels, widgets) | `index-2.php` |
| A blank starting point for any other page | `page-template.php` |

Every other page on your site — the shop grid, cart, checkout, account
pages, about, contact, help — is still built on the old theme until you
convert it.

## Converting a page

Take one old page at a time and follow this pattern (it's exactly how
`product.php` was rebuilt from your original `shop-single-v1.html`):

1. **Open the old page.** Find where its own content starts, right after
   the navigation, and where it ends, right before the footer.
2. **Copy `page-template.php`** as your starting point for the new page.
3. **Paste the old page's unique content** between `require_once('files/header.php')`
   and `require_once('files/footer.php')`. Everything above and below that
   in the old file — the `<head>`, the navbar, the footer, the vendor
   `<script>` tags — is already handled by the shared header and footer, so
   delete it from this page.
4. **Swap every icon.** The old theme used `ci-` icon classes; the new one
   uses Bootstrap Icons (`bi-`). The table below covers every icon used
   across the pages built so far — check it before guessing a name.
5. **Swap any carousel.** Replace a `tns-carousel` block with the
   `hscroll-group` / `hscroll` / `hscroll-nav` pattern from `product.php`
   (search that file for "Style with" to see it end to end).
6. **Check for `lightGallery`.** If a page uses it for a photo gallery
   (rather than the single-image zoom `product.php` uses), flag it and send
   me that page — lightGallery's commercial licence is unclear, so it's
   worth replacing rather than carrying forward.
7. **Lint and test it**, the same way each earlier step was: open it in the
   browser, click through everything on the page, and check the browser's
   console for errors (right-click, Inspect, Console tab).

Paste me any page and I'll do this conversion for you directly, the same
way I did the header, footer, and product page.

### Icon name changes (`ci-` → `bi-`)

| Old (Cartzilla) | New (Bootstrap Icons) |
|---|---|
| `ci-cart` | `bi-cart3` |
| `ci-heart` | `bi-heart` / `bi-heart-fill` |
| `ci-user` | `bi-person` |
| `ci-search` | `bi-search` |
| `ci-menu` | `bi-list` |
| `ci-home` | `bi-house` |
| `ci-location` | `bi-geo-alt` |
| `ci-support` | `bi-headset` |
| `ci-mail` | `bi-envelope` |
| `ci-card` | `bi-credit-card` |
| `ci-delivery` | `bi-truck` |
| `ci-security-check` | `bi-shield-check` |
| `ci-star-filled` / `ci-star` | `bi-star-fill` / `bi-star` |
| `ci-arrow-right` | `bi-arrow-right` |
| `ci-arrow-up` | `bi-arrow-up` |
| `ci-reload` | `bi-arrow-clockwise` |
| `ci-ruler` | `bi-rulers` |
| `ci-announcement` | `bi-megaphone` |
| `ci-twitter` | `bi-twitter-x` |
| `ci-facebook` | `bi-facebook` |
| `ci-instagram` | `bi-instagram` |
| `ci-view-grid` | `bi-grid` |
| `ci-close` / `×` buttons | Bootstrap's own `.btn-close` (no icon needed) |

If a page uses a `ci-` icon not listed here, search
[icons.getbootstrap.com](https://icons.getbootstrap.com) for the closest
match and tell me if nothing fits.

## Retiring the old theme

**Do this only once every page has been converted.** Deleting these while
an unconverted page still links to them will break that page.

Safe to delete once every page is converted:

- `css/theme.min.css`
- `js/theme.min.js`
- `theme.css` (the extra one from your very first header, if it's still
  there and turns out to be unused — open it and check first)
- `vendor/tiny-slider/`
- `vendor/simplebar/`
- `vendor/smooth-scroll/`
- `vendor/lightgallery/` (unless a page still genuinely needs it)
- `vendor/drift-zoom/` (the old copy — the new one lives in `assets/vendor/drift/`)
- `vendor/bootstrap/` (the old copy — the new one lives in `assets/vendor/bootstrap/`)
- The old Font Awesome / `ci-` icon font files, once no page references `ci-` classes any more
- `img/` — the folder of Cartzilla demo photos (cart items, size-chart swatches). Your real photos live in `imgz/` and are untouched by any of this.

Keep:

- `imgz/` — your real product and site photos
- `files/functions.php` — your own code
- Anything else that isn't part of the Cartzilla template

## Pre-launch checklist

Pulled together from everything flagged across all four steps:

- [ ] **Cartzilla licence.** Confirm you have a paid licence, since the
      files were originally saved from the public demo site.
- [ ] **Cart wiring.** `files/header.php` and `files/footer.php` both read
      `$_SESSION['cart']` for the count and total. Connect this to your
      real cart logic.
- [ ] **Backend handlers.** These forms currently point to files that
      don't exist yet: `cart-add.php`, `cart-remove.php`, `subscribe.php`,
      `review-add.php`.
- [ ] **Placeholder reviews.** The Omar and Barbra reviews on the product
      page, and the "74 reviews / 4.2 rating" figures, are placeholders.
      Replace with real reviews before launch — a made-up review
      attributed to a real, named person can imply an endorsement they
      never gave, and fabricated reviews are illegal to publish in many
      places.
- [ ] **Product data.** Only the vest has real structured data
      (`$product` array at the top of `product.php`). Every other product
      needs the same treatment.
- [ ] **Delivery details.** Check the courier names, timeframes and
      pricing in the Delivery accordion are accurate.
- [ ] **Placeholder links.** Outlets, Affiliates, Privacy, Terms of use,
      and a few others in the footer still point to `#`.
- [ ] **Favicons and manifest.** `apple-touch-icon.png`, the favicon PNGs,
      and `site.webmanifest` are referenced but weren't part of this
      rebuild — confirm they still exist in your site folder.
- [ ] **Cross-browser and mobile check**, once every page is converted:
      open the site on an actual phone, not just a resized desktop
      browser window.
