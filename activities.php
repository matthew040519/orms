
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
    .activity-holder{
        width:20vw;
    }
    .activity-img{
        object-fit: cover;
        object-position:center center;
        transition: transform .3s ease;
    }
    .activity-item:hover .activity-img{
        transform:scale(1.2);
    }
    a.activity-item.card.rounded-0.shadow.flex-row.text-decoration-none.text-dark {
        background: #8080801c;
    }
</style>
<div class="content py-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-outline card-primary rounded-0 shadow">
                <div class="card-body">
                    <div class="row" id="activity-list">
                        <?php 
                        include('include/connection.php');
                        $activitys = $con->query("SELECT * FROM `activity_list` where delete_flag =0 and `status` = 1 order by `name` asc");
                        while($row = $activitys->fetch_assoc()):
                            $row['description'] = strip_tags(html_entity_decode($row['description']));
                        ?>
                        <!-- <div class="col"> -->
                            <a href="#" data-toggle="modal" data-target="#exampleModalCenter<?php echo $row['id']; ?>" class="activity-item card rounded-0 shadow flex-row text-decoration-none text-dark p-0">
                                <div class="col-auto p-0">
                                    <div class="activity-holder overflow-hidden">
                                    <img src="<?= $row['image_path'] ?>" class="img-top rounded-0 activity-img" alt="<?= $row['name'] ?> Image">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="container-fluid p-1 m-0 h-100 d-flex flex-column justify-content-center">
                                        <h3 class="text-navy mb-0"><b><?= $row['name'] ?></b></h3>
                                        <div class="truncate-5">
                                            <?= html_entity_decode($row['description']) ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <!-- </div> -->
                        <?php include('modals/activity_details.php');
                       endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
       
    })
</script>
          </div>
        </section>
        <!-- /.content -->
  <div class="modal fade rounded-0" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header rounded-0">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body rounded-0">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade rounded-0" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md modal-dialog-centered rounded-0" role="document">
      <div class="modal-content rounded-0">
        <div class="modal-header rounded-0">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body rounded-0">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade rounded-0" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header rounded-0">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-right"></span>
        </button>
      </div>
      <div class="modal-body rounded-0">
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
              <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
              <img src="" alt="">
      </div>
    </div>
  </div>
      </div>
      <!-- /.content-wrapper -->
      <?php require_once('inc/footer.php') ?>
  </body>
</html>
