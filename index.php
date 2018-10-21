<?php
/**
 * Advanced PHP 7 eCommerce Website (https://22digital.agency)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 *
 * @copyright Copyright (c) 22 Digital (https://22digital.agency)
 * @copyright Copyright (c) Justin Hartman (https://justinhartman.blog)
 * @author    Justin Hartman <justin@hartman.me> (https://justinhartman.blog)
 * @link      https://github.com/justinhartman/complete-php7-ecom-website GitHub Project
 * @since     0.1.0
 * @license   https://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 */

/**
 * Check platform requirements.
 */
require __DIR__ . '/config/requirements.php';

/**
 * Load the bootstrap file.
 */
require __DIR__ . '/config/bootstrap.php';

/**
 * Load the template files.
 */
include INC . 'header.php';
include INC . 'nav.php';
?>

<!-- SHOP CONTENT -->
<section id="content">
    <div class="content-blog">
        <div class="container">
            <div class="row">
                <div class="page_header text-center">
                    <h2>Shop</h2>
                    <p>Browse our collection of Products to find just what you are looking for.</p>
                </div>
                <div class="col-md-12">
                        <div id="shop-mason" class="shop-mason-3col">
                            <div class="row">
                            <?php
                            // Get a list of all the products; either for the home page or the
                            // individual category pages.
                            $sql = "SELECT * FROM `products`";
                            if (isset($_GET['id']) & !empty($_GET['id'])) {
                                $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
                                $sql .= " WHERE `catid`=$id";
                            }
                            // Setup the data for the loop.
                            $res = mysqli_query($connection, $sql);
                            $product = mysqli_fetch_assoc($res);
                            // Run through all the products and display the items.
                            foreach ($res as $r):
                                // This checks for every third product item in the list and
                                // outputs a clearfix component to ensure our layout renders
                                // as expected and ensures the products all line up correctly.
                                $count++;
                                if ($count % 4 == 0) {
                                    echo '<div class="clearfix space35"></div>';
                                }
                            ?>
                                <div class="shop-item">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <img src="<?php echo getenv('STORE_URL'); ?>/admin/<?php echo $r['thumb']; ?>" class="img-responsive" width="250px" alt="">
                                            <div class="product-overlay">
                                                <span>
                                                    <a href="<?php echo getenv('STORE_URL'); ?>/single.php?id=<?php echo $r['id']; ?>" class="fa fa-link"></a>
                                                    <a href="<?php echo getenv('STORE_URL'); ?>/addtocart.php?id=<?php echo $r['id']; ?>" class="fa fa-shopping-cart"></a>
                                                </span>
                                            </div>
                                        </div>
                                        <?php // TODO: Need to add functionality so people can rate items.  ?>
                                        <div class="rating">
                                            <span class="fa fa-star act"></span>
                                            <span class="fa fa-star act"></span>
                                            <span class="fa fa-star act"></span>
                                            <span class="fa fa-star act"></span>
                                            <span class="fa fa-star act"></span>
                                        </div>
                                        <h2 class="product-title"><a href="<?php echo getenv('STORE_URL'); ?>/single.php?id=<?php echo $r['id']; ?>"><?php echo $r['name']; ?></a></h2>
                                        <div class="product-price"><?php echo getenv('STORE_CURRENCY') . $r['price']; ?><span></span></div>
                                    </div>
                                </div>
                            <?php
                            endforeach; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- Pagination -->
                    <?php // TODO: Pagination doesn't work. Need to build in the functionality. ?>
                    <div class="page_nav">
                        <a href=""><i class="fa fa-angle-left"></i></a>
                        <a href="" class="active">1</a>
                        <a href="">2</a>
                        <a href="">3</a>
                        <a class="no-active">...</a>
                        <a href="">9</a>
                        <a href=""><i class="fa fa-angle-right"></i></a>
                    </div>
                    <!-- End Pagination -->
                </div>
            </div>
        </div>
    </div>
</section>

<?php include INC . 'footer.php'; ?>
