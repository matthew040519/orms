<div id="exampleModalCenter<?php echo $row['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalCenterTitle"><?php echo $row['room_name']; ?></h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
                                       
                                        <img class="img-fluid card-img-top" src="images/<?php echo $row['Image']; ?>">
                                        <div class="card-body">
                                            <h3><?php echo $row['room_name']; ?></h3>
                                            <p class="card-text"><blockquote><?php echo $row['details'];  ?></blockquote></p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                <ul>
                                                    <?php
                                                    $id = $row['id'];
                                                    $query1 = mysqli_query($con, "SELECT setuprooms.id as ID, amenities.amenities FROM setuprooms INNER JOIN amenities ON amenities.id=setuprooms.amenities_id WHERE setuprooms.room_id = '$id'");
                                                    while($row1 = mysqli_fetch_array($query1)){ ?>
                                                    <li id="<?php echo $row1['ID']; ?>"><?php echo $row1['amenities']; ?></li>
                                                    <?php } ?>
                                                </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <ul>
                                                        <li><i class="fa fa-bath fa-lg"></i> <?php echo $row['Baths']; ?> Bathroom</li>
                                                        <li><i class="fa fa-bed fa-lg"></i> <?php echo $row['Bedroom']; ?> Bedroom</li>
                                                        <li><i class="fa fa-microchip fa-lg"></i> <?php echo $row['floor_area']; ?> Floor Area</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            
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