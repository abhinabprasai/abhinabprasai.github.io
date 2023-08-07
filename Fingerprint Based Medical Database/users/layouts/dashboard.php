<?php
function displayDashboard()
{
?>
    <div class="dashboard-wrapper">
        <div class="header-section">
            <div class="profile">
                Howdy <?= $_SESSION['userInfo']['name'] ?>!
            </div>
        </div>
        
<?php
}
?>