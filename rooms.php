
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<style>
  #header{
    height:70vh;
    width:calc(100%);
    position:relative;
    top:-1em;
  }
  #header:before{
    content:"";
    position:absolute;
    height:calc(100%);
    width:calc(100%);
    background-image:url('oldfiles/images/no-image-available.png');
    background-size:cover;
    background-repeat:no-repeat;
    background-position: center center;
  }
  #header>div{
    position:absolute;
    height:calc(100%);
    width:calc(100%);
    z-index:2;
  }

  #top-Nav a.nav-link.active {
      color: #343a40;
      font-weight: 900;
      position: relative;
  }
  #top-Nav a.nav-link.active:before {
    content: "";
    position: absolute;
    border-bottom: 2px solid #343a40;
    width: 33.33%;
    left: 33.33%;
    bottom: 0;
  }
</style>
<?php require_once('inc/header.php') ?>
  <body class="layout-top-nav layout-fixed layout-navbar-fixed" style="height: auto;">
    <div class="wrapper">
     
     <?php require_once('inc/topBarNav.php') ?>
    
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper pt-5" >
       
        <!-- Main content -->
        <section class="content ">
          <div class="container">
          
<style>
    .room-holder{
        width:20vw;
    }
    .room-img{
        object-fit: cover;
        object-position:center center;
        transition: transform .3s ease;
    }
    .room-item:hover .room-img{
        transform:scale(1.2);
    }
</style>
<div class="content py-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-outline card-primary rounded-0 shadow">
                <div class="card-body">
                    <div class="list-group" id="room-list">
                        <?php 
                        include('include/connection.php');
                        $rooms = $con->query("SELECT * FROM `rooms`");
                        while($row = $rooms->fetch_assoc()):
                           
                        ?>
                        <a href="#" data-toggle="modal" data-target="#exampleModalCenter<?php echo $row['id']; ?>" class="text-decoration-none text-dark room-item list-group-item list-group-item-action">
                            <div class="d-flex align-items-top">
                                <div class="col-auto">
                                    <div class="room-holder overflow-hidden">
                                    <img src="images/<?= $row['Image']; ?>" class="img-thumbnail rounded-0 room-img" alt="<?= $row['room_name'] ?>">
                                </div>
                            </div>
                            <div class="col-auto flex-grow-1 flex-shrink-1">
                                    <h3 class="text-navy mb-0"><b><?= $row['room_name'] ?></b></h3>
                                    <div class='text-muted'><span class="mr-3"><i class="fa fa-bed"></i></span><?= $row['good_for'] ?></div>
                                    <div class="truncate-5">
                                        <?= html_entity_decode($row['details']) ?>
                                    </div>
                                    <h4 class='text-success'><small><span class="tex-muted mr-3"><i class="fa fa-tag"></i></span></small><?= number_format($row['Rate'],2) ?>/<small>day</small></h4>
                                </div>
                            </div>
                        </a>
                        <?php
                      include('modals/room_details.php');
                      endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    
</script>
          </div>
        </section>
     
      </div>
      <!-- /.content-wrapper -->
      <?php require_once('inc/footer.php') ?>
  </body>
</html>
