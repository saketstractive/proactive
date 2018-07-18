<link href="//vjs.zencdn.net/5.11/video-js.min.css" rel="stylesheet">
<script src="//vjs.zencdn.net/5.11/video.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/videojs-youtube/2.3.2/Youtube.min.js"></script>

<?php
  $url = "";
  $title = "";
  $desc = "";
  foreach ($video_data as $value) {
    $title = $value["video_title"];
    $desc = $value["video_desc"];
    $url = $value["video_url"];
  }
?>

<div class="row">
    <div class="col-md-12">

      <div class="panel panel-default">
        <div class="panel-heading"><span class="text-primary"><i class="fa fa-play-circle"></i> <?php echo $title; ?></span></div>
        <div class="panel-body">
            <video
              id="vid1"
              class="video-js vjs-default-skin"
              autoplay
              width="800" height="400"
              data-setup='{ "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "<?php echo $url; ?>"}], "youtube": { "ytControls": 2 } }'
            >
            </video>

            <?php
                if ($desc !== "") {
            ?>

                <div class="m-t-b-30">
                    <?php echo $desc; ?>
                </div>

            <?php
                }
             ?>

        </div>
      </div>
    </div>
</div>
