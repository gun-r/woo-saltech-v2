<?php
defined('ABSPATH') || exit;

global $product;

if (!$product->is_purchasable()) {
	return;
}

// Grab the raw unit price for JS
$unit_price = (float) $product->get_price();
?>

<?php if ($product->is_in_stock()): ?>
	<form class="cart"
		action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
		method="post" enctype='multipart/form-data'>

		<?php do_action('woocommerce_before_add_to_cart_button'); ?>

		<div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mb-4">

			<!-- Quantity Input -->
			<div class="flex items-center">
				<label for="quantity_<?php echo esc_attr($product->get_id()); ?>" class="sr-only">
					Quantity
				</label>
				<div class="flex items-center border border-gray-300 rounded-md overflow-hidden bg-white">
					<button type="button"
						class="qty-btn minus px-3 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-colors border-r border-gray-300"
						onclick="salSimpleQty('minus', <?php echo esc_js($product->get_id()); ?>)">
						<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
						</svg>
					</button>
					<input type="number" id="quantity_<?php echo esc_attr($product->get_id()); ?>"
						class="w-14 px-2 py-2 text-center border-0 focus:outline-none focus:ring-0 font-medium text-gray-900 text-sm"
						name="quantity" value="1" min="1" step="1"
						onchange="salSimpleRecalc(<?php echo esc_js($product->get_id()); ?>)" />
					<button type="button"
						class="qty-btn plus px-3 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-colors border-l border-gray-300"
						onclick="salSimpleQty('plus', <?php echo esc_js($product->get_id()); ?>)">
						<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
						</svg>
					</button>
				</div>
			</div>

			<!-- Add to Cart Button -->
			<button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>"
				class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-2 rounded-md transition-colors text-sm">
				<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
				</svg>
				<span><?php echo esc_html($product->single_add_to_cart_text()); ?></span>
			</button>
		</div>

		<!-- Total price line: hidden at qty=1, shown above qty=1 -->
		<p id="sal-simple-total-<?php echo esc_attr($product->get_id()); ?>" class="sal-qty-total-price"></p>

		<?php do_action('woocommerce_after_add_to_cart_button'); ?>
	</form>

	<style>
		input[type="number"]::-webkit-inner-spin-button,
		input[type="number"]::-webkit-outer-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}

		input[type="number"] {
			-moz-appearance: textfield;
		}

		/* ── Total price line ── */
		.sal-qty-total-price {
			font-size: 0.8rem;
			color: #6b7280;
			margin-top: -0.5rem;
			margin-bottom: 0.5rem;
			min-height: 1.25rem;
		}

		.sal-qty-total-price strong {
			color: #15803d;
			font-weight: 700;
		}
	</style>

	<script>
		(function () {

			// Store product price globally
			window['SAL_UNIT_PRICE_<?php echo (int) $product->get_id(); ?>'] =
				<?php echo (float) $product->get_price(); ?>;

			function formatDKK(amount) {
				return 'DKK ' + amount.toLocaleString('da-DK', {
					minimumFractionDigits: 2,
					maximumFractionDigits: 2
				});
			}

			// Plus / Minus buttons
			window.salSimpleQty = function (action, productId) {

				var input = document.getElementById('quantity_' + productId);

				if (!input) {
					return;
				}

				var qty = parseInt(input.value, 10) || 1;
				var min = parseInt(input.getAttribute('min'), 10) || 1;
				var max = parseInt(input.getAttribute('max'), 10) || 999999;

				if (action === 'minus' && qty > min) {
					qty--;
				}

				if (action === 'plus' && qty < max) {
					qty++;
				}

				input.value = qty;

				salSimpleRecalc(productId);
			};

			// Calculate total price
			window.salSimpleRecalc = function (productId) {

				var input = document.getElementById('quantity_' + productId);
				var totalEl = document.getElementById('sal-simple-total-' + productId);

				if (!input || !totalEl) {
					return;
				}

				var unitPrice = window['SAL_UNIT_PRICE_' + productId];

				if (typeof unitPrice === 'undefined') {
					return;
				}

				var qty = parseInt(input.value, 10) || 1;

				// Hide total when quantity is 1
				if (qty <= 1) {
					totalEl.innerHTML = '';
					return;
				}

				var total = unitPrice * qty;

				totalEl.innerHTML =
					'Total for ' + qty +
					': <strong>' + formatDKK(total) + '</strong>';
			};

			// Trigger on manual typing
			document.addEventListener('DOMContentLoaded', function () {

				var input = document.getElementById(
					'quantity_<?php echo (int) $product->get_id(); ?>'
				);

				if (input) {
					input.addEventListener('input', function () {
						salSimpleRecalc(
							<?php echo (int) $product->get_id(); ?>
						);
					});
				}
			});

		})();
	</script>

<?php else: ?>
	<!-- Out of Stock -->
	<div class="flex items-center gap-2 px-3 py-2 bg-gray-100 border border-gray-300 rounded-md">
		<svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
				d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
		</svg>
		<span class="text-sm font-medium text-gray-700"><?php esc_html_e('Out of stock', 'woocommerce'); ?></span>
	</div>
<?php endif; ?>