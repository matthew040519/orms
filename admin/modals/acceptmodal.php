<div id="acceptModal<?php echo $row['Id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalCenterTitle">Accept Transaction</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
                                    
									<div class="modal-body">
										<h5 class="mb-0">Do you want to accept this transaction?</h5>
                                        <form method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['Id']; ?>">
                                        
									</div>
									<div class="modal-footer">
										<button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" name="accepted" class="btn  btn-primary">Accept</button>
									</div>
                                    </form>
								</div>
							</div>
						</div>

                        <?php

                            if(isset($_POST['accepted']))
                            {
                                $id = $_POST['id'];
								$user_id = $_SESSION['id'];

                                mysqli_query($con, "UPDATE reservation SET status = 1, user_id = $user_id WHERE id = '$id'");
                                echo "<script>window.location.replace('pendingreservation.php?add=success')</script>";
                            }
                        
                        
                        ?>

                        