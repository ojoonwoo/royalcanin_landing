<?php
	include_once "../include/autoload.php";

	$mnv_f = new mnv_function();
	$my_db         = $mnv_f->Connect_MySQL();

	include "./head.php";

    function create_serial()
    {
        $serial = sprintf('%12d',rand(100000000000,999999999999));
        return $serial;
    }

    if ($_REQUEST['view'] == "u") {
        $query  = "SELECT * FROM data_info WHERE 1 AND idx='".$_REQUEST['idx']."' Order by idx DESC";
        $res    = mysqli_query($my_db, $query);
        $data   = mysqli_fetch_array($res);
        $serial = $data['data_serial'];

        $data_category_arr  = explode(",",$data['data_category']);
        $data_date_arr      = explode("-",$data['data_date']);
        $data_file_arr      = explode(".",$data['data_file_name2']);

        $exec_txt           = "update_data";
        $submit_txt         = "수정";
    }else{    
        $serial = create_serial();    
        $exec_txt           = "insert_data";
        $submit_txt         = "등록";
    }
?>
<script src="../lib/jquery-ui.js"></script>
<script src="../lib/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>
<script src="../lib/jQuery-File-Upload/js/jquery.iframe-transport.js"></script>
<script src="../lib/jQuery-File-Upload/js/jquery.fileupload.js"></script>
<!-- <script src="./lib/jquery.fileDownload-master/src/Scripts/jquery.fileDownload.js"></script> -->

<!-- 합쳐지고 최소화된 최신 CSS -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"> -->
<!-- 부가적인 테마 -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css"> -->
<style>
    .ui-state-default, .ui-widget-content .ui-state-default {
        border : 1px solid #c5c5c5;
    }
    .img-area img,
    .img-area video {
        display: block;
        width: 200px;
        margin-bottom: 10px;
    }
</style>
<div id="page-wrapper">
  <div class="container-fluid">
  <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">데이터 <?php echo $submit_txt?></h1>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="table-responsive">
    <table class="table table-bordered" style="width:80%">
        <tr>
            <td>* 제목</td>
            <td><input type="text" id="data_title" class="form-control" style="border:1px solid #ccc" placeholder="영상 제목을 입력해 주세요" value="<?php echo $data['data_title']?>"></td>
        </tr>
        <tr>
            <td>* 브랜드명</td>
            <td><input type="text" id="data_brand" class="form-control" style="border:1px solid #ccc" placeholder="브랜드명을 입력해 주세요" value="<?php echo $data['data_brand']?>"></td>
        </tr>
        <tr>
            <td>* 카테고리 (카테고리가 2개 이상일때 아래 카테고리를 선택해 주세요)</td>
            <td>
                <select id="data_category">
                    <option value="" <?php if($data_category_arr[0]==""){?>selected<?php }?>>선택하세요</option>
                    <option value="SHORT VIDEO" <?php if($data_category_arr[0]=="SHORT VIDEO"){?>selected<?php }?>>SHORT VIDEO</option>
                    <option value="IMAGE" <?php if($data_category_arr[0]=="IMAGE"){?>selected<?php }?>>IMAGE</option>
                    <option value="FOOD & DRINKS" <?php if($data_category_arr[0]=="FOOD & DRINKS"){?>selected<?php }?>>FOOD & DRINKS</option>
                    <option value="COSMETICS" <?php if($data_category_arr[0]=="COSMETICS"){?>selected<?php }?>>COSMETICS</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>카테고리2</td>
            <td>
                <select id="data_category2">
                    <option value="" <?php if($data_category_arr[1]==""){?>selected<?php }?>>선택하세요</option>
                    <option value="SHORT VIDEO" <?php if($data_category_arr[1]=="SHORT VIDEO"){?>selected<?php }?>>SHORT VIDEO</option>
                    <option value="IMAGE" <?php if($data_category_arr[1]=="IMAGE"){?>selected<?php }?>>IMAGE</option>
                    <option value="FOOD & DRINKS" <?php if($data_category_arr[1]=="FOOD & DRINKS"){?>selected<?php }?>>FOOD & DRINKS</option>
                    <option value="COSMETICS" <?php if($data_category_arr[1]=="COSMETICS"){?>selected<?php }?>>COSMETICS</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>카테고리3</td>
            <td>
                <select id="data_category3">
                    <option value="" <?php if($data_category_arr[2]==""){?>selected<?php }?>>선택하세요</option>
                    <option value="SHORT VIDEO" <?php if($data_category_arr[2]=="SHORT VIDEO"){?>selected<?php }?>>SHORT VIDEO</option>
                    <option value="IMAGE" <?php if($data_category_arr[2]=="IMAGE"){?>selected<?php }?>>IMAGE</option>
                    <option value="FOOD & DRINKS" <?php if($data_category_arr[2]=="FOOD & DRINKS"){?>selected<?php }?>>FOOD & DRINKS</option>
                    <option value="COSMETICS" <?php if($data_category_arr[2]=="COSMETICS"){?>selected<?php }?>>COSMETICS</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>카테고리4</td>
            <td>
                <select id="data_category4">
                    <option value="" <?php if($data_category_arr[3]==""){?>selected<?php }?>>선택하세요</option>
                    <option value="SHORT VIDEO" <?php if($data_category_arr[3]=="SHORT VIDEO"){?>selected<?php }?>>SHORT VIDEO</option>
                    <option value="IMAGE" <?php if($data_category_arr[3]=="IMAGE"){?>selected<?php }?>>IMAGE</option>
                    <option value="FOOD & DRINKS" <?php if($data_category_arr[3]=="FOOD & DRINKS"){?>selected<?php }?>>FOOD & DRINKS</option>
                    <option value="COSMETICS" <?php if($data_category_arr[3]=="COSMETICS"){?>selected<?php }?>>COSMETICS</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>* 데이터 업로드</td>
            <td>
                <div class="file-upload">
                    <label for="fileUp" class="upload-label">이미지업로드</label>
                    <input type="file" name="files[]" data-url="../Upload.php?fid=<?php echo $serial?>" accept="image/*" id="fileUp">
                    <div class="img-area">
                    <?php
                        if ($data['data_file_name']){
                    ?>                
                        <img id="img-preview" src="../uploads/<?php echo $data['data_serial']?>/<?php echo $data['data_file_name']?>" alt="">
                    <?php
                        } else {
                    ?>
                        <img id="img-preview" src="" alt="">
                    <?php
                        }
                    ?>
                    </div>
                </div>
                <hr>
                <div class="video-upload">
                    <label for="long-video-chk" class="upload-label">영상업로드</label>
                    <input type="file" name="files[]" data-url="../Upload.php?fid=<?php echo $serial?>" accept="video/*" id="fileUp2">
                    <div class="img-area">
                    <?php
                        if($data['data_file_name2']) {
                    ?>					
                        <video id="vid-preview" autoplay loop muted playsinline class="video-autoplay">
                            <source src="../uploads/<?php echo $data['data_serial']?>/<?php echo $data['data_file_name2']?>?v=<?php echo time()?>" type="video/mp4">
                        </video>					
                    <?php
                        } else {
                    ?>			
                        <video id="vid-preview" src="" autoplay loop muted playsinline class="video-autoplay"></video>
                    <?php
                        }
                    ?>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>데이터 설명</td>
            <td>
                <textarea name="" id="data_desc" class="form-control" rows="10"><?php echo $data['data_desc']?></textarea>
            </td>
        </tr>
        <tr>
            <td>* 제작월</td>
            <!-- <td><input type="text" id="video_date" class="form-control" style="border:1px solid #ccc" placeholder="영상 등록일을 예제와 같은 형식으로 입력해 주세요. ex)2017-11"></td> -->
            <td>
                <select id="rdate_year">
<?
    $i = 2020;
    while ($i > 2000)
    {
?>                    
                    <option value="<?=$i?>" <?php if($data_date_arr[0] == $i){?>selected<?php }?>><?=$i?></option>
<?  
        $i--;
    }
?>                    
                </select>
                <select id="rdate_day">
<?
    $j = 1;
    while ($j < 32)
    {
        if ($j < 10)
            $day_val    = "0".$j;
        else
            $day_val    = $j;
?>                    
                    <option value="<?=$day_val?>" <?php if($data_date_arr[1] == $day_val){?>selected<?php }?>><?=$j?></option>
<?  
        $j++;
    }
?>                    
                </select>
            </td>
        </tr>
        <tr>
            <td>노출 여부 선택</td>
            <td>
                <select id="showYN" class="form-control">
                    <option value="Y" <?php if($data['showYN'] == "Y"){?>selected<?php }?>>노출</option>
                    <option value="N" <?php if($data['showYN'] == "N"){?>selected<?php }?>>비노출</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="button" class="btn btn-success"><?php echo $submit_txt?></button>
            </td>
        </tr>
    </table>    
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
</body>

</html>



<script type="text/javascript">

var data_file_name = "<?php echo $data['data_file_name']?>";
var data_file_name2 = "<?php echo $data['data_file_name2']?>";

$(function () {
    // var url = $('.fileUpload').data('url');
    $('#fileUp, #fileUp2').fileupload({
        // url: url,
        dataType: 'json',
        autoUpload: true,
        // acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png|mp4)$/i,
        maxFileSize: 20000000,
        // imageMaxWidth: 1920,
        disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
    }).on('fileuploadadd', function (e, data) {
        // $('.fileupload-layer').removeClass('is-show');
        // $('#next-step').removeClass('is-active');
        console.log('fileuploadadd');
        // console.log('loading...');
        // $('.loading-layer').show();
    }).on('fileuploadprocessalways', function (e, data) {
        // console.log('processalways');
    }).on('fileuploadprogressall', function (e, data) {
        // console.log('fileuploadprogressall');
    }).on('fileuploaddone', function (e, data) {
        console.log(data.result.files[0]);
        // data_file_name = data.result.files[0].name;
        var timestamp = new Date().getTime();
        // if (data.result.files[0].type == "video/mp4")
        //     $(".img-area").html("<video autoplay loop muted playsinline class='video-autoplay' style='width:300px;'><source src='../uploads/<?=$serial?>/"+data_file_name+"?v="+timestamp+"' type='video/mp4'></video>");
        // else
        //     $(".img-area").html("<img src='../uploads/<?=$serial?>/"+data_file_name+"?v="+timestamp+"' style='width:300px;height:300px'>");
        if(e.target.id === 'fileUp') {
            data_file_name = data.result.files[0].name;
            $("#img-preview").attr("src", "../uploads/<?=$serial?>/"+data_file_name);
        } else if (e.target.id === 'fileUp2') {
            data_file_name2 = data.result.files[0].name;
            $("#vid-preview").attr("src", "../uploads/<?=$serial?>/"+data_file_name2+"?v="+timestamp);
        } else {
            return;
        }
        $(".img-area").show();

    }).on('fileuploadfail', function (e, data) {
        // console.log('fail');
        // console.log(data);
        alert('이미지파일을 올려주세요');
    });

    $(".btn-success").on("click", function(){
        var data_title 		= $("#data_title").val();
        var data_brand 		= $("#data_brand").val();
        var data_category 	= $("#data_category").val();
        var data_category2 	= $("#data_category2").val();
        var data_category3 	= $("#data_category3").val();
        var data_category4 	= $("#data_category4").val();
        var data_desc 		= $("#data_desc").val();
        var data_date 		= $("#rdate_year").val() + "-" + $("#rdate_day").val();
        var showYN 			= $("#showYN").val();
        var data_category_txt = data_category;
        if (data_category2 != "") {
            data_category_txt = data_category+","+data_category2;
        }
        if (data_category3 != "") {
            data_category_txt = data_category_txt+","+data_category3;
        }
        if (data_category4 != "") {
            data_category_txt = data_category_txt+","+data_category4;
        }
        if (data_title == "")
        {
            alert("제목을 입력해 주세요.");
            return false;
        }

        if (data_brand == "")
        {
            alert("브랜드명을 입력해 주세요.");
            return false;
        }

        if (data_category == "")
        {
            alert("카테고리를 입력해 주세요.");
            return false;
        }

        if (data_file_name == "")
        {
            alert("파일을 업로드해 주세요.");
            return false;
        }

        if (data_date == "")
        {
            alert("제작일을 입력해 주세요.");
            return false;
        }

        $.ajax({
            type   : "POST",
            async  : false,
            url    : "../main_exec.php",
            data:{
                "exec"				  : "<?php echo $exec_txt?>",
                "data_title"		  : data_title,
                "data_brand"		  : data_brand,
                "data_category"		  : data_category_txt,
                "data_desc"           : data_desc,
                "data_date"		      : data_date,
                "data_file_name"      : data_file_name,
                "data_file_name2"     : data_file_name2,
                "data_serial"         : '<?=$serial?>',
                "showYN"			  : showYN
            },
            success: function(response){
                console.log(response);
                if (response.match("Y") == "Y")
                {
                    alert("데이터가 <?php echo $submit_txt?> 되었습니다.");
                    location.href = "data_list.php";
                }else{
                    alert("다시 <?php echo $submit_txt?>해 주세요.");
                    location.reload();
                }
            }
        });			

    });

});
	


</script>
