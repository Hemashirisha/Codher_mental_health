<?php
//include 'storypost.php';
include(dirname(__FILE__) . '/DB.php');
$query='SELECT * FROM stories';
$result = $con->query($query);

$values=array();
while($row = $result->fetch_assoc()){
    $values[]=$row;
    
}
$len=count($values);
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</head>
<body style="background-image: url(listen_bg.png);size: 100%;background-repeat: no-repeat;background-size: cover;">
<?php
for($x=0;$x<$len;$x++){
    $row=$values;
    ?>
    <div class="w3-card-4 " style=" margin: 0 auto;float: none;margin-bottom: 30px;margin-top:150px;width: 50%;height: 75%;">
        <div class="w3-display-container w3-text-white w3-center">
          <img src="story_images\<?php echo $row[$x]['story_img'];?>" alt=<?php echo $row[$x]['story_img'];?> style="width:40%;padding:20px;">
        </div>
        <div class="w3-center">
          <div>
            <h3><?php echo $row[$x]['title'];?></h3>
          </div>
        
        <div >
            <p><?php echo $row[$x]['story'];?></p>
        </div>
        </div>
      </div>
      <?php
        }
      ?>
      <div class="w3-display-bottomright" style="position:fixed;">
          <img src="share_your_story.png" id="share_your_story" width=300px>
      </div>
      <div id="id01" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:1000px">
    
          <div class="w3-center"><br>
            <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
            <!-- <img src="img_avatar4.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top"> -->
          </div>
    
          <form class="w3-container" action= "story_post.php" method="POST">
            <div class="w3-section">
                <label><b>Image</b></label>
              <input type=file placeholder="Insert Image" name="story_img" id="story_img" required>
              <br>
              <br>
              <br>
              <label><b>Title</b></label>
              <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Title" name="story_title" id="story_title" required>
              <br><br>
              <label><b>Story</b></label>
              <textarea class="w3-input w3-border" style="width:100%;height:fit-content;" placeholder="Write your story" name="story" id="story" row="50" cols="50"></textarea>
              <input type="button" class="w3-button w3-block w3-green w3-section w3-padding" value="Submit" id="story_submit">
            </div>
          </form>
    
          <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
            <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
          </div>
    
        </div>
      </div>
      

</body>

<script>
   $(function(){
        $("#share_your_story").click(function(){
            document.getElementById('id01').style.display='block';
        })
   }); 
   $(function(){
       $("#story_submit").click(function(){
       //var id=$("#ChangeId").text();
    var fd = new FormData();
    title=$("#story_title").val();
    story=$("#story").val();
    // alert(title);
    // alert(story);
    //alert(title+descr);
    var files = $('#story_img')[0].files[0];
    if(title.length==0||story.length==0||$('#story_img').get(0).files.length === 0){
        alert("Fields cannot be empty!");
    }
    else{

    fd.append('file',files);
    fd.append('story_title',title);
    fd.append('story',story);

    $.ajax({
        url: 'story_post.php',
        type: 'POST',
        data: fd,
        contentType: false,
        processData: false,
        success: function(data){
            console.log(data);
            location.href = 'stories.php'
            //console.log(fd.get('file'));

        }
       
    });
    }
   });
});

</script>

