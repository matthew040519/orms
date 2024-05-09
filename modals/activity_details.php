<div id="exampleModalCenter<?php echo $row['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalCenterTitle"><?php echo $row['name']; ?></h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
                                       
                                        <img class="img-fluid card-img-top" src="<?php echo $row['image_path']; ?>">
                                        <div class="card-body">
                                            <h3><?php echo $row['name']; ?></h3>
                                            <p class="card-text"><blockquote><?php echo $row['description'];  ?></blockquote></p>
                                            
                                        </div>
                                        <!-- <div class="card-footer">
                                            <small class="text-muted">Rate: <?php echo number_format($row['Rate'], 2); ?></small>
                                        </div> -->
										
                                    </div>
									<!-- <div class="modal-footer">
										<button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" name="submit" class="btn  btn-primary">Save Room</button>
									</div> -->
								</div>
							</div>
						</div>