<?php
  ob_start();
  
  require_once("script/model.php");
  
  define("HOME", "home");
  $week = HOME;
  
  // Prevent errors when calling script directly
  if (isset($_GET["week"]))
  {
    $week = $_GET["week"];
  }

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Comp1950</title>
    
    <link type="text/css" rel="stylesheet" href="css/reset.css"/> <!--reset css-->
		<link rel="stylesheet" href="css/layout.css" media="screen" />
    <link rel="icon" type="image/png" href="img/favicon.ico" /> <!--favicon-->
        
    <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
    <script type="text/javascript" src="script/jquery.toc.min.js"></script>
    
    
    <link rel="stylesheet" href="css/main_nav.css" media="screen" />
    
<?php

  $model = new LessonDataCollection();
  
  if ($week != HOME && $model->hasActiveLessons())
  {
?>
  <script type="text/javascript">
      
      $(function() {
        // Table of contents
        // - not displayed on home page
        // - CSS not loaded, unless javascript active
        
        var tocCss = document.createElement("link");
        tocCss.setAttribute("rel", "stylesheet");
        tocCss.setAttribute("href", "css/layout_toc.css");
        document.getElementsByTagName('head')[0].appendChild(tocCss);
        $('#toc').toc({ 'selectors': 'h2'
                      , 'container': '#main_content' });  
      });
    </script>
<?php
  }
?> 
	</head>

	<body>
    <div id="container" name="top">
			<header>
				<h1>logo here<h1>
			</header>

      <!--Horizontal Navigation-->
      <nav id="main_nav">
        <ul class="main_nav">
<?php

    echo "<li><a href=\"";
    if ($week != HOME) echo "index.php";
    echo "\">Home</a></li>".PHP_EOL;
      
    if ($model->hasActiveLessons())
    {
          $lessons = $model->getLessons();
          
          $thisWeeksLesson = $lessons[$model->indexOfCurrentLesson()];
          
          echo  "<li><a href=\"";
          if ($week != $thisWeeksLesson ->getId()){
            echo "index.php?week=". $thisWeeksLesson->getId();
          }
          echo "\">Week ". $thisWeeksLesson ->getId() ."</a></li>".PHP_EOL;
            
          echo "<li><a href=\"\">Lectures</a>".PHP_EOL;
          
          echo "  <ul class=\"nav first\">".PHP_EOL;
            foreach($lessons as $lesson){
              echo  "<li><a href=\"";
              if ($week != $lesson->getId()){
                  echo "index.php?week=". $lesson->getId();
              }
              echo "\">". $lesson->getTitle() ."</a></li>".PHP_EOL;
            }
          echo "   </ul>".PHP_EOL;
          echo " </li>".PHP_EOL;
    }
?>
          <li><a href="http://jcajm.tumblr.com/">Blog</a></li>
        </ul>
        <br style="clear: left" />
      </nav>

<?php if ($week != HOME){ ?>
      <nav id="toc_nav">
        <div id="toc"></div>
      </nav>
<?php } ?>
      
			<section id="main_content">
<?php
  
  $contentPath = "lecture/$week/content.inc";
  
  if (file_exists($contentPath))
  {
    @include("lecture/$week/content.inc");
  }
  else if ($week == HOME)
  {
    echo "<article>Under Construction</article>";
  }
  else
  {
    header("Location: index.php");
  }
  
  ?>
      </section>
			
			<footer>
				<p>This is the footer</p>
			</footer>
		</div>
	</body>
</html>