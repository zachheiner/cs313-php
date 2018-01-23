<!DOCTYPE html>
<html>
	<head>
    	<title>Zach Heiners Home Page</title>
    	
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" href="home.css">

    	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  			<a class="navbar-brand" href="home.php">SHOELIT</a>
  				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    				<span class="navbar-toggler-icon"></span>
  				</button>

  				<div class="collapse navbar-collapse" id="navbarSupportedContent">
    				<ul class="navbar-nav mr-auto">
      					<li class="nav-item">
        					<a class="nav-link" href="aboutus.php">ABOUT US</a>
      					</li>
                <li class="nav-item">
                  <a class="nav-link" href="assignment.php">ASSIGNMENTS</a>
                </li>
    				</ul>
    				<form class="form-inline my-2 my-lg-0">
      					<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    				</form>
  				</div>
		</nav>
  </head>
	<body>
      <?php


          echo "<h1>THIS IS A SITE FOR THOSE WHO LOVE SHOES</h1>";
          echo "<h1>POST, LIKE, AND SHOW LOVE FOR OTHERS SHOES</h1>";
          echo "<div class='d-flex flex-wrap justify-content-center'>";
              echo "<img class='bred1' src='shoes/jordan1bred.jpeg' alt=JORDAN1>";
              echo "<p>THE SHOE THAT STARTED IT ALL</p>";
              echo "<img class='royal1' src='shoes/jordan1royal.jpeg' alt=JORDAN1>";
              echo "<p>JORDANS FAVORITE ONE</p>";
              echo "<img class='shadow1' data-alt-src='shoes/shadow1onfoot.jpeg' src='shoes/jordan1shadow.jpeg' alt=JORDAN1>";
              echo "<p>THE CLASSIEST JORDAN ONE</p>";
              echo "<img class='blacktoe' data-alt-src='shoes/blacktoe1onfoot.jpeg' src='shoes/jordan1blacktoe.jpeg' alt=JORDAN1>";
              echo "<p>THE ALTERNATE</p>";
              echo "<img class='shattered' data-alt-src='shoes/shattered1onfoot.jpeg' src='shoes/shatteredbackboard.jpeg' alt=JORDAN1>";
              echo "<p>THE BEST EVER BUILT</p>";
              echo "<img class='top3' data-alt-src='shoes/top31onfoot.jpeg' src='shoes/jordan1topthree.jpeg' alt=JORDAN1>";
              echo "<p>THE TOP THREE COCKTAIL</p>";
              echo "<img class='blackcement' data-alt-src='shoes/blackcement3onfoot.jpeg' src='shoes/jordan3blackcement.jpeg' alt=JORDAN3>";
              echo "<p>THE ONE THAT SAVED A FRANCHISE</p>";
              echo "<img class='whitecement' data-alt-src='shoes/whitecement4onfoot.jpeg' src='shoes/jordan4whitecement.jpeg' alt=JORDAN4>";
              echo "<p>DO THE RIGHT THING</p>";
              echo "<img class='bred4' data-alt-src='shoes/bred4onfoot.jpeg' src='shoes/jordan4bred.jpeg' alt=JORDAN4>";
              echo "<p>THE CLASSIC FOUR</p>";
              echo "<img class='oreo4' data-alt-src='shoes/oreo4onfoot.jpeg' src='shoes/jordan4oreo.jpeg' alt=JORDAN4>";
              echo "<p>THE EASIEST TO WEAR</p>";
              echo "<img class='toro4' data-alt-src='shoes/toro4onfoot.jpeg' src='shoes/jordan4toro.jpeg' alt=JORDAN4>";
              echo "<p>THE TORO</p>";
              echo "<img class='kaws4' data-alt-src='shoes/kaws4onfoot.jpeg' src='shoes/kaws4.jpeg' alt=JORDAN4>";
              echo "<p>THE GRAIL</p>";
              echo "<img class='grape5' data-alt-src='shoes/grape5onfoot.jpeg' src='shoes/grape5.jpeg' alt=JORDAN5>";
              echo "<p>OLD SCHOOL</p>";
              echo "<img class='camo5' data-alt-src='shoes/camo5onfoot.jpeg' src='shoes/camo.jpeg' alt=JORDAN5>";
              echo "<p>HIDE IN PLAIN SIGHT</p>";
              echo "<img class='supreme5' data-alt-src='shoes/supreme5onfoot.jpeg' src='shoes/supreme5.jpeg' alt=JORDAN5>";
              echo "<p>HYPEBEAST 5</p>";
              echo "<img class='bred11' data-alt-src='shoes/bred11onfoot.jpeg' src='shoes/Bred11.jpeg' alt=JORDAN11>";
              echo "<p>THE COMEBACK</p>";
              echo "<img class='concord11' data-alt-src='concord11onfoot.jpeg' src='shoes/concord11.jpeg' alt=JORDAN11>";
              echo "<p>THE PRETTIEST</p>";
              echo "<img class='flugame12' data-alt-src='flugame12onfoot.jpeg' src='shoes/flugame12.jpeg' alt=JORDAN12>";
              echo "<p>GET DOWN WITH THE SICKNESS</p>";
              echo "<img class='flint13' data-alt-src='flint13onfoot.jpeg' src='shoes/flint13.jpeg' alt=JORDAN13>";
              echo "<p>THE OFF COLOR GEM</p>";
              echo "<img class='lastshot' data-alt-src='lastshot14onfoot.jpeg' src='shoes/lastshot14.jpeg' alt=JORDAN14>";
              echo "<p>THE LAST SHOT</p>";
          echo "</div>"


      ?>

      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script>
         $(document).ready(function () {
            $('.bred1')
            .mouseover(function () {
                $(this).attr("src", "shoes/bred1onfoot.jpeg");
          })
            .mouseout(function () {
                $(this).attr("src", "shoes/jordan1bred.jpeg");
            });
          });

         $(document).ready(function () {
            $('.royal1')
            .mouseover(function () {
                $(this).attr("src", "shoes/royal1onfoot.jpeg");
          })
            .mouseout(function () {
                $(this).attr("src", "shoes/jordan1royal.jpeg");
            });
          });

         $(document).ready(function () {
            $('.shadow1')
            .mouseover(function () {
                $(this).attr("src", "shoes/shadow1onfoot.jpeg");
          })
            .mouseout(function () {
                $(this).attr("src", "shoes/jordan1shadow.jpeg");
            });
          });

         $(document).ready(function () {
            $('.blacktoe')
            .mouseover(function () {
                $(this).attr("src", "shoes/blacktoe1onfoot.jpeg");
          })
            .mouseout(function () {
                $(this).attr("src", "shoes/jordan1blacktoe.jpeg");
            });
          });

         $(document).ready(function () {
            $('.shattered')
            .mouseover(function () {
                $(this).attr("src", "shoes/shattered1onfoot.jpeg");
          })
            .mouseout(function () {
                $(this).attr("src", "shoes/shatteredbackboard.jpeg");
            });
          });

         $(document).ready(function () {
            $('.top3')
            .mouseover(function () {
                $(this).attr("src", "shoes/top31onfoot.jpeg");
          })
            .mouseout(function () {
                $(this).attr("src", "shoes/jordan1topthree.jpeg");
            });
          });

         $(document).ready(function () {
            $('.blackcement')
            .mouseover(function () {
                $(this).attr("src", "shoes/blackcement3onfoot.jpeg");
          })
            .mouseout(function () {
                $(this).attr("src", "shoes/jordan3blackcement.jpeg");
            });
          });

         $(document).ready(function () {
            $('.whitecement')
            .mouseover(function () {
                $(this).attr("src", "shoes/whitecement4onfoot.jpeg");
          })
            .mouseout(function () {
                $(this).attr("src", "shoes/jordan4whitecement.jpeg");
            });
          });

         $(document).ready(function () {
            $('.bred4')
            .mouseover(function () {
                $(this).attr("src", "shoes/bred4onfoot.jpeg");
          })
            .mouseout(function () {
                $(this).attr("src", "shoes/jordan4bred.jpeg");
            });
          });

         $(document).ready(function () {
            $('.oreo4')
            .mouseover(function () {
                $(this).attr("src", "shoes/oreo4onfoot.jpeg");
          })
            .mouseout(function () {
                $(this).attr("src", "shoes/jordan4oreo.jpeg");
            });
          });

         $(document).ready(function () {
            $('.toro4')
            .mouseover(function () {
                $(this).attr("src", "shoes/toro4onfoot.jpeg");
          })
            .mouseout(function () {
                $(this).attr("src", "shoes/jordan4toro.jpeg");
            });
          });

         $(document).ready(function () {
            $('.kaws4')
            .mouseover(function () {
                $(this).attr("src", "shoes/kaws4onfoot.jpeg");
          })
            .mouseout(function () {
                $(this).attr("src", "shoes/kaws4.jpeg");
            });
          });

         $(document).ready(function () {
            $('.grape5')
            .mouseover(function () {
                $(this).attr("src", "shoes/grape5onfoot.jpeg");
          })
            .mouseout(function () {
                $(this).attr("src", "shoes/grape5.jpeg");
            });
          });

         $(document).ready(function () {
            $('.camo5')
            .mouseover(function () {
                $(this).attr("src", "shoes/camo5onfoot.jpeg");
          })
            .mouseout(function () {
                $(this).attr("src", "shoes/camo.jpeg");
            });
          });

         $(document).ready(function () {
            $('.supreme5')
            .mouseover(function () {
                $(this).attr("src", "shoes/supreme5onfoot.jpeg");
          })
            .mouseout(function () {
                $(this).attr("src", "shoes/supreme5.jpeg");
            });
          });

         $(document).ready(function () {
            $('.bred11')
            .mouseover(function () {
                $(this).attr("src", "shoes/bred11onfoot.jpeg");
          })
            .mouseout(function () {
                $(this).attr("src", "shoes/Bred11.jpeg");
            });
          });

         $(document).ready(function () {
            $('.concord11')
            .mouseover(function () {
                $(this).attr("src", "shoes/concord11onfoot.jpeg");
          })
            .mouseout(function () {
                $(this).attr("src", "shoes/concord11.jpeg");
            });
          });

         $(document).ready(function () {
            $('.flugame12')
            .mouseover(function () {
                $(this).attr("src", "shoes/flugame12onfoot.jpeg");
          })
            .mouseout(function () {
                $(this).attr("src", "shoes/flugame12.jpeg");
            });
          });

         $(document).ready(function () {
            $('.flint13')
            .mouseover(function () {
                $(this).attr("src", "shoes/flint13onfoot.jpeg");
          })
            .mouseout(function () {
                $(this).attr("src", "shoes/flint13.jpeg");
            });
          });

         $(document).ready(function () {
            $('.lastshot')
            .mouseover(function () {
                $(this).attr("src", "shoes/lastshot14onfoot.jpeg");
          })
            .mouseout(function () {
                $(this).attr("src", "shoes/lastshot14.jpeg");
            });
          });

      </script>
    	
	</body>
</html>
