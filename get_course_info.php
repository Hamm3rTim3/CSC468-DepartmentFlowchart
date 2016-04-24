<html>
  <?php
                      
    //$x = $x->getElementsB yTagName('course');
    function getCourseFromXml( $file, $inPreFix, $inNumber)
    {
      $xmlDoc = new DOMDocument();
      $xmlDoc->load($file);
      $x = $xmlDoc->documentElement;
      $preFix = '';
      $course = Array( "preFix" => "", 
                       "name" => "",
                       "number" => "",
                       "credits" => "",
                       "description" => "",
                       "preReq" => Array(),
                       "coReq" => Array(),
                       "notes" => "", );
      foreach ($x->childNodes AS $item) {

        $course = Array( "preFix" => "", 
                 "name" => "",
                 "number" => "",
                 "credits" => "",
                 "description" => "",
                 "preReq" => Array(),
                 "coReq" => Array(),
                 "notes" => "", );
        if( $item->nodeName == 'course' )
        {
          foreach ($item->childNodes AS $member) 
          {
            if( $member->nodeName == 'preFix' )
            {
              $course['preFix'] = $member->nodeValue;
            }
            else if( $member->nodeName == 'name' )
            {
              $course['name'] = $member->nodeValue;
            }
            else if( $member->nodeName == 'number' )
            {
              $course['number'] = $member->nodeValue;
            }
            else if( $member->nodeName == 'credits' )
            {
              $course['credits'] = $member->nodeValue;
            }
            else if( $member->nodeName == 'description' )
            {
              $course['description'] = $member->nodeValue;
            }
            else if( $member->nodeName == 'preReq' && $member->nodeValue != "" )
            {
              array_push($course['preReq'], $member->nodeValue);
            }
            else if( $member->nodeName == 'coReq' && $member->nodeValue != "" )
            {
              array_push($course['coReq'], $member->nodeValue);
            }
            else if( $member->nodeName == 'notes' )
            {
              $course['notes'] = $member->nodeValue;
            }
          }
          if( $course['preFix'] == $inPreFix && $course['number'] == $inNumber )
          {
            return $course;
          }
          //$preFix = item->getElementsByTagName('preFix');        
          
        }
      }
      $course['name'] = "Course Not Found";
      $course['number'] = "400";
      return $course;
    }

    function printCourse( $toPrint )
    {
      //Print Course Name
      print "<h2>" . 
            $toPrint['name'] . 
            " - ( " . $toPrint['preFix'] . " " . $toPrint['number'] . " )" . 
            "</h2>";
      print "<p><b>Credits: &nbsp</b>" . $toPrint['credits'] . "</p>";
      print "<p><b>Pre-Requisites: &nbsp</b>";
      if( count($toPrint['preReq']) == 0 )      
        print "none</p>";
      else
      {
        print " ";
        print implode(", ", $toPrint['preReq']);
        print "</p>";
      }

      print "<p><b>Co-Requisites: &nbsp</b>";
      if( count($toPrint['coReq']) == 0 )
      {      
        print "none</p>";
      }
      else
      {
        print " ";
        print implode(", ", $toPrint['coReq']);
        print "</p>";
      }
      if( $toPrint['description'] !== "")
      {
        print "<p><b>Description: </b></br>";
        print $toPrint['description'] . "</p>";      
      }
      else print "<p><b>Description: </b>none...</p>";
      if( $toPrint['notes'] !== "")
      {
        print "<p><b>Notes: </b></br>";
        print $toPrint['notes'] . "</p>";      
      }
      else print "<p><b>Notes: </b>none...</p>";
      
     
    }    
    
    //printCourse(getCourseFromXml( "courses.xml", "CSC", "300"));
    printCourse(getCourseFromXml( "courses.xml", $_GET['preFix'], $_GET['number']));

      
  ?>
</html>
