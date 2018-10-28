<!-- VERSION #1.0 , lAST EDITED BY MAYAR -->
<?php require_once("assets/layouts/header.php") ?>

<div class="login">
	<div class="wrap">
		<div class="col_1_of_login span_1_of_login">
			<h4 class="title">New Visitors</h4>
			<p>Sign up to Exchange ! </p>
			<div class="button1">
				<a href="register.php"><input type="submit" name="Submit" value="Continue"></a>
			</div>
			<div class="clear"></div>
		</div>

		<div class="col_1_of_login span_1_of_login">
			<div class="login-title">
				<!--<h4 class="title">Users</h4>-->
				<?php echo sessionErrors();?> <br />
				<div class="comments-area">
					<form action="login_validation.php" method="post" >
						<p>
							<label>E-mail</label>
							<span>*</span>
							<input type="text" name="email" value="">
						</p>
						<p>
							<label>Password</label>
							<span>*</span>
							<input type="password"name="password" value="">
						</p>
						<p>
							<input style ="background-color: #D5331D;"type="submit"name="submit" value="Login">
						</p>
					</form>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
        <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>

<?php require_once("assets/layouts/footer.php") ?>