<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="form-group">
                    <label  class="col-lg-4 control-label">Select Type</label>
                    <div class="col-lg-8">
                      <select name="type_name" class="form-control" onChange="showHideDiv(this.value)">
                        <option value="" selected="selected">Select type</option>
                        <option value="Type 1">Type 1</option>
                        <option value="Type 2">Type 2</option>
                        <option value="Type 3">Type 3</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group" id="word1">
                    <label  class="col-lg-4 control-label">Words 1</label>
                    <div class="col-lg-8">
                      <textarea class="form-control" name="sub_category" id="editor1" rows="3" placeholder="Enter Words"></textarea>
                    </div>
                  </div>
                  <div class="form-group" id="menuImg">
                    <label  class="col-lg-4 control-label">Words 2</label>
                    <div class="col-lg-8">
                      <textarea class="form-control" name="sub_category" id="editor1" rows="3" placeholder="Enter Words"></textarea>
                    </div>
                  </div>
                  <div class="form-group" id="audioFile">
                    <label  class="col-lg-4 control-label">Words 3</label>
                    <div class="col-lg-8">
                      <textarea class="form-control" name="sub_category" id="editor1" rows="3" placeholder="Enter Words"></textarea>
                    </div>
                  </div>

                  
                  
                  <script>
                  function showHideDiv(getType){
                    var word1 = document.getElementById('words1');
                    var menuImg = document.getElementById('menuImg');
                    var audioFile = document.getElementById('audioFile');
                    
                    
                    if(getType=="Type 1"){
                    word1.style.display='block';
                      menuImg.style.display='none';
                      audioFile.style.display='none';

                    }else if(getType=="Type 2"){
                      word1.style.display='none';
                      menuImg.style.display='block';
                      audioFile.style.display='none';
                    }
                    else if(getType=="Type 3"){
                      word1.style.display='none';
                      menuImg.style.display='none';
                      audioFile.style.display='block';
                    }else{
                        word1.style.display='none';
                      menuImg.style.display='none';
                      audioFile.style.display='none';
                    }

                  }
                  </script>
</body>
</html>