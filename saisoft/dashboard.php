<?php
session_start();
if(!isset($_SESSION['user'])) header("Location: index.php");
include 'db.php';

if(isset($_POST['send_feedback'])){
    $msg = mysqli_real_escape_string($conn, $_POST['msg']);
    mysqli_query($conn, "INSERT INTO feedback(message) VALUES('$msg')");
    echo "<script>alert('Feedback Received!');</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Enterprise Dashboard | Sai Soft</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="cursor"></div>

    <nav class="dash-nav">
        <div class="logo">SAI SOFT <span>INFOSYS</span></div>
        <div class="menu">
            <a href="#products">Products</a>
            <a href="#pricing">Pricing</a>
            <a href="#gst">GST Tools</a>
            <a href="#support">Support</a>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </nav>

    <main class="main-content">
        <section class="welcome-banner card">
            <h1 class="logo-3d">PANDIT N. KALURKAR</h1>
            <h3>3 Star Sales & Implementation Partner</h3>
            <p>Welcome, <?php echo $_SESSION['user']; ?> | Contact: 8806663011</p>
        </section>

        <section class="card">
            <h3>Customer Subscription Insights</h3>
            <canvas id="subChart" height="100"></canvas>
        </section>

        <h2 class="section-label">Tally Solutions Suite</h2>
        <section id="products" class="grid-4">
            <div class="card product" onclick="showPop('TallyPrime', 'Complete Invoicing, Accounting, Payroll & Taxation solution.')">TallyPrime</div>
            <div class="card product" onclick="showPop('Tally Server', 'Enterprise-grade high-performance data server.')">TallyPrime Server</div>
            <div class="card product" onclick="showPop('Tally Cloud', 'Access your data securely from anywhere.')">TallyPrime Cloud</div>
            <div class="card product" onclick="showPop('TallyCapital', 'Seamless Business Loan & Financial management.')">TallyCapital</div>
            <div class="card product" onclick="showPop('Shoper9', 'Specialized Retail management for chains.')">Shoper9</div>
        </section>

        <section id="pricing" class="grid-2">
            <div class="card">
                <h3>GST Calculator (18%)</h3>
                <input type="number" id="basePrice" placeholder="Enter Base Amount" oninput="calcGST()">
                <div id="gstRes" class="res-box">GST: ₹0 | Total: ₹0</div>
            </div>
            <div class="card">
                <h3>Subscription Plans</h3>
                <div class="plan-list">
                    <span>Monthly: ₹999</span>
                    <span>Quarterly: ₹2499</span>
                    <span>Yearly: ₹7999</span>
                    <span class="highlight">Lifetime: ₹19999</span>
                </div>
            </div>
        </section>

        <section id="gst" class="grid-3">
            <div class="card tool">GSTR 1 / 3B Filing</div>
            <div class="card tool">E-Invoice Generation</div>
            <div class="card tool">GSTR 2A/2B Reconciliation</div>
        </section>

        <footer id="support" class="footer-card">
            <div class="contact-info">
                <h3>Registered Office</h3>
                <p>Golden Dreams Buildcon, MIDC Chilkalthana, Sambhajinagar 431006</p>
                <div class="btn-group">
                    <button class="btn-3d" onclick="window.open('https://wa.me/918806663011')"><i class="fab fa-whatsapp"></i> WhatsApp</button>
                    <button class="btn-3d" onclick="window.open('https://maps.google.com')"><i class="fa fa-map-marker"></i> Directions</button>
                </div>
            </div>
        </footer>
    </main>

    <script>
        function calcGST() {
            let val = document.getElementById('basePrice').value;
            if(val) {
                let gst = val * 0.18;
                document.getElementById('gstRes').innerText = `GST: ₹${gst.toFixed(2)} | Total: ₹${(parseFloat(val)+gst).toFixed(2)}`;
            }
        }

        function showPop(name, desc) { alert(name + ": " + desc); }

        window.onload = function() {
            new Chart(document.getElementById('subChart'), {
                type: 'bar',
                data: {
                    labels: ['TallyPrime', 'Server', 'Cloud', 'AMC'],
                    datasets: [{ label: 'Active Subscriptions', data: [120, 45, 80, 60], backgroundColor: '#00d2ff' }]
                },
                options: { responsive: true, scales: { y: { beginAtZero: true } } }
            });
        };
    </script>
</body>
</html>