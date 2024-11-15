<?php
session_start();
if (!isset($_SESSION['userdata'])) {
    header('location: ../');
}
$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];
$status = ($_SESSION['userdata']['status'] == 0) ? '<b style="color:red;">Not Voted</b>' : '<b style="color:green;">Voted</b>';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System - Dashboard</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
</head>

<body>
    <div id="mainSection">
        <center>
            <div id="headerSection">
                <a href="../"><button id="backbtn">Back</button></a>
                <a href="logout.php"><button id="logoutbtn">Logout</button></a>
                <h1>Online Voting System</h1>
            </div>
        </center>
        <hr>

        <div id="mainpanel">
            <div id="Profile">
                <center>
                    <img src="../uploads/<?php echo $userdata['photo']; ?>" height="100" width="100"
                        alt="Profile Picture">
                </center>
                <br><br>
                <b>Name:</b> <?php echo $userdata['name']; ?><br><br>
                <b>Mobile:</b> <?php echo $userdata['mobile']; ?><br><br>
                <b>Address:</b> <?php echo $userdata['address']; ?><br><br>
                <b>Status:</b> <?php echo $status; ?><br><br>
            </div>

            <div id="Group">
                <?php
                if ($groupsdata) {
                    foreach ($groupsdata as $group) {
                        ?>
                        <div>
                            <img style="float: right; border-radius: 5px;" src="../uploads/<?php echo $group['photo']; ?>"
                                height="100" width="100" alt="Group Image">
                            <b>Group Name:</b> <?php echo $group['name']; ?><br><br>
                            <b>Votes:</b> <?php echo $group['votes']; ?><br><br>
                            <form action="../api/vote.php" method="post">
                                <input type="hidden" name="gvotes" value="<?php echo $group['votes']; ?>">
                                <input type="hidden" name="gid" value="<?php echo $group['id']; ?>">
                                <?php if ($userdata['status'] == 0) { ?>
                                    <button type="submit" id="votebtn">Vote</button>
                                <?php } else { ?>
                                    <button disabled id="voted">Voted</button>
                                <?php } ?>
                            </form>
                        </div>
                        <hr>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>