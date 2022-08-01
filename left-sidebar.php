    <div class="left-side-bar">
		<div class="brand-logo">
			<a href="index.php">
				<img src="vendors/images/deskapp-logo.svg" alt="" class="dark-logo">
				<img src="vendors/images/deskapp-logo-white.svg" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li>
						<a href="index.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-home"></span><span class="mtext">Home</span>
						</a>
					</li>
					<?php if ($_SESSION['role'] == 'admin'): ?>
						<!-- Admin -->
						<li>
							<a href="aspirasi.php" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-edit-file"></span><span class="mtext">Aspirasi</span>
							</a>
						</li>
					<?php elseif ($_SESSION['role'] == 'kasir'): ?>
						<!-- Kasir -->
						<li>
							<a href="aspirasi.php" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-edit-file"></span><span class="mtext">Aspirasi</span>
							</a>
						</li>
					<?php else: ?>
						<!-- Pelanggan -->
						<li>
							<a href="aspirasi-mahasiswa.php?id=<?php echo $_SESSION['id_mahasiswa']; ?>" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-edit-file"></span><span class="mtext">Aspirasi</span>
							</a>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>