<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // If user is logged in show username
    $username = $_SESSION['username'];
    echo '
    <nav class="nav nav-top">
        <ul class="nav-list">
            <li>Welcome, ' . $username . '!</li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>';
} else {
    // If user is not logged in show login and register button
    echo '
    <nav class="nav nav-top">
        <ul class="nav-list">
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        </ul>
    </nav>';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
    <link rel="stylesheet" type="text/css" href="homepage.css">
</head>
<body>
    <header>
        <h1>Campaign</h1>
    </header>
    <div class="campaign-item">
        <img src="image/earth.png" alt="Campaign Image">
        <div class="campaign-item-text">
            <h2>Join the Green Revolution: Protecting Our Planet Together</h2>
            <p>Join us in our mission to protect the planet! Our environmental awareness campaign aims to inspire individuals to embrace sustainable living practices. Through tree planting drives, beach clean-ups, and engaging educational workshops, we empower communities to reduce their carbon footprint and safeguard our precious natural resources for future generations.</p>
            <div class="learn-more"><a href="#">Learn More</a></div>
        </div>
    </div>
    <div class="campaign-item">
        <img src="image/brain.jpg" alt="Campaign Image">
        <div class="campaign-item-text">
            <h2>Break the Silence: Empowering Minds, Healing Hearts</h2>
            <p>You're not alone, and help is always available. Our mental health awareness campaign seeks to break down the stigma surrounding mental illness and promote a culture of compassion and support. From providing access to crisis hotlines and counseling services to hosting mindfulness sessions and informative panel discussions, we're here to foster a community where mental health is prioritized and nurtured.</p>
            <div class="learn-more"><a href="#">Learn More</a></div>
        </div>
    </div>
    <div class="campaign-item">
        <img src="image/shop.png" alt="Campaign Image">
        <div class="campaign-item-text">
            <h2>Shop Local, Thrive Local</h2>
            <p> Let's build a thriving local economy together! Our small business support campaign encourages residents to rally behind their neighborhood entrepreneurs. By showcasing the unique stories and offerings of local businesses and organizing "shop local" events, we aim to strengthen community ties and ensure the vibrancy and success of our local economy.</p>
            <div class="learn-more"><a href="#">Learn More</a></div>
        </div>
    </div>
    <div class="campaign-item">
        <img src="image/digital.jpeg" alt="Campaign Image">
        <div class="campaign-item-text">
            <h2>Empowerment through Technology: Bridging the Digital Divide</h2>
            <p>Unlock the power of the digital world with us! Our digital literacy campaign is committed to bridging the digital divide by providing essential skills training to individuals of all ages. From basic computer literacy classes to workshops on internet safety and utilizing digital tools for education and employment, we empower everyone to navigate the digital landscape with confidence and competence.</p>
            <div class="learn-more"><a href="#">Learn More</a></div>
        </div>
    </div>
    <div class="campaign-item">
        <img src="image/diversity.jpg" alt="Campaign Image">
        <div class="campaign-item-text">
            <h2>Unity in Diversity: Celebrating Our Differences, Building Our Future</h2>
            <p>Celebrate our differences and embrace unity! Our diversity and inclusion campaign celebrates the rich tapestry of cultures, identities, and perspectives within our community. Through cultural festivals, diversity training sessions, and initiatives to promote equal opportunities for all, we strive to create a welcoming and inclusive environment where everyone feels valued and respected.</p>
            <div class="learn-more"><a href="#">Learn More</a></div>
        </div>
    </div>

</body>
<footer>
        <nav class="nav"></nav>
    </footer>
</html>
