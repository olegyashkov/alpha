<?php 

Template::render_header([
	'title' =>'Contacty Us',
	'is_home' => false,
	'menu_active_item' => 'contact'
	]);

$error = '';
if(!empty($_POST['name']) AND !empty($_POST['email']))
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];



	if(strlen($name) > 3 AND strlen($name) < 30 AND strlen($email) < 50)
	{
		$sql = "
  			INSERT INTO `users`
  			(`name`, `email`, `subject`, `message`)
  			VALUES ('{$name}' , '{$email}','{$subject}','{$message}')
  		";
		$result = mysqli_query($db, $sql);
		exit;
		
		

	}
	else
	{
		

		$error = 'введите корректные данные';	
		
	}
	

	
}



?>


<section id="main" class="container 75%">

					<header>
						<h2>Contact Us</h2>
						<p>Tell us what you think about our little operation.</p>
					</header>
					<div class="box">
						<form method="post" action="index.php?page=contact">
						<span style="color: red"><?php echo $error ?></span>
							<div class="row uniform 50%">
								
								<div class="6u 12u(mobilep)">
									<input type="text" name="name" id="name" value="Vasya" placeholder="Name" />

								</div>
								<div class="6u 12u(mobilep)">
									<input type="email" name="email" id="email" value="pup@pupkin.com" placeholder="Email" />
								</div>
							</div>
							<div class="row uniform 50%">
								<div class="12u">
									<input type="text" name="subject" id="subject" value="subject" placeholder="Subject" />
								</div>
							</div>
							<div class="row uniform 50%">
								<div class="12u">
									<textarea name="message" id="message" placeholder="Enter your message" value="hello world" rows="6"></textarea>
								</div>
							</div>
							<div class="row uniform">
								<div class="12u">
									<ul class="actions align-center">
										<li><input type="submit" value="Send Message" /></li>
									</ul>
								</div>
							</div>
						</form>
					</div>
				</section>
				<?php
				Template::render_footer()
				?>