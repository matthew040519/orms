<div id="deleteModal<?php echo $row['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalCenterTitle">Delete Rooms</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
                                    
									<div class="modal-body">
										<h5 class="mb-0">Do you want to Delete this Rooms?</h5>
                                        <form method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        
									</div>
									<div class="modal-footer">
										<button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" name="decline" class="btn  btn-danger">Decline</button>
									</div>
                                    </form>
								</div>
							</div>
						</div>

                        <?php

                            if(isset($_POST['decline']))
                            {
                                $id = $_POST['id'];

                                $user_id = $_SESSION['id'];

                                mysqli_query($con, "UPDATE rooms SET active = 0 WHERE id = '$id'");
                                echo "<script>window.location.replace('rooms.php')</script>";
                            }
                        
                        
                        ?>

                        