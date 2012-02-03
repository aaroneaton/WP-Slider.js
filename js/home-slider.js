jQuery(function($){
  var slider = new Slider($("#demo"));

  slider.setSize( 940, 380);
  slider.setPhotos([
      { "src" : "http://liberalarts.tamu.edu/images/pictures/NewsPics/Regan2010.jpg", "name" : "Test" },
      { "src" : "http://perftest.tamu.edu/wp-content/uploads/2011/08/2010-11-29-00-196x300.jpg", "name" : "Berger" }
    ]);
});    

