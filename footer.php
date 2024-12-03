<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4">Address</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>A 563, Main Shahrah-e-Usman, Sector 11-A North Karachi, Karachi,</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-outline-light btn-social" href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social" href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social" href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-outline-light btn-social" href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4">Opening Hours</h4>
                <h6 class="text-light">Monday - Friday:</h6>
                <p class="mb-4">09.00 AM - 09.00 PM</p>
                <h6 class="text-light">Saturday - Sunday:</h6>
                <p class="mb-0">09.00 AM - 12.00 PM</p>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4">Services</h4>
                <a class="btn btn-link" href="">Diagnostic Test</a>
                <a class="btn btn-link" href="">Engine Servicing</a>
                <a class="btn btn-link" href="">Tires Replacement</a>
                <a class="btn btn-link" href="">Oil Changing</a>
                <a class="btn btn-link" href="">Vacuum Cleaning</a>
            </div>

            <div class="col-lg-3 col-md-6">
    <h4 class="text-light mb-4">Subscribe Yourself</h4>
    <p>Explore the latest advancements in car automation with our latest newsletter. Stay updated on trends directly in your inbox.</p>
    <div class="position-relative mx-auto" style="max-width: 400px;">
        <form action="subscribe.php" method="POST"  id="newsletterForm">
            <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="email" name="email" id="email" placeholder="Your email" required>
            <button type="submit" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">Subscribe</button>
        </form>
    </div>
    <!-- Success and Error Messages -->
    <div id="message" class="mt-3"></div>
</div>

<script>
document.getElementById('newsletterForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const email = document.getElementById('email').value;
    const messageDiv = document.getElementById('message');

    fetch('subscribe.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `email=${encodeURIComponent(email)}`,
    })
    .then(response => response.text())
    .then(data => {
        messageDiv.innerHTML = `<p class="text-success">${data}</p>`;
    })
    .catch(error => {
        messageDiv.innerHTML = `<p class="text-danger">Subscription failed. Please try again.</p>`;
        console.error('Error:', error);
    });
});
</script>

            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">TechDriveLab</a> All Right Reserved.

                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->

                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FAQs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/wow/wow.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/tempusdominus/js/moment.min.js"></script>
        <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>