<div id="exampleModalCenterEdit<?php echo $row['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalCenterTitle">Update Rooms</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<?php
                                        $rooms_id = $row['id'];
                                        $queryEdit = mysqli_query($con, "SELECT * FROM rooms WHERE id = '$rooms_id'");
                                        $rowRooms = mysqli_fetch_array($queryEdit);
                                    
                                    ?>
                                    </div>
									<div class="modal-body">
                                        <form method="POST" enctype="multipart/form-data">
                                            <img src="../images/<?php echo $rowRooms['Image'] ?>" class="img-fluid" alt="">
                                            <input type="hidden" value="<?php echo $rowRooms['id']; ?>" name="id">
											<div class="form-group">
												<label for="recipient-name" class="col-form-label">Room Image:</label>
												<input type="file" class="form-control" name="image" id="room-image">
											</div>
                                            <div class="form-group">
												<label for="message-text" class="col-form-label">Room Name</label>
												<input type="text" value="<?php echo $rowRooms['room_name']; ?>" required name="room_name" class="form-control">
											</div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Good for # of Person:</label>
                                                        <input type="number" value="<?php echo $rowRooms['good_for']; ?>" required name="good_for_person" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Bedroom</label>
                                                        <input type="number" value="<?php echo $rowRooms['Bedroom']; ?>" required name="bedroom" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Bath</label>
                                                        <input type="number" value="<?php echo $rowRooms['Baths']; ?>" required name="bath" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
											<div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Floor Area</label>
                                                        <input type="number" value="<?php echo $rowRooms['floor_area']; ?>" required name="floor_area" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Rate</label>
                                                        <input type="text" value="<?php echo number_format($rowRooms['Rate'], 2); ?>" required name="rate" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
												<label for="message-text" class="col-form-label">Room Details</label>
												<textarea name="room_details" required class="form-control" id="" cols="30" rows="10"><?php echo $rowRooms['details']; ?></textarea>
											</div>
                                            <div class="form-group">
												<label for="message-text" class="col-form-label">Status</label>
												<select class="form-control" name="status">
                                                    <option value="1" <?php if($rowRooms['active'] = 1)  { echo  "selected"; } ?>>Available</option>
                                                    <option value="0" <?php if($rowRooms['active'] = 0)  { echo  "selected"; } ?>>Not Available</option>
                                                </select>
											</div>
										
                                    </div>
									<div class="modal-footer">
										<button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" name="update" class="btn  btn-primary">Save Room</button>
									</div>
                                    </form>
								</div>
							</div>
						</div>

                        <?php
        
                if(isset($_POST['update'])){

                    $target = "../images/". basename($_FILES['image']['name']);
                    $image = $_FILES['image']['name'];
                    $room_name = $_POST['room_name'];
                    $good_for_person = $_POST['good_for_person'];
                    $bedroom = $_POST['bedroom'];
                    $bath = $_POST['bath'];
                    $floor_area = $_POST['floor_area'];
                    $rate = $_POST['rate'];
                    $room_detail = $_POST['room_details'];
                    $id = $_POST['id'];
                    $status = $_POST['status'];

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)){

                        $query = mysqli_query($con, "UPDATE rooms SET `room_name` = '$room_name', 
                        `good_for` = '$good_for_person', `Image` = '$image', `details` = '$room_detail', `Bedroom` = '$bedroom', 
                        `Baths` = '$bath', `floor_area` = '$floor_area', `Rate` = '$rate', `active` = '$status' WHERE id = '$id'");

                        echo "<script>alert('Successfully Update')</script>";
                        echo "<script>window.location.replace('rooms.php')</script>";
                    } else {
                        $query = mysqli_query($con, "UPDATE rooms SET `room_name` = '$room_name', 
                        `good_for` = '$good_for_person', `details` = '$room_detail', `Bedroom` = '$bedroom', 
                        `Baths` = '$bath', `floor_area` = '$floor_area', `Rate` = '$rate', `active` = '$status' WHERE id = '$id'");

                        echo "<script>alert('Successfully Update')</script>";
                        echo "<script>window.location.replace('rooms.php')</script>";
                    }

                   
                }
        
        ?>