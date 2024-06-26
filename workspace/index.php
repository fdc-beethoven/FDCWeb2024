<?php
// initialize any config files
require_once "config/init.php";

// load header
include "view_partials/header.php";

if (isset($_GET['page'])) {
	switch ($_GET['page']) {
		case 'register':
			if (isset($_SESSION['is_logged_in'])) {
				include "view_partials/forbidden_logout.php";

			} else {
				include "pages/register.php";
			}
			break;

		case 'login':
			if (isset($_SESSION['is_logged_in'])) {
				include "view_partials/forbidden_logout.php";
			} else {
				include "pages/login.php";
			}
			break;

		case 'logout':
			// delete session
			session_destroy();

			// redirect to login
			echo "<script>
				window.location.href = '?page=login';
			</script>";
			break;
		case "dashboard":
			if (!isset($_SESSION['is_logged_in'])) {
				include "view_partials/forbidden_login.php";

			} else {
				include "pages/dashboard.php";
			}
			break;
		default:
			include "pages/landing_page.php";
			break;
	}
} else {
	include "pages/landing_page.php";
}

// load footer
include "view_partials/footer.php";