<?php
  // Data Wrapper, hiding the data type of the underltying data
  class LessonDataWrapper
  {
      private $id;
      private $title;
      
      public function getId(){ return $this->id; }
      
      public function getTitle(){ return $this->title; }
      
      public function __construct($id, $title){
        $this->id = $id;
        $this->title = $title;
      }
  }
  
  // Data Wrapper, holding all data from 'the config file' or 'the database'
  class LessonDataCollection
  {
    private $lessons;
    private $currentLesson;
    
    // Handles loading the lessons from the data source
    private function loadLessons(){
      
      // simluating data access for proto-site
      $this->lessons = array();
    
      $this->lessons[] = new LessonDataWrapper("01", "01 | introduction");
      $this->lessons[] = new LessonDataWrapper("02", "02 | tools & standards");
      $this->lessons[] = new LessonDataWrapper("03", "03 | HTML 5 & SEO");
      $this->lessons[] = new LessonDataWrapper("04", "04 | css concepts");
      $this->lessons[] = new LessonDataWrapper("05", "05 | more css");
      $this->lessons[] = new LessonDataWrapper("06", "06 | CSS and SSIs");
      $this->lessons[] = new LessonDataWrapper("07", "07 | template development");
      $this->lessons[] = new LessonDataWrapper("09", "09 | methodology");
      $this->lessons[] = new LessonDataWrapper("10", "10 | jQuery / Git");
    
      $this->currentLesson = 7;
    }
    
    // Returns the count of active lessons foudn in the data source
    public function getCount(){
      return count($this->lessons);
    }
  
    // constructor, popluates the lessons list
    public function __construct(){
      $this->loadLessons();
      
    }
    
    // Returns the lessons in this collection
    public function getLessons(){
      return $this->lessons;
    }
    
    // Returns the index of the current ('this week') lesson
    public function indexOfCurrentLesson(){
      return $this->currentLesson;
    }
    
    // Checks if any active lessons are contained within the collection
    public function hasActiveLessons(){
      return $this->getCount() > 0;
    }
    
    // Returns the index of the next lesson page relative to the
    // $activePageIndex
    public function indexOfNextLessonPage($activePageIndex){
      $count = $this->getCount();
      if ($activePageIndex >= $count || $activePageIndex < 0 ){
        return 0;
      }
      else{
        return ++$activePageIndex;
      }
    }
  }
?>