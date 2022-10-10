<?php
if (isset($_SESSION['success'])) { ?>
    <div class="alert alert-success alert-dismissible fade show text-left px-2" role="alert">
        <?php echo $_SESSION['success']['data']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
<?php 
unset($_SESSION['success']);
}
if (isset($_SESSION['danger'])) { ?>
    <div class="alert alert-danger alert-dismissible fade show text-left" role="alert">
        <?php echo $_SESSION['danger']['data']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
<?php 
unset($_SESSION['danger']);
} 
?>
