<?php
function displaySidebar($links){
?>
<div class="sidebar-wrapper">
    <div class="dashboard-logo">
        <img src="../img/dashboad-logo.png" alt="not found">
        <h2>FMBD</h2>
    </div>
    <div class="dashboard-cta">
        <div class="links">
            <?php foreach($links as $link) : ?>
                <a href="<?=$link['link']?>">
                    <img src="../img/<?=$link['title'] . '-icon.png'?>">
                    <sup><?=ucwords($link['title'])?></sup>
                </a> <br>
            <?php endforeach; ?>
            <!-- <a href="">abc</a>
            <br>
            <a href="">abc</a> -->
        </div>

        <a class="logout" href="../layouts/logout.php">
            <img src="../img/logout-icon.png">
            <sup>Sign out</sup>
        </a>
    </div>
</div>
<?php
}
?>