<?php include "frame.php" ?>
<!doctype html>
<html lang="en-US">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>การตั้งค่า</title>
	</head>
	<!--
		.boxed = boxed version
	-->
	<body>




			<!-- 
				MIDDLE 
			-->
			<section id="middle">
				<div id="content" class="padding-20">

					<div class="page-profile">

						<div class="row">

						<!-- COL 2 -->
							<div class="col-md-12 col-lg-8">

								<div class="tabs white nomargin-top">
									<ul class="nav nav-tabs tabs-primary">
										<li class="active">
											<a href="#overview" data-toggle="tab">Overview</a>
										</li>
										<li>
											<a href="#edit" data-toggle="tab">Edit</a>
										</li>
									</ul>

									<div class="tab-content">
										<!-- Overview -->
										<div id="overview" class="tab-pane active">
									      <div class="row">
									        <div class="col-xs-12 col-sm-12 col-md-12 toppad" >
									   
									   
									          <div class="panel panel-info">
									            <div class="panel-heading">
									              <h3 class="panel-title">Sheena Shrestha</h3>
									            </div>
									            <div class="panel-body">
									              <div class="row">
									                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" class="img-circle img-responsive"> </div>
									                <div class=" col-md-9 col-lg-9 "> 
									                  <table class="table table-user-information">
									                    <tbody>
									                      <tr>
									                        <td>Department:</td>
									                        <td>Programming</td>
									                      </tr>
									                      <tr>
									                        <td>Hire date:</td>
									                        <td>06/23/2013</td>
									                      </tr>
									                      <tr>
									                        <td>Date of Birth</td>
									                        <td>01/24/1988</td>
									                      </tr>
									                   
									                         <tr>
									                             <tr>
									                        <td>Gender</td>
									                        <td>Female</td>
									                      </tr>
									                        <tr>
									                        <td>Home Address</td>
									                        <td>Kathmandu,Nepal</td>
									                      </tr>
									                      <tr>
									                        <td>Email</td>
									                        <td><a href="mailto:info@support.com">info@support.com</a></td>
									                      </tr>
									                        <td>Phone Number</td>
									                        <td>123-4567-890(Landline)<br><br>555-4567-890(Mobile)
									                        </td>
									                           
									                      </tr>
									                     
									                    </tbody>
									                  </table>
									                </div>
									              </div>
									            </div>						            
									          </div>
									        </div>
									      </div>										

							</div><!-- /COL 3 -->
										<!-- Edit -->
										<div id="edit" class="tab-pane">

											<form class="form-horizontal" method="get">
												<h4>Personal Information</h4>
												<fieldset>
													<div class="form-group">
														<label class="col-md-3 control-label" for="profileFirstName">First Name</label>
														<div class="col-md-8">
															<input type="text" class="form-control" id="profileFirstName">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="profileLastName">Last Name</label>
														<div class="col-md-8">
															<input type="text" class="form-control" id="profileLastName">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="profileAddress">Address</label>
														<div class="col-md-8">
															<input type="text" class="form-control" id="profileAddress">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="profileCompany">Company</label>
														<div class="col-md-8">
															<input type="text" class="form-control" id="profileCompany">
														</div>
													</div>
												</fieldset>

												<hr />

												<h4>About</h4>
												<fieldset>
													<div class="form-group">
														<label class="col-xs-3 control-label">Public Profile</label>
														<div class="col-md-8">
															<label class="checkbox">
																<input type="checkbox" value="1" checked="checked" id="profilePublic">
																<i></i> Checkbox 1
															</label>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="profileBio">Biographical Info</label>
														<div class="col-md-8">
															<textarea class="form-control" rows="3" id="profileBio"></textarea>
														</div>
													</div>
													<div class="form-group">
														<div class="sky-form">
															<label class="col-xs-3 control-label">Profile Image</label>
															<div class="col-md-8">
																<label for="file" class="input input-file">
																	<div class="button">
																		<input type="file" id="file" onchange="this.parentNode.nextSibling.value = this.value">Browse
																	</div>
																	<input type="text" readonly>
																</label>
																<a href="#" class="btn btn-danger btn-xs nomargin"><i class="fa fa-times"></i> Remove Current Image</a>
															</div>
														</div>
													</div>


												</fieldset>

												<hr />

												<h4>Change Password</h4>
												<fieldset class="mb-xl">
													<div class="form-group">
														<label class="col-md-3 control-label" for="profileNewPassword">New Password</label>
														<div class="col-md-8">
															<input type="text" class="form-control" id="profileNewPassword">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="profileNewPasswordRepeat">Repeat New Password</label>
														<div class="col-md-8">
															<input type="text" class="form-control" id="profileNewPasswordRepeat">
														</div>
													</div>
												</fieldset>

												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														<button type="submit" class="btn btn-primary">Submit</button>
														<button type="reset" class="btn btn-default">Reset</button>
													</div>
												</div>

											</form>

										</div>
						</div>

					</div>

				</div>
			</section>
			<!-- /MIDDLE -->

		</div>
	</body>
</html>