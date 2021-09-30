$(document).ready(function () {
var SkillID = [];
var SkillName = [];
$("input[name='skill_ids']").change(function() {
 //   alert(tmp);
  var checked =$(this).val();
  var div="<div class='demoSkills'>"+($(this).attr('data-name'))+"<a class='x-box' onclick='removeSkills(`"+$(this).attr('data-name')+"`,`"+$(this).val()+"`)'>x</a></div>";
  var name ={id:checked,name:div};
    if ($(this).is(':checked')) {
      SkillID.push(checked);
      SkillName.push(name);
    }else{
    SkillID.splice($.inArray(checked, SkillID),1);
    SkillName.splice($.inArray(name, SkillName),1);
    }
    localStorage.setItem("SkillID",SkillID);
  });
$('#save-skills').on('click', function () {

var inputSkills='<input type="text" class="form-control" id="InputSkills" name="skills[]" placeholder="Please select your skills" disabled>';
if (Array.isArray(SkillName) && SkillName.length) {
    var skillDiv=[];
for(let i=0; i<SkillName.length; i++)
{
     skillDiv[i]=SkillName[i].name;
}
  document.getElementById("InputSkillss").innerHTML=skillDiv.join(" ");

  console.log('skil',SkillName[0].name)
}
else{
document.getElementById("InputSkillss").innerHTML=inputSkills;
$("#InputSkillss").css('background', '#fffff');
$("#InputSkillss").css('padding', '0px');
}

$("#InputSkillss").css('background', '#f7f7f7');
$("#InputSkillss").css('padding', '5px');
$('#skill-section').modal('hide'); 
  });
  
$("#step-2-register").click(function (e) { 

e.preventDefault();
   var name=$("#InputFullName").val();
   var activity_area=$("#InputActivity").val();
   var company_name=$("#InputCompanyName").val();
   var company_url=$("#InputCompanyUrl").val();
   var occupation=$("#InputOccupation").val();
   var job_history=$("#InputBriefJobHistory").val();
 
   $.ajax({
                    url:'ajax/save-step-2.php',
                    method:'POST',
                    data:{
                        name:name,
                        activity_area:activity_area,
                        company_name:company_name,
                        company_url:company_url,
                        occupation:occupation,
                        job_history:job_history,
                        skills:SkillID
                    },
                  success:function(data){
                    if(data=="success")
                      { 
                          $.toast({
            heading: 'Dear User',
            text: "Data Saved Successfully.",
            position: 'top-right',
            loaderBg: '#0000',
            bgColor:'#FF3A99',
            icon: 'success',
            textColor: '#FFFF',
            hideAfter: 3000,
            stack: 6
          });
          var delay = 2000; 
        var url = 'profile-registration-step-2.php'
        setTimeout(function(){ window.location = url; }, delay);
        }
}
});
}); 

});
  
 function removeSkills(name,id)
{
    var SkillID=localStorage.getItem("SkillID");
    alert(SkillID);
    SkillID.splice($.inArray(id, SkillID),1);
    alert(SkillID)
} 

function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
            $("#previewImg").attr("src", reader.result);
             const data = reader.result.replace("data:", "").replace(/^.+,/, "");
                
              var jsonData = JSON.stringify({"data": data});
                 $.ajax({
                     type: "POST",
                     url: "web-api/user/update-user-profile-picture.php",
                     data: jsonData,
                     dataType: "json",
                     contentType: "application/json",
                     success: function (response) {
                    if(response.success==1)
                    {
                       
                    }
                   
                }
        });  
               
               
               
               
               
            }
             

            reader.readAsDataURL(file);
        }
    }














$(document).ready(function(){
$('.filter').hide('1000');
    $(".filter-button").click(function(){
       
        
        var value = $(this).attr('data-filter');
        
        if(value == "all")
        {
             $('#onskill-hide').hide();
        }
        else
        {
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');
            $('#onskill-hide').hide();
            
        }
    });
    
    if ($(".filter-button").removeClass("active")) {
$(this).removeClass("active");
}
$(this).addClass("active");

});
