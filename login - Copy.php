<?php
include 'header.php';
//session_start();

?>
<style>
	#login_div{
		
		width: 30%; padding: 2%; background-color: #ffffff; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);  border: 1px solid transparent;
    border-radius: 10px;    position: absolute;
    top: 50%;
    left: 50%;
    -moz-transform: translateX(-50%) translateY(-50%);
    -webkit-transform: translateX(-50%) translateY(-50%);
    transform: translateX(-50%) translateY(-50%);
	}	
	#myCanvas{
    background:black;

		height: 100%;
		width: 100%;
		margin: 0;
		top: 0;
		position: absolute;
}
	body{margin:0;height:100%;
	}
	
	

	
@media screen and (max-width:1000px) {	
  #login_div{
	width:90%;
	  padding: 3%;
	}
	
	#myCanvas{
   display: none;
}
	
	}
</style>

<canvas id="myCanvas">
</canvas>
<div id="login_div" align="center" style="z-index: 11;">
<h1>LogIn</h1><br>
<div id="login_div_message" style="width: 100%;">&nbsp;</div>

<input type="email" name="email" id="email" placeholder="Email" style="width: 100%;"><br><br>
<input type="password" name="password" id="password" placeholder="Password" style="width: 100%;"><br><br>
<input type="button" name="action" id="login_user" value="login" style="width: 100%;"><br><br>
	
</div>


<center><div style="height: 400px; 
	
	
	
	-webkit-filter: grayscale(30%); /* Safari 6.0 - 9.0 */
    filter: grayscale(30%);
	
	transform: translate3d(0px, 0px, 0px); background:url(images/smoke_left.png) no-repeat center;"><font style="color:crimson; font-size: 55px;">Job Expenses</font></div></center>
	
<!--	
color: transparent;
   text-shadow: 0 0 5px rgba(0,0,0,0.5);
	-->
	

	
<script>
//$(document).ready(function(){
	
$('#login_div').on('keydown', '#password', function (e) {
    var key = e.which;
    if(key == 13) {
       // alert("enter");
        $('#login_user').click();
        return false;
    }
});
	
$('#login_user').on('click', function(){
	//alert("d");
	
	var email=$("#email").val();
	var password=$("#password").val();
	
	var datastring = 'email='+email+'&password='+password+'&action=login';
               $.ajax({  
				     url:"login_ajax.php",
                     method:"POST",  
                     data:datastring, 
                     success:function(data)  
                     {  
                        //alert(data);
						//$(".body_content").html(data); 
						 $("#login_div_message").html(data); 
					 }
					 }); 
})
	
// });		
</script>

<script>
// Create an array to store our particles
var particles = [];

// The amount of particles to render
var particleCount = 30;

// The maximum velocity in each direction
var maxVelocity = 2;

// The target frames per second (how often do we want to update / redraw the scene)
var targetFPS = 33;

// Set the dimensions of the canvas as variables so they can be used.
var canvasWidth = 400;
var canvasHeight = 400;

// Create an image object (only need one instance)
var imageObj = new Image();

// Once the image has been downloaded then set the image on all of the particles
imageObj.onload = function() {
    particles.forEach(function(particle) {
            particle.setImage(imageObj);
    });
};

// Once the callback is arranged then set the source of the image
imageObj.src = "images/Smoke10.png";
//imageObj.src="images/smoke_right.png";
// A function to create a particle object.
function Particle(context) {

    // Set the initial x and y positions
    this.x = 0;
    this.y = 0;

    // Set the initial velocity
    this.xVelocity = 0;
    this.yVelocity = 0;

    // Set the radius
    this.radius = 5;

    // Store the context which will be used to draw the particle
    this.context = context;

    // The function to draw the particle on the canvas.
    this.draw = function() {
        
        // If an image is set draw it
        if(this.image){
            this.context.drawImage(this.image, this.x-128, this.y-128);         
            // If the image is being rendered do not draw the circle so break out of the draw function                
            return;
        }
        // Draw the circle as before, with the addition of using the position and the radius from this object.
        this.context.beginPath();
        this.context.arc(this.x, this.y, this.radius, 0, 2 * Math.PI, false);
        this.context.fillStyle = "rgba(0, 0, 0, 1)";
        this.context.fill();
        this.context.closePath();
    };

    // Update the particle.
    this.update = function() {
        // Update the position of the particle with the addition of the velocity.
        this.x += this.xVelocity;
        this.y += this.yVelocity;

        // Check if has crossed the right edge
        if (this.x >= canvasWidth) {
            this.xVelocity = -this.xVelocity;
            this.x = canvasWidth;
        }
        // Check if has crossed the left edge
        else if (this.x <= 0) {
            this.xVelocity = -this.xVelocity;
            this.x = 0;
        }

        // Check if has crossed the bottom edge
        if (this.y >= canvasHeight) {
            this.yVelocity = -this.yVelocity;
            this.y = canvasHeight;
        }
        
        // Check if has crossed the top edge
        else if (this.y <= 0) {
            this.yVelocity = -this.yVelocity;
            this.y = 0;
        }
    };

    // A function to set the position of the particle.
    this.setPosition = function(x, y) {
        this.x = x;
        this.y = y;
    };

    // Function to set the velocity.
    this.setVelocity = function(x, y) {
        this.xVelocity = x;
        this.yVelocity = y;
    };
    
    this.setImage = function(image){
        this.image = image;
    }
}

// A function to generate a random number between 2 values
function generateRandom(min, max){
    return Math.random() * (max - min) + min;
}

// The canvas context if it is defined.
var context;

// Initialise the scene and set the context if possible
function init() {
    var canvas = document.getElementById('myCanvas');
    if (canvas.getContext) {

        // Set the context variable so it can be re-used
        context = canvas.getContext('2d');

		
        // Create the particles and set their initial positions and velocities
        for(var i=0; i < particleCount; ++i){
            var particle = new Particle(context);
            
            // Set the position to be inside the canvas bounds
            particle.setPosition(generateRandom(0, canvasWidth), generateRandom(0, canvasHeight));
            
            // Set the initial velocity to be either random and either negative or positive
            particle.setVelocity(generateRandom(-maxVelocity, maxVelocity), generateRandom(-maxVelocity, maxVelocity));
            particles.push(particle);            
        }
    }
    else {
        alert("Please use a modern browser");
    }
}

// The function to draw the scene
function draw() {
    // Clear the drawing surface and fill it with a black background
    context.fillStyle = "rgba(0, 0, 0, 0.5)";
    context.fillRect(0, 0, 400, 400);
	

    // Go through all of the particles and draw them.
    particles.forEach(function(particle) {
        particle.draw();
    });
}

// Update the scene
function update() {
    particles.forEach(function(particle) {
        particle.update();
    });
}

// Initialize the scene
init();

// If the context is set then we can draw the scene (if not then the browser does not support canvas)
if (context) {
    setInterval(function() {
        // Update the scene befoe drawing
        update();

        // Draw the scene
        draw();
    }, 1000 / targetFPS);
}

</script>