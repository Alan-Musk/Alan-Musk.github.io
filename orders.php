<?php
session_start();
include('db_connect.php');

// Ensure that you check for the existence of session variables
if (isset($_SESSION['login_user']) && isset($_SESSION['member_id'])) {
    $member_id = $_SESSION['member_id'];

    // Prepare SQL with placeholders
    $paymentSql = "SELECT * FROM payment WHERE member_id = ?";
    $stmt = $conn->prepare($paymentSql);

    // Bind parameters to the placeholders
    $stmt->bind_param("s", $member_id);

    // Execute the statement and store the result
    $stmt->execute();
    $payments = $stmt->get_result();
    $paymentData = $payments->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>cs-self-learning - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="Alan_styles.css">
  <style>
    * {
	padding: 0;
	margin: 0;
	box-sizing: border-box;
}
body {
	display: flex;
	justify-content: center;
	align-items: center;
	height: 100vh;
	background-color: #4793e3;
}
#main .table_container {
	overflow: hidden;
	margin: 0 20px;
	background-color: #fff;
	box-shadow: 0 0 50px rgba(0, 0, 0, 0.5);
}
#main .table_container table {
	border-collapse: collapse;
}
#main .table_container table thead tr th {
	color: #fff;
	background-color: #4fc3a1;
}
/* 还是取单数 */
#main .table_container table thead tr th:nth-child(odd) {
	background-color: #324960;
}
#main .table_container table thead tr th,
#main .table_container table tbody tr td {
	text-align: center;
	padding: 20px 40px;
}
#main .table_container table tbody tr td {
	border: 1px solid rgb(200, 200, 200);
}
#main .table_container table tbody tr:nth-child(odd) {
	background-color: #f8f8f8;
}
#main h2{
    margin-left: 100px;
    margin-right: 100px;
    color: red;
}
@media (max-width: 765px) {
	#main .table_container table {
		display: flex;
	}
	#main .table_container table thead tr {
		display: flex;
		flex-direction: column;
	}
	#main .table_container table tbody {
		display: flex;
		overflow: auto;
	}
	#main .table_container table tbody tr {
		display: flex;
		flex-direction: column;
	}
	#main .table_container table thead tr th,
	#main .table_container table tbody tr td {
		text-align: left;
		width: 120px;
		padding: 20px;
		border: 0;
		border-bottom: 1px solid rgb(200, 200, 200);
		border-right: 1px solid rgb(200, 200, 200);
	}
	#main .table_container table thead tr th:last-child,
	#main .table_container table tbody tr td:last-child {
		border-bottom: 0;
	}
	#main .table_container table tbody tr td:nth-child(odd) {
		background-color: #f8f8f8;
	}
	#main .table_container table tbody tr:nth-child(odd) {
		background-color: transparent;
	}
}

  </style>
</head>
<body>
      <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><img src="assets/img/favicon.png" alt="" class="img-fluid"><a href="index.html">Eyes</a>
      </h1>
      <nav id="navbar" class="navbar">
        <ul>
          <li style="margin-left: 80px;"><a class="nav-link scrollto active" href="index.html">Home</a></li>
          <li style="margin-left: 80px;"><a class="nav-link scrollto" href="#about">About us</a></li>
          <li style="margin-left: 80px;"><a class="nav-link scrollto" href="sponsors.html">Sponsors</a></li>
          <li style="margin-left: 80px;"><a class="nav-link scrollto" href="#contact">Shop/Store</a></li>
          <li style="margin-left: 80px;"><a class="nav-link scrollto" href="#contact">Contact Us</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

<div id="main" >
<?php if (isset($_SESSION['login_user']) && !empty($paymentData)): ?>
        <h2>Payment Details for: <?php echo htmlspecialchars($_SESSION['login_user']); ?></h2>
        <div class="table_container"><table border="1">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($paymentData as $payment): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($payment['DATE']); ?></td>
                        <td><?php echo htmlspecialchars($payment['amount']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table></div>
        
    <?php else: ?>
        <!-- Show some message or content if not logged in or no payments -->
        <p>No payment details available or you are not logged in.</p>
    <?php endif; ?>
</div>
    
  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">


          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Information</h3>
            <p>
              Last updated Date : December 26, 2023 <br> <br>
              <strong>Name:</strong> Zhangfan<br>
              <strong>Student ID:</strong> s1546489<br>
            </p>
          </div>
          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Eyes</h3>
            <p>
              No.1 Wenxian Road <br>
              Minhou County, Fuzhou City <br>
              China <br><br>
              <strong>Phone:</strong> +86 18025192301<br>
              <strong>Email:</strong> Alanmusk@163.com<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="index.html">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index.html">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index.html">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index.html">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index.html">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Social Networks</h4>
            <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>Eyes</span></strong>. All Rights Reserved
      </div>

    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="Alan_javascript.js"></script>
</body>
</html>
