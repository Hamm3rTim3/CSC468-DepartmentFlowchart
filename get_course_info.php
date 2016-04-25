<html>
  <?php
                      
    /*
    getCourseFromXML
    
    Description:
    This function opens an xml file and searches for a course based
    on its prefix and number tags. It then returns the xml for
    that course in an array with the xml tag names as the keys 
    in the key value pairs.
    */
    function getCourseFromXml( $file, $inPreFix, $inNumber)
    {
      //Read file into document object model
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
        //Reset the array for next search
        $course = Array( "preFix" => "", 
                 "name" => "",
                 "number" => "",
                 "credits" => "",
                 "description" => "",
                 "preReq" => Array(),
                 "coReq" => Array(),
                 "notes" => "", );
        //only search course nodes
        if( $item->nodeName == 'course' )
        {
          foreach ($item->childNodes AS $member) 
          { //extract all info out of the node
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
            //THere are multiple pre and co-requizites possible so they are stored in a list
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
          //if the preFix and course number are matched then we found the right one
          if( $course['preFix'] == $inPreFix && $course['number'] == $inNumber )
          {
            return $course;
          }
          //$preFix = item->getElementsByTagName('preFix');        
          
        }
      }
      //If none were found set the name and number for error update
      $course['name'] = "Course Not Found";
      $course['number'] = "400";
      return $course;
    }

    /*
    Description:
    Prints out information about a course in formatted html
    */
    function printCourse( $toPrint )
    {
      //Print Course Name: CourseName - ( prefix, course number )
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
