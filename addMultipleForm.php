<style>
.add_form_field
{
    background-color: #3c8dbc;
    border: none;
    color: white;
    padding: 8px 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border: 1px solid #186dad;

}
.delete{
   background-color: #3c8dbc;
    border: none;
    color: white;
    padding: 5px 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
    //float: right;
    border-radius: 20px;
}

@media(max-width:769px){
.delete{float: right!important;}
}
@media(max-width:480px){
.delete{float: right!important;}
}
@media(max-width:320px){
.delete{float: right!important;}
}
</style>			
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
				
    <script>
    $(document).ready(function() {
	//alert('ok');
    var max_fields1      = 5;
    var wrapper1         = $(".containerForm1"); 
    var add_button1      = $(".add_form_field1"); 
    
    var x = 1; 
    $(add_button1).click(function(e){ 
        e.preventDefault();
        if(x < max_fields1){ 
            x++; 
            $(wrapper1).append('<div><div class="box-body pad"><div class="form-group" id="textarea1"><label  class="col-lg-4 control-label">Textarea 1</label><div class="col-lg-8"><textarea class="form-control" name="Textarea_1[]" id="" rows="3" placeholder="Enter Textarea 1"></textarea></div></div><div class="form-group" id="textarea2"><label  class="col-lg-4 control-label">Textarea2</label><div class="col-lg-8"><textarea class="form-control" name="Textarea_2[]" id="" rows="3" placeholder="Enter Textarea 2"></textarea></div></div><div class="form-group" id="audioFile"><label  class="col-lg-4 control-label">Add Audio</label><div class="col-lg-8"> <input type="file" id="soundFile" accept="audio/*" class="form-control" name="m_audio[]"></div></div><div class="form-group" id="audioTxt"><label  class="col-lg-4 control-label">Audio Match Text</label><div class="col-lg-8"><textarea name="audio_match_text[]" id="" cols="66" rows="5" placeholder="Audio Match Text"></textarea></div></div><a href="#" class="delete"><i class="fa fa-remove"></i></a></div></div>'); 
	     //alert('Fields added');
        }
		else
		{
		alert('You Reached the limits')
		}
    });
    
    $(wrapper1).on("click",".delete", function(e){ 
        e.preventDefault(); $(this).parent('div').remove(); x--;
		alert('Fields removed');
    })
 });
</script>

    <fieldset id="account" class="containerForm1">
	    <span class="add_form_field1"  id="addColum">Add <span>+ </span></span>
		
	<div class="form-group" id="textarea1">
	<label  class="col-lg-4 control-label">Textarea 1</label>
	<div class="col-lg-8">
	  <textarea class="form-control" name="Textarea_1[]" id="" rows="3" placeholder="Enter Textarea 1"></textarea>
	</div>
  </div>
    <div class="form-group" id="textarea2">
	<label  class="col-lg-4 control-label">Textarea 2</label>
	<div class="col-lg-8">
	  <textarea class="form-control" name="Textarea_2[]" id="" rows="3" placeholder="Enter Textarea 2"></textarea>
	</div>
  </div>
	<div class="form-group" id="menuImg">
	<label  class="col-lg-4 control-label">Sub to Sub Menu Image</label>
	<div class="col-lg-8">
	  <input type="file" class="form-control" id="menu"  name="m_image">
	</div>
	</div>
	<div class="form-group" id="audioFile">
	<label  class="col-lg-4 control-label">Add Audio</label>
	<div class="col-lg-8">
	  <input type="file" id="soundFile" accept="audio/*" class="form-control" name="m_audio[]">
	</div>
	</div>
	<div class="form-group" id="audioTxt">
	<label  class="col-lg-4 control-label">Audio Match Text</label>
	<div class="col-lg-8">
	  <textarea name="audio_match_text[]" id="" cols="66" rows="5" placeholder="Audio Match Text"></textarea>
	</div>
	</div>
   </fieldset> 
				