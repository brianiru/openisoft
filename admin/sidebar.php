<div class="sidebar">
    <ul>
        <li><a href="index.php" class=""><i class="fas fa-desktop"></i> Dashboard</a></li>
        <li><a href="requests.php"><i class="fas fa-question"></i> Requests</a></li>
        <li><a href="drivers.php"> <i class="fas fa-user-tie"></i> Drivers</a></li>
        <li><a href="approved-requests.php"> <i class="fas fa-calendar-check"></i> Approved requests</a></li>
        <li><a href="ratings.php"> <i class="fas fa-eye"></i> View ratings</a></li>
        <li><a href="contacts.php"> <i class="fas fa-phone"></i> Contacts</a></li>
        <!-- profile -->
        <li><a href="profile.php"> <i class="fas fa-user-cog"></i> Profile</a></li>
        <li><a href="logout.php"> <i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
</div>
<script>
    // get the current url
    let url = window.location.href;
    // get the sidebar links
    let links = document.querySelectorAll(".sidebar ul li a");
    // loop through the links
    links.forEach(link => {
        // if the current url is equal to the link href
        if (url == link.href) {
            // add the active class to the link
            link.classList.add("active");
        }
    });
</script>