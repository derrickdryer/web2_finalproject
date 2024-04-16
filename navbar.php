<div id='navbar'>
    <h1>Threadit</h1>
    <div class="nav-buttons">
        <?php if (!isset($isHomePage)) : ?>
            <div class="dropdown">
                <button class="dropbtn" onclick="location.href='../'">Home</button>
            </div>
        <?php endif; ?>
            <?php if (isset($_SESSION['userName'])) : ?>
                <?php if (!isset($isNewThreadPage)) : ?>
                    <div class="dropdown">
                        <button class="dropbtn" onclick="location.href='./thread/'">New Thread</button>
                    </div>
                <?php endif; ?>
                <?php if (!isset($isCommunityPage)) : ?>
                    <div class="dropdown">
                        <button class="dropbtn">Communities</button>
                        <div class="dropdown-content">
                            <a href="./community/">All Communities</a>
                            <a href="./community/membership.php">My Communities</a>
                            <a href="./community/join.php">Join Community</a>
                            <a href="./community/create.php">Create Community</a>
                        </div>
                    </div>
        <?php endif; endif; ?>
        <div class="dropdown">
        <button class="dropbtn"><?php if (isset($_SESSION['userName'])) { echo $_SESSION['userName']; } else { echo 'Account';} ?></button>
            <div class="dropdown-content">
                <?php
                    if (isset($_SESSION['userName'])) {
                        // User is logged in
                        echo '<a href="./profile/">Profile</a>';
                        if ($_SESSION['userName'] == 'admin') {
                            echo '<a href="./admin/">Admin</a>';
                        }
                        if (isset($isHomePage) && $isHomePage == true) {
                            echo '<a href="./logout/">Logout</a>';
                        } else {
                            echo '<a href="../logout/">Logout</a>';
                        }
                    } else {
                        // User is not logged in
                        if (isset($isHomePage) && $isHomePage == true) {
                            echo '<a href="./login/">Login</a>';
                            echo '<a href="./register/">Register</a>';
                        } else {
                            echo '<a href="../login/">Login</a>';
                            echo '<a href="../register/">Register</a>';
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</div>