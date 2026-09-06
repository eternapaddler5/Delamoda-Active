// Delamoda Active — cart logic
function loadCart() {
    try {
        const stored = JSON.parse(localStorage.getItem('activewear_cart'));
        return Array.isArray(stored) ? stored : [];
    } catch (e) {
        return [];
    }
}

let cart = loadCart();

function saveCart() {
    localStorage.setItem('activewear_cart', JSON.stringify(cart));
    updateCartUI();
}

function addToCart(id, name, price, image, btn) {
    if (!id || !name || Number.isNaN(price)) return;

    const existingItem = cart.find(item => String(item.id) === String(id));
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({ id, name, price, image, quantity: 1 });
    }
    saveCart();

    if (btn) {
        const originalText = btn.innerText;
        btn.innerText = 'ADDED!';
        btn.classList.add('added');
        setTimeout(() => {
            btn.innerText = originalText;
            btn.classList.remove('added');
        }, 1200);
    }
}

function getCartTotal() {
    return cart.reduce((total, item) => total + (item.price * item.quantity), 0).toFixed(2);
}

function getCartCount() {
    return cart.reduce((sum, item) => sum + item.quantity, 0);
}

function removeFromCart(id) {
    cart = cart.filter(item => String(item.id) !== String(id));
    saveCart();
    renderCheckoutCart();
}

function updateCartUI() {
    const count = getCartCount();
    const ids = ['cart-count', 'nav-cart-count', 'mobile-cart-count'];

    ids.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.innerText = count;
            if (id === 'cart-count') {
                el.classList.add('scale-125');
                setTimeout(() => el.classList.remove('scale-125'), 200);
            }
        }
    });
}

function renderCheckoutCart() {
    const container = document.getElementById('checkout-cart-items');
    const totalEl = document.getElementById('checkout-total');
    if (!container) return;

    container.innerHTML = '';
    if (cart.length === 0) {
        container.innerHTML = '<p class="text-zinc-500 text-sm">Your cart is empty. <a href="index.php#shop" class="text-rose-600 font-bold underline">Shop now</a></p>';
    } else {
        cart.forEach(item => {
            const row = document.createElement('div');
            row.className = 'flex justify-between items-center py-3 border-b border-zinc-200';
            row.innerHTML = `
                <div>
                    <h4 class="font-bold uppercase text-sm text-zinc-900"></h4>
                    <p class="text-xs text-zinc-500 mt-0.5">Qty: ${item.quantity}</p>
                </div>
                <div class="flex items-center gap-3">
                    <p class="font-bold text-sm">K${(item.price * item.quantity).toFixed(2)}</p>
                    <button type="button" class="remove-cart-item text-rose-500 hover:text-rose-700 text-xs font-bold uppercase" aria-label="Remove item from cart">Remove</button>
                </div>
            `;
            row.querySelector('h4').textContent = item.name;
            row.querySelector('.remove-cart-item').addEventListener('click', () => removeFromCart(item.id));
            container.appendChild(row);
        });
    }

    if (totalEl) totalEl.innerText = `K${getCartTotal()}`;

    const cartDataInput = document.getElementById('cart_data');
    if (cartDataInput) cartDataInput.value = JSON.stringify(cart);
}

function addFromButton(btn) {
    addToCart(
        parseInt(btn.dataset.id, 10),
        btn.dataset.name,
        parseFloat(btn.dataset.price),
        btn.dataset.image,
        btn
    );
}

function initCartButtons() {
    document.querySelectorAll('.quick-add-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            addFromButton(this);
        });
    });

    document.querySelectorAll('.product-card').forEach(card => {
        card.addEventListener('click', function (e) {
            if (e.target.closest('.quick-add-btn')) return;
            const btn = this.querySelector('.quick-add-btn');
            if (btn) addFromButton(btn);
        });
    });
}

function bootCart() {
    updateCartUI();
    renderCheckoutCart();
    initCartButtons();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', bootCart);
} else {
    bootCart();
}
