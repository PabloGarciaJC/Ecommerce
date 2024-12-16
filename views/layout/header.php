<!-- top-header -->
<div class="agile-main-top">
	<div class="container-fluid">
		<div class="row main-top-w3l py-2">
			<div class="col-lg-4 header-most-top">
				<p class="text-white text-lg-left text-center">
					<?php echo TEXT_BEST_OFFERS; ?>
					<i class="fas fa-shopping-cart ml-1"></i>
				</p>
			</div>
			<div class="col-lg-8 header-right mt-lg-0 mt-2">
				<ul class="text-right">
					<li class="text-center border-right text-white">
						<i class="fas fa-phone mr-2"></i> <?php echo TEXT_PHONE_NUMBER; ?>
					</li>
					<li class="text-center border-right text-white">
						<?php if (isset($_SESSION['usuarioRegistrado'])) : ?>
							<a href="<?= BASE_URL ?>Admin/dashboard" class="text-white">
								<?php echo $usuario->Usuario; ?>
							</a>
						<?php else : ?>
							<a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" class="text-white">
								<i class="fas fa-sign-in-alt mr-2"></i> <?php echo TEXT_HELLO_IDENTIFY; ?></a>
							</a>
						<?php endif; ?>
					</li>
					<li class="text-center text-white">
						<a href="#" data-toggle="modal" data-target="#exampleModal2" class="text-white">
							<i class="fas fa-sign-out-alt mr-2"></i><?php echo TEXT_REGISTER; ?></a>
					</li>
				</ul>
			</div>
		</div>

	</div>
</div>

<div class="navbar-inner">
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">

			<div class="language-selector">
				<form action="<?php echo BASE_URL . ltrim($_SERVER['REQUEST_URI'], '/') ?>" method="POST">
					<div class="language-dropdown">
						<select id="language-select" name="lenguaje" required onchange="this.form.submit()">
							<option value="es" <?php echo (isset($_SESSION['lang']) && $_SESSION['lang'] == 'es') ? 'selected' : ''; ?>>
								🇪🇸 Español
							</option>
							<option value="en" <?php echo (isset($_SESSION['lang']) && $_SESSION['lang'] == 'en') ? 'selected' : ''; ?>>
								🇬🇧 Inglés
							</option>
							<option value="fr" <?php echo (isset($_SESSION['lang']) && $_SESSION['lang'] == 'fr') ? 'selected' : ''; ?>>
								🇫🇷 Francés
							</option>
						</select>
					</div>
				</form>
			</div>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
				aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">

				<ul class="navbar-nav ml-auto text-center mr-xl-5">
					<li class="nav-item <?php echo (basename($_SERVER['REQUEST_URI']) == '' || basename($_SERVER['REQUEST_URI']) == 'index.php') ? 'active' : ''; ?> mr-lg-2 mb-lg-0 mb-2">
						<a class="nav-link" href="<?php echo BASE_URL; ?>"><?php echo TEXT_INICIO; ?>
							<span class="sr-only">(current)</span>
						</a>
					</li>
					<!-- Categorías y Productos -->
					<?php if (!empty($categoriasConSubcategoriasYProductos)) : ?>
						<?php foreach ($categoriasConSubcategoriasYProductos as $item) : ?>
							<li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
								<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<?= $item['categoria']->nombre ?>
								</a>
								<!-- Dropdown de Subcategorías y Productos -->
								<div class="dropdown-menu multi-level-dropdown">
									<div class="agile_inner_drop_nav_info p-4">
										<div class="row">
											<!-- Subcategorías -->
											<?php if (isset($item['subcategorias']) && $item['subcategorias']->num_rows > 0) : ?>
												<div class="col-sm-6 multi-gd-img">
													<h6>Subcategorías</h6>
													<ul class="multi-column-dropdown">
														<?php while ($subcategoria = $item['subcategorias']->fetch_object()) : ?>
															<li><a href="catalogo.php?categoriaId=<?= $subcategoria->id ?>"><?= $subcategoria->nombre ?></a></li>
														<?php endwhile; ?>
													</ul>
												</div>
											<?php endif; ?>
											<!-- Productos -->
											<?php if (isset($item['productos']) && $item['productos']->num_rows > 0) : ?>
												<div class="col-sm-6 multi-gd-img">
													<h6>Productos</h6>
													<ul class="multi-column-dropdown">
														<?php while ($producto = $item['productos']->fetch_object()) : ?>
															<li><a href="producto.php?id=<?= $producto->id ?>"><?= $producto->nombre ?></a></li>
														<?php endwhile; ?>
													</ul>
												</div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</li>
						<?php endforeach; ?>
					<?php endif; ?>
					<!-- Otros enlaces -->
					<li class="nav-item <?php echo (basename($_SERVER['REQUEST_URI']) == 'nosotros') ? 'active' : ''; ?> mr-lg-2 mb-lg-0 mb-2">
						<a class="nav-link" href="<?php echo BASE_URL; ?>Home/nosotros"><?php echo TEXT_NOSOTROS; ?></a>
					</li>
					<li class="nav-item <?php echo (basename($_SERVER['REQUEST_URI']) == 'contactanos') ? 'active' : ''; ?>">
						<a class="nav-link" href="<?php echo BASE_URL; ?>Home/contactanos"><?php echo TEXT_CONTACTANOS; ?></a>
					</li>
				</ul>
			</div>

		</nav>
	</div>
</div>
<!-- //navigation -->

<!-- Buscador -->
<div class="header-bot">
	<div class="container">
		<div class="row header-bot_inner_wthreeinfo_header_mid">
			<!-- logo -->
			<div class="col-md-3 logo_agile">
				<h1 class="text-center">
					<a href="<?= BASE_URL ?>" class="font-weight-bold font-italic">
						<img src="<?= BASE_URL ?>assets/images/logo2.png" class="img-fluid"><?php echo TEXT_ELECTRO_STORE; ?>
					</a>
				</h1>
			</div>
			<div class="col-md-9 header mt-4 mb-md-0 mb-4">
				<div class="row">
					<div class="col-10 agileits_search">
						<form class="form-inline" action="#" method="post">
							<input class="form-control mr-sm-2" type="search" placeholder="<?php echo TEXT_SEARCH_BUTTON; ?>" aria-label="Search" required>
							<button class="btn my-2 my-sm-0" type="submit"><?php echo TEXT_SEARCH_BUTTON; ?></button>
						</form>
					</div>
					<div class="col-2 top_nav_right text-center mt-sm-0 mt-2">
						<div class="wthreecartaits wthreecartaits2 cart cart box_1">
							<form action="#" method="post" class="last">
								<input type="hidden" name="cmd" value="_cart">
								<input type="hidden" name="display" value="1">
								<button class="btn w3view-cart" type="submit" name="submit" value="">
									<i class="fas fa-cart-arrow-down"></i>
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>